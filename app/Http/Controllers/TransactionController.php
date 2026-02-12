<?php

namespace App\Http\Controllers;

use App\Jobs\TransactionJob;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with('account.customer')
            ->latest()
            ->paginate(20);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Queue SOA sending with delay
     */

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $accounts = Account::with('customer')
            ->where('status', 'active')
            ->get();

        return view('transactions.create', compact('accounts'));
    }

    /**
     * Store a newly created transaction in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'account_id' => 'required|exists:accounts,id',
        'transaction_number' => 'required|string|unique:transactions',
        'type' => 'required|in:disbursement,payment',
        'amount' => 'required|numeric|min:0',
        'transaction_date' => 'required|date',
        'payment_method' => 'nullable|string',
        'reference_number' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $transaction = DB::transaction(function () use ($validated) {
        $account = Account::findOrFail($validated['account_id']);

        if ($validated['type'] === 'disbursement') {
            $newBalance = $account->balance + $validated['amount'];
        } else {
            $newBalance = $account->balance - $validated['amount'];
        }

        $transaction = Transaction::create([
            'account_id' => $validated['account_id'],
            'transaction_number' => $validated['transaction_number'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'transaction_date' => $validated['transaction_date'],
            'balance_after' => $newBalance,
            'payment_method' => $validated['payment_method'] ?? null,
            'reference_number' => $validated['reference_number'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'processed_by' => Auth::id(),
        ]);

        $account->balance = $newBalance;

        if ($newBalance <= 0) {
            $account->status = 'paid';
        }

        $account->save();

        return $transaction; // important
    });

    // Dispatch job
    TransactionJob::dispatch($transaction->account_id);

    return redirect()->route('transactions.index')
        ->with('success', 'Transaction created successfully and info sent.');
}


    public function show(Transaction $transaction)
    {
        $transaction->load('account.customer', 'processedBy');
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $accounts = Account::with('customer')->get();
        return view('transactions.edit', compact('transaction', 'accounts'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'payment_method' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $account = $transaction->account;

            if ($transaction->type === 'disbursement') {
                $account->balance -= $transaction->amount;
            } else {
                $account->balance += $transaction->amount;
            }

            if ($account->balance > 0 && $account->status === 'paid') {
                $account->status = 'active';
            }

            $account->save();
            $transaction->delete();
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}

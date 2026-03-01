<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2000'
        ]);

        $month = $request->month;
        $year = $request->year;

        $transactions = Transaction::with('account.customer')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year)
            ->get()
            ->groupBy('account_id');

        $reportData = [];

        foreach ($transactions as $accountId => $accountTransactions) {

            $account = $accountTransactions->first()->account;

            $disbursements = $accountTransactions
                ->where('type', 'disbursement')
                ->sum('amount');

            $payments = $accountTransactions
                ->where('type', 'payment')
                ->sum('amount');

            $reportData[] = [
                'client_name' => $account->customer->name,
                'account_number' => $account->account_number,
                'disbursements' => $disbursements,
                'payments' => $payments,
            ];
        }

        $totalDisbursements = collect($reportData)->sum('disbursements');
        $totalPayments = collect($reportData)->sum('payments');

        return view('reports.monthly', compact(
            'reportData',
            'totalDisbursements',
            'totalPayments',
            'month',
            'year'
        ));
    }
}

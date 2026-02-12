<?php

namespace App\Jobs;

use App\Mail\TransactionMail;
use App\Models\Account;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class transactionJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;
    public int $timeout = 120;
    protected int $accountId;

    public function __construct(int $accountId)
    {
        $this->accountId = $accountId;
    }

    public function handle(): void
    {
        $account = Account::with(['customer', 'transactions' => function ($q) {
            $q->latest()->limit(1); // get latest transaction only
        }])->find($this->accountId);

        if (!$account || !$account->customer || !$account->customer->email) {
            Log::warning("Skipping Account ID {$this->accountId} — invalid email.");
            return;
        }

        $latestTransaction = $account->transactions->first();

        if (!$latestTransaction) {
            Log::warning("Skipping Account ID {$this->accountId} — no transactions found.");
            return;
        }

        Mail::to($account->customer->email)
            ->send(new TransactionMail($account->transactions->first()));

        Log::info("SOA email SENT to {$account->customer->email} (Latest Transaction ID: {$latestTransaction->id})");
    }
}

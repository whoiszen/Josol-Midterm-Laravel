<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class ManagementController extends Controller
{
    public function soaGeneration()
    {
        $accounts = $this->getAccountsForSOA();

        return view('soa.index',[
            'accounts' => $accounts
        ]);
    }

    public function generateAllSOAs()
    {
        $accounts = $this->getAccountsForSOA();

        foreach ($accounts as $account) {
        
            

            \Log::info("Generating SOA for Account ID: {$account->id}, Account Number: {$account->account_number}");
        }

        return redirect()->route('soa.index')->with('status', 'All SOAs have been generated successfully.');
    }

    private function getAccountsForSOA()
    {
        return Account::whereDay('start_date', 23)->get();
        // return Account::whereDay('start_date', now()->day)->get();
    }
}

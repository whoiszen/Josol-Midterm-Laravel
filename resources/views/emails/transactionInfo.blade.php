<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Information</title>
</head>
<body>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-lg font-semibold">Transaction Information</h3>
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                            {{ $transaction->type === 'disbursement' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Transaction Number</p>
                            <p class="font-semibold text-lg">{{ $transaction->transaction_number }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Transaction Date</p>
                            <p class="font-semibold">{{ $transaction->transaction_date->format('F d, Y') }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Amount</p>
                            <p class="font-semibold text-2xl {{ $transaction->type === 'disbursement' ? 'text-red-600' : 'text-green-600' }}">
                                {{ $transaction->type === 'disbursement' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Balance After Transaction</p>
                            <p class="font-semibold text-lg">₱{{ number_format($transaction->balance_after, 2) }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Account</p>
                            <p class="font-semibold">
                                <a href="{{ route('accounts.show', $transaction->account) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    {{ $transaction->account->account_number }}
                                </a>
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Customer</p>
                            <p class="font-semibold">
                                <a href="{{ route('customers.show', $transaction->account->customer) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    {{ $transaction->account->customer->name }}
                                </a>
                            </p>
                        </div>

                        @if($transaction->type === 'payment')
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Payment Method</p>
                                <p class="font-semibold">{{ $transaction->payment_method ? ucfirst($transaction->payment_method) : 'N/A' }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Reference Number</p>
                                <p class="font-semibold">{{ $transaction->reference_number ?? 'N/A' }}</p>
                            </div>
                        @endif

                        @if($transaction->processedBy)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Processed By</p>
                                <p class="font-semibold">{{ $transaction->processedBy->name }}</p>
                            </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Created At</p>
                            <p class="font-semibold">{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
                        </div>

                        @if($transaction->notes)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Notes</p>
                                <p class="font-semibold">{{ $transaction->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Statement of Account</title>

<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
        padding: 30px;
        margin: 0;
    }

    .card {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
        max-width: 900px;
        margin: auto;
    }

    .header {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 2px solid #eef2ff;
        margin-bottom: 25px;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        background: linear-gradient(to right, #4f46e5, #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 5px;
    }

    .subtitle {
        font-size: 13px;
        color: #6b7280;
        margin: 2px 0;
    }

    .section-title {
        margin-top: 25px;
        font-weight: bold;
        font-size: 15px;
        color: #374151;
        padding-bottom: 6px;
        border-bottom: 2px solid #e5e7eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }

    th {
        background: #f3f4f6;
        padding: 10px;
        text-align: left;
        font-weight: 600;
        border: 1px solid #e5e7eb;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 10px;
        border: 1px solid #e5e7eb;
        color: #374151;
    }

    tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    .text-right {
        text-align: right;
    }

    .info-table td:first-child {
        width: 40%;
        background: #f9fafb;
        font-weight: 600;
    }

    .balance-box {
        margin-top: 25px;
        background: linear-gradient(to right, #4f46e5, #6366f1);
        padding: 18px;
        border-radius: 10px;
        color: white;
        text-align: right;
        font-size: 16px;
        font-weight: bold;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        background: #e0e7ff;
        color: #4338ca;
    }

    .footer {
        margin-top: 40px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
        text-align: center;
        font-size: 10px;
        color: #9ca3af;
    }

</style>
</head>

<body>

<div class="card">

    <div class="header">
        <div class="title">LendingHub</div>
        <div class="subtitle">Statement of Account</div>
        <div class="subtitle">Generated on {{ \Carbon\Carbon::now()->format('F d, Y') }}</div>
    </div>

    <div class="section-title">Account Information</div>
    <table class="info-table">
        <tr>
            <td>Customer Name</td>
            <td>{{ $account->customer->name }}</td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td>{{ $account->account_number }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <span class="status-badge">
                    {{ ucfirst($account->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <td>Principal Amount</td>
            <td>₱{{ number_format($account->principal_amount, 2) }}</td>
        </tr>
        <tr>
            <td>Current Balance</td>
            <td><strong>₱{{ number_format($account->balance, 2) }}</strong></td>
        </tr>
    </table>

    <div class="section-title">Transaction History</div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Transaction #</th>
                <th>Type</th>
                <th class="text-right">Amount</th>
                <th class="text-right">Balance After</th>
            </tr>
        </thead>
        <tbody>
            @foreach($account->transactions as $transaction)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y') }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td class="text-right">₱{{ number_format($transaction->amount, 2) }}</td>
                    <td class="text-right">₱{{ number_format($transaction->balance_after, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="balance-box">
        Total Outstanding Balance: ₱{{ number_format($account->balance, 2) }}
    </div>

    <div class="footer">
        This is a system-generated statement. For inquiries, please contact LendingHub Support.<br>
        © {{ date('Y') }} LendingHub. All rights reserved.
    </div>

</div>

</body>
</html>

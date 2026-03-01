<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Monthly Report - {{ date('F', mktime(0,0,0,$month,1)) }} {{ $year }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('reports.index') }}"
                 class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                ← Back to Report Filter
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left">Client Name</th>
                                <th class="px-6 py-3 text-left">Account #</th>
                                <th class="px-6 py-3 text-left">Disbursements</th>
                                <th class="px-6 py-3 text-left">Payments</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach($reportData as $row)
                                <tr>
                                    <td class="px-6 py-4">{{ $row['client_name'] }}</td>
                                    <td class="px-6 py-4">{{ $row['account_number'] }}</td>
                                    <td class="px-6 py-4 text-red-600">
                                        ₱{{ number_format($row['disbursements'],2) }}
                                    </td>
                                    <td class="px-6 py-4 text-green-600">
                                        ₱{{ number_format($row['payments'],2) }}
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Totals Row -->
                            <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                                <td colspan="2" class="px-6 py-4 text-right">
                                    TOTAL
                                </td>
                                <td class="px-6 py-4 text-red-600">
                                    ₱{{ number_format($totalDisbursements,2) }}
                                </td>
                                <td class="px-6 py-4 text-green-600">
                                    ₱{{ number_format($totalPayments,2) }}
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

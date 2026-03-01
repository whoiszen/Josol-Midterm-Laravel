<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Monthly Transaction Reports
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('reports.generate') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium">Month</label>
                            <select name="month" class="w-full mt-1 border rounded-md p-2">
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Year</label>
                            <input type="number" name="year"
                                   value="{{ now()->year }}"
                                   class="w-full mt-1 border rounded-md p-2">
                        </div>

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Generate Report
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4 p-4">
                    <div class="flex justify-between">
                        <a
                            href="#"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >
                            Export to csv
                        </a>
                    </div>
                </div>
                <div class="m-4 p-4">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-start">
                                    Product type
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Product value
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Creation date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $report->loanType }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $report->value }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $report->createdAt }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

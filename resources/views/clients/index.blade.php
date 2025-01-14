<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clients
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4 p-4">
                    <div class="flex justify-between">
                        <a
                            href="{{ route('dashboard') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >
                            Go to Dashboard
                        </a>

                        <a
                            href="{{ route('clients.create') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >
                            Create Client
                        </a>
                    </div>
                </div>
                <div class="m-4 p-4">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-start">
                                    First Name
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Last Name
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Phone
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Cash Loan
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Home Loan
                                </th>
                                <th class="px-6 py-3 text-start">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $client->firstName }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $client->lastName }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $client->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $client->phone }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $client->hasAppliedForCashLoan ? 'yes': 'no' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $client->hasAppliedForHomeLoan ? 'yes': 'no' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a
                                            href="{{ route('clients.edit', $client->id) }}"
                                            class="hover:bg-gray-100 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        >
                                            Edit
                                        </a>

                                        <button
                                            class="hover:bg-gray-100 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'delete-client-{{ $client->id }}')"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @include('clients.partials.client-delete-form')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

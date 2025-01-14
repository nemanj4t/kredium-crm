<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clients - Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex m-4 p-4">
                    <a
                        href="{{ route('clients.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Go to Clients
                    </a>
                </div>
                <div class="p-4 m-4 shadow-sm sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('clients.partials.client-basic-info-form', ['edit' => true])
                    </div>
                </div>
                <div class="p-4 m-4 shadow-sm sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('clients.partials.client-cash-loan-form')
                    </div>
                </div>
                <div class="p-4 m-4 shadow-sm sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('clients.partials.client-home-loan-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

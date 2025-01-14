<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Home Loan
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Issue home loan
        </p>
    </header>

    <form method="post" action="{{ route('clients.home-loan', $client) }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="property_value" value="Property Value" />
            <x-text-input id="property_value" name="property_value" type="number" step="0.01" class="mt-1 block w-full" :value="old('property_value', $client?->homeLoan?->homeLoan->property_value ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('property_value')" />
        </div>

        <div>
            <x-input-label for="down_payment_amount" value="Down Payment Amount" />
            <x-text-input id="down_payment_amount" name="down_payment_amount" step="0.01" type="number" class="mt-1 block w-full" :value="old('down_payment_amount', $client?->homeLoan?->homeLoan->down_payment_amount ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('down_payment_amount')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</section>

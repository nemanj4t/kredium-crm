<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Cash Loan
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Issue cash loan
        </p>
    </header>

    <form method="post" action="{{ route('clients.cash-loan', $client) }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="amount" value="Amount" />
            <x-text-input id="amount" name="amount" type="number" step=0.01 class="mt-1 block w-full" :value="old('amount', $client?->cashLoan?->cashLoan->amount ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</section>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Basic Info
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Basic client information
        </p>
    </header>

    <form method="post" action="{{ $edit ? route('clients.update', $client) : route('clients.store') }}" class="mt-6 space-y-6">
        @csrf

        @if($edit)
            @method('put')
        @endif

        <div>
            <x-input-label for="first_name" value="First Name" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $edit ? $client->first_name : '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" value="Last Name" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $edit ? $client->last_name: '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $edit ? $client->email : '')"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" value="Phone" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $edit ? $client->phone : '')" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</section>

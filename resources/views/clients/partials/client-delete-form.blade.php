<x-modal name="delete-client-{{ $client->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('clients.destroy', $client->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Delete {{ $client->firstName }}?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once you delete this client, all its data will be removed!
            </p>

            <div class="mt-6 py-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Delete
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>

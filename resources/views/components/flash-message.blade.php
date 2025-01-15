@props(['type' => 'info'])

@php
    $classes = [
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error' => 'bg-red-100 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
        'info' => 'bg-blue-100 border-blue-500 text-blue-700',
    ];
@endphp

@if(session($type))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 2000)"
        x-show="show"
        class="fixed bottom-4 right-4 z-50 p-4 mb-4 text-sm border-l-4 rounded shadow-lg {{ $classes[$type] }}"
        role="alert"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4"
    >
        <div class="flex justify-between">
            <div>
                <strong>{{ ucfirst($type) }}:</strong> {{ session($type) }}
            </div>
            <button
                @click="show = false"
                class="ml-2 text-current hover:opacity-75 focus:outline-none"
            >
                &times;
            </button>
        </div>
    </div>
@endif

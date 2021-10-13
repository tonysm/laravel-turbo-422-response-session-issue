<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Show Post #:id', ['id' => $post->id]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <h1 class="text-3xl font-semibold">{{ $post->title }}</h1>

                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

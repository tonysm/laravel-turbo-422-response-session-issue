<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf

                        <div>
                            <x-jet-label for="title" value="{{ __('Title') }}" />
                            <x-jet-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" autofocus />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="content" value="{{ __('Content') }}" />
                            <x-jet-input id="content" class="block w-full mt-1" type="text" name="content" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('dashboard') }}">
                                {{ __('Cancel') }}
                            </a>

                            <x-jet-button dusk="create-posts-button" class="ml-4">
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

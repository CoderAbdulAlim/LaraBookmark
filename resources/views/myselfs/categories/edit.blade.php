<x-app-layout>
    @auth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category::Update Form') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('categories') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Back to Category List') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>
    @endauth

    @auth
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black border-b dark:bg-gray-400 dark:border-gray-700">

                    <!-- Category Form START -->
                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Category Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category Description -->
                        <div class="mt-5">
                            <x-input-label for="description" :value="__('Description')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="description">{{ $category->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>


                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-5">
                            <x-primary-button class="ms-4 bg-black text-white">
                                {{ __('Update Category') }}
                            </x-primary-button>
                        </div>

                    </form>
                    <!-- Category Form END -->

                </div>
            </div>
        </div>
    </div>
    @endauth
</x-app-layout>
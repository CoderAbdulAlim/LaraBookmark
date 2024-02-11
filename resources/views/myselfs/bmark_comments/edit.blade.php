<x-app-layout>
    @auth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments::Update Form') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('comments') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Back to Comment List') }}
                </x-primary-button>
            </a>
            <a href="{{ route('topics') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Back to Topic List') }}
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

                    <!-- Comment Form START -->
                    <form method="POST" action="{{ route('comments.update', $comment) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Comment content -->
                        <div>
                            <x-input-label for="content" :value="__('Comment')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="$comment->content" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>


                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-5">
                            <x-primary-button class="ms-4 bg-black text-white">
                                {{ __('Update Comment') }}
                            </x-primary-button>
                        </div>

                    </form>
                    <!-- Comment Form END -->

                </div>
            </div>
        </div>
    </div>
    @endauth
</x-app-layout>
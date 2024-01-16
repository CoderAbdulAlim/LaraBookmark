<x-app-layout>
    @auth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comment::New Form') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('comments') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Back to Comment List') }}
                </x-primary-button>
            </a>
            <a href="{{ route('posts') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Back to Post List') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>
    @endauth

    @auth
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-black border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <!-- Comment Form START -->
                    <form method="POST" action="{{ route('comments.store', $post) }}">
                        @csrf

                        <div>
                            {{ 'Comment of :: ' . $post->id . ' # ' .  $post->title}}
                        </div>
                        <!-- Comment content -->
                        <div class="mt-5">
                            <x-input-label for="content" :value="__('Comment')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <textarea id="content" name="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="content">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Hidden Input for Post ID -->
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-5">
                            <x-primary-button class="ms-4 bg-white text-black">
                                {{ __('Submit New Comment') }}
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Full Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Blog Show START -->
                    <h2 class="text-4xl font-extrabold dark:text-white">{{ $post->title }}</h2>
                    <p class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $post->content }}</p>
                    <p class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                        @foreach($post->tags as $tag)
                        <a href="#" class="inline-flex items-center text-lg text-blue-600 dark:text-blue-500 hover:underline">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </p>
                    <a href="{{route('myboard.mycomments.create', $post)}}" class="inline-flex items-center text-lg text-blue-600 dark:text-blue-500 hover:underline">
                        Write a comment
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    <div class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                        @foreach($post->comments as $comment)
                        <p class="inline-flex items-center text-lg text-gray-500 dark:text-gray-400">
                            {{ $comment->aphorism }}
                        </p>
                        @endforeach
                    </div>
                    <!-- Blog Show END -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
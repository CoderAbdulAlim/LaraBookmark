<x-app-layout>
    @auth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post::New Form') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
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

                    <!-- Post Form START -->
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf

                        <!-- Post Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Post Content -->
                        <div class="mt-5">
                            <x-input-label for="content" :value="__('Content')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <textarea id="content" name="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="content">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Post Category -->
                        <div class="mt-5">
                            <x-input-label for="category_id" :value="__('Category')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Post Tag -->
                        <div class="mt-5">
                            <x-input-label for="tag_id" :value="__('Tag')" class="text-gray-900 whitespace-nowrap dark:text-white" />
                            <select id="tag_id" name="tag_ids[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" multiple>
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}" {{ in_array($tag->id, old('tag_ids', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tag_id')" class="mt-2" />
                        </div>


                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-5">
                            <x-primary-button class="ms-4 bg-white text-black">
                                {{ __('Submit New Post') }}
                            </x-primary-button>
                        </div>


                    </form>
                    <!-- Post Form END -->

                </div>
            </div>
        </div>
    </div>
    @endauth
    <script>
        new TomSelect("#tag_id", {
            maxItems: 20
        });
    </script>
</x-app-layout>
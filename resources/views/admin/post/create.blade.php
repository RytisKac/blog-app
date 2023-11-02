<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new post') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{route('admin.post.store')}}" enctype="multipart/form-data" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input name="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" placeholder="Title"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input name="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required  autocomplete="slug" placeholder="Slug"/>
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="excerpt" :value="__('Excerpt')" />
            <x-text-input name="excerpt" class="block mt-1 w-full" type="text" name="excerpt" :value="old('excerpt')" required  autocomplete="excerpt" placeholder="Excerpt"/>
            <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="content" :value="__('Content')" />
            <textarea name="content" rows="4" required value="{{old('content')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your content here..."></textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="image" :value="__('Image')"/>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" type="file">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="tags" :value="__('Tags')" />
            <x-text-input name="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')" required  autocomplete="tags" placeholder="Tags (separate by comma)"/>
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
        </div>
        <div>
            <x-primary-button>
                {{ __('Save post') }}
            </x-primary-button>
        </div>
    </form>
</x-admin-layout>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new category') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{route('admin.category.store')}}" enctype="multipart/form-data" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input name="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input name="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required  autocomplete="slug" placeholder="slug"/>
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input name="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required  autocomplete="description" placeholder="description"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div>
            <x-primary-button>
                {{ __('Save category') }}
            </x-primary-button>
        </div>
    </form>
</x-admin-layout>

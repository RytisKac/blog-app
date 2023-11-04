<x-app-layout :categories="$categories">
    <x-header>
        <x-slot name="title">
            Minimal blog template for creative expressions
        </x-slot>
        100% customisable and SEO-friendly blog template for personal and commercial purposes.
    </x-header>
    <div class="bg-gray-200">
        <div class="max-w-4xl mx-auto flex flex-col gap-4 py-4 px-4">
            @foreach ($posts as $post)
                <x-post-card :post="$post"/>
            @endforeach
        </div>
    </div>
</x-app-layout>

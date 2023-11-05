<x-admin-layout>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
        <div>
            <x-nav-link href="{{route('admin.post.create')}}">
                Create Post
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-4 flex-wrap">
                    @forelse($posts as $post)
                        <x-admin.post-card :post="$post"/>
                    @empty
                        <p>No posts yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

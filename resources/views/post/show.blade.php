<x-app-layout>
    <x-header>
        <x-slot name="title">
            {{$post->title}}
        </x-slot>
        {{$post->excerpt}}
        <p class="text-gray-500 font-bold">{{$post->updated_at}}</p>
    </x-header>
    <div class="bg-gray-100">
        <div class="px-4">
            <img src="{{asset($post->image)}}" class="max-w-5xl w-full mx-auto rounded-lg" alt="">
        </div>

        <div class="max-w-xl mx-auto py-4 px-4">
            {!! $post->content !!}
        </div>
    </div>
</x-app-layout>

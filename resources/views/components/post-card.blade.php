@props(['post'])
<a href="{{route('post.show', ['post' => $post])}}">
    <div class="flex flex-col-reverse items-center gap-4 bg-gray-100 rounded-lg p-6 lg:flex-row hover:scale-105 transition-all">
        <div class="w-2/3">
            <p class="text-gray-500 font-bold">{{$post->updated_at}}</p>
            <h2 class="text-3xl font-extrabold">{{$post->title}}</h2>
            <p class="text-gray-500 mb-2">{{$post->excerpt}}</p>
            @foreach(explode(',', $post->tags) as $tag) 
                @if ($loop->iteration == 5)
                    @break
                @endif
                <span class="bg-black text-white text-xs rounded-full p-2">{{$tag}}</span>
            @endforeach
        </div>
        <div class="max-w-sm">
            <img src="{{asset($post->image)}}" alt="" class="rounded-lg">
        </div>
    </div>
</a>

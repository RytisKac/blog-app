<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'posts' => Post::query()->paginate(10)
        ]);
    }
    //
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'required',
            'tags' => 'required',
        ]);

        Post::query()->create(
            $request->only('title', 'slug', 'excerpt', 'content', 'image', 'tags')
        );

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post): View
    {
        return view('admin.post.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'required',
            'tags' => 'required',
        ]);

        $post->update(
            $request->only('title', 'slug', 'excerpt', 'content', 'image', 'tags')
        );

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.dashboard');
    }
}

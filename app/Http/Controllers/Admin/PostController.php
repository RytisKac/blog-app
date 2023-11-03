<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
    
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.post.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tags' => 'required',
            'category' => 'nullable|exists:categories,id'
        ]);

        $imagePath = $request->file('image')->store('images');
        
        Post::query()->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'tags' => $request->tags,
            'category_id' => $request->category ?? null
        ]);

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tags' => 'required',
        ]);

        $imagePath = $request->file('image')->store('images');

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'tags' => $request->tags
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.dashboard');
    }
}

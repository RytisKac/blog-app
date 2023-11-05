<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('admin.index', [
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
            'content' => $request['content'],
            'image' => $imagePath,
            'tags' => $request->tags,
            'category_id' => $request->category ?? null
        ]);

        return redirect()->route('admin.index');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tags' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
        }

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request['content'],
            'image' => $imagePath ?? $post->image,
            'tags' => $request->tags,
            'category_id' => $request->category ?? null
        ]);

        return redirect()->route('admin.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        //check if image exists in images storage if it does delete it
        if(Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.index');
    }
}

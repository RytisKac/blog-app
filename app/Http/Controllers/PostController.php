<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    //
    public function index(): View
    {
        $posts = Post::latest()->paginate(6);

        return view('home', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post): View
    {
        return view('post.show', [
            'post' => $post
        ]);
    }


}

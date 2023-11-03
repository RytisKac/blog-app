<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    //
    public function show(Category $category): View
    {
        $posts = $category->posts()->latest()->paginate(6);

        return view('category.show', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}

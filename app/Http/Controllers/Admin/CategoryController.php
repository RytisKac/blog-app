<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    //

    public function index(): View
    {
        $categories = Category::all();

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function show(Category $category): View
    {
        $posts = $category->posts()->paginate(10);
        return view('admin.category.show', ['category' => $category, 'posts' => $posts]);
    }

    public function store(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'description' => 'required'
        ]);

        Category::query()->create($request->only(['name', 'slug', 'description']));

        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category): View
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'description' => 'required'
        ]);

        $category->update($request->only(['name', 'slug', 'description']));

        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}

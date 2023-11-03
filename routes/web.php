<?php

use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Admin\PostController as AdminPostController;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [AdminPostController::class, 'index'])->middleware(['verified'])->name('admin.dashboard');

    Route::group(['prefix' => 'post'], function () {
        Route::get('create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('store', [AdminPostController::class, 'store'])->name('admin.post.store');
        Route::get('edit/{post:slug}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::put('update/{post:slug}', [AdminPostController::class, 'update'])->name('admin.post.update');
        Route::delete('destroy/{post:slug}', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
        Route::get('create', function () {
            return view('admin.category.create');
        })->name('admin.category.create');
        Route::post('store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
        Route::get('edit/{category:slug}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('update/{category:slug}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('destroy/{category:slug}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Admin\PostController as AdminPostController;
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

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' =>'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [AdminPostController::class, 'index'])->middleware(['verified'])->name('admin.dashboard');

    Route::group(['prefix' => 'post'], function () {
        Route::get('create', function () {
            return view('admin.post.create');
        })->name('admin.post.create');
        Route::post('store', [AdminPostController::class, 'store'])->name('admin.post.store');
        Route::get('edit/{post:slug}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::put('update/{post:slug}', [AdminPostController::class, 'update'])->name('admin.post.update');
        Route::delete('destroy/{post:slug}', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

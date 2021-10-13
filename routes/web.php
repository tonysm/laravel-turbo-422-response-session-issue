<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('posts/create', function () {
        return view('posts.create');
    })->name('posts.create');

    Route::get('posts/{show}', function (Post $post) {
        return view('posts.show', [
            'post' => $post,
        ]);
    })->name('posts.show');

    Route::post('posts', function () {
        $post = Post::create(request()->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]));

        return redirect()->route('posts.show', $post);
    })->name('posts.store');
});

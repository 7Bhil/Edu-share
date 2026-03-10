<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $query = Post::with(['user', 'category'])
        ->where('status', 'published')
        ->latest();

    // Search filtering
    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', "%{$searchTerm}%")
              ->orWhere('content', 'like', "%{$searchTerm}%");
        });
    }

    // Category filtering
    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    $posts = $query->paginate(5);
    $categories = \App\Models\Category::all();

    return view('welcome', [
        'posts' => $posts,
        'categories' => $categories
    ]);
})->name('welcome');

Route::get('/articles/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/dashboard', function () {
    $posts = Post::with(['user', 'category'])->latest()->get();
    $categories = \App\Models\Category::all();
    return view('dashboard', ['posts' => $posts, 'categories' => $categories]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/role', [AdminController::class, 'changeRole'])->name('users.role');
    
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::post('/posts/{post}/toggle-status', [AdminController::class, 'toggleStatus'])->name('posts.toggle-status');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//bookmark route
Route::get('/bookmarks', [BookmarkController::class, 'index'])->middleware(['auth', 'verified'])->name('bookmarks');
Route::get('/bookmarks/create', [BookmarkController::class, 'create'])->middleware(['auth', 'verified'])->name('bookmarks.create');
Route::post('/bookmarks', [BookmarkController::class, 'store'])->middleware(['auth', 'verified'])->name('bookmarks.store');
Route::get('/bookmarks/{bookmark}', [BookmarkController::class, 'show'])->middleware(['auth', 'verified'])->name('bookmarks.show');
Route::get('/bookmarks/{bookmark}/edit', [BookmarkController::class, 'edit'])->middleware(['auth', 'verified'])->name('bookmarks.edit');
Route::patch('/bookmarks/{bookmark}/update', [BookmarkController::class, 'update'])->middleware(['auth', 'verified'])->name('bookmarks.update');
Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->middleware(['auth', 'verified'])->name('bookmarks.destroy');

//post route
Route::get('/topics', [TopicController::class, 'index'])->middleware(['auth', 'verified'])->name('topics');
Route::get('/topics/create', [TopicController::class, 'create'])->middleware(['auth', 'verified'])->name('topics.create');
Route::post('/topics', [TopicController::class, 'store'])->middleware(['auth', 'verified'])->name('topics.store');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->middleware(['auth', 'verified'])->name('topics.show');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->middleware(['auth', 'verified'])->name('topics.edit');
Route::patch('/topics/{topic}/update', [TopicController::class, 'update'])->middleware(['auth', 'verified'])->name('topics.update');
Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->middleware(['auth', 'verified'])->name('topics.destroy');

//category route
Route::get('/categories', [CategoryController ::class, 'index'])->middleware(['auth', 'verified'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->middleware(['auth', 'verified'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('categories.edit');
Route::patch('/categories/{category}/update', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('categories.destroy');

//tag route
Route::get('/tags', [TagController::class, 'index'])->middleware(['auth', 'verified'])->name('tags');
Route::get('/tags/create', [TagController::class, 'create'])->middleware(['auth', 'verified'])->name('tags.create');
Route::post('/tags', [TagController::class, 'store'])->middleware(['auth', 'verified'])->name('tags.store');
Route::get('/tags/{tag}', [TagController::class, 'show'])->middleware(['auth', 'verified'])->name('tags.show');
Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->middleware(['auth', 'verified'])->name('tags.edit');
Route::patch('/tags/{tag}/update', [TagController::class, 'update'])->middleware(['auth', 'verified'])->name('tags.update');
Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->middleware(['auth', 'verified'])->name('tags.destroy');

//comments route
Route::get('/comments', [CommentController::class, 'index'])->middleware(['auth', 'verified'])->name('comments');
Route::get('/comments/{post}/create', [CommentController::class, 'create'])->middleware(['auth', 'verified'])->name('comments.create');
Route::post('/comments', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware(['auth', 'verified'])->name('comments.edit');
Route::patch('/comments/{comment}/update', [CommentController::class, 'update'])->middleware(['auth', 'verified'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('comments.destroy');

require __DIR__.'/auth.php';

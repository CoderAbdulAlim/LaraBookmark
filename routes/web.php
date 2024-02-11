<?php

use App\Http\Controllers\BmarkCommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TopicCommentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //bookmark route
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');
    Route::get('/bookmarks/create', [BookmarkController::class, 'create'])->name('bookmarks.create');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::get('/bookmarks/{bookmark}', [BookmarkController::class, 'show'])->name('bookmarks.show');
    Route::get('/bookmarks/{bookmark}/edit', [BookmarkController::class, 'edit'])->name('bookmarks.edit');
    Route::patch('/bookmarks/{bookmark}/update', [BookmarkController::class, 'update'])->name('bookmarks.update');
    Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    //post route
    Route::get('/topics', [TopicController::class, 'index'])->name('topics');
    Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');
    Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
    Route::patch('/topics/{topic}/update', [TopicController::class, 'update'])->name('topics.update');
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');
    
    //category route
    Route::get('/categories', [CategoryController ::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    //tag route
    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::patch('/tags/{tag}/update', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    
    //TopicComments route
    Route::get('/topic_comments', [TopicCommentController::class, 'index'])->name('topic_comments');
    Route::get('/topic_comments/{topic}/create', [TopicCommentController::class, 'create'])->name('topic_comments.create');
    Route::post('/topic_comments/{topic}', [TopicCommentController::class, 'store'])->name('topic_comments.store');
    Route::get('/topic_comments/{comment}/edit', [TopicCommentController::class, 'edit'])->name('topic_comments.edit');
    Route::patch('/topic_comments/{comment}/update', [TopicCommentController::class, 'update'])->name('topic_comments.update');
    Route::delete('/topic_comments/{comment}', [TopicCommentController::class, 'destroy'])->name('topic_comments.destroy');
    
    //BookmarkComments route
    Route::get('/bmark_comments', [BmarkCommentController::class, 'index'])->name('bmark_comments');
    Route::get('/bmark_comments/{bookmark}/create', [BmarkCommentController::class, 'create'])->name('bmark_comments.create');
    Route::post('/bmark_comments/{bookmark}', [BmarkCommentController::class, 'store'])->name('bmark_comments.store');
    Route::get('/bmark_comments/{comment}/edit', [BmarkCommentController::class, 'edit'])->name('bmark_comments.edit');
    Route::patch('/bmark_comments/{comment}/update', [BmarkCommentController::class, 'update'])->name('bmark_comments.update');
    Route::delete('/bmark_comments/{comment}', [BmarkCommentController::class, 'destroy'])->name('bmark_comments.destroy');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->latest()
            ->when(Auth::check(), function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->paginate(2);

            return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('posts', 'title')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        $tag_ids = $request->input('tag_ids');
        $post->tags()->attach($tag_ids);

        return redirect()->route('posts')->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('posts', 'title')
                ->ignore($post->id)
                ->where(function ($query) use ($request, $post) {
                    return $query->where('user_id', $request->user()->id)
                    ->where('title', $post->title);
                }),
            ],
            'content' => 'required|string',
            // 'url' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);

        $post->update($request->validated());

        return redirect()->route('posts')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts')->with('success', 'Post deleted successfully');
    }
}

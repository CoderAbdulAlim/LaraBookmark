<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicUpdateRequest;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $topics = Topic::with(['user', 'category'])
            ->latest()
            ->when(Auth::check(), function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->paginate(5);

        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('topics.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('topics', 'title')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $topic = $request->user()->topics()->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        $tag_ids = $request->input('tag_ids');
        $topic->tags()->attach($tag_ids);

        return redirect()->route('topics')->with('success', 'topic created successfully');
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function edit(Topic $topic)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('topics.edit', compact('topic', 'categories', 'tags'));
    }

    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('topics', 'title')
                    ->ignore($topic->id)
                    ->where(function ($query) use ($request, $topic) {
                        return $query->where('user_id', $request->user()->id)
                            ->where('title', $topic->title);
                    }),
            ],
            'content' => 'required|string',
            // 'url' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);

        $topic->update($request->validated());

        return redirect()->route('topics')->with('success', 'topic updated successfully');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics')->with('success', 'topic deleted successfully');
    }
}

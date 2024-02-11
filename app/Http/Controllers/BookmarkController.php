<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkUpdateRequest;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\ContentType;
use App\Models\ReadStatus;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $bookmarks = Bookmark::with(['user', 'category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(5);

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $contenttypes = ContentType::all();
        return view('bookmarks.create', compact('categories', 'tags', 'contenttypes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>  [
                'required',
                Rule::unique('bookmarks', 'name')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'url' =>  [
                'required',
                Rule::unique('bookmarks', 'url')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'description' => 'required',
            'category_id' => 'required',
            'contenttype_id' => 'required',
        ]);

        $bookmark = $request->user()->bookmarks()->create([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'contenttype_id' => $request->contenttype_id,
        ]);

        $tag_ids = $request->input('tag_ids');
        $bookmark->tags()->attach($tag_ids);

        return redirect()->route('bookmarks')->with('success', 'Bookmark store successfully');
    }

    public function show(Bookmark $bookmark)
    {
        return view('bookmarks.show', compact('bookmark'));
    }

    public function edit(Bookmark $bookmark)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $contenttypes = ContentType::all();
        $readstatuses = ReadStatus::all();
        return view('bookmarks.edit', compact('bookmark', 'categories', 'tags', 'contenttypes', 'readstatuses'));
    }

    public function update(BookmarkUpdateRequest $request, Bookmark $bookmark)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('bookmarks', 'name')
                    ->ignore($bookmark->id)
                    ->where(function ($query) use ($request, $bookmark) {
                        return $query->where('user_id', $request->user()->id)
                            ->where('name', $bookmark->name);
                    }),
            ],
            'url' => [
                'required',
                Rule::unique('bookmarks', 'url')
                    ->ignore($bookmark->id)
                    ->where(function ($query) use ($request, $bookmark) {
                        return $query->where('user_id', $request->user()->id)
                            ->where('url', $bookmark->url);
                    }),
            ],
            'description' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $bookmark->update($request->validated());

        return redirect()->route('bookmarks')->with('success', 'Bookmark updated successfully');
    }

    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();

        return redirect()->route('bookmarks')->with('success', 'Bookmark deleted successfully');
    }
}

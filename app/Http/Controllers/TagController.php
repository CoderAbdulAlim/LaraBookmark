<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }
    
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(2);

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        Tag::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // return view('tags.index');
        return redirect()->route('tags')->with('success', 'Tag created successfully');
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts;

        return view('tags.show', compact('tag','posts'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'tag' => $tag
        ]);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('tags', $tag)->with('success', 'Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags')->with('success', 'Tag deleted successfully');
    }
}

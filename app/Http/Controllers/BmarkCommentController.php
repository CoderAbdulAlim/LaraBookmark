<?php

namespace App\Http\Controllers;

use App\Http\Requests\BmarkCommentUpdateRequest;
use App\Models\BmarkComment;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BmarkCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $comments = BmarkComment::orderBy('created_at', 'desc')->paginate(5);

        return view('bmark_comments.index', compact('comments'));
    }

    public function create(Bookmark $bookmark)
    {
        return view('bmark_comments.create', compact('bookmark'));
    }

    public function store(Request $request, Bookmark $bookmark)
    {
        $request->validate([
            'content' => 'required',
            'bookmark_id' => 'required|exists:bookmarks,id',
        ]);
        
        $comment = $request->user()->bmark_comments()->create([
            'content' => $request->content,
            'bookmark_id' => $request->bookmark_id,
        ]);
        
        $request->flash();

        if ($comment) {
            return redirect()->route('bookmarks.show', ['bookmark' => $bookmark])->with('success', 'Comments created successfully');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to store comment']);
        }
    }

    public function edit(BmarkComment $comment)
    {
        return view('bmark_comments.edit', [
            'comment' => $comment
        ]);
    }

    public function update(BmarkCommentUpdateRequest $request, BmarkComment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('bmark_comments', $comment)->with('success', 'Comment updated successfully');
    }

    public function destroy(BmarkComment $comment)
    {
        $comment->delete();

        return redirect()->route('bmark_comments')->with('success', 'Comment deleted successfully');
    }
}

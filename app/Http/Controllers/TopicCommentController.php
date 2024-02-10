<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCommentUpdateRequest;
use App\Models\Topic;
use App\Models\TopicComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $comments = TopicComment::orderBy('created_at', 'desc')->paginate(5);

        return view('topic_comments.index', compact('comments'));
    }

    public function create(Topic $topic)
    {
        return view('topic_comments.create', compact('topic'));
    }

    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'content' => 'required',
            'topic_id' => 'required|exists:topics,id',
        ]);
        
        $comment = $request->user()->topic_comments()->create([
            'content' => $request->content,
            'topic_id' => $request->topic_id,
        ]);
        
        $request->flash();

        if ($comment) {
            return redirect()->route('topics.show', ['topic' => $topic])->with('success', 'Comments created successfully');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to store comment']);
        }
    }

    public function edit(TopicComment $comment)
    {
        return view('topic_comments.edit', [
            'comment' => $comment
        ]);
    }

    public function update(TopicCommentUpdateRequest $request, TopicComment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('topic_comments', $comment)->with('success', 'Comment updated successfully');
    }

    public function destroy(TopicComment $comment)
    {
        $comment->delete();

        return redirect()->route('topic_comments')->with('success', 'Comment deleted successfully');
    }
}

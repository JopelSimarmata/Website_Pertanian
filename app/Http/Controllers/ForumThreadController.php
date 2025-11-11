<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumThread;

class ForumThreadController extends Controller
{
    public function index()
    {
        $threads = ForumThread::latest()->get();
        return view('forum.index', compact('threads'));
    }


    public function add()
    {
        return view('forum.add');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ForumThread::create([ 
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => 1, 
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread berhasil dibuat!');
    }

    public function detail($id)
    {
        $thread = ForumThread::findOrFail($id);
        return view('forum.detail', compact('thread'));
    }
}

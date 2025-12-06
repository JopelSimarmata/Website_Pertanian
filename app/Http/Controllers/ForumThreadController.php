<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumThread;
use App\Models\ForumCategories;
use App\Models\User;

class ForumThreadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        
        $query = ForumThread::with('author', 'category');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        if ($category) {
            $query->where('category_id', $category);
        }
        
        // Pinned threads first, then by latest
        $threads = $query->orderBy('is_pinned', 'desc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(15);
        
        $categories = ForumCategories::withCount('threads')->get();
        $totalThreads = ForumThread::count();
        $totalReplies = \App\Models\ForumReplies::count();
        $totalMembers = User::count();
        
        return view('forum.index', compact('threads', 'categories', 'totalThreads', 'totalReplies', 'totalMembers'));
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

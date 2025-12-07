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
        
        $query = ForumThread::with(['author', 'category', 'likes']);
        
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum-images', 'public');
        }

        ForumThread::create([ 
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id() ?? 1,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread berhasil dibuat!');
    }

    public function detail($id)
    {
        $thread = ForumThread::with(['author', 'category', 'likes'])->findOrFail($id);
        return view('forum.detail', compact('thread'));
    }

    public function toggleLike($id)
    {
        $thread = ForumThread::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false, 
                'message' => 'Anda harus login untuk menyukai thread'
            ], 401);
        }

        $liked = $thread->toggleLike($user);

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $thread->likes_count
        ]);
    }

    public function toggleSolved($id)
    {
        $thread = ForumThread::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login'
            ], 401);
        }

        // Only author can mark as solved
        if ($thread->author_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pembuat thread yang bisa menandai sebagai terjawab'
            ], 403);
        }

        $thread->is_solved = !$thread->is_solved;
        $thread->save();

        return response()->json([
            'success' => true,
            'is_solved' => $thread->is_solved,
            'message' => $thread->is_solved ? 'Thread ditandai sebagai terjawab!' : 'Tandai terjawab dibatalkan'
        ]);
    }
}

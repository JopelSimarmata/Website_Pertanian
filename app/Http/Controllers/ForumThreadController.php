<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumThread;
use App\Models\ForumCategories;
use App\Models\User;
use App\Models\ForumReplies;

class ForumThreadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        $status = $request->get('status');
        
        $query = ForumThread::with(['author.profile', 'category', 'likes']);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        if ($category) {
            $query->where('category_id', $category);
        }
        
        // Filter by status
        if ($status === 'solved') {
            $query->where('is_solved', true);
        } elseif ($status === 'unsolved') {
            $query->where('is_solved', false);
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('forum-images', 'public');
                $imagePaths[] = $path;
            }
        }

        ForumThread::create([ 
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id() ?? 1,
            'category_id' => $request->category_id,
            'image' => !empty($imagePaths) ? json_encode($imagePaths) : null,
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread berhasil dibuat!');
    }

    public function detail($id)
    {
        $thread = ForumThread::with(['author.profile', 'category', 'likes', 'replies.author.profile'])->findOrFail($id);
        
        // Increment views count
        $thread->increment('views_count');
        
        return view('forum.detail', compact('thread'));
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $thread = ForumThread::findOrFail($id);
        
        $reply = $thread->replies()->create([
            'author_id' => auth()->id(),
            'content' => $request->reply,
        ]);

        // Increment replies count
        $thread->increment('replies_count');

        return redirect()->route('forum.detail', $id)->with('success', 'Balasan berhasil dikirim!');
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

    public function edit($id)
    {
        $thread = ForumThread::findOrFail($id);
        
        // Check authorization
        if (auth()->id() !== $thread->author_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $categories = ForumCategories::all();
        return view('forum.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $thread = ForumThread::findOrFail($id);
        
        // Check authorization
        if (auth()->id() !== $thread->author_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:forum_categories,category_id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $thread->title = $request->title;
        $thread->content = $request->content;
        $thread->category_id = $request->category_id;

        // Handle new images upload
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('forum-images', 'public');
                $imagePaths[] = $path;
            }
            
            if (!empty($imagePaths)) {
                $thread->image = json_encode($imagePaths);
            }
        }

        $thread->save();

        return redirect()->route('forum.detail', $id)->with('success', 'Thread berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $thread = ForumThread::findOrFail($id);
        
        // Check authorization
        if (auth()->id() !== $thread->author_id && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus thread ini'
            ], 403);
        }

        // Delete associated images if exists
        if ($thread->image) {
            $images = is_array($thread->image) ? $thread->image : json_decode($thread->image, true);
            if ($images) {
                foreach ((array)$images as $imagePath) {
                    if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
                        \Storage::disk('public')->delete($imagePath);
                    }
                }
            }
        }

        $thread->delete();

        return response()->json([
            'success' => true,
            'message' => 'Thread berhasil dihapus'
        ]);
    }
}

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
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
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
        // Validate basic fields first
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:forum_categories,category_id',
            'tags' => 'nullable|string',
        ]);

        // Validate images separately with better error handling
        if ($request->has('images') && $request->images) {
            $request->validate([
                'images' => 'array|max:5',
                'images.*' => 'file|mimes:jpeg,jpg,png,gif,webp|mimetypes:image/jpeg,image/jpg,image/png,image/gif,image/webp|max:5120',
            ], [
                'images.*.file' => 'File harus berupa gambar',
                'images.*.mimes' => 'Format gambar harus: JPEG, JPG, PNG, GIF, atau WEBP',
                'images.*.mimetypes' => 'File harus berupa gambar yang valid',
                'images.*.max' => 'Ukuran gambar maksimal 5MB',
                'images.max' => 'Maksimal 5 foto',
            ]);
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('forum-images', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        // Process tags - split by comma and clean up
        $tags = null;
        if ($request->tags) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
            $tagsArray = array_filter($tagsArray); // Remove empty values
            $tags = !empty($tagsArray) ? json_encode($tagsArray) : null;
        }

        $imageData = !empty($imagePaths) ? json_encode($imagePaths) : null;
        
        // Debug log
        \Log::info('Creating thread with images', [
            'image_paths' => $imagePaths,
            'image_data' => $imageData,
            'has_images' => !empty($imagePaths)
        ]);

        ForumThread::create([ 
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id() ?? 1,
            'category_id' => $request->category_id,
            'tags' => $tags,
            'image' => $imageData,
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread berhasil dibuat!');
    }

    public function detail($id)
    {
        $thread = ForumThread::with(['author.profile', 'category', 'likes', 'replies.author.profile'])->findOrFail($id);
        
        // Increment views count - only once per user per day
        $viewKey = 'thread_view_' . $id;
        $lastViewed = session($viewKey);
        $today = now()->format('Y-m-d');
        
        // Only increment if:
        // 1. User hasn't viewed this thread today, OR
        // 2. User is not the author (don't count author's own views)
        if ((!$lastViewed || $lastViewed !== $today) && auth()->id() !== $thread->author_id) {
            $thread->increment('views_count');
            session([$viewKey => $today]);
        }
        
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
            'likes_count' => $thread->likes_count,
            'dislikes_count' => $thread->dislikes_count
        ]);
    }

    public function toggleDislike($id)
    {
        $thread = ForumThread::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false, 
                'message' => 'Anda harus login untuk tidak menyukai thread'
            ], 401);
        }

        $disliked = $thread->toggleDislike($user);

        return response()->json([
            'success' => true,
            'disliked' => $disliked,
            'likes_count' => $thread->likes_count,
            'dislikes_count' => $thread->dislikes_count
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
            'images' => 'nullable|array|max:5',
            'images.*' => 'file|mimes:jpeg,jpg,png,gif,webp|mimetypes:image/jpeg,image/jpg,image/png,image/gif,image/webp|max:5120',
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

    public function markAsSolution($replyId)
    {
        $reply = \App\Models\ForumReplies::findOrFail($replyId);
        $thread = $reply->thread;
        
        // Check if user is the thread owner
        if ($thread->author_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pembuat thread yang dapat menandai jawaban'
            ], 403);
        }

        // Toggle solution status
        $reply->is_solution = !$reply->is_solution;
        $reply->save();

        $message = $reply->is_solution 
            ? 'Balasan berhasil ditandai menjawab!' 
            : 'Balasan tidak lagi ditandai menjawab';

        return response()->json([
            'success' => true,
            'is_solution' => $reply->is_solution,
            'message' => $message
        ]);
    }

    public function toggleSolved($id)
    {
        $thread = ForumThread::findOrFail($id);
        
        // Check if user is the thread owner
        if ($thread->author_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pembuat thread yang dapat mengubah status'
            ], 403);
        }

        // If trying to mark as solved, check if there's at least one solution
        if (!$thread->is_solved) {
            $hasSolution = \App\Models\ForumReplies::where('thread_id', $thread->thread_id)
                ->where('is_solution', true)
                ->exists();
            
            if (!$hasSolution) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tandai minimal 1 balasan sebagai "Menjawab" terlebih dahulu'
                ], 400);
            }
        }

        // Toggle solved status
        $thread->is_solved = !$thread->is_solved;
        $thread->save();

        return response()->json([
            'success' => true,
            'is_solved' => $thread->is_solved,
            'message' => $thread->is_solved 
                ? 'Thread ditandai sebagai terjawab' 
                : 'Thread tidak lagi ditandai terjawab'
        ]);
    }
}

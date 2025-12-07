<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $thread['title'] ?? 'Detail Thread' }} - Forum LadangQu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        /* Liked state for thread like button */
        .group\/like.liked svg {
            fill: #f43f5e;
            stroke: #f43f5e;
        }
        
        /* Liked state for comment like button */
        .comment-like-btn.liked svg {
            fill: #f43f5e;
            stroke: #f43f5e;
        }
        
        /* Bookmarked state */
        .bookmark-btn.bookmarked svg {
            fill: #000;
            stroke: #000;
        }
        
        /* Scrollable comments container */
        .comments-scroll-container {
            max-height: 600px;
            overflow-y: auto;
        }
        
        /* Custom scrollbar */
        .comments-scroll-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .comments-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .comments-scroll-container::-webkit-scrollbar-thumb {
            background: #16a34a;
            border-radius: 10px;
        }
        
        .comments-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #15803d;
        }
        
        /* Toast notification */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        
        .toast-notification.hiding {
            animation: slideOut 0.3s ease-out forwards;
        }
        
        /* Reply section */
        .reply-section {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .reply-section.active {
            max-height: 500px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('image/logo.png') }}" alt="LadangQu Logo" class="h-8 w-8 object-contain">
                        <span class="text-green-700 font-bold text-xl">LadangQu</span>
                    </a>
                    <div class="hidden md:flex items-center gap-6">
                        <a href="/" class="text-gray-600 hover:text-green-700 font-medium transition-colors">Beranda</a>
                        <a href="/forum" class="text-green-700 font-semibold">Forum</a>
                        <a href="/marketplace" class="text-gray-600 hover:text-green-700 font-medium transition-colors">Marketplace</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 text-white flex items-center justify-center font-bold cursor-pointer hover:scale-105 transition-transform">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <a href="/forum" class="hover:text-green-700 transition-colors">Forum</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-900 font-medium">Detail Thread</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-1 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-12">
                <!-- Thread Detail Card -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <!-- Thread Header -->
                    <div class="flex gap-4 mb-6">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-green-500 to-green-700 text-white flex items-center justify-center font-bold text-2xl flex-shrink-0 shadow-md">
                            {{ substr($thread['author'] ?? 'B', 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-3 leading-tight">{{ $thread['title'] }}</h1>
                            <div class="flex items-center gap-3 text-sm text-gray-600 mb-3">
                                <span class="font-semibold text-gray-800">{{ $thread['author'] }}</span>
                                <span class="text-gray-300">•</span>
                                <span>{{ $thread['date'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">{{ $thread['category'] }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">{{ $thread['status'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Thread Content -->
                    <div class="prose max-w-none mb-6">
                        <p class="text-gray-700 leading-relaxed text-base">
                            {{ $thread['content'] }}
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex items-center gap-2 flex-wrap mb-6 pb-6 border-b border-gray-200">
                        @foreach($thread['tags'] as $tag)
                        <span class="inline-flex items-center px-3 py-1.5 bg-gray-50 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-100 transition-colors cursor-pointer">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <!-- Thread Actions -->
                    <div class="flex items-center gap-6 text-sm text-gray-500">
                        <button onclick="toggleLike(this)" class="flex items-center gap-2 hover:text-rose-500 transition-colors group/like">
                            <svg class="w-6 h-6 group-hover/like:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span class="font-semibold like-count" data-count="{{ $thread['likes'] }}" data-initial="{{ $thread['likes'] }}">{{ $thread['likes'] >= 1000 ? number_format($thread['likes']/1000, 1, '.', '').'K' : $thread['likes'] }}</span>
                        </button>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <span class="font-semibold comment-count" data-count="{{ $thread['replies'] }}">{{ $thread['replies'] >= 1000 ? number_format($thread['replies']/1000, 1, '.', '').'K' : $thread['replies'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span class="font-semibold">{{ $thread['views'] >= 1000 ? number_format($thread['views']/1000, 1, '.', '').'K' : $thread['views'] }}</span>
                        </div>
                        <button onclick="toggleBookmark(this)" class="ml-auto text-gray-400 hover:text-gray-600 transition-colors bookmark-btn">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                        </button>
                    </div>
                </article>

                <!-- Comments Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mt-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Komentar ({{ $thread['replies'] ?? 23 }})</h2>
                    </div>

                    <!-- Comments List -->
                    <div class="comments-scroll-container mb-6">
                        <div class="comments-list space-y-4">
                            <!-- Sample Comments - Oldest to Newest (top to bottom) -->
                            @php
                                $commentAuthors = [
                                    ['name' => 'Rizki Pratama', 'initial' => 'R', 'color' => 'blue', 'time' => '2 minggu lalu'],
                                    ['name' => 'Siti Nurhaliza', 'initial' => 'S', 'color' => 'purple', 'time' => '1 minggu lalu'],
                                    ['name' => 'Ahmad Fauzi', 'initial' => 'A', 'color' => 'green', 'time' => '5 hari lalu'],
                                    ['name' => 'Dewi Lestari', 'initial' => 'D', 'color' => 'pink', 'time' => '3 hari lalu'],
                                    ['name' => 'Budi Santoso', 'initial' => 'B', 'color' => 'orange', 'time' => '2 hari lalu'],
                                    ['name' => 'Maya Sari', 'initial' => 'M', 'color' => 'teal', 'time' => '1 hari lalu'],
                                    ['name' => 'Eko Prasetyo', 'initial' => 'E', 'color' => 'cyan', 'time' => '12 jam lalu'],
                                    ['name' => 'Rina Wati', 'initial' => 'R', 'color' => 'amber', 'time' => '5 jam lalu'],
                                    ['name' => 'Hendra Gunawan', 'initial' => 'H', 'color' => 'indigo', 'time' => '2 jam lalu'],
                                    ['name' => 'Linda Wijaya', 'initial' => 'L', 'color' => 'rose', 'time' => '30 menit lalu'],
                                ];
                                $commentTexts = [
                                    'Informasi yang sangat berguna! Terima kasih sudah berbagi pengalaman.',
                                    'Saya juga mengalami masalah yang sama. Solusi ini sangat membantu.',
                                    'Apakah ada cara alternatif lain untuk mengatasi masalah ini?',
                                    'Pengalaman yang menarik! Saya akan coba terapkan di lahan saya.',
                                    'Terima kasih atas tips-nya. Sangat bermanfaat untuk petani pemula seperti saya.',
                                    'Bagaimana dengan kondisi cuaca yang tidak menentu? Apakah tetap efektif?',
                                    'Saya sudah mencoba cara ini dan hasilnya memuaskan!',
                                    'Berapa lama waktu yang dibutuhkan sampai terlihat hasilnya?',
                                    'Metode ini cocok untuk lahan skala kecil atau besar?',
                                    'Sangat inspiratif! Saya akan bagikan ke kelompok tani kami.',
                                ];
                            @endphp
                            @foreach($commentAuthors as $index => $author)
                            <div class="comment-item flex gap-3 p-4 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-{{ $author['color'] }}-500 to-{{ $author['color'] }}-700 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                                    {{ $author['initial'] }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-semibold text-sm text-gray-900">{{ $author['name'] }}</span>
                                        <span class="text-xs text-gray-500">{{ $author['time'] }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700 leading-relaxed mb-2">{{ $commentTexts[$index] }}</p>
                                    
                                    @php
                                        $initialLikes = [12, 8, 15, 6, 19, 11, 7, 14, 9, 18]; // Fixed like counts untuk setiap comment
                                    @endphp
                                    <!-- Comment Actions -->
                                    <div class="flex items-center gap-4 text-xs">
                                        <button onclick="toggleCommentLike(this)" class="comment-like-btn flex items-center gap-1 text-gray-500 hover:text-rose-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                            <span class="comment-like-count" data-count="{{ $initialLikes[$index] }}" data-initial="{{ $initialLikes[$index] }}">{{ $initialLikes[$index] }}</span>
                                        </button>
                                        <button onclick="toggleReplySection(this)" class="text-gray-500 hover:text-blue-600 transition-colors font-medium">Balas</button>
                                    </div>

                                    <!-- Reply Section -->
                                    <div class="reply-section mt-3">
                                        <div class="reply-form">
                                            <textarea rows="2" placeholder="Tulis balasan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none text-xs"></textarea>
                                            <div class="flex justify-end mt-2">
                                                <button onclick="submitReply(this)" class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors text-xs">
                                                    Kirim Balasan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="comment-form border-t border-gray-200 pt-6">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Tambah Komentar</label>
                        <textarea rows="4" placeholder="Tulis komentar Anda..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none text-sm"></textarea>
                        <div class="flex justify-end mt-3">
                            <button onclick="submitComment(this)" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors text-sm shadow-sm">
                                Kirim Komentar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar - Removed -->
        </div>
    </main>

    <script>
        // Check if thread was liked from sidebar and restore like count
        document.addEventListener('DOMContentLoaded', function() {
            const threadId = window.location.pathname.split('/').pop();
            
            // Check localStorage for like state
            const likedThreads = JSON.parse(localStorage.getItem('likedThreads') || '{}');
            
            if (likedThreads[threadId]) {
                const likeButton = document.querySelector('.group\\/like');
                if (likeButton) {
                    likeButton.classList.add('liked');
                    
                    // Update count to show +1
                    const countSpan = likeButton.querySelector('.like-count');
                    if (countSpan) {
                        const initialCount = parseInt(countSpan.getAttribute('data-initial'));
                        countSpan.textContent = formatNumber(initialCount + 1);
                        countSpan.setAttribute('data-count', initialCount + 1);
                    }
                }
            }
        });

        function formatNumber(num) {
            if (num >= 1000) {
                return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
            }
            return num.toString();
        }

        function toggleLike(button) {
            button.classList.toggle('liked');
            const countSpan = button.querySelector('.like-count');
            const initialCount = parseInt(countSpan.getAttribute('data-initial'));
            
            if (button.classList.contains('liked')) {
                // Liked: initial + 1
                countSpan.textContent = formatNumber(initialCount + 1);
                countSpan.setAttribute('data-count', initialCount + 1);
            } else {
                // Not liked: back to initial
                countSpan.textContent = formatNumber(initialCount);
                countSpan.setAttribute('data-count', initialCount);
            }
            
            // Save to localStorage
            const threadId = window.location.pathname.split('/').pop();
            const likedThreads = JSON.parse(localStorage.getItem('likedThreads') || '{}');
            
            if (button.classList.contains('liked')) {
                likedThreads[threadId] = true;
            } else {
                delete likedThreads[threadId];
            }
            
            localStorage.setItem('likedThreads', JSON.stringify(likedThreads));
        }

        function toggleBookmark(button) {
            button.classList.toggle('bookmarked');
            
            if (button.classList.contains('bookmarked')) {
                showToast('Thread berhasil disimpan!', 'success');
            } else {
                showToast('Thread dihapus dari simpanan', 'info');
            }
        }

        function toggleCommentLike(button) {
            button.classList.toggle('liked');
            const countSpan = button.querySelector('.comment-like-count');
            const initialCount = parseInt(countSpan.getAttribute('data-initial'));
            
            if (button.classList.contains('liked')) {
                // Liked: initial + 1
                countSpan.textContent = initialCount + 1;
                countSpan.setAttribute('data-count', initialCount + 1);
            } else {
                // Not liked: back to initial
                countSpan.textContent = initialCount;
                countSpan.setAttribute('data-count', initialCount);
            }
        }

        function toggleReplySection(button) {
            const commentDiv = button.closest('.comment-item');
            const replySection = commentDiv.querySelector('.reply-section');
            
            if (replySection.classList.contains('active')) {
                replySection.classList.remove('active');
            } else {
                replySection.classList.add('active');
                setTimeout(() => {
                    const textarea = replySection.querySelector('textarea');
                    if (textarea) textarea.focus();
                }, 300);
            }
        }

        function submitReply(button) {
            const replySection = button.closest('.reply-section');
            const textarea = replySection.querySelector('textarea');
            const replyText = textarea.value.trim();
            
            if (replyText === '') {
                alert('Silakan tulis balasan terlebih dahulu');
                return;
            }
            
            textarea.value = '';
            replySection.classList.remove('active');
            showToast('Balasan berhasil ditambahkan!', 'success');
        }

        function submitComment(button) {
            const form = button.closest('.comment-form');
            const textarea = form.querySelector('textarea');
            const commentText = textarea.value.trim();
            
            if (commentText === '') {
                alert('Silakan tulis komentar terlebih dahulu');
                return;
            }
            
            // Create new comment element
            const commentsList = document.querySelector('.comments-list');
            const newComment = document.createElement('div');
            newComment.className = 'comment-item flex gap-3 p-4 bg-gray-50 rounded-lg';
            
            // Random color for avatar
            const colors = ['blue', 'purple', 'green', 'pink', 'orange', 'teal', 'cyan', 'amber', 'indigo', 'rose'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            
            // Get user initial (default to 'U' for User)
            const userInitial = 'U';
            
            newComment.innerHTML = `
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-${randomColor}-500 to-${randomColor}-700 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                    ${userInitial}
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-sm text-gray-900">Anda</span>
                        <span class="text-xs text-gray-500">Baru saja</span>
                        <button onclick="deleteComment(this)" class="ml-auto text-xs text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed mb-2">${commentText}</p>
                    
                    <!-- Comment Actions -->
                    <div class="flex items-center gap-4 text-xs">
                        <button onclick="toggleCommentLike(this)" class="comment-like-btn flex items-center gap-1 text-gray-500 hover:text-rose-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span class="comment-like-count" data-count="0" data-initial="0">0</span>
                        </button>
                        <button onclick="toggleReplySection(this)" class="text-gray-500 hover:text-blue-600 transition-colors font-medium">Balas</button>
                    </div>

                    <!-- Reply Section -->
                    <div class="reply-section mt-3">
                        <div class="reply-form">
                            <textarea rows="2" placeholder="Tulis balasan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none text-xs"></textarea>
                            <div class="flex justify-end mt-2">
                                <button onclick="submitReply(this)" class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors text-xs">
                                    Kirim Balasan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Add to the END of comments list (paling bawah = yang terbaru)
            commentsList.appendChild(newComment);
            
            // Increment comment counter
            const commentCountSpan = document.querySelector('.comment-count');
            if (commentCountSpan) {
                const currentCount = parseInt(commentCountSpan.getAttribute('data-count'));
                const newCount = currentCount + 1;
                commentCountSpan.textContent = formatNumber(newCount);
                commentCountSpan.setAttribute('data-count', newCount);
            }
            
            // Scroll to the new comment
            setTimeout(() => {
                newComment.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
            
            textarea.value = '';
            showToast('Komentar berhasil ditambahkan!', 'success');
        }

        function deleteComment(button) {
            if (confirm('Hapus komentar ini?')) {
                const commentItem = button.closest('.comment-item');
                commentItem.remove();
                
                // Decrement comment counter
                const commentCountSpan = document.querySelector('.comment-count');
                if (commentCountSpan) {
                    const currentCount = parseInt(commentCountSpan.getAttribute('data-count'));
                    const newCount = Math.max(0, currentCount - 1); // Prevent negative
                    commentCountSpan.textContent = formatNumber(newCount);
                    commentCountSpan.setAttribute('data-count', newCount);
                }
                
                showToast('Komentar berhasil dihapus', 'info');
            }
        }

        function showToast(message, type = 'success') {
            const existingToast = document.querySelector('.toast-notification');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            
            const icon = type === 'success' 
                ? '<svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
                : '<svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>';
            
            toast.innerHTML = `
                ${icon}
                <span class="text-sm font-medium text-gray-900">${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>

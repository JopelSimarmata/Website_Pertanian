<x-layout>
<x-navbar></x-navbar>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Header --}}
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
      <p class="text-sm text-gray-500 mt-1">Semua pemberitahuan aktivitas Anda</p>
    </div>
    
    @if($notifications->where('is_read', false)->count() > 0)
    <button onclick="markAllAsRead()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      Tandai Semua Dibaca
    </button>
    @endif
  </div>

  {{-- Notifications List --}}
  @if($notifications->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 divide-y divide-gray-200">
      @foreach($notifications as $notification)
        <div class="p-4 hover:bg-gray-50 transition {{ !$notification->is_read ? 'bg-emerald-50/30' : '' }}">
          <a href="{{ $notification->data['url'] ?? '#' }}" 
             onclick="markAsRead({{ $notification->notification_id }})"
             class="block">
            <div class="flex items-start gap-4">
              
              {{-- Icon --}}
              <div class="flex-shrink-0">
                @if($notification->type === 'visit_request_new')
                  <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                @elseif($notification->type === 'visit_request_approved')
                  <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                @elseif($notification->type === 'visit_request_rejected')
                  <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                @else
                  <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                  </div>
                @endif
              </div>

              {{-- Content --}}
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                  <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">
                      {{ $notification->data['title'] ?? 'Notifikasi' }}
                      @if(!$notification->is_read)
                        <span class="inline-block w-2 h-2 bg-emerald-500 rounded-full ml-2"></span>
                      @endif
                    </p>
                    <p class="text-sm text-gray-600 mt-1">{{ $notification->data['message'] ?? '' }}</p>
                    <p class="text-xs text-gray-400 mt-2">
                      {{ $notification->created_at->diffForHumans() }}
                    </p>
                  </div>
                  
                  {{-- Delete Button --}}
                  <button 
                    onclick="event.preventDefault(); event.stopPropagation(); deleteNotification({{ $notification->notification_id }})"
                    class="flex-shrink-0 p-1 text-gray-400 hover:text-red-600 transition"
                    title="Hapus notifikasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $notifications->links() }}
    </div>
  @else
    {{-- Empty State --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
      <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
      </div>
      <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Notifikasi</h3>
      <p class="text-sm text-gray-500">Anda tidak memiliki notifikasi saat ini</p>
    </div>
  @endif

</div>

<script>
  function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    }).catch(err => console.error('Error marking notification as read:', err));
  }

  function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.reload();
      }
    })
    .catch(err => console.error('Error marking all as read:', err));
  }

  function deleteNotification(notificationId) {
    if (confirm('Hapus notifikasi ini?')) {
      fetch(`/notifications/${notificationId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        }
      })
      .catch(err => console.error('Error deleting notification:', err));
    }
  }
</script>

</x-layout>

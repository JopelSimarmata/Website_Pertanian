<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        
        <div class="hidden sm:flex shrink-0 items-center sm:ml-6">
          <a href="/" class="flex items-center">
            <img src="<?php echo e(asset('image/logo.png')); ?>" alt="LadangQu" class="h-8 w-auto" />            
            <span class="ml-2 text-xl font-bold text-green-600">LadangQu</span>
          </a>
        </div>

        <div class="hidden sm:block absolute left-1/2 transform -translate-x-1/2">
          <div class="flex space-x-4 whitespace-nowrap">

            
            <a href="/" aria-current="page" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition <?php echo e(request()->is('/') ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">
              <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
              </svg>
              <span>Beranda</span>
            </a>

            <a href="/forum" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition <?php echo e(request()->is('forum*') ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">
              <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.186 1.186 0 0 1 .863-.501c1.153-.086 2.305-.213 3.458-.379 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
              </svg>
              <span>Forum</span>
            </a>

            <a href="/marketplace" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition <?php echo e(request()->is('marketplace*') ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">
              <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
              <span>Marketplace</span>
            </a>

            <?php if(auth()->guard()->check()): ?>
            <a href="/visit-requests" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition <?php echo e(request()->is('visit-requests*') || request()->is('kunjungan*') ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">
              <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
              </svg>
              <span>Kunjungan Lokasi</span>
            </a>

              <?php if(strtolower(Auth::user()->role ?? '') === 'petani'): ?>
                <a href="<?php echo e(route('dashboard.farmer')); ?>" class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition <?php echo e(request()->is('dashboard/farmer*') ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">
                  <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                  </svg>
                  <span>Dashboard</span>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 space-x-2">
        <?php if(auth()->guard()->guest()): ?>
          <a href="/login" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 transition shadow-sm">Masuk</a>
          <a href="/register" class="inline-flex items-center px-4 py-2 border border-emerald-600 text-sm font-medium rounded-lg text-emerald-600 bg-white hover:bg-emerald-50 transition">Daftar</a>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
          <!-- notification dropdown -->
          <div class="relative">
            <el-dropdown>
              <button type="button" class="relative rounded-full p-1 text-gray-700 hover:text-gray-900 focus:outline-2 focus:outline-offset-2 focus:outline-emerald-500">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                  <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span id="notif-badge" class="hidden absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
              </button>

              <el-menu anchor="bottom end" popover class="w-80 origin-top-right rounded-lg bg-white shadow-lg outline outline-black/5">
                <div class="px-4 py-3 border-b border-gray-200">
                  <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                    <a href="/notifications" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua</a>
                  </div>
                </div>
                <div id="notification-list" class="max-h-96 overflow-y-auto">
                  <div class="px-4 py-8 text-center text-sm text-gray-500">
                    Memuat notifikasi...
                  </div>
                </div>
              </el-menu>
            </el-dropdown>
          </div>

          <!-- profile dropdown -->
          <div class="relative ml-3">
            <el-dropdown>
              <button class="relative flex items-center space-x-2 rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                <span class="sr-only">Open user menu</span>
                    <?php
                      $navUser = Auth::user();
                      $dbAvatar = \Illuminate\Support\Facades\DB::table('user_profiles')->where('user_id', $navUser->id)->value('avatar');
                      if (!empty($dbAvatar)) {
                        $avatar = asset('storage/' . $dbAvatar);
                      } elseif (!empty($navUser->profile_photo_url)) {
                        $avatar = $navUser->profile_photo_url;
                      } else {
                        $avatarName = $navUser->name ?? 'User';
                        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($avatarName) . '&color=ffffff&background=059669&size=128';
                      }
                    ?>
                    <img src="<?php echo e($avatar); ?>" alt="<?php echo e($navUser->name ?? ''); ?>" class="h-8 w-8 rounded-full object-cover" />
                <div class="hidden sm:flex flex-col leading-tight max-w-[140px]">
                  <span class="text-sm font-medium text-gray-700 truncate"><?php echo e(Auth::user()->name); ?></span>
                  <span class="text-xs text-green-600 truncate font-bold"><?php echo e(Auth::user()->role ?? 'Petani'); ?></span>
                </div>
              </button>


              <el-menu anchor="bottom end" popover class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline outline-black/5">
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                <a href="/notifications" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Notifikasi</a>
                <form method="POST" action="/logout">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700">Keluar</button>
                </form>
              </el-menu>
            </el-dropdown>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

      <el-disclosure id="mobile-menu" hidden class="block sm:hidden border-t border-gray-200">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <a href="/" class="block rounded-lg px-3 py-2 text-base font-medium transition <?php echo e(request()->is('/') ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">Beranda</a>
      <a href="/forum" class="block rounded-lg px-3 py-2 text-base font-medium transition <?php echo e(request()->is('forum*') ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">Forum</a>
      <a href="/marketplace" class="block rounded-lg px-3 py-2 text-base font-medium transition <?php echo e(request()->is('marketplace*') ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">Marketplace</a>
        <?php if(auth()->guard()->check()): ?>
          <a href="/visit-requests" class="block rounded-lg px-3 py-2 text-base font-medium transition <?php echo e(request()->is('visit-requests*') || request()->is('kunjungan*') ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">Kunjungan Lokasi</a>
          <?php if(strtolower(Auth::user()->role ?? '') === 'petani'): ?>
            <a href="<?php echo e(route('dashboard.farmer')); ?>" class="block rounded-lg px-3 py-2 text-base font-medium transition <?php echo e(request()->is('dashboard/farmer*') ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'); ?>">Dashboard</a>
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </el-disclosure>
</nav>

<?php if(auth()->guard()->check()): ?>
<script>
  // Load notifications on page load
  document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
    // Refresh notifications every 30 seconds
    setInterval(loadNotifications, 30000);
  });

  function loadNotifications() {
    fetch('/notifications/unread')
      .then(response => response.json())
      .then(data => {
        const badge = document.getElementById('notif-badge');
        const list = document.getElementById('notification-list');
        
        // Update badge
        if (data.unread_count > 0) {
          badge.classList.remove('hidden');
        } else {
          badge.classList.add('hidden');
        }

        // Update notification list
        if (data.notifications.length > 0) {
          let html = '';
          data.notifications.forEach(notif => {
            const iconHtml = getNotificationIcon(notif.type);
            const timeAgo = formatTimeAgo(notif.created_at);
            
            html += `
              <a href="${notif.data.url || '#'}" 
                 onclick="markNotificationRead(${notif.notification_id})"
                 class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                <div class="flex items-start gap-3">
                  ${iconHtml}
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                      ${notif.data.title || 'Notifikasi'}
                    </p>
                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">${notif.data.message || ''}</p>
                    <p class="text-xs text-gray-400 mt-1">${timeAgo}</p>
                  </div>
                </div>
              </a>
            `;
          });
          
          html += `
            <div class="px-4 py-3 text-center border-t border-gray-200">
              <a href="/notifications" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                Lihat Semua Notifikasi
              </a>
            </div>
          `;
          
          list.innerHTML = html;
        } else {
          list.innerHTML = `
            <div class="px-4 py-8 text-center text-sm text-gray-500">
              Tidak ada notifikasi baru
            </div>
          `;
        }
      })
      .catch(err => {
        console.error('Error loading notifications:', err);
        document.getElementById('notification-list').innerHTML = `
          <div class="px-4 py-8 text-center text-sm text-red-500">
            Gagal memuat notifikasi
          </div>
        `;
      });
  }

  function getNotificationIcon(type) {
    const icons = {
      'visit_request_new': `
        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
        </div>
      `,
      'visit_request_approved': `
        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      `,
      'visit_request_rejected': `
        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      `
    };
    
    return icons[type] || `
      <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
      </div>
    `;
  }

  function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    if (seconds < 60) return 'Baru saja';
    if (seconds < 3600) return Math.floor(seconds / 60) + ' menit lalu';
    if (seconds < 86400) return Math.floor(seconds / 3600) + ' jam lalu';
    if (seconds < 604800) return Math.floor(seconds / 86400) + ' hari lalu';
    return Math.floor(seconds / 604800) + ' minggu lalu';
  }

  function markNotificationRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
      }
    })
    .then(() => {
      // Reload notifications after marking as read
      setTimeout(loadNotifications, 500);
    })
    .catch(err => console.error('Error marking notification as read:', err));
  }
</script>
<?php endif; ?>
<?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/components/navbar.blade.php ENDPATH**/ ?>
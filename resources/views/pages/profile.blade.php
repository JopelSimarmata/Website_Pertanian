<x-layout>
<x-navbar></x-navbar>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Header with Avatar --}}
  <div class="bg-gradient-to-r from-emerald-600 to-green-600 rounded-2xl shadow-lg p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
    
    <div class="relative flex flex-col md:flex-row items-center gap-6">
      <div class="relative">
        @php
          if (isset($profile) && !empty($profile->avatar)) {
              $avatar = asset('storage/' . $profile->avatar);
          } elseif (!empty($user->profile_photo_url)) {
              $avatar = $user->profile_photo_url;
          } else {
              $avatarName = $user->name ?? 'User';
              $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($avatarName) . '&color=ffffff&background=059669&size=128';
          }
        @endphp
        <img id="avatarPreview" src="{{ $avatar }}" alt="avatar" class="w-32 h-32 rounded-full object-cover shadow-2xl border-4 border-white/30" />
        <div class="absolute bottom-0 right-0 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg cursor-pointer" onclick="document.getElementById('editToggle').click()">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
          </svg>
        </div>
      </div>

      <div class="flex-1 text-center md:text-left">
        <h1 class="text-3xl font-bold mb-2">{{ $user->name ?? '—' }}</h1>
        <p class="text-emerald-100 mb-3 flex items-center justify-center md:justify-start gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          {{ $user->email ?? '—' }}
        </p>
        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
          <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/20 backdrop-blur-sm text-sm font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            {{ ucfirst($user->role ?? 'User') }}
          </span>
          @if(isset($profile) && !empty($profile->city))
            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/20 backdrop-blur-sm text-sm">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              {{ $profile->city }}{{ !empty($profile->province) ? ', ' . $profile->province : '' }}
            </span>
          @endif
        </div>
      </div>

      <div>
        <button onclick="toggleEdit()" id="editToggle" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-emerald-600 rounded-xl hover:bg-emerald-50 transition font-semibold shadow-lg">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
          </svg>
          <span id="editButtonText">Edit Profil</span>
        </button>
      </div>
    </div>
  </div>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg p-4">
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
      </div>
    </div>
  @endif

  {{-- Profile Content --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    
    {{-- Display Mode --}}
    <div id="display">
      <div class="px-8 py-6 border-b border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
          <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          Informasi Pribadi
        </h2>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan data pribadi Anda</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8">
        
        {{-- Personal Info Card --}}
        <div class="space-y-6">
          <h3 class="font-bold text-gray-900 text-lg pb-2 border-b border-gray-200">Data Diri</h3>
          
          <div class="space-y-4">
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-xs text-gray-500 mb-1">Nama Lengkap</p>
                <p class="font-semibold text-gray-900">{{ $user->name ?? '—' }}</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-xs text-gray-500 mb-1">Email</p>
                <p class="font-semibold text-gray-900">{{ $user->email ?? '—' }}</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-xs text-gray-500 mb-1">Nomor ID/KTP</p>
                <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->id_number : null) ?? '—' }}</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->phone : null) ?? '—' }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Location & Bank Info Card --}}
        <div class="space-y-6">
          <h3 class="font-bold text-gray-900 text-lg pb-2 border-b border-gray-200">Alamat & Bank</h3>
          
          <div class="space-y-4">
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-xs text-gray-500 mb-1">Alamat</p>
                <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->address : null) ?? '—' }}</p>
                @if(isset($profile) && ($profile->city || $profile->province))
                  <p class="text-sm text-gray-600 mt-1">
                    {{ $profile->city ?? '' }}{{ isset($profile->province) && $profile->province ? ', ' . $profile->province : '' }}
                    {{ isset($profile->postal_code) && $profile->postal_code ? ' - ' . $profile->postal_code : '' }}
                  </p>
                @endif
              </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-4 border border-emerald-100">
              <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Informasi Bank
              </h4>
              <div class="space-y-2">
                <div>
                  <p class="text-xs text-gray-600">Bank</p>
                  <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->bank_name : null) ?? '—' }}</p>
                </div>
                <div>
                  <p class="text-xs text-gray-600">Nama Pemilik</p>
                  <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->bank_account_name : null) ?? '—' }}</p>
                </div>
                <div>
                  <p class="text-xs text-gray-600">Nomor Rekening</p>
                  <p class="font-semibold text-gray-900">{{ (isset($profile) ? $profile->bank_account_number : null) ?? '—' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    {{-- Edit Mode --}}
    <form id="editForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
      @csrf
      
      <div class="px-8 py-6 border-b border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
          <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
          </svg>
          Edit Profil
        </h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi pribadi dan data akun Anda</p>
      </div>

      <div class="p-8 space-y-8">
        
        {{-- Avatar Upload --}}
        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border-2 border-gray-200">
          <h3 class="font-bold text-gray-900 mb-4">Foto Profil</h3>
          <div class="flex items-center gap-6">
            <img id="avatarEditPreview" src="{{ $avatar }}" class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow-md">
            <div class="flex-1">
              <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input id="avatarInput" type="file" name="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer" />
              </label>
              <p class="text-xs text-gray-500 mt-2">JPG, PNG atau GIF. Maksimal 2MB</p>
            </div>
          </div>
        </div>

        {{-- Personal Information --}}
        <div>
          <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Informasi Pribadi</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">
                Email <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Nomor ID/KTP</label>
              <input type="text" name="id_number" value="{{ old('id_number', isset($profile) ? $profile->id_number : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Nomor Telepon</label>
              <input type="text" name="phone" value="{{ old('phone', isset($profile) ? $profile->phone : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
          </div>
        </div>

        {{-- Address Information --}}
        <div>
          <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Informasi Alamat</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-gray-900 mb-2">Alamat Lengkap</label>
              <textarea name="address" rows="3" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition resize-none">{{ old('address', isset($profile) ? $profile->address : '') }}</textarea>
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Kota</label>
              <input type="text" name="city" value="{{ old('city', isset($profile) ? $profile->city : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Provinsi</label>
              <input type="text" name="province" value="{{ old('province', isset($profile) ? $profile->province : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Kode Pos</label>
              <input type="text" name="postal_code" value="{{ old('postal_code', isset($profile) ? $profile->postal_code : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
          </div>
        </div>

        {{-- Bank Information --}}
        <div>
          <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Informasi Bank</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Nama Bank</label>
              <input type="text" name="bank_name" value="{{ old('bank_name', isset($profile) ? $profile->bank_name : '') }}" placeholder="Contoh: BCA, Mandiri, BRI" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Nama Pemilik Rekening</label>
              <input type="text" name="bank_account_name" value="{{ old('bank_account_name', isset($profile) ? $profile->bank_account_name : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-gray-900 mb-2">Nomor Rekening</label>
              <input type="text" name="bank_account_number" value="{{ old('bank_account_number', isset($profile) ? $profile->bank_account_number : '') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" />
            </div>
          </div>
        </div>

      </div>

      {{-- Action Buttons --}}
      <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row gap-3 justify-end">
        <button type="button" onclick="toggleEdit()" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-semibold">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
          Batal
        </button>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Simpan Perubahan
        </button>
      </div>

    </form>

  </div>

</div>

<script>
  function toggleEdit(){
    var d = document.getElementById('display');
    var f = document.getElementById('editForm');
    var btnText = document.getElementById('editButtonText');
    
    if(d.style.display === 'none'){
      d.style.display = '';
      f.style.display = 'none';
      btnText.innerText = 'Edit Profil';
    } else {
      d.style.display = 'none';
      f.style.display = '';
      btnText.innerText = 'Tutup';
    }
  }

  // Preview avatar when user selects a file
  document.addEventListener('DOMContentLoaded', function(){
    var input = document.getElementById('avatarInput');
    var preview = document.getElementById('avatarPreview');
    var editPreview = document.getElementById('avatarEditPreview');
    
    if (input && (preview || editPreview)) {
      input.addEventListener('change', function(e){
        var file = this.files && this.files[0];
        if (!file) return;
        
        var reader = new FileReader();
        reader.onload = function(ev){
          if(preview) preview.src = ev.target.result;
          if(editPreview) editPreview.src = ev.target.result;
        }
        reader.readAsDataURL(file);
      });
    }
  });
</script>

</x-layout>
<x-layout>
<x-navbar></x-navbar>

  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-6 gap-4">
      <div class="flex items-center gap-4">
        @php
          if (!empty($profile->avatar)) {
              $avatar = asset('storage/' . $profile->avatar);
          } elseif (!empty($user->profile_photo_url)) {
              $avatar = $user->profile_photo_url;
          } else {
              $avatar = 'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';
          }
        @endphp
        <img id="avatarPreview" src="{{ $avatar }}" alt="avatar" class="h-16 w-16 rounded-full object-cover shadow" />

        <div>
          <h1 class="text-2xl font-bold text-emerald-800">{{ $user->name ?? '—' }}</h1>
          <div class="mt-1 text-sm text-gray-500">{{ $user->email ?? '—' }}</div>
          <div class="mt-2">
            <span class="inline-block text-xs px-2 py-0.5 rounded bg-gray-100 text-gray-700">{{ ucfirst($user->role ?? 'User') }}</span>
          </div>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <button onclick="toggleEdit()" id="editToggle" class="bg-emerald-600 text-white px-3 py-2 rounded-md">Edit</button>
      </div>
    </div>

    @if(session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow sm:rounded-lg">
      <div class="px-4 py-6 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage your account information</p>
      </div>
      <div class="border-t border-gray-200 px-4 py-6 sm:p-0">
        <div id="display" class="divide-y divide-gray-100">
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">Full name</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->name ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">Email address</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->email ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">ID Number</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $profile->id_number ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">Phone</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $profile->phone ?? $user->phone ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">Address</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $profile->address ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">City</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $profile->city ?? '—' }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-900">Province</dt>
            <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $profile->province ?? '—' }}</dd>
          </div>
        </div>

        <form id="editForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display:none;" class="space-y-6 px-4 py-6 sm:px-6">
          @csrf
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full name</label>
              <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Number</label>
              <input type="text" name="id_number" value="{{ old('id_number', $profile->id_number ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Postal Code</label>
              <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700">Address</label>
              <textarea name="address" class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('address', $profile->address ?? '') }}</textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">City</label>
              <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Province</label>
              <input type="text" name="province" value="{{ old('province', $profile->province ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Bank Name</label>
              <input type="text" name="bank_name" value="{{ old('bank_name', $profile->bank_name ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Bank Account Name</label>
              <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $profile->bank_account_name ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700">Bank Account Number</label>
              <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $profile->bank_account_number ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
            </div>
              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Avatar (image)</label>
                <input id="avatarInput" type="file" name="avatar" accept="image/*" class="mt-1 block w-full" />
                <p class="text-xs text-gray-500 mt-1">Pilih gambar untuk mengubah avatar. Preview akan muncul sebelum disimpan.</p>
              </div>
          </div>

          <div class="flex items-center justify-end gap-2">
            <button type="button" onclick="toggleEdit()" class="bg-gray-200 px-4 py-2 rounded-md">Cancel</button>
            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md">Save</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    function toggleEdit(){
      var d = document.getElementById('display');
      var f = document.getElementById('editForm');
      var btn = document.getElementById('editToggle');
      if(d.style.display === 'none'){
        d.style.display = '';
        f.style.display = 'none';
        btn.innerText = 'Edit';
      } else {
        d.style.display = 'none';
        f.style.display = '';
        btn.innerText = 'Close';
      }
    }
  </script>

  <script>
    // preview avatar when user selects a file
    document.addEventListener('DOMContentLoaded', function(){
      var input = document.getElementById('avatarInput');
      var preview = document.getElementById('avatarPreview');
      if (input && preview) {
        input.addEventListener('change', function(e){
          var file = this.files && this.files[0];
          if (!file) return;
          var reader = new FileReader();
          reader.onload = function(ev){
            preview.src = ev.target.result;
          }
          reader.readAsDataURL(file);
        });
      }
    });
  </script>

</x-layout>
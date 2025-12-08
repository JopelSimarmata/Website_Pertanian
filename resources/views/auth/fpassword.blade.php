<x-layout>
  <div class="max-w-md mx-auto mt-20 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Reset Password</h2>

    @if (session('success'))
      <div class="bg-emerald-100 text-emerald-700 p-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <label class="block mb-2 font-medium">Email</label>
      <input type="email" name="email" class="w-full border rounded px-3 py-2" required>

      @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror

      <button type="submit" class="mt-4 w-full bg-emerald-600 text-white py-2 rounded">
        Kirim Link Reset Password
      </button>
    </form>
  </div>
</x-layout>

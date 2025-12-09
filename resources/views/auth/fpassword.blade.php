<x-layout>
  <div class="min-h-screen bg-gradient-to-r from-green-100 to-green-50 flex items-center justify-center px-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 ring-1 ring-gray-100">

      <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-emerald-800">Lupa Password</h2>
        <p class="text-sm text-gray-500 mt-1">Masukkan email Anda untuk menerima tautan reset password.</p>
      </div>

      @if (session('status'))
        <div class="bg-emerald-100 text-emerald-700 p-3 rounded mb-4 text-sm">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input 
            type="email" 
            name="email"
            required 
            class="mt-2 block w-full rounded-md border border-gray-200 px-3 py-2 placeholder-gray-400 focus:ring-emerald-300 focus:outline-none"
          />
          @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <button 
          type="submit" 
          class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold transition">
          Kirim Email Reset Password
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-500">
        Ingat password? 
        <a href="/login" class="text-emerald-600 font-semibold hover:underline">Masuk</a>
      </p>

    </div>
  </div>
</x-layout>

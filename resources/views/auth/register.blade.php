<x-layout>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" class="mx-auto h-10 w-auto" />
    <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">Daftar</h2>
  </div>

  <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{ route('register  ') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="name" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
        <div class="mt-2">
          <input id="name" type="text" name="name" required autocomplete="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" value="{{ old('name') }}">
        </div>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" value="{{ old('email') }}">
        </div>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
        <div class="mt-2">
          <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
        </div>
      </div>

      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Konfirmasi Password</label>
        <div class="mt-2">
          <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar</button>
      </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
      Sudah punya akun?
      <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk sekarang</a>
    </p>
  </div>
</div>
</x-layout>
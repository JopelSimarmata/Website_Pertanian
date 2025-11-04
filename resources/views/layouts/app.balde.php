<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Title tiap halaman diatur lewat @section('title') --}}
    <title>@yield('title', 'LadangQu')</title>

    {{-- Load CSS Tailwind --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- Navbar Global --}}
    @include('partials.navbar')

    {{-- Tempat masuk konten halaman --}}
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    {{-- Footer Global --}}
    @include('partials.footer')

    {{-- Load JS --}}
    @vite('resources/js/app.js')
</body>

</html>

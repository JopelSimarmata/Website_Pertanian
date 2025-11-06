<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
    <title>LadangQu</title>
</head>
<body class="bg-[#ECFFE6] text-gray-900">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- CONTENT: navbar is fixed at the top, add top padding so page content is not covered --}}
    <div class="pt-20">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('components.footer')

</body>
</html>

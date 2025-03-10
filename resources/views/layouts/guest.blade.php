<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BMHC</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-cover bg-center relative"
      style="background-image: url('{{ asset('images/bgna.jpg') }}'); background-size: cover; background-position: center;">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-opacity-80 relative z-10 px-6">
        <div class="flex flex-col items-center">
            <a href="/" wire:navigate class="flex flex-col items-center">
                <img src="{{ asset('images/app-removebg-preview.png') }}" alt="" class="w-24 h-24">
                <h1 class="text-3xl font-bold text-blue-800 mt-2 tracking-wide shadow-md">BMHC</h1>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</body>
</html>

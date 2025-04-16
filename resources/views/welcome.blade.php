<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome | BHMC</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .background-image {
            background-image: url('images/s.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="relative min-h-screen flex items-center justify-center background-image">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-60 z-0"></div>

        <!-- Content -->
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-5xl font-extrabold mb-4 tracking-tight">
                Welcome to <span class="text-green-400">BHMC</span>
            </h1>
            <p class="text-lg mb-8 text-gray-200">
                A simple and efficient platform for managing your health center data.
            </p>

            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300 w-64">
                    Login
                </a>

            </div>


        </div>
    </div>

</body>
</html>

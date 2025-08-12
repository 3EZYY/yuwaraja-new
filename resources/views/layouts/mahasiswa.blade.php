<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'YUWARAJAXVII') }} - Mahasiswa Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-yuwarajaxvii.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-yuwarajaxvii.svg') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'orbitron': ['Orbitron', 'sans-serif'],
                        'rajdhani': ['Rajdhani', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <!-- Sidebar Component -->
        <x-sidebar role="mahasiswa" />

        <!-- Main Content -->
        <div class="lg:ml-72 transition-all duration-300">
            <!-- Top Navigation Bar (Mobile/Additional) -->
            <nav class="bg-black/20 backdrop-blur-md border-b border-cyan-400/20 p-4 lg:hidden">
                <div class="flex items-center justify-between">
                    <h1 class="text-white font-bold">YUWARAJA XVII</h1>
                    <div class="flex items-center space-x-4">
                        <!-- User Profile -->
                        <div class="flex items-center space-x-2">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('profile-pictures/' . Auth::user()->photo) }}" alt="Profile Photo" class="w-8 h-8 rounded-full border-2 border-cyan-400">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                                </div>
                            @endif
                            <span class="text-white text-sm">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="min-h-screen">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

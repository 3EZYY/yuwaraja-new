<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Session Expired - {{ config('app.name', 'YUWARAJA XVII') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600;700&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(255, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            animation: grid-move 20s linear infinite;
        }

        @keyframes grid-move {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .glow-text {
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(255, 0, 0, 0.3); }
            to { box-shadow: 0 0 30px rgba(255, 0, 0, 0.6); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Cyber Grid Background -->
    <div class="cyber-grid"></div>
    
    <!-- Main Content -->
    <div class="relative z-10 text-center px-6 max-w-2xl mx-auto">
        <!-- 419 Number -->
        <div class="mb-8 float-animation">
            <h1 class="text-8xl md:text-9xl font-bold font-mono glow-text text-red-400">
                419
            </h1>
        </div>
        
        <!-- Error Message -->
        <div class="mb-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-kanit">
                Session Expired
            </h2>
            <p class="text-lg text-gray-300 mb-6 font-kanit">
                Sesi Anda telah berakhir karena keamanan. 
                Silakan refresh halaman atau login kembali untuk melanjutkan.
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <!-- Refresh Button -->
            <button onclick="location.reload()" 
                    class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-300 pulse-glow font-kanit">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh Halaman
            </button>
            
            <!-- Login Button -->
            <a href="{{ url('/login') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition-all duration-300 font-kanit">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login Kembali
            </a>
        </div>
        
        <!-- Additional Help -->
        <div class="mt-12 text-center">
            <p class="text-gray-400 text-sm font-kanit">
                Untuk keamanan, sesi akan berakhir setelah periode tidak aktif. 
                <br>
                <a href="{{ url('/') }}" class="text-red-400 hover:text-red-300 underline">
                    Kembali ke beranda
                </a>
            </p>
        </div>
        
        <!-- Logo -->
        <div class="mt-8 flex justify-center">
            <img src="{{ asset('images/logo-yuwarajaxvii.svg') }}" 
                 alt="YUWARAJA XVII" 
                 class="h-16 w-auto opacity-50">
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 border border-red-400 opacity-30 rotate-45"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 border border-red-400 opacity-20 rotate-12"></div>
    <div class="absolute top-1/2 left-5 w-2 h-2 bg-red-400 rounded-full opacity-60"></div>
    <div class="absolute top-1/4 right-20 w-1 h-1 bg-red-400 rounded-full opacity-80"></div>
</body>
</html>
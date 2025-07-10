<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PKKMB YUWARAJA 2025 - ACCESS TERMINAL</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @if (!file_exists(public_path('build/manifest.json')))
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <!-- Kustomisasi CSS - VERSI RAPIH & KONSISTEN -->
        <style>
            /* === CORE SETUP === */
            body {
                font-family: 'Rajdhani', sans-serif;
                background-color: #0a0a14;
                color: #e0e0e0;
                overflow-x: hidden;
            }
            .font-orbitron { font-family: 'Orbitron', sans-serif; }

            /* === ANIMATED BACKGROUND === */
            .background-container {
                position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: -1;
                background: linear-gradient(135deg, #0a0a14 0%, #1a0f2e 100%);
            }
            .grid-lines {
                position: absolute; inset: 0;
                background-image:
                    linear-gradient(rgba(0, 255, 255, 0.07) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(240, 200, 8, 0.07) 1px, transparent 1px);
                background-size: 40px 40px;
                animation: pan-grid 60s linear infinite;
            }
            @keyframes pan-grid {
                from { background-position: 0 0; } to { background-position: 100% 100%; }
            }

            /* === LOGIN FORM CONTAINER & ANIMASI === */
            .auth-card {
                background: rgba(13, 12, 34, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(0, 225, 255, 0.2);
                box-shadow: 0 0 40px rgba(247, 212, 38, 0.15);
                position: relative;
                overflow: hidden;
                animation: float-in 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
                opacity: 0;
            }
            @keyframes float-in {
                from { transform: translateY(40px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            /* === DEKORASI VISUAL CARD === */
            .auth-card::before {
                content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
                background: linear-gradient(90deg, transparent, #00e1ff, transparent);
                animation: scanline 5s linear infinite 1.5s;
            }
            @keyframes scanline { from { top: -10px; } to { top: 110%; } }
            
            .corner {
                position: absolute; width: 15px; height: 15px;
                border-color: #F7D426; border-style: solid;
                opacity: 0; animation: show-borders 1s forwards 1s;
            }
            @keyframes show-borders { to { opacity: 0.8; } }
            .corner.top-left { top: -1px; left: -1px; border-width: 2px 0 0 2px; }
            .corner.top-right { top: -1px; right: -1px; border-width: 2px 2px 0 0; }
            .corner.bottom-left { bottom: -1px; left: -1px; border-width: 0 0 2px 2px; }
            .corner.bottom-right { bottom: -1px; right: -1px; border-width: 0 2px 2px 0; }

            /* === FORM STYLING (SANGAT PENTING!) === */
            .form-field {
                position: relative;
                margin-bottom: 1.5rem; /* 24px */
                animation: float-in 0.8s forwards;
                opacity: 0;
            }
            .cyber-input {
                background: rgba(10, 10, 20, 0.5) !important;
                border: 1px solid rgba(0, 225, 255, 0.3) !important;
                color: #e0e0e0 !important;
                border-radius: 4px !important;
                width: 100%;
                padding: 10px 15px !important;
                transition: all 0.3s ease;
            }
            .cyber-input:focus {
                outline: none !important;
                border-color: #F7D426 !important;
                box-shadow: 0 0 10px rgba(240, 200, 8, 0.5) !important;
                --tw-ring-shadow: 0 0 #0000 !important;
            }
            /* FIX UNTUK BROWSER AUTOFILL (background jadi aneh) */
            .cyber-input:-webkit-autofill,
            .cyber-input:-webkit-autofill:hover, 
            .cyber-input:-webkit-autofill:focus, 
            .cyber-input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0 30px #1a0f2e inset !important;
                -webkit-text-fill-color: #e0e0e0 !important;
                caret-color: #e0e0e0 !important;
                border-color: #F7D426 !important;
            }

            /* === CUSTOM SELECT/DROPDOWN === */
            .cyber-select {
                -webkit-appearance: none; -moz-appearance: none; appearance: none;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2300e1ff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
                background-position: right 0.75rem center;
                background-repeat: no-repeat; background-size: 1.2em 1.2em;
            }
            .cyber-select:focus {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ff00dd' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            }
            .cyber-select option { background-color: #1a0f2e; color: #e0e0e0; }

            /* === CUSTOM DATE PICKER ICON === */
            .cyber-input[type="date"]::-webkit-calendar-picker-indicator {
                filter: invert(80%) sepia(50%) saturate(5000%) hue-rotate(150deg);
                cursor: pointer;
                opacity: 0.7;
                transition: opacity 0.3s;
            }
            .cyber-input[type="date"]::-webkit-calendar-picker-indicator:hover { opacity: 1; }

            /* === CUSTOM CHECKBOX === */
            .cyber-checkbox-label input[type="checkbox"] { display: none; }
            .cyber-checkbox-label .custom-checkbox-ui::before {
                content: ''; display: inline-block;
                width: 16px; height: 16px; border: 1px solid rgba(0, 225, 255, 0.5);
                margin-right: 10px; vertical-align: -3px; transition: all 0.2s;
                border-radius: 2px;
            }
            .cyber-checkbox-label input[type="checkbox"]:checked + .custom-checkbox-ui::before {
                background-color: #00e1ff; border-color: #00e1ff; box-shadow: 0 0 5px #00e1ff;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="background-container">
            <div class="grid-lines"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4">
            <div class="auth-card w-full sm:max-w-xl p-8 md:p-12 rounded-lg">
                <div class="corner top-left"></div><div class="corner top-right"></div>
                <div class="corner bottom-left"></div><div class="corner bottom-right"></div>
                
                <div class="text-center mb-8 opacity-0" style="animation: float-in 1s forwards 0.5s;">
                    <a href="/">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Yuwaraaja" class="mx-auto mb-4 w-24 h-24">
                        <h1 class="text-3xl md:text-4xl font-orbitron font-black uppercase text-white">
                            YUWARAJA <span class="text-cyan-400">2025</span>
                        </h1>
                        <p class="text-yellow-400 text-sm tracking-[0.3em]">PKKMB VOKASI UB</p>
                    </a>
                </div>

                {{-- Slot untuk form --}}
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
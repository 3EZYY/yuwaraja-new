<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>PPKMB Fakultas Vokasi - YUWARAJA</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Tailwind Config -->
        <script>
            tailwind.config = {
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

        <!-- Kustomisasi CSS - VERSI RAPIH & KONSISTEN -->
        <style>
            /* === TEXT EFFECTS === */
            .text-glow-cyan {
                text-shadow: 0 0 10px #00eaff, 0 0 20px #00eaff, 0 0 30px #00eaff;
            }
            .text-glow-yellow {
                text-shadow: 0 0 10px #ffe066, 0 0 20px #ffe066, 0 0 30px #ffe066;
            }
            .text-glow-red {
                text-shadow: 0 0 10px #ef4444, 0 0 20px #ef4444, 0 0 30px #ef4444;
            }
            
            /* === CYBERPUNK GRID === */
            .cyber-grid {
                background-image: 
                    linear-gradient(rgba(0, 234, 255, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(0, 234, 255, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: grid-move 20s linear infinite;
            }
            @keyframes grid-move {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }
            
            /* === FLOATING PARTICLES === */
            .floating-particles {
                position: relative;
                overflow: hidden;
            }
            .floating-particles::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    radial-gradient(2px 2px at 20px 30px, rgba(255, 224, 102, 0.3), transparent),
                    radial-gradient(2px 2px at 40px 70px, rgba(0, 234, 255, 0.3), transparent),
                    radial-gradient(1px 1px at 90px 40px, rgba(255, 224, 102, 0.2), transparent),
                    radial-gradient(1px 1px at 130px 80px, rgba(0, 234, 255, 0.2), transparent);
                background-repeat: repeat;
                background-size: 200px 100px;
                animation: float-particles 15s ease-in-out infinite;
                pointer-events: none;
            }
            @keyframes float-particles {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-10px) rotate(180deg); }
            }
            
            /* === CORE SETUP === */
            body {
                font-family: 'Rajdhani', sans-serif;
                background-color: #0a0a14;
                color: #e0e0e0;
                overflow-x: hidden;
                width: 100%;
                max-width: 100vw;
            }
            
            * {
                box-sizing: border-box;
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
                max-width: 100%;
                width: 100%;
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
                width: 100% !important;
                max-width: 100% !important;
                padding: 10px 15px !important;
                transition: all 0.3s ease;
                box-sizing: border-box !important;
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

            /* === RESPONSIVE FIXES === */
            @media (max-width: 768px) {
                .auth-card {
                    margin: 1rem;
                    padding: 1rem !important;
                    max-width: calc(100vw - 2rem);
                }
                .cyber-input {
                    font-size: 16px !important; /* Prevent zoom on iOS */
                }
                .grid {
                    gap: 1rem !important;
                }
            }
            
            @media (max-width: 480px) {
                .auth-card {
                    margin: 0.5rem;
                    padding: 0.75rem !important;
                    max-width: calc(100vw - 1rem);
                }
                h1 {
                    font-size: 1.5rem !important;
                }
                h2 {
                    font-size: 1rem !important;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Session Expired Alert -->
        <?php if(session('show_alert') && session('error')): ?>
            <div id="session-alert" 
                 class="fixed top-4 right-4 z-50 bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg border border-red-500"
                 style="animation: slide-in 0.5s ease-out;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <span class="font-medium"><?php echo e(session('error')); ?></span>
                    </div>
                    <button onclick="closeAlert()" class="ml-4 text-white hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-2">
                    <button onclick="location.reload()" 
                            class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded text-sm transition-colors">
                        Refresh Halaman
                    </button>
                </div>
            </div>
            
            <style>
                @keyframes slide-in {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slide-out {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            </style>
            
            <script>
                function closeAlert() {
                    const alert = document.getElementById('session-alert');
                    if (alert) {
                        alert.style.animation = 'slide-out 0.3s ease-in forwards';
                        setTimeout(() => alert.remove(), 300);
                    }
                }
                
                // Auto hide alert after 10 seconds
                setTimeout(() => {
                    closeAlert();
                }, 10000);
            </script>
        <?php endif; ?>

        <div class="background-container">
            <div class="grid-lines"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-center items-center py-6 px-2 sm:px-4">
            <div class="auth-card w-full max-w-2xl p-4 sm:p-6 md:p-8 lg:p-12 rounded-lg">
                <div class="corner top-left"></div><div class="corner top-right"></div>
                <div class="corner bottom-left"></div><div class="corner bottom-right"></div>
                
                <div class="text-center mb-8 opacity-0" style="animation: float-in 1s forwards 0.5s;">
                    <a href="/">
                        <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo Yuwaraaja" class="mx-auto mb-4 w-24 h-24">
                        <h1 class="text-3xl md:text-4xl font-orbitron font-black uppercase text-white">
                            YUWARAJA <span class="text-cyan-400">2025</span>
                        </h1>
                        <p class="text-yellow-400 text-sm tracking-[0.3em]">PKKMB VOKASI UB</p>
                    </a>
                </div>

                
                <?php echo e($slot); ?>

            </div>
        </div>
    </body>
</html><?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/layouts/guest.blade.php ENDPATH**/ ?>
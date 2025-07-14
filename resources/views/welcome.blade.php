<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKKMB YUWARAJA 2025 - Vokasi Universitas Brawijaya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --color-bg: #02040a;
            --color-primary: #00d1ff;
            --color-secondary: #ffc900;
            --color-text: #c0c8d6;
            --color-heading: #ffffff;
            --color-surface: rgba(10, 15, 29, 0.6);
        }

        html {
            scroll-behavior: auto;
        }

        body {
            font-family: 'Exo 2', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            overflow-x: hidden;
        }

        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
        }

        .font-kanit {
            font-family: 'Kanit', sans-serif;
        }

        /* === BACKGROUND & ANIMASI === */
        .background-wrapper {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .background-wrapper::before,
        .background-wrapper::after {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(0, 209, 255, 0.1), transparent 60%);
            animation: move-glow 20s infinite alternate ease-in-out;
        }

        .background-wrapper::after {
            bottom: -200px;
            right: -200px;
            background: radial-gradient(circle, rgba(255, 201, 0, 0.08), transparent 60%);
            animation-duration: 25s;
            animation-direction: alternate-reverse;
        }

        @keyframes move-glow {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(100px, 100px);
            }
        }

        .grid-lines {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 209, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 201, 0, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: pan-grid 60s linear infinite;
        }

        @keyframes pan-grid {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 1000px 1000px;
            }
        }

        .stars-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(to top, var(--color-primary), transparent);
            border-radius: 999px;
            opacity: 0;
            animation: meteor-fall 8s ease-in-out infinite;
            filter: drop-shadow(0 0 8px var(--color-primary));
            transform: rotate(15deg);
        }

        .star:nth-child(1) {
            top: -10%;
            left: 10%;
            animation-delay: 0s;
        }

        .star:nth-child(2) {
            top: -20%;
            left: 25%;
            animation-delay: 2s;
        }

        .star:nth-child(3) {
            top: -15%;
            left: 45%;
            animation-delay: 4s;
            background: linear-gradient(to bottom, var(--color-secondary), transparent);
        }

        .star:nth-child(4) {
            top: -10%;
            left: 60%;
            animation-delay: 6s;
        }

        .star:nth-child(5) {
            top: -25%;
            left: 75%;
            animation-delay: 1.5s;
        }

        .star:nth-child(6) {
            top: -30%;
            left: 85%;
            animation-delay: 3.5s;
        }

        .star:nth-child(7) {
            top: -10%;
            left: 95%;
            animation-delay: 5s;
            background: linear-gradient(to bottom, var(--color-secondary), transparent);
        }

        @keyframes meteor-fall {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(15deg);
            }

            5% {
                opacity: 1;
            }

            100% {
                transform: translateY(120vh) rotate(15deg);
                opacity: 0;
            }
        }

        /* === EFEK GLOW (SHADOW) PADA ELEMEN === */
        .text-glow-yellow {
            text-shadow: 0 0 8px rgba(255, 201, 0, 0.6);
        }

        .text-glow-cyan {
            text-shadow: 0 0 8px rgba(0, 209, 255, 0.6);
        }

        .box-glow-yellow {
            box-shadow: 0 0 25px rgba(255, 201, 0, 0.15);
        }

        .box-glow-cyan {
            box-shadow: 0 0 25px rgba(0, 209, 255, 0.1);
        }

        /* === KODE LAINNYA (SUDAH DISEMPURNAKAN) === */
        .reveal-up {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1s cubic-bezier(0.19, 1, 0.22, 1), transform 1s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .reveal-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .section-title.visible::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            height: 2px;
            width: 80px;
            background: var(--color-secondary);
            animation: scale-line 1s cubic-bezier(0.19, 1, 0.22, 1) 0.5s forwards;
            transform-origin: center;
        }

        @keyframes scale-line {
            from {
                transform: translateX(-50%) scaleX(0);
            }

            to {
                transform: translateX(-50%) scaleX(1);
            }
        }

        .glitch-text {
            position: relative;
            color: var(--color-heading);
        }

        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--color-bg);
            overflow: hidden;
        }

        .glitch-text::before {
            left: 2px;
            text-shadow: -2px 0 var(--color-secondary);
            animation: glitch-anim-1 2.5s infinite linear reverse;
        }

        .glitch-text::after {
            left: -2px;
            text-shadow: -2px 0 var(--color-primary);
            animation: glitch-anim-2 2s infinite linear reverse;
        }

        @keyframes glitch-anim-1 {

            0%,
            100% {
                clip-path: inset(45% 0 50% 0);
            }

            25% {
                clip-path: inset(0 0 100% 0);
            }

            50% {
                clip-path: inset(80% 0 15% 0);
            }

            75% {
                clip-path: inset(40% 0 33% 0);
            }
        }

        @keyframes glitch-anim-2 {

            0%,
            100% {
                clip-path: inset(65% 0 30% 0);
            }

            25% {
                clip-path: inset(20% 0 75% 0);
            }

            50% {
                clip-path: inset(50% 0 45% 0);
            }

            75% {
                clip-path: inset(10% 0 85% 0);
            }
        }

        .cyber-card {
            background: var(--color-surface);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 209, 255, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border-radius: 0.5rem;
        }

        .cyber-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 201, 0, 0.15);
        }

        header.scrolled {
            background-color: rgba(5, 6, 11, 0.8);
            backdrop-filter: blur(10px);
            border-bottom-color: rgba(255, 201, 0, 0.1);
        }

        .explore-button {
            display: inline-flex;
            align-items: center;
            border: 2px solid var(--color-secondary);
            font-weight: 700;
            position: relative;
            transition: all 0.3s ease;
        }

        .explore-button .text-part {
            background-color: var(--color-bg);
            color: var(--color-secondary);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .explore-button .color-part {
            background-color: var(--color-secondary);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .explore-button:hover .text-part {
            background-color: transparent;
        }

        .header-button {
            background: rgba(0, 209, 255, 0.1);
            border: 1px solid rgba(0, 209, 255, 0.3);
            color: #fff;
            transition: all 0.3s ease;
        }

        .header-button:hover {
            background: var(--color-primary);
            color: var(--color-bg);
            box-shadow: 0 0 15px var(--color-primary);
        }

        details {
            border: 1px solid rgba(0, 209, 255, 0.15);
            transition: background-color 0.3s, border-color 0.3s;
        }

        details:hover {
            background-color: var(--color-surface);
        }

        details[open] {
            background-color: var(--color-surface);
            border-color: rgba(255, 201, 0, 0.6);
        }

        details summary::-webkit-details-marker {
            display: none;
        }

        details[open] summary .arrow-down {
            transform: rotate(180deg);
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            /* Mulai dari luar layar */
            width: 70%;
            max-width: 300px;
            height: 100vh;
            background-color: rgba(5, 6, 11, 0.95);
            backdrop-filter: blur(15px);
            z-index: 998;
            transition: right 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
            border-left: 1px solid rgba(0, 209, 255, 0.2);
        }

        .mobile-nav.open {
            right: 0;
        }

        /* Tombol Hamburger */
        .hamburger-button {
            z-index: 999;
            display: none;
            /* Hanya muncul di mobile */
        }

        @media (max-width: 767px) {
            .hamburger-button {
                display: block;
            }
        }

        .hamburger-button .line {
            width: 28px;
            height: 2px;
            background-color: var(--color-heading);
            transition: all 0.3s ease-in-out;
        }

        .hamburger-button.open .line-1 {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger-button.open .line-2 {
            opacity: 0;
        }

        .hamburger-button.open .line-3 {
            transform: rotate(-45deg) translate(6px, -6px);
        }
    </style>
</head>

<body class="antialiased">
    <!-- Background Wrapper -->
    <div class="background-wrapper">
        <div class="grid-lines"></div>
        <div class="stars-container">
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
        </div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-transparent bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-4" style="user-select: none;">
                <img src="/images/logo.svg" alt="Logo Yuwaraja 2025" class="h-10 md:h-12 w-auto object-contain">
                <span class="text-xl md:text-2xl font-orbitron font-extrabold text-white tracking-wider">
                    YUWARAJA<span class="text-cyan-400">25</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav id="main-nav"
                class="hidden md:flex items-center space-x-6 lg:space-x-8 font-rajdhani font-bold text-sm lg:text-base text-gray-300" style="user-select: none;">
                <a href="#beranda" class="nav-link hover:text-yellow-400 transition-colors">BERANDA</a>
                <a href="#informasi" class="nav-link hover:text-yellow-400 transition-colors">INFORMASI</a>
                <a href="#prodi" class="nav-link hover:text-yellow-400 transition-colors">PRODI</a>
                <a href="#faq" class="nav-link hover:text-yellow-400 transition-colors">FAQ</a>
            </nav>

            <!-- Auth buttons & Hamburger -->
            <div class="flex items-center gap-4">
                <!-- Desktop Auth Buttons -->
                <div class="hidden md:flex items-center gap-2">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="header-button px-5 py-2 text-sm font-bold rounded-md">DASHBOARD</a>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-300 hover:text-white px-4 py-2 transition-colors">Log In</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="header-button px-5 py-2 text-sm font-bold rounded-md">REGISTER</a>
                    @endif
                    @endauth
                    @endif
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="hamburger-button"
                    class="hamburger-button flex flex-col justify-center items-center space-y-1.5 md:hidden z-50">
                    <span class="line line-1 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                    <span class="line line-2 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                    <span class="line line-3 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                </button>
            </div>
        </div>
    </header>

    <main class="relative z-10">
        <!-- Hero Section -->
        <section id="beranda" class="min-h-screen flex items-center justify-center text-center overflow-hidden">
            <div class="container mx-auto px-6" style="user-select: none;">
                <div class="max-w-4xl mx-auto">
                    <h2
                        class="font-rajdhani text-2xl md:text-3xl text-cyan-400 tracking-[0.3em] uppercase reveal-up text-glow-cyan">
                        PKKMB VOKASI UB</h2>
                    <h1 class="font-orbitron text-5xl md:text-7xl lg:text-8xl text-white mt-4 reveal-up glitch-text"
                        style="transition-delay: 0.2s;" data-text="YUWARAJA 2025">
                        YUWARAJA 2025
                    </h1>
                    <p class="mt-8 text-lg md:text-xl text-gray-400 leading-relaxed reveal-up"
                        style="transition-delay: 0.4s;">
                        Sebuah era baru telah tiba. Sambungkan potensimu, bentuk masa depan. Selamat datang, Ksatria
                        Yuwaraja, di gerbang inovasi Fakultas Vokasi Universitas Brawijaya.
                    </p>
                    <div class="mt-12 reveal-up" style="transition-delay: 0.6s;">
                        <a href="#informasi" class="explore-button">
                            <span class="color-part">
                                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </span>
                            <span class="text-part text-lg">MULAI EKSPLORASI</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi Terbaru Section -->
        <section id="informasi" class="py-24">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2
                        class="section-title reveal-up text-4xl md:text-5xl font-orbitron font-bold text-white text-glow-yellow relative">
                        LATEST <span class="text-yellow-400">TRANSMISSIONS</span></h2>
                    <p class="mt-4 text-lg text-gray-400 reveal-up" style="transition-delay: 0.2s;">Update intel penting
                        langsung dari pusat komando.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="cyber-card p-8 reveal-up box-glow-yellow">
                        <h3 class="text-xl font-bold font-rajdhani text-white mb-2 text-glow-yellow">RANGKAIAN ACARA
                        </h3>
                        <p class="text-gray-400">Jadwal lengkap, peraturan pakaian, dan semua yang perlu kamu ketahui
                            untuk orientasi. Jangan sampai salah kostum, Ksatria!</p>
                    </div>
                    <div class="cyber-card p-8 reveal-up box-glow-cyan" style="transition-delay: 0.15s;">
                        <h3 class="text-xl font-bold font-rajdhani text-white mb-2 text-glow-cyan">MISI & PENUGASAN</h3>
                        <p class="text-gray-400">Tugas awal telah di-deploy! Selesaikan misimu untuk membuktikan
                            kemampuan dan mendapatkan poin pengalaman pertama.</p>
                    </div>
                    <div class="cyber-card p-8 reveal-up box-glow-yellow" style="transition-delay: 0.3s;">
                        <h3 class="text-xl font-bold font-rajdhani text-white mb-2 text-glow-yellow">EVENT KOMUNITAS
                        </h3>
                        <p class="text-gray-400">Jadwal meet & greet, workshop, dan webinar untuk memperluas jaringanmu.
                            Saatnya terhubung dengan ksatria lain!</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Studi Section -->
        <section id="prodi" class="py-24 bg-black/20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2
                        class="section-title reveal-up text-4xl md:text-5xl font-orbitron font-bold text-white text-glow-cyan relative">
                        PILIH <span class="text-cyan-400">SPESIALISASIMU</span></h2>
                    <p class="mt-4 text-lg text-gray-400 reveal-up" style="transition-delay: 0.2s;">Dua departemen,
                        berbagai jalur untuk mendominasi masa depan.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="reveal-up">
                        <h3
                            class="text-3xl font-orbitron font-bold text-cyan-400 mb-6 border-b-2 border-cyan-400/30 pb-4 text-glow-cyan">
                            DEPT. BISNIS & HOSPITALITY</h3>
                        <ul class="space-y-6">
                            <li>
                                <h4 class="text-xl font-rajdhani font-bold text-white">D4 MANAJEMEN PERHOTELAN</h4>
                                <p class="text-gray-400">Mencetak pemimpin visioner di industri perhotelan global.</p>
                            </li>
                            <li>
                                <h4 class="text-xl font-rajdhani font-bold text-white">D3 KEUANGAN & PERBANKAN</h4>
                                <p class="text-gray-400">Menguasai arus finansial dengan presisi dan teknologi terkini.
                                </p>
                            </li>
                            <li>
                                <h4 class="text-xl font-rajdhani font-bold text-white">D3 ADMINISTRASI BISNIS</h4>
                                <p class="text-gray-400">Menjadi ahli strategi dalam manajemen dan operasional bisnis
                                    modern.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="reveal-up" style="transition-delay: 0.2s;">
                        <h3
                            class="text-3xl font-orbitron font-bold text-yellow-400 mb-6 border-b-2 border-yellow-400/30 pb-4 text-glow-yellow">
                            DEPT. INDUSTRI KREATIF & DIGITAL</h3>
                        <ul class="space-y-6">
                            <li>
                                <h4 class="text-xl font-rajdhani font-bold text-white">D4 DESAIN GRAFIS</h4>
                                <p class="text-gray-400">Mengubah imajinasi menjadi karya visual yang mendefinisikan
                                    zaman.</p>
                            </li>
                            <li>
                                <h4 class="text-xl font-rajdhani font-bold text-white">D3 TEKNOLOGI INFORMASI</h4>
                                <p class="text-gray-400">Membangun dan mengamankan infrastruktur digital masa depan.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-24">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2
                        class="section-title reveal-up text-4xl md:text-5xl font-orbitron font-bold text-white text-glow-yellow relative">
                        KNOWLEDGE <span class="text-yellow-400">BASE</span></h2>
                    <p class="mt-4 text-lg text-gray-400 reveal-up" style="transition-delay: 0.2s;">Pertanyaan yang
                        sering muncul di transmisi para Ksatria.</p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4">
                    <details class="bg-transparent rounded-lg p-5 cursor-pointer reveal-up">
                        <summary class="flex justify-between items-center font-bold text-lg text-white">Apa itu PKKMB
                            YUWARAJA?<svg class="h-6 w-6 text-cyan-400 transition-transform duration-300 arrow-down"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg></summary>
                        <p class="mt-4 text-gray-300 border-t border-gray-700 pt-4">PKKMB Yuwaraja adalah serangkaian
                            kegiatan orientasi untuk memperkenalkan dunia perkuliahan, budaya, dan nilai-nilai inovasi
                            di Fakultas Vokasi Universitas Brawijaya.</p>
                    </details>
                    <details class="bg-transparent rounded-lg p-5 cursor-pointer reveal-up"
                        style="transition-delay: 0.1s;">
                        <summary class="flex justify-between items-center font-bold text-lg text-white">Bagaimana cara
                            mendapatkan KTM?<svg
                                class="h-6 w-6 text-cyan-400 transition-transform duration-300 arrow-down" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg></summary>
                        <p class="mt-4 text-gray-300 border-t border-gray-700 pt-4">Informasi pengambilan KTM akan
                            diumumkan secara resmi melalui SIAM dan website ini. Pastikan untuk selalu memeriksa
                            pembaruan.</p>
                    </details>
                    <details class="bg-transparent rounded-lg p-5 cursor-pointer reveal-up"
                        style="transition-delay: 0.2s;">
                        <summary class="flex justify-between items-center font-bold text-lg text-white">Di mana saya
                            bisa menemukan info UKM?<svg
                                class="h-6 w-6 text-cyan-400 transition-transform duration-300 arrow-down" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg></summary>
                        <p class="mt-4 text-gray-300 border-t border-gray-700 pt-4">Akan ada "Expo UKM" yang jadwalnya
                            akan diumumkan di bagian Informasi. Kamu bisa bertanya, mencoba, dan mendaftar langsung
                            untuk mengasah skill di luar akademik.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black/30 border-t border-cyan-500/10 py-8 mt-12">
        <div class="container mx-auto px-6 text-center text-gray-500">
            <p class="font-orbitron text-lg text-gray-300">PKKMB YUWARAJA 2025</p>
            <p class="mt-2 text-sm">© {{ date('Y') }} Divisi Informasi & Teknologi. All systems operational.</p>
            <div class="mt-4 flex justify-center space-x-6"><a href="#"
                    class="text-gray-400 hover:text-yellow-400 transition-colors" title="Instagram"><svg class="h-6 w-6"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919C8.416 2.175 8.796 2.163 12 2.163zm0 1.802c-3.552 0-3.957.014-5.336.077-2.587.118-3.901 1.436-4.02 4.02C2.617 9.423 2.603 9.81 2.603 12s.014 2.577.077 3.957c.118 2.587 1.436 3.901 4.02 4.02 1.379.063 1.784.077 5.336.077s3.957-.014 5.336-.077c2.587-.118 3.901-1.436 4.02-4.02.063-1.379.077-1.784.077-5.336s-.014-3.957-.077-5.336c-.118-2.587-1.436-3.901-4.02-4.02C15.957 3.979 15.552 3.965 12 3.965zM12 6.873c-2.841 0-5.127 2.286-5.127 5.127s2.286 5.127 5.127 5.127 5.127-2.286 5.127-5.127-2.286-5.127-5.127-5.127zm0 8.418c-1.815 0-3.291-1.476-3.291-3.291s1.476-3.291 3.291-3.291 3.291 1.476 3.291 3.291-1.476 3.291-3.291 3.291zm4.868-8.52c-.781 0-1.414.633-1.414 1.414s.633 1.414 1.414 1.414 1.414-.633 1.414-1.414-.633-1.414-1.414-1.414z" />
                    </svg></a>
                <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors" title="Twitter/X"><svg
                        class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-.424.727-.666 1.58-.666 2.474 0 1.71.87 3.213 2.188 4.094-.807-.026-1.566-.247-2.229-.616v.054c0 2.38 1.693 4.37 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.31-3.81 2.09-6.115 2.09-.398 0-.79-.023-1.175-.068 2.179 1.397 4.768 2.212 7.548 2.212 9.058 0 14.01-7.502 14.01-14.01 0-.213-.005-.425-.014-.636A10.024 10.024 0 0024 4.557z" />
                    </svg></a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors" title="TikTok"><svg
                        class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.525.02c1.31-.02 2.61-.01 3.91.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.38 1.92-3.54 2.96-5.94 3.04-1.9.06-3.78-.23-5.31-1.42-1.24-.97-2.03-2.34-2.26-3.88-.06-.43-.04-.86-.04-1.3 0-2.01 0-4.02-.01-6.03-.01-1.49.34-2.97 1.14-4.28.98-1.58 2.54-2.6 4.35-2.95.75-.14 1.5-.22 2.25-.21.01 2.19-.01 4.38-.01 6.57 0 .4-.03.8-.08 1.19-.24 1.56-1.3 2.92-2.81 3.42-1.3.42-2.71.32-3.9-.29-.4-.19-.75-.43-1.07-.72-.13-.12-.26-.25-.39-.39v-3.17c.13.13.26.25.39.38.48.42 1.04.74 1.65.94 1.18.39 2.47.33 3.59-.14 1.55-.67 2.59-2.06 2.82-3.66.07-.47.05-.95.05-1.43-.01-2.2-.01-4.4 0-6.6.01-.15.02-.3.04-.45z" />
                    </svg></a>
            </div>
        </div>
    </footer>

    <!-- Scripts untuk Animasi -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Smooth Scroll Handler
            document.querySelectorAll('#main-nav a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerOffset = document.querySelector('header').offsetHeight;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Reveal on Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.reveal-up').forEach(el => observer.observe(el));

            // Header Scroll Effect
            window.addEventListener('scroll', () => {
                document.querySelector('header')?.classList.toggle('scrolled', window.scrollY > 20);
            }, {
                passive: true
            });

            // Hamburger Menu Toggle
            const hamburgerBtn = document.getElementById('hamburger-button');
            const mobileNav = document.getElementById('mobile-nav');
            const mobileNavLinks = document.querySelectorAll('.nav-link-mobile');

            hamburgerBtn.addEventListener('click', () => {
                hamburgerBtn.classList.toggle('open');
                mobileNav.classList.toggle('open');
            });

            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    hamburgerBtn.classList.remove('open');
                    mobileNav.classList.remove('open');
                });
            });
        });
    </script>
</body>

</html>
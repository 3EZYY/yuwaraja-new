<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPKMB Fakultas Vokasi - YUWARAJA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Orbitron:wght@400..900&display=swap"
        rel="stylesheet">

    <!-- Vite Assets -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --color-bg: #02040a;
            --color-primary: #183A4A;
            --color-secondary: #E8AA1F;
            --color-text: #c0c8d6;
            --color-heading: #ffffff;
            --color-surface: rgba(10, 15, 29, 0.6);
            --header-bg: #02050C;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Kanit', sans-serif;
            background-image: linear-gradient(to bottom, #012633, #030409);
            color: var(--color-text);
            overflow-x: hidden;
        }

        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
        }

        .font-kanit {
            font-family: 'Kanit', sans-serif;
        }

        /* === HEADER STYLES === */
        .header-container {
            background-color: var(--header-bg);
            border: none;
        }

        .nav-link.active span {
            display: block;
        }

        .nav-link span {
            display: none;
        }

        .nav-link:hover span {
            display: block;
        }

        /* tombol header */
        .login-button {
            color: var(--color-secondary);
            font-size: 17px;
            letter-spacing: 0.05em;
            transition: filter 0.3s;
        }

        .login-button:hover {
            filter: brightness(1.2);
        }

        .register-button {
            background-color: #002837;
            color: var(--color-heading);
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 0.05em;
            border-radius: 0.8rem;
            padding: 10px 20px;
            border: 1px solid #fff;
            transition: background-color 0.3s;
        }

        .register-button:hover {
            background-color: #204a5d;
        }

        .background-wrapper {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        @keyframes pan-grid {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 1000px 1000px;
            }
        }

        .reveal-up {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1s cubic-bezier(0.19, 1, 0.22, 1), transform 1s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .reveal-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .glitch-text {
            position: relative;
            color: var(--color-heading);
            z-index: 1;
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
            z-index: -1;
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

        /* === Hero Section === */

        .hero-background {
            position: relative;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            inset: 0;
            z-index: 0;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            animation: slow-pan-zoom 20s infinite alternate ease-in-out;
        }

        /* .hero-background::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            animation: slow-pan-zoom 20s infinite alternate ease-in-out;
        } */

        /* Posisikan konten hero di atas background-nya */
        .hero-content {
            position: absolute;
            z-index: 1;
        }

        @keyframes slow-pan-zoom {
            from {
                transform: scale(1.05) translateX(0%);
            }

            to {
                transform: scale(1.15) translateX(-2%);
            }
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
            background: var(--color-surface, rgba(0, 14, 20, 0.5));
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .cyber-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 0 20px rgba(0, 209, 255, 0.1);
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

        /* FAQ Styles */
        .faq-item {
            background-color: #061a24;
            border: 1px solid rgba(63, 234, 229, 0.25);
            border-radius: 1.25rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-item:hover {
            border-color: rgba(63, 234, 229, 0.6);
            box-shadow: 0 0 25px rgba(63, 234, 229, 0.1);
        }

        .faq-item summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            list-style: none;
            font-weight: 600;
            color: white;
            font-size: 1rem;
        }

        .faq-item summary::-webkit-details-marker {
            display: none;
        }

        .faq-icon {
            position: relative;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .faq-icon::before,
        .faq-icon::after {
            content: '';
            position: absolute;
            background-color: #3FEAE5;
            border-radius: 2px;
            transition: transform 0.3s ease-in-out;
        }

        .faq-icon::before {
            top: 50%;
            left: 0;
            width: 100%;
            height: 2.5px;
            transform: translateY(-50%);
        }

        .faq-icon::after {
            top: 0;
            left: 50%;
            width: 2.5px;
            height: 100%;
            transform: translateX(-50%);
        }

        .faq-item[open]>summary .faq-icon::after {
            transform: translateX(-50%) rotate(90deg);
        }

        .faq-content-wrapper {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.4s ease-in-out;
        }

        .faq-item[open] .faq-content-wrapper {
            grid-template-rows: 1fr;
        }

        .faq-content-inner {
            overflow: hidden;
        }

        .faq-content-inner p {
            padding: 0 1.25rem 1.25rem;
            /* Padding untuk teks jawaban */
            color: #cbd5e1;
            line-height: 1.6;
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
    <header class="p-4 z-50 fixed top-0 w-full">
        <div class="header-container max-w-7xl mx-auto rounded-full px-6 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="#">
                    <img src="/images/Secondary-Logo.svg" alt="Adaptive Yuwaraja XVII Logo" class="h-12 md:h-14">
                </a>

                <nav class="hidden lg:flex items-center space-x-10 text-white font-normal">
                    <a href="#beranda" class="nav-link active relative text-base text-white">
                        Beranda
                        <span
                            class="absolute left-1/2 transform -translate-x-1/2 -bottom-3 h-[3px] w-8 bg-yellow-500 rounded-full"></span>
                    </a>
                    <a href="#informasi"
                        class="nav-link relative text-base text-gray-300 hover:text-white transition-colors">
                        Informasi
                        <span
                            class="absolute left-1/2 transform -translate-x-1/2 -bottom-3 h-[3px] w-8 bg-yellow-500 rounded-full"></span>
                    </a>
                    <a href="#prodi"
                        class="nav-link relative text-base text-gray-300 hover:text-white transition-colors">
                        Prodi
                        <span
                            class="absolute left-1/2 transform -translate-x-1/2 -bottom-3 h-[3px] w-8 bg-yellow-500 rounded-full"></span>
                    </a>
                    <a href="#faq" class="nav-link relative text-base text-gray-300 hover:text-white transition-colors">
                        FAQ
                        <span
                            class="absolute left-1/2 transform -translate-x-1/2 -bottom-3 h-[3px] w-8 bg-yellow-500 rounded-full"></span>
                    </a>
                </nav>

                <div class="hidden lg:flex items-center space-x-6">
                    <?php if(auth()->guard()->check()): ?>
                    <a href="/dashboard"
                        class="bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-gray-900 font-semibold text-sm md:text-base px-4 md:px-6 py-2 md:py-2.5 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-yellow-500/25 tracking-wide">
                        DASHBOARD
                    </a>
                    <?php else: ?>
                    <a href="/login" class="login-button">LOG IN</a>
                    <a href="/register" class="register-button">REGISTER</a>
                    <?php endif; ?>
                </div>

                <button id="hamburger-button"
                    class="hamburger-button flex flex-col justify-center items-center space-y-1.5 lg:hidden z-50">
                    <span class="line line-1 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                    <span class="line line-2 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                    <span class="line line-3 w-7 h-0.5 bg-white transition-all duration-300 ease-in-out"></span>
                </button>
            </div>
        </div>
    </header>

    <nav id="mobile-nav" class="mobile-nav flex flex-col items-center justify-center p-8 space-y-6">
        <a href="#beranda" class="nav-link-mobile font-kanit text-2xl text-white">Beranda</a>
        <a href="#informasi" class="nav-link-mobile font-kanit text-2xl text-white">Informasi</a>
        <a href="#prodi" class="nav-link-mobile font-kanit text-2xl text-white">Prodi</a>
        <a href="#faq" class="nav-link-mobile font-kanit text-2xl text-white">FAQ</a>
        <div class="mt-8 pt-8 border-t border-gray-700 w-full flex flex-col items-center gap-4">
            <?php if(auth()->guard()->check()): ?>
            <a href="/dashboard"
                class="bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-gray-900 font-semibold text-lg sm:text-xl px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-yellow-500/25 tracking-wide w-full max-w-xs text-center">
                DASHBOARD
            </a>
            <?php else: ?>
            <a href="/login" class="login-button text-2xl">LOG IN</a>
            <a href="/register" class="register-button text-lg w-full max-w-xs text-center">REGISTER</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="relative z-10">
        <!-- Hero Section -->
        <section id="beranda" class="relative min-h-screen flex items-center justify-center text-center">

            <div id="hero-bg-slider"
                class="hero-background absolute inset-0 z-0 transition-opacity duration-1000 ease-in-out opacity-100">
            </div>

            <div class="hero-content container mx-auto px-6" style="user-select: none;">
                <div class="max-w-4xl mx-auto text-center">
                    <h2
                        class="font-kanit text-lg sm:text-md md:text-xl text-white tracking-[0.2em] md:tracking-[0.3em] uppercase reveal-up">
                        PKKMB FAKULTAS VOKASI <BR>UNIVERSITAS BRAWIJAYA
                    </h2>

                    <h2 class="font-orbitron mb-7 text-4xl sm:text-5xl md:text-7xl lg:text-8xl text-[#3FEAE5] text-glow-cyan mt-4 font-bold reveal-up"
                        style="transition-delay: 0.1s;">
                        YUWARAJA
                        <span class="block text-[#E8AA1F] text-glow-yellow"></span>
                        <span class="block text-[#E8AA1F] text-glow-yellow">
                            XVII - 2025
                        </span>
                    </h2>

                    <h2
                        class="font-kanit text-lg sm:text-xl md:text-2xl text-white tracking-[0.2em] md:tracking-[0.2em] uppercase reveal-up">
                        Be Adaptive, Shape Tomorrow!
                    </h2>

                    <h2 class="text-base md:text-md mb-10 text-white font-light max-w-2xl mx-auto leading-relaxed reveal-up"
                        style="transition-delay: 0.2s;">
                        Pengenalan kehidupan kampus bagi mahasiswa baru Fakultas Vokasi Universitas Brawijaya
                    </h2>

                    <div class="mt-10 md:mt-1 flex flex-col sm:flex-row items-center justify-center gap-5 reveal-up" style="transition-delay: 0.3s;">
                        <!-- Tombol 1 -->
                        <a href="#informasi"
                            class="inline-flex items-center justify-center border-2 border-[#E8AA1F] rounded-sm overflow-hidden transition-all duration-300 group hover:shadow-lg hover:shadow-yellow-500/20">
                            <span class="bg-[#E8AA1F] p-2 sm:p-3">
                                <img src="/images/logo-explore.svg" alt="logo explore" class="h-5 w-5 sm:h-6 sm:w-8" />
                            </span>
                            <span class="px-4 sm:px-6 text-xs sm:text-sm font-medium text-white">
                                MULAI EKSPLORASI
                            </span>
                        </a>
                        <!-- Tombol 2 (MODIFIED) -->
                        <button id="open-vokasi-popup"
                            class="inline-flex items-center justify-center border-2 border-[#E8AA1F] rounded-sm overflow-hidden transition-all duration-300 group hover:shadow-lg hover:shadow-yellow-500/20">
                            <span class="bg-[#E8AA1F] p-2 sm:p-3">
                                <img src="/images/start.svg" alt="logo explore" class="h-5 w-5 sm:h-6 sm:w-8" />
                            </span>
                            <span class="px-4 sm:px-6 text-xs sm:text-sm font-medium text-white">
                                MENGENAL LEBIH DEKAT VOKASI
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- ▲▲▲ SELESAI ▲▲▲ -->

        <!-- Informasi Terbaru Section -->
        <section id="informasi" class="relative py-24">
            <div class="absolute -top-16 left-0 w-full h-32 z-10 pointer-events-none blur-[30px] bg-[#012633]"></div>

            <div class="container mx-auto px-6 relative z-20 mb-24">
                <div
                    class=" bg-[#00000033] flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 lg:gap-16 bg-surface backdrop-blur-md rounded-2xl py-10 md:py-16 border-none box-glow-primary animate-reveal-up">

                    <!-- Logo Vokasioner -->
                    <div class="flex-shrink-0 animate-reveal-up">
                        <img src="/images/vokasioner.svg" alt="Vokasioner Logo" class="w-48 md:w-64">

                    </div>

                    <div class="max-w-xl text-center md:text-left animate-reveal-up" style="animation-delay: 0.2s;">
                        <p class="text-light-text leading-relaxed text-center">
                            YUWARAJA menjadi gerbang utama dalam pengenalan nilai VOKASI yang terkandung dalam istilah
                            VOKASIONER, di mana setiap hurufnya memiliki makna, antara lain
                            <strong class="text-white font-bold">Visionary, Outstanding, Kindness,</strong>
                            <span class="text-[#E8AA1F] font-bold">ADAPTIVE,</span>
                            <strong class="text-white font-bold">Skillfull, Innovative, Optimistic, Novelty,
                                Entrepreneur, and Resilience.</strong>
                        </p>
                    </div>

                    <!-- Logo Adaptive -->
                    <div class="flex-shrink-0 animate-reveal-up" style="animation-delay: 0.4s;">
                        <img src="/images/adaptive.svg" alt="Adaptive Yuwaraja XVII Logo" class="w-48 md:w-64">
                    </div>

                </div>
            </div>
            <div class="container mx-auto px-6 relative z-20">
                <div class="text-center mb-16">
                    <h2 class="text-2xl md:text-5xl font-orbitron font-bold text-white text-glow-cyan relative">
                        They Grow Into Greatness Here</h2>
                    <p class="mt-4 text-lg text-[#3FEAE5] font-extralight reveal-up" style="transition-delay: 0.2s;">
                        Mereka Adalah Alumni-Alumni yang lahir dan berproses menjadi besar di Vokasi UB.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8 lg:gap-10 items-center">
                    <!-- Card 1 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan">
                        <div class="mb-6">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="/images/ahmad.png" alt="Ahmad Syaifulloh"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-[#3FEAE5]">
                                <div>
                                    <h3 class="text-lg sm:text-xl font-kanit text-white text-glow-cyan">CTO PT Sinergi
                                        Ketahanan Pangan (CHICKIN)</h3>
                                    <p class="text-[#3FEAE5] text-sm italic">Ahmad Syaifulloh - Alumni Vokasi UB, 2013
                                    </p>
                                </div>
                            </div>
                            <p class="text-[#3FEAE5] text-sm sm:text-base font-extralight">
                                CHICKIN adalah perusahaan agritech yang memodernisasi industri peternakan ayam Indonesia
                                melalui teknologi IoT CI-Touch. Mereka menyediakan solusi terintegrasi untuk peternak
                                broiler, mulai dari sapronak hingga distribusi. Dengan slogan #TumbuhBareng, CHICKIN
                                berkomitmen mendemokratisasi akses protein dan memperkuat ketahanan pangan nasional
                                melalui inovasi digital berkelanjutan.
                            </p>
                        </div>

                    </div>

                    <!-- Card 2 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan" style="transition-delay: 0.15s;">
                        <div class="mb-6">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="/images/fato.png" alt="Maulana Derifato"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-[#3FEAE5]">
                                <div>
                                    <h3 class="text-lg sm:text-xl font-kanit text-white text-glow-cyan">CEO PT Myeco
                                        Indonesia</h3>
                                    <p class="text-[#3FEAE5] text-sm italic">Maulana Derifato Achmad - Alumni Vokasi UB,
                                        2021</p>
                                </div>
                            </div>
                            <p class="text-[#3FEAE5] text-sm sm:text-base font-extralight">
                                PT Myeco Indonesia adalah startup teknologi yang menghadirkan solusi otomatisasi
                                perangkat listrik berbasis AIoT (Artificial Intelligence & Internet of Things). Myeco
                                menciptakan super app penghemat listrik dengan penghematan hingga 55%. Melalui teknologi
                                Smart EcoRoom dan motto "Save your OUTgo with myECO", perusahaan berkomitmen menciptakan
                                smart home ramah lingkungan untuk masa depan berkelanjutan.
                            </p>
                        </div>

                    </div>

                    <!-- Card 3 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan" style="transition-delay: 0.3s;">
                        <div class="mb-6">
                            <img src="/images/event.svg" alt="event komunitas" class="w-10 sm:w-12 h-auto mb-4">
                            <h3 class="text-lg sm:text-xl font-kanit text-white mb-2 text-glow-cyan"> Where Success
                                Takes Shape!</h3>
                            <p class="text-gray-400 text-sm sm:text-base">
                                Ribuan Alumni Vokasi UB telah membuktikan keunggulan sebagai praktisi handal dan
                                wirausahawan sukses. Mereka yang dulu berproses di kampus, kini memimpin industri,
                                membangun bisnis, dan menciptakan lapangan kerja. Skill praktis + jiwa entrepreneur
                                adalah formula kesuksesan nyata.

                            </p>
                        </div>
                        <!-- <a href="/login" class="block w-full text-center bg-[#E8AA1F] text-[#012633] rounded-full px-4 py-2 text-base sm:text-xl font-semibold">
                            Lihat Selengkapnya
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-6 relative z-20">
                <div class="text-center mt-40 mb-10">
                    <h2 class="text-2xl md:text-5xl font-orbitron font-bold text-white text-glow-cyan relative">
                        How will you grow here? Learn, lead, succeed</h2>
                    <p class="mt-4 text-lg text-[#3FEAE5] font-extralight reveal-up" style="transition-delay: 0.2s;">
                        Bagaimana Vokasi UB membantumu berproses.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8 lg:gap-10 items-center">
                    <!-- Card 1 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan">
                        <div class="mb-6">

                            <h3 class="text-lg sm:text-xl font-kanit text-white mb-2 text-glow-cyan">Sertifikasi
                                Kompetensi</h3>
                            <p class="text-[#3FEAE5] text-sm sm:text-base font-extralight">
                                Mahasiswa Fakultas Vokasi Universitas Brawijaya Wajib Menempuh Sertifikasi Kompetensi
                                Berstandar BNSP (Badan Nasional Sertifikasi Profesi) pada Semester Akhir Sebagai Syarat
                                Kelulusan. Akan dikoordinir program studi.
                            </p>
                        </div>

                    </div>

                    <!-- Card 2 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan" style="transition-delay: 0.15s;">
                        <div class="mb-6">

                            <h3 class="text-lg sm:text-xl font-kanit text-white mb-2 text-glow-cyan">Kewajiban Magang
                            </h3>
                            <p class="text-[#3FEAE5] text-sm sm:text-base font-extralight">
                                Mahasiswa Fakultas Vokasi Universitas Brawijaya Wajib Menempuh Magang/On Job Training di
                                perusahaan selama minimal 1 semester.
                            </p>
                        </div>

                    </div>

                    <!-- Card 3 -->
                    <div class="cyber-card p-6 sm:p-8 reveal-up hover:box-glow-cyan" style="transition-delay: 0.15s;">

                        <div class="mb-6">
                            <h3 class="text-lg sm:text-xl font-kanit text-white mb-2 text-glow-cyan">Praktik Diutamakan
                            </h3>
                            <p class="text-[#3FEAE5] text-sm sm:text-base font-extralight">
                                Pendidikan vokasi, dengan fokus utamanya pada penguasaan keahlian terapan, menawarkan
                                pendekatan belajar yang unik, di mana praktik lapangan mendominasi 60% dari keseluruhan
                                pembelajaran.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <!-- Program Studi Section -->
        <section id="prodi" class="pt-14">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-2xl md:text-5xl font-orbitron font-bold text-white text-glow-cyan relative">
                        PILIH SPESIALISASIMU</h2>
                    <p class="mt-4 text-lg text-[#3FEAE5] font-extralight reveal-up" style="transition-delay: 0.2s;">
                        Update intel penting
                        Dua Departement, Berbagai Jalur untuk mendominasi Masa Depan</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
                    <!-- KARTU 1: BISNIS & HOSPITALITY -->
                    <div
                        class="department-card bg-[#061a24] rounded-2xl p-8 border border-cyan-500/20 shadow-lg shadow-cyan-500/10">
                        <!-- Judul Departemen -->
                        <h3 class="font-orbitron text-2xl text-[#3FEAE5] uppercase text-glow-cyan font-bold">
                            Bisnis & Hospitality
                        </h3>
                        <!-- Garis Pemisah -->
                        <div class="mt-4 mb-8 h-px w-full bg-[#E8AA1F]/50"></div>

                        <!-- Daftar Program Studi -->
                        <ul class="space-y-4">
                            <li>
                                <a href="https://vokasi.ub.ac.id/manajemen-perhotelan/" target="_blank"
                                    class="flex items-center justify-between group p-3 -m-3 rounded-lg transition-colors hover:bg-white/5">
                                    <div>
                                        <h4 class="font-kanit text-lg font-semibold text-white">D4 Manajemen Perhotelan
                                        </h4>
                                        <p class="text-gray-400 text-sm mt-1">Mencetak pemimpin visioner di Industri
                                            Perhotelan Global.</p>
                                    </div>
                                    <img src="images/arrow.svg" alt="arrow" class="w-5 h-5">
                                </a>
                            </li>
                            <li>
                                <a href="https://vokasi.ub.ac.id/keubank/" target="_blank"
                                    class="flex items-center justify-between group p-3 -m-3 rounded-lg transition-colors hover:bg-white/5">
                                    <div>
                                        <h4 class="font-kanit text-lg font-semibold text-white">D3 Keuangan & Perbankan
                                        </h4>
                                        <p class="text-gray-400 text-sm mt-1">Menguasai arus finansial dengan presisi
                                            dan teknologi terkini.</p>
                                    </div>
                                    <img src="images/arrow.svg" alt="arrow" class="w-5 h-5">
                                </a>
                            </li>
                            <li>
                                <a href="https://vokasi.ub.ac.id/adbis/" target="_blank"
                                    class="flex items-center justify-between group p-3 -m-3 rounded-lg transition-colors hover:bg-white/5">
                                    <div>
                                        <h4 class="font-kanit text-lg font-semibold text-white">D3 Administrasi Bisnis
                                        </h4>
                                        <p class="text-gray-400 text-sm mt-1">Menjadi ahli strategi dalam manajemen dan
                                            operasional bisnis modern.</p>
                                    </div>
                                    <img src="images/arrow.svg" alt="arrow" class="w-5 h-5">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- KARTU 2: INDUSTRI KREATIF & DIGITAL -->
                    <div
                        class="department-card bg-[#061a24] rounded-2xl p-8 border border-cyan-500/20 shadow-lg shadow-cyan-500/10">
                        <!-- Judul Departemen -->
                        <h3 class="font-orbitron text-2xl text-[#3FEAE5] uppercase text-glow-cyan font-bold">
                            Industri Kreatif & Digital
                        </h3>
                        <!-- Garis Pemisah -->
                        <div class="mt-4 mb-8 h-px w-full bg-[#E8AA1F]/50"></div>

                        <!-- Daftar Program Studi -->
                        <ul class="space-y-4">
                            <li>
                                <a href="https://vokasi.ub.ac.id/desaingrafis/" target="_blank"
                                    class="flex items-center justify-between group p-3 -m-3 rounded-lg transition-colors hover:bg-white/5">
                                    <div>
                                        <h4 class="font-kanit text-lg font-semibold text-white">D4 Desain Grafis</h4>
                                        <p class="text-gray-400 text-sm mt-1">Mengubah Imajinasi Menjadi Karya Visual
                                            yang mendefinisikan zaman.</p>
                                    </div>
                                    <img src="images/arrow.svg" alt="arrow" class="w-5 h-5">
                                </a>
                            </li>
                            <li>
                                <a href="https://vokasi.ub.ac.id/ti/" target="_blank"
                                    class="flex items-center justify-between group p-3 -m-3 rounded-lg transition-colors hover:bg-white/5">
                                    <div>
                                        <h4 class="font-kanit text-lg font-semibold text-white">D3 Teknologi Informasi
                                        </h4>
                                        <p class="text-gray-400 text-sm mt-1">Membangun dan Mengamankan Infrastruktur
                                            Digital Masa Depan.</p>
                                    </div>
                                    <img src="images/arrow.svg" alt="arrow" class="w-5 h-5">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="relative py-24">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                    <div class="lg:col-span-5 flex justify-center">
                        <img src="/images/logo-yuwarajaxvii.svg" alt="logo yuwaraja"
                            class="w-64 md:w-72 lg:w-full max-w-sm reveal-up">
                    </div>

                    <div class="lg:col-span-7">
                        <div class="text-center lg:text-left mb-12">
                            <h2
                                class="text-2xl md:text-5xl font-orbitron font-bold text-white text-glow-cyan relative reveal-up">
                                KNOWLEDGE BASED
                            </h2>
                            <p class="mt-4 text-lg text-[#3FEAE5] font-extralight reveal-up"
                                style="transition-delay: 0.1s;">
                                Pertanyaan yang sering muncul di Transisi Ksatria
                            </p>
                        </div>

                        <!-- Accordion FAQ -->
                        <div class="max-w-3xl mx-auto lg:mx-0 space-y-5">
                            <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <!-- Item FAQ <?php echo e($index + 1); ?> -->
                            <details class="faq-item reveal-up" style="transition-delay: <?php echo e(0.2 + ($index * 0.1)); ?>s;">
                                <summary>
                                    <span><?php echo e($faq->question); ?></span>
                                    <div class="faq-icon"></div>
                                </summary>
                                <div class="faq-content-wrapper">
                                    <div class="faq-content-inner">
                                        <p><?php echo e($faq->answer); ?></p>
                                    </div>
                                </div>
                            </details>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <!-- Default FAQ jika tidak ada data di database -->
                            <details class="faq-item reveal-up" style="transition-delay: 0.2s;">
                                <summary>
                                    <span>Apa itu PKKMB Yuwaraja</span>
                                    <div class="faq-icon"></div>
                                </summary>
                                <div class="faq-content-wrapper">
                                    <div class="faq-content-inner">
                                        <p>PKKMB Yuwaraja adalah serangkaian kegiatan orientasi untuk memperkenalkan
                                            dunia perkuliahan, budaya, dan nilai-nilai inovasi di Fakultas Vokasi
                                            Universitas Brawijaya.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item reveal-up" style="transition-delay: 0.3s;">
                                <summary>
                                    <span>Bagaimana Cara Mendapatkan KTM</span>
                                    <div class="faq-icon"></div>
                                </summary>
                                <div class="faq-content-wrapper">
                                    <div class="faq-content-inner">
                                        <p>Informasi pengambilan KTM akan diumumkan secara resmi melalui SIAM dan
                                            website ini. Pastikan untuk selalu memeriksa pembaruan.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item reveal-up" style="transition-delay: 0.4s;">
                                <summary>
                                    <span>Di mana saya mendapatkan info tentang UKM</span>
                                    <div class="faq-icon"></div>
                                </summary>
                                <div class="faq-content-wrapper">
                                    <div class="faq-content-inner">
                                        <p>Akan ada "Expo UKM" yang jadwalnya akan diumumkan di bagian Informasi. Kamu
                                            bisa bertanya, mencoba, dan mendaftar langsung untuk mengasah skill di luar
                                            akademik.</p>
                                    </div>
                                </div>
                            </details>
                            <?php endif; ?>
                        </div>
                    </div>




                </div>
            </div>
        </section>

        <!-- Section "Didukung Oleh" -->
        <section class="container mx-auto px-6">
            <!-- Judul -->
            <h3 class="text-center text-lg text-cyan-400 font-light mb-6 tracking-wider capitalize">
                Sponsor
            </h3>

            <!-- Kontainer Logo Utama -->
            <div class="max-w-6xl mx-auto bg-white rounded-2xl p-6 shadow-lg shadow-cyan-500/10">
                <div class="gap-8 flex flex-wrap place-items-center justify-center">
                    <img src="/images/logo-sponsor/1.svg" class="h-24">
                    <img src="/images/logo-sponsor/2.svg" class="h-24">
                    <img src="/images/logo-sponsor/3.svg" class="h-16">
                    <img src="/images/logo-sponsor/4.svg" class="h-24">
                    <img src="/images/logo-sponsor/5.svg" class="h-24">
                    <img src="/images/logo-sponsor/6.svg" class="h-24">
                    <img src="/images/logo-sponsor/7.svg" class="h-16">
                    <img src="/images/logo-sponsor/8.svg" class="h-24">
                </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-transparent pt-28 relative overflow-hidden">
        <div class="container mx-auto px-6 lg:px-8 pb-44  md:pb-32">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">

                <!-- Kolom Kiri: Logo -->
                <div class="flex items-center gap-4">
                    <!-- Pastikan path logo sudah benar -->
                    <a href="https://www.ub.ac.id">
                        <img src="/images/logo-ub.svg" alt="Logo Universitas Brawijaya" class="h-16 md:h-16">
                    </a>
                    <a href="https://vokasi.ub.ac.id">
                        <img src="/images/logo-vokasi.svg" alt="Logo Fakultas Vokasi Universitas Brawijaya"
                            class="h-12 md:h-16">
                    </a>
                </div>

                <!-- Kolom Kanan: Informasi Kontak -->
                <div class="flex flex-col items-center md:items-end text-center md:text-right">
                    <div class="font-light text-white">
                        <p>Website Resmi YUWARAJA XVII</p>
                        <p>Fakultas Vokasi | Universitas Brawijaya</p>
                    </div>

                    <!-- Tombol Instagram -->
                    <a href="https://www.instagram.com/pkkmb_vokasiub"
                        class="mt-4 inline-flex items-center gap-3 px-6 py-2 bg-[#092c3a] rounded-full border border-[#e0a325]/80 hover:bg-[#0f3c4f] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="2"
                            stroke="#e0a325" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <rect x="4" y="4" width="16" height="16" rx="4" />
                            <circle cx="12" cy="12" r="3" />
                            <line x1="16.5" y1="7.5" x2="16.5" y2="7.501" />
                        </svg>
                        <span class="font-light text-white">@pkkmb_vokasiub</span>
                    </a>

                    <p class="mt-4 text-xs text-gray-400">
                        ©Copyright 2025, IT Division & Operation Yuwaraja
                    </p>
                </div>
            </div>
        </div>

        <div
            class="absolute bottom-0 left-0 right-0 h-16 flex items-center justify-center bg-gradient-to-t from-[#061a24] to-transparent">
            <img src="/images/footer.svg" alt="">
        </div>
    </footer>

    <div id="vokasi-popup"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[1000] p-4 hidden">
        <div class="bg-[#18232c] rounded-lg w-full max-w-4xl relative shadow-2xl shadow-cyan-500/10">
            <!-- Header with Title and Close/Download Buttons -->
            <div class="flex justify-between items-center p-4 border-b border-gray-700">
                <h3 class="text-white font-kanit text-lg"></h3>
                <div class="flex items-center gap-4">
                    <!-- Download Button -->
                    <a href="/images/tentang-vokasi.png" download="tentang-vokasi.png"
                        class="text-gray-300 hover:text-white transition-colors" title="Unduh Gambar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>
                    <!-- Close Button -->
                    <button id="close-popup-btn" class="text-gray-300 hover:text-white transition-colors" title="Tutup">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Image Content -->
            <div class="overflow-auto max-h-[80vh] p-2">
                <img src="/images/tentang-vokasi.svg" alt="Mengenal Pendidikan Vokasi UB" class="w-full h-auto">
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- KODE HAMBURGER MENU YANG SUDAH DIPERBAIKI TOTAL ---
            const hamburgerBtn = document.getElementById('hamburger-button');
            const mobileNav = document.getElementById('mobile-nav');
            const mobileNavLinks = mobileNav.querySelectorAll('a');

            function closeMobileMenu() {
                hamburgerBtn.classList.remove('open');
                mobileNav.classList.remove('open');
            }

            hamburgerBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                hamburgerBtn.classList.toggle('open');
                mobileNav.classList.toggle('open');
            });

            mobileNavLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });

            document.addEventListener('click', function(event) {
                if (mobileNav.classList.contains('open') && !mobileNav.contains(event.target)) {
                    closeMobileMenu();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && mobileNav.classList.contains('open')) {
                    closeMobileMenu();
                }
            });


            // --- ▼▼▼ KODE POPUP VOKASI (ADDED) ▼▼▼ ---
            const openPopupBtn = document.getElementById('open-vokasi-popup');
            const closePopupBtn = document.getElementById('close-popup-btn');
            const vokasiPopup = document.getElementById('vokasi-popup');

            if (openPopupBtn && closePopupBtn && vokasiPopup) {
                const showPopup = () => {
                    vokasiPopup.classList.remove('hidden');
                };
                const hidePopup = () => {
                    vokasiPopup.classList.add('hidden');
                };
                openPopupBtn.addEventListener('click', showPopup);
                closePopupBtn.addEventListener('click', hidePopup);
                vokasiPopup.addEventListener('click', (event) => {
                    if (event.target === vokasiPopup) {
                        hidePopup();
                    }
                });
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && !vokasiPopup.classList.contains('hidden')) {
                        hidePopup();
                    }
                });
            }
            // --- ▲▲▲ SELESAI ▲▲▲ ---


            // --- Kode Lainnya yang Sudah Ada (Animasi Reveal dan Navigasi Aktif) ---
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

            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('nav.hidden.lg\\:flex .nav-link'); // Selector lebih spesifik

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.pageYOffset >= sectionTop - 150) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active', 'text-white');
                    link.classList.add('text-gray-300');
                    const navLinkHref = link.getAttribute('href');
                    if (navLinkHref && navLinkHref.includes(current)) {
                        link.classList.add('active', 'text-white');
                        link.classList.remove('text-gray-300');
                    }
                });
            });

            const bgSliderElement = document.getElementById('hero-bg-slider');

            const bgImages = [
                '/images/bg-img.jpg',
                '/images/bg-img-2.jpg',
                '/images/bg-img-3.jpg'
            ];

            bgImages.forEach(src => {
                const img = new Image();
                img.src = src;
            });

            let currentIndex = 0;

            bgSliderElement.style.backgroundImage = `url('${bgImages[currentIndex]}')`;

            setInterval(() => {
                currentIndex = (currentIndex + 1) % bgImages.length;
                bgSliderElement.classList.remove('opacity-100');
                bgSliderElement.classList.add('opacity-0');

                setTimeout(() => {
                    bgSliderElement.style.backgroundImage = `url('${bgImages[currentIndex]}')`;
                    bgSliderElement.classList.remove('opacity-0');
                    bgSliderElement.classList.add('opacity-100');
                }, 1000);

            }, 5000);
        });
    </script>
</body>

</html><?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/welcome.blade.php ENDPATH**/ ?>
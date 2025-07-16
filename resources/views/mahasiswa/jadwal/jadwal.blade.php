@extends('layouts.app')

@section('content')
<div class="py-12 min-h-screen relative overflow-hidden" style="background: linear-gradient(135deg, #0b101a 0%, #1a1f2e 50%, #0f1419 100%);">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="cyber-grid"></div>
        <div class="floating-particles"></div>
    </div>
    
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
        <!-- Header Section with Modern Design -->
        <div class="text-center mb-12">
            <div class="inline-block bg-gray-900/90 backdrop-blur-lg border-2 border-cyan-400/50 rounded-2xl px-8 py-6 shadow-2xl hover:border-cyan-300 transition-all duration-300">
                <h1 class="text-5xl font-orbitron font-bold text-transparent bg-gradient-to-r from-cyan-400 via-yellow-400 to-pink-400 bg-clip-text mb-4 animate-pulse-glow">
                    SCHEDULE CONTROL
                </h1>
                <p class="text-cyan-300 font-mono text-lg opacity-80">// Access your event schedules and activities</p>
                <div class="w-32 h-1 bg-gradient-to-r from-cyan-400 to-yellow-400 mx-auto mt-4 rounded-full animate-pulse"></div>
            </div>
        </div>
        
        <div class="bg-gray-900/80 backdrop-blur-lg shadow-2xl rounded-3xl mb-8 border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-500 cyber-card-modern">
            <div class="p-8 md:p-12">

    <style>
        .cyber-card {
            background: linear-gradient(135deg, rgba(24, 24, 37, 0.9) 0%, rgba(31, 41, 55, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid var(--db-border);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .cyber-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(0, 209, 255, 0.1) 0%, 
                rgba(255, 201, 0, 0.05) 50%, 
                rgba(0, 209, 255, 0.1) 100%);
            opacity: 0;
            transition: all 0.4s ease;
            border-radius: 1rem;
        }
        
        .cyber-card::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--db-primary), var(--db-secondary), var(--db-primary));
            border-radius: 1rem;
            z-index: -1;
            opacity: 0;
            transition: all 0.4s ease;
        }
        
        .cyber-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: var(--db-primary);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 40px rgba(0, 209, 255, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        
        .cyber-card:hover::before {
            opacity: 1;
        }
        
        .cyber-card:hover::after {
            opacity: 0.6;
        }
        
        .cyber-card-item {
            background: linear-gradient(135deg, rgba(24, 24, 37, 0.95) 0%, rgba(31, 41, 55, 0.9) 100%);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 209, 255, 0.2);
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }
        
        .cyber-card-item:hover {
            transform: translateY(-6px);
            border-color: rgba(0, 209, 255, 0.6);
            box-shadow: 
                0 12px 30px rgba(0, 0, 0, 0.4),
                0 0 30px rgba(0, 209, 255, 0.15);
        }
        
        .status-badge {
            background: linear-gradient(135deg, rgba(0, 209, 255, 0.2) 0%, rgba(0, 209, 255, 0.1) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 209, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .cyber-btn {
            background: linear-gradient(135deg, #00d1ff 0%, #0ea5e9 100%);
            border: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cyber-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .cyber-btn:hover::before {
            left: 100%;
        }
        
        .cyber-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 209, 255, 0.3);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        /* Enhanced Cyber Theme Styling */
        :root {
            --cyber-primary: #00ffff;
            --cyber-secondary: #ff6b35;
            --cyber-accent: #ffd700;
            --cyber-dark: #0a0a0a;
            --cyber-darker: #050505;
            --cyber-gray: #1a1a1a;
            --cyber-light-gray: #2a2a2a;
            --cyber-text: #ffffff;
            --cyber-text-muted: #a0a0a0;
            --cyber-border: #333333;
            --cyber-glow: 0 0 20px rgba(0, 255, 255, 0.3);
            --cyber-glow-hover: 0 0 30px rgba(0, 255, 255, 0.5);
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            color: var(--cyber-text);
            overflow-x: hidden;
        }

        /* Background Effects */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 107, 53, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 215, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Text Glow Effects */
        .text-glow-cyan {
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5), 0 0 20px rgba(0, 255, 255, 0.3), 0 0 30px rgba(0, 255, 255, 0.1);
        }

        .text-glow-yellow {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5), 0 0 20px rgba(255, 215, 0, 0.3), 0 0 30px rgba(255, 215, 0, 0.1);
        }

        /* Enhanced Card Styling */
        .cyber-card {
            background: linear-gradient(145deg, rgba(26, 26, 26, 0.9), rgba(42, 42, 42, 0.7));
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 16px;
            backdrop-filter: blur(20px);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(0, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cyber-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .cyber-card:hover::before {
            left: 100%;
        }

        .cyber-card:hover {
            border-color: rgba(0, 255, 255, 0.6);
            box-shadow: 
                0 12px 40px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                0 0 0 1px rgba(0, 255, 255, 0.3),
                0 0 30px rgba(0, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .cyber-card-item {
            background: linear-gradient(145deg, rgba(15, 15, 15, 0.95), rgba(25, 25, 25, 0.9));
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(15px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .cyber-card-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(0, 255, 255, 0.05) 50%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .cyber-card-item:hover::before {
            opacity: 1;
        }

        .cyber-card-item:hover {
            border-color: rgba(0, 255, 255, 0.5);
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(0, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transform: translateY(-4px) scale(1.02);
        }

        .cyber-card-modern {
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.95) 0%, rgba(20, 20, 30, 0.9) 100%);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 16px;
            backdrop-filter: blur(20px);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        /* Enhanced Button Styling */
        .cyber-btn {
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.1), rgba(0, 200, 255, 0.2));
            border: 1px solid rgba(0, 255, 255, 0.4);
            border-radius: 8px;
            color: var(--cyber-primary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .cyber-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .cyber-btn:hover::before {
            left: 100%;
        }

        .cyber-btn:hover {
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.2), rgba(0, 200, 255, 0.3));
            border-color: rgba(0, 255, 255, 0.8);
            color: #ffffff;
            box-shadow: 
                0 0 20px rgba(0, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Animations */
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-glow {
            0%, 100% { 
                text-shadow: 0 0 5px rgba(0, 255, 255, 0.5), 0 0 10px rgba(0, 255, 255, 0.3); 
            }
            50% { 
                text-shadow: 0 0 10px rgba(0, 255, 255, 0.8), 0 0 20px rgba(0, 255, 255, 0.5), 0 0 30px rgba(0, 255, 255, 0.3); 
            }
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Font Styling */
        .font-orbitron {
            font-family: 'Orbitron', 'Courier New', monospace;
            font-weight: 700;
        }

        /* Status Badge Enhancements */
        .status-badge {
            background: linear-gradient(45deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
            border: 1px solid rgba(255, 215, 0, 0.4);
            color: var(--cyber-accent);
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cyber-card-item {
                margin-bottom: 1rem;
            }
            
            .floating-animation {
                animation: none;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(26, 26, 26, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.3), rgba(0, 200, 255, 0.5));
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.5), rgba(0, 200, 255, 0.7));
        }
    </style>
        
        @if(isset($detailMode) && $detailMode)
            <!-- Enhanced Detail Mode with Cyber Theme -->
            <div class="relative">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-xl animate-pulse"></div>
                    <div class="absolute bottom-20 right-20 w-24 h-24 bg-yellow-500/10 rounded-full blur-xl animate-pulse" style="animation-delay: 1s;"></div>
                    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-pink-500/10 rounded-full blur-xl animate-pulse" style="animation-delay: 2s;"></div>
                </div>

                <!-- Main Detail Card -->
                <div class="relative bg-gray-900/90 backdrop-blur-lg shadow-2xl rounded-3xl border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-500 overflow-hidden">
                    <!-- Header Section with Gradient -->
                    <div class="relative bg-gradient-to-r from-gray-900/95 via-cyan-900/20 to-gray-900/95 p-8 md:p-12 border-b border-cyan-500/20">
                        <!-- Decorative Corner Elements -->
                        <div class="absolute top-0 left-0 w-20 h-20 border-l-2 border-t-2 border-cyan-400/50 rounded-tl-3xl"></div>
                        <div class="absolute top-0 right-0 w-20 h-20 border-r-2 border-t-2 border-cyan-400/50 rounded-tr-3xl"></div>
                        
                        <!-- Event Title with Enhanced Styling -->
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-1 h-16 bg-gradient-to-b from-cyan-400 to-yellow-400 rounded-full mr-6 animate-pulse"></div>
                                <div>
                                    <div class="text-sm font-mono text-cyan-400 mb-2 tracking-wider">// EVENT DETAILS</div>
                                    <h1 class="text-4xl md:text-5xl font-orbitron font-bold text-transparent bg-gradient-to-r from-cyan-400 via-white to-yellow-400 bg-clip-text animate-pulse-glow">
                                        {{ $jadwal->nama_acara }}
                                    </h1>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="inline-flex items-center px-4 py-2 bg-green-500/20 border border-green-400/50 rounded-full text-green-400 font-mono text-sm mb-6">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                ACTIVE EVENT
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-8 md:p-12">
                        <!-- Event Info Grid -->
                        <div class="grid md:grid-cols-2 gap-8 mb-8">
                            <!-- Date & Time Card -->
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-cyan-400/20 hover:border-cyan-400/40 transition-all duration-300 group">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-orbitron font-bold text-cyan-400">Schedule</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-300">
                                        <span class="text-sm font-mono text-gray-500 w-16">Start:</span>
                                        <span class="font-bold text-yellow-400">{{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <span class="text-sm font-mono text-gray-500 w-16">End:</span>
                                        <span class="font-bold text-yellow-400">{{ $jadwal->tanggal_selesai->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <span class="text-sm font-mono text-gray-500 w-16">Duration:</span>
                                        <span class="font-bold text-green-400">{{ $jadwal->tanggal_mulai->diffInHours($jadwal->tanggal_selesai) }} hours</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-cyan-400/20 hover:border-cyan-400/40 transition-all duration-300 group">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-orbitron font-bold text-cyan-400">Location</h3>
                                </div>
                                <div class="text-2xl font-bold text-green-400 mb-2">{{ $jadwal->lokasi ?? 'Online Event' }}</div>
                                <div class="text-sm text-gray-400 font-mono">{{ $jadwal->lokasi ? 'Physical Location' : 'Virtual Meeting' }}</div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="bg-gradient-to-br from-gray-800/30 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-cyan-400/20 mb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-orbitron font-bold text-cyan-400">Event Description</h3>
                            </div>
                            <div class="text-gray-300 leading-relaxed text-lg">
                                {!! nl2br(e($jadwal->deskripsi)) !!}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('mahasiswa.jadwal.index') }}" class="cyber-btn inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-500 hover:to-gray-600 text-white font-bold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-gray-500/25 group">
                                <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Back to Schedule
                            </a>
                            
                            <button class="cyber-btn inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/25 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Add to Calendar
                            </button>
                        </div>
                    </div>

                    <!-- Decorative Bottom Elements -->
                    <div class="absolute bottom-0 left-0 w-20 h-20 border-l-2 border-b-2 border-cyan-400/50 rounded-bl-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 border-r-2 border-b-2 border-cyan-400/50 rounded-br-3xl"></div>
                </div>
            </div>
        @else
            <div class="bg-gray-900/80 backdrop-blur-lg shadow-2xl rounded-3xl mb-8 border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-500 cyber-card-modern">
                <div class="p-8 md:p-12">
                    <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-orbitron font-bold text-yellow-400 text-glow-yellow flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        ACTIVE SCHEDULES
                    </h2>
                    <div class="text-cyan-400 font-mono text-sm">
                        <span class="animate-pulse">●</span> {{ $jadwal->count() }} events available
                    </div>
                </div>

                @if($jadwal->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-400 text-xl font-mono">No active schedules found</p>
                    <p class="text-gray-500 text-sm mt-2">Check back later for new events</p>
                </div>
                @else
                <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2">
                    @foreach($jadwal as $item)
                    <div class="group relative cyber-card-item p-6 floating-animation cursor-pointer" style="animation-delay: {{ $loop->index * 0.1 }}s;" onclick="window.location.href='{{ route('mahasiswa.jadwal.detail', $item->id) }}'">
                        <!-- Enhanced Card Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-yellow-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Schedule Header -->
                        <div class="relative z-10">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <a href="{{ route('mahasiswa.jadwal.detail', $item->id) }}" class="block group-hover:scale-105 transition-transform duration-300">
                                        <h3 class="text-xl font-orbitron font-bold text-cyan-400 group-hover:text-yellow-400 transition-colors duration-300 mb-2 text-glow-cyan hover:animate-pulse-glow">
                                            {{ $item->nama_acara }}
                                        </h3>
                                    </a>
                                    
                                    <!-- Schedule Type Badge -->
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border transition-all duration-300 bg-yellow-500/20 text-yellow-400 border-yellow-400/50 group-hover:bg-yellow-500/30">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            SCHEDULED
                                        </span>
                                    </div>
                                    
                                    <!-- Date and Time Info -->
                                    <div class="flex items-center text-sm text-gray-400 font-mono mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Date: <span class="text-yellow-400 font-bold">{{ $item->tanggal_mulai->format('d M Y') }}</span></span>
                                    </div>
                                    
                                    <!-- Time Info -->
                                    <div class="flex items-center text-sm text-gray-400 font-mono mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Time: <span class="text-cyan-400 font-bold">{{ $item->tanggal_mulai->format('H:i') }} - {{ $item->tanggal_selesai->format('H:i') }}</span></span>
                                    </div>
                                    
                                    <!-- Location Info -->
                                    <div class="flex items-center text-sm text-gray-400 font-mono">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>Location: <span class="text-green-400 font-bold">{{ $item->lokasi ?? 'Online' }}</span></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Description Preview -->
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm leading-relaxed">{{ Str::limit($item->deskripsi, 120) }}</p>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="mt-4 pt-4 border-t border-gray-700/50">
                                <a href="{{ route('mahasiswa.jadwal.detail', $item->id) }}" class="cyber-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/25 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    VIEW SCHEDULE
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                
                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $jadwal->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

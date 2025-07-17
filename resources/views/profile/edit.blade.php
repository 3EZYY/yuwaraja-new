@extends('layouts.app')

@section('title', 'My Cyber Profile')

@section('content')
<style>
    .profile-container {
        background: linear-gradient(135deg, #0b101a 0%, #1a1f2e 50%, #0f1419 100%);
        position: relative;
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(135deg, rgba(0, 209, 255, 0.1) 0%, rgba(255, 201, 0, 0.05) 100%);
        border-bottom: 1px solid rgba(0, 209, 255, 0.2);
        backdrop-filter: blur(10px);
    }
    
    .cyber-card-enhanced {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(16, 20, 31, 0.8) 100%);
        border: 1px solid rgba(0, 209, 255, 0.2);
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
    
    .cyber-card-enhanced::before {
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
        border-radius: 16px;
    }
    
    .cyber-card-enhanced:hover::before {
        opacity: 1;
    }
    
    .cyber-card-enhanced:hover {
        transform: translateY(-4px);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 40px rgba(0, 209, 255, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    
    .profile-avatar-container {
        position: relative;
        display: inline-block;
    }
    
    .profile-avatar-container::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: linear-gradient(45deg, #00d1ff, #ffc900, #00d1ff);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
        animation: avatar-glow 3s ease-in-out infinite;
    }
    
    .profile-avatar-container:hover::before {
        opacity: 1;
    }
    
    @keyframes avatar-glow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.7; }
    }
    
    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, #00d1ff, transparent);
        margin: 2rem 0;
        position: relative;
    }
    
    .section-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: #00d1ff;
        border-radius: 50%;
        box-shadow: 0 0 10px #00d1ff;
    }
    
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }
    
    .floating-elements::before {
        content: '';
        position: absolute;
        top: 20%;
        left: 10%;
        width: 4px;
        height: 4px;
        background: #ffc900;
        border-radius: 50%;
        box-shadow: 0 0 10px #ffc900;
        animation: float-1 6s ease-in-out infinite;
    }
    
    .floating-elements::after {
        content: '';
        position: absolute;
        top: 60%;
        right: 15%;
        width: 3px;
        height: 3px;
        background: #00d1ff;
        border-radius: 50%;
        box-shadow: 0 0 8px #00d1ff;
        animation: float-2 8s ease-in-out infinite reverse;
    }
    
    @keyframes float-1 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    @keyframes float-2 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(-180deg); }
    }
    
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, rgba(0, 209, 255, 0.1) 0%, rgba(255, 201, 0, 0.05) 100%);
        border: 1px solid rgba(0, 209, 255, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 209, 255, 0.1);
    }
</style>

{{-- Latar belakang utama dengan efek gradasi dan animasi --}}
<div class="min-h-screen profile-container">
    <!-- Floating Elements -->
    <div class="floating-elements"></div>
    
    <!-- Enhanced Header -->
    <div class="profile-header px-6 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center space-x-4">
                <div class="profile-avatar-container">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/profile/'.Auth::user()->photo) }}" alt="Profile Avatar" class="h-16 w-16 rounded-full object-cover border-2 border-yellow-400 shadow-lg relative z-10">
                    @else
                        <div class="h-16 w-16 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center border-2 border-yellow-400 relative z-10">
                            <span class="text-2xl font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <h1 class="font-orbitron font-bold text-3xl text-yellow-400 text-glow-yellow">
                        {{ __('My Cyber Profile') }}
                    </h1>
                    <p class="text-cyan-300 font-mono text-sm mt-1">
                        > System_User: {{ Auth::user()->username }} | Status: Online
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Stats -->
    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="profile-stats">
            <div class="stat-card">
                <div class="text-2xl font-bold text-yellow-400 font-orbitron">{{ Auth::user()->kelompok ? Auth::user()->kelompok->nama : 'No Cluster' }}</div>
                <div class="text-cyan-300 text-sm font-mono">Current Cluster</div>
            </div>
            <div class="stat-card">
                <div class="text-2xl font-bold text-cyan-400 font-orbitron">{{ Auth::user()->program_studi ?? 'Not Set' }}</div>
                <div class="text-cyan-300 text-sm font-mono">Study Program</div>
            </div>
            <div class="stat-card">
                <div class="text-2xl font-bold text-green-400 font-orbitron">{{ Auth::user()->created_at->diffForHumans() }}</div>
                <div class="text-cyan-300 text-sm font-mono">Member Since</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 pb-12 space-y-8">
        <!-- Profile Information Card -->
        <div class="cyber-card-enhanced p-8 border-l-4 border-yellow-400">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h2 class="text-2xl font-orbitron font-bold text-yellow-400 text-glow-yellow">Profile Information</h2>
            </div>
            <p class="text-cyan-300 font-mono text-sm mb-6">
                > Update your account's profile information and avatar.
            </p>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="section-divider"></div>

        <!-- Security Card -->
        <div class="cyber-card-enhanced p-8 border-l-4 border-cyan-500">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h2 class="text-2xl font-orbitron font-bold text-cyan-400 text-glow-cyan">Security Protocol</h2>
            </div>
            <p class="text-cyan-300 font-mono text-sm mb-6">
                > Maintain strong encryption for your access credentials.
            </p>
            @include('profile.partials.update-password-form')
        </div>

        <div class="section-divider"></div>

        <!-- Danger Zone Card -->
        <div class="cyber-card-enhanced p-8 border-l-4 border-red-500">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <h2 class="text-2xl font-orbitron font-bold text-red-400 text-glow-red">Danger Zone</h2>
            </div>
            <p class="text-red-300 font-mono text-sm mb-6">
                > WARNING: This action will permanently erase all your data from the system. Backup any important information before proceeding.
            </p>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection

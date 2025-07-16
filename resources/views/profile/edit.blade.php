@extends('layouts.app')

@section('title', 'My Cyber Profile')

@section('content')
    {{-- Latar belakang utama dengan efek gradasi dan noise --}}
    <div class="min-h-screen bg-black bg-gradient-to-br from-gray-900 via-black to-blue-900/30">
        <div class="px-6 pt-6">
            <h2 class="font-orbitron font-semibold text-2xl text-yellow-400 leading-tight text-glow-yellow flex items-center">
                <!-- SVG dan judul -->
                {{ __('My Cyber Profile') }}
            </h2>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                <div class="p-4 sm:p-8 cyber-card border-l-4 border-yellow-400">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="p-4 sm:p-8 cyber-card border-l-4 border-cyan-500">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="p-4 sm:p-8 cyber-card border-l-4 border-red-500">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection

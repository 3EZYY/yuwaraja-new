<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900 relative overflow-hidden">
        <!-- Cyber Grid Background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_#0a0a0a_0%,_#1a1a1a_100%)]"></div>
        
        <!-- Animated Grid -->
        <div class="cyber-grid"></div>
        
        <!-- Main Container -->
        <div class="relative z-10 w-full max-w-md mx-auto px-6">
            <!-- Header -->
            <div class="text-center mb-8 opacity-0" style="animation: float-in 0.8s forwards 0.2s;">
                <h2 class="text-3xl font-bold text-transparent bg-gradient-to-r from-cyan-400 to-pink-400 bg-clip-text mb-2">
                    {{ __('Reset Password') }}
                </h2>
                <div class="h-0.5 w-20 bg-gradient-to-r from-cyan-400 to-pink-400 mx-auto"></div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="opacity-0" style="animation: float-in 0.8s forwards 0.4s;">
                    <x-input-label for="email" value="Email" class="mb-2 text-sm text-cyan-300 tracking-wide" />
                    
                    <div class="relative cyber-input-container">
                        <!-- Email Icon -->
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        
                        <!-- Input -->
                        <input id="email" name="email" type="email" 
                               placeholder="Alamat email Anda"
                               value="{{ old('email', $request->email) }}" required autofocus
                               class="w-full bg-transparent border-none outline-none focus:border-none focus:ring-0 focus:outline-none text-white placeholder-gray-400 pl-10" />
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-400" />
                </div>

                <!-- Password -->
                <div class="opacity-0" style="animation: float-in 0.8s forwards 0.6s;">
                    <x-input-label for="password" value="Password Baru" class="mb-2 text-sm text-cyan-300 tracking-wide" />
                    
                    <div class="relative cyber-input-container">
                        <!-- Password Icon -->
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        
                        <!-- Input -->
                        <input id="password" name="password" type="password" 
                               placeholder="Masukkan password baru"
                               required autocomplete="new-password"
                               class="w-full bg-transparent border-none outline-none focus:border-none focus:ring-0 focus:outline-none text-white placeholder-gray-400 pl-10" />
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-400" />
                </div>

                <!-- Confirm Password -->
                <div class="opacity-0" style="animation: float-in 0.8s forwards 0.8s;">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" class="mb-2 text-sm text-cyan-300 tracking-wide" />
                    
                    <div class="relative cyber-input-container">
                        <!-- Password Icon -->
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        
                        <!-- Input -->
                        <input id="password_confirmation" name="password_confirmation" type="password" 
                               placeholder="Ulangi password baru"
                               required autocomplete="new-password"
                               class="w-full bg-transparent border-none outline-none focus:border-none focus:ring-0 focus:outline-none text-white placeholder-gray-400 pl-10" />
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-400" />
                </div>

                <!-- Submit Button -->
                <div class="opacity-0" style="animation: float-in 0.8s forwards 1.0s;">
                    <x-primary-button 
                        class="w-full justify-center text-lg py-3 bg-gradient-to-r from-cyan-500 to-pink-500 hover:from-cyan-400 hover:to-pink-400 text-black font-bold uppercase tracking-wider transition-all duration-300 shadow-[0_0_15px_rgba(0,225,255,0.3)] hover:shadow-[0_0_25px_rgba(0,225,255,0.5)] focus:from-cyan-600 focus:to-pink-600 active:scale-95 border-none ring-offset-gray-900">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
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

        .cyber-input-container {
            position: relative;
            background: rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(64, 224, 208, 0.3);
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .cyber-input-container:focus-within {
            border-color: rgba(0, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }

        @keyframes float-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-guest-layout>

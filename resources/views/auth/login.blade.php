<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

    {{-- Form Login dengan animasi delay pada setiap elemen --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Judul -->
        <div class="form-field text-center mb-8" style="animation-delay: 0.8s;">
            <h2 class="text-xl font-orbitron text-cyan-400 tracking-widest">
                // AUTHENTICATION REQUIRED //
            </h2>
        </div>

        <!-- Agent ID / Email -->
        <div class="relative mb-6 opacity-0" style="animation: float-in 0.8s forwards 1.0s;">
            <x-input-label for="login" value="Masukan Username/Email" class="mb-3 text-lg text-[#fff]" />

            <div
                class="flex items-center gap-2 bg-black border border-yellow-300 rounded px-4 py-2 focus-within:ring-2 focus-within:ring-yellow-300 transition-all">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>

                <!-- Input -->
                <input id="login" name="login" type="text" placeholder="Masukan Username/Email" value="{{ old('login') }}"
                    required autofocus autocomplete="username"
                    class="w-full bg-transparent border-none outline-none focus:border-none focus:ring-0 focus:outline-none text-white placeholder-gray-400" />
            </div>

            <x-input-error :messages="$errors->get('login')" class="mt-2 text-yellow-400" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-400" />
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-yellow-400" />
        </div>

        <!-- Password -->
        <div class="relative mb-4 opacity-0" style="animation: float-in 0.8s forwards 1.2s;">
            <x-input-label for="password" value="Password" class="mb-3 text-lg text-[#fff]" />

            <div
                class="flex items-center gap-2 bg-black border border-cyan-500 rounded px-4 py-2 focus-within:ring-2 focus-within:ring-cyan-500 transition-all">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>

                <!-- Input -->
                <input id="password" name="password" type="password" placeholder="Masukan Password" required
                    autocomplete="current-password"
                    class="w-full bg-transparent border-none outline-none focus:border-none focus:ring-0 focus:outline-none text-white placeholder-gray-400" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-400" />
        </div>


        <!-- Remember Me & Lost Password -->
        <div class="flex items-center justify-between mt-6 text-sm opacity-0"
            style="animation: float-in 0.8s forwards 1.4s;">
            <label for="remember_me" class="inline-flex items-center cyber-checkbox-label">
                <input id="remember_me" name="remember" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="custom-checkbox-ui ms-2 text-gray-400 hover:text-white transition">
                    {{ __('Keep Connection') }}
                </span>
            </label>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
                class="underline text-gray-500 hover:text-cyan-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 transition">
                {{ __('Lupa Password?') }}
            </a>
            @endif
        </div>

        <!-- Submit Button & Register -->
        <div class="mt-8 opacity-0" style="animation: float-in 0.8s forwards 1.6s;">
            <x-primary-button
                class="w-full justify-center text-lg py-3 bg-cyan-500 hover:bg-cyan-400 text-black font-bold uppercase tracking-wider transition-all duration-300 shadow-[0_0_15px_rgba(0,225,255,0.5)] hover:shadow-[0_0_25px_rgba(0,225,255,0.8)] focus:bg-cyan-600 active:scale-95 border-none ring-offset-gray-900">
                {{ __('[ Login ]') }}
            </x-primary-button>

            @if (Route::has('register'))
            <p class="text-center mt-6 text-sm">
                <span class="text-gray-400">Belum Punya Akun?</span>
                <a href="{{ route('register') }}"
                    class="font-bold underline text-yellow-400 hover:text-yellow-300 rounded-md focus:outline-none transition">
                    {{ __('Daftar') }}
                </a>
            </p>
            @endif
        </div>
    </form>
</x-guest-layout>
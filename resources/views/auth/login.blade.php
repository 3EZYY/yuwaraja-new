<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

    {{-- Form dengan animasi stagger/delay untuk setiap elemen --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf  


        <!-- Username atau Email -->
        <div class="relative mb-6 opacity-0" style="animation: float-in 0.8s forwards 1.0s;">
            <x-input-label for="login" value="Agent ID / Email" class="sr-only" />
            <x-text-input id="login"
                          class="block w-full cyber-input"
                          type="text"
                          name="login"
                          :value="old('login')"
                          required
                          autofocus
                          autocomplete="username"
                          placeholder="Agent ID / Email" />
            <div class="input-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
            </div>
            <x-input-error :messages="$errors->get('login')" class="mt-2 text-pink-400" />
        </div>

        <!-- Password -->
        <div class="relative mb-4 opacity-0" style="animation: float-in 0.8s forwards 1.2s;">
            <x-input-label for="password" value="Access Key" class="sr-only" />
            <x-text-input id="password"
                          class="block w-full cyber-input"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password"
                          placeholder="Access Key" />
            <div class="input-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-400" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-6 text-sm opacity-0" style="animation: float-in 0.8s forwards 1.4s;">
            <label for="remember_me" class="inline-flex items-center cyber-checkbox-label">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="custom-checkbox-ui ms-2 text-gray-400 hover:text-white transition">{{ __('Keep Connection') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-gray-500 hover:text-cyan-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition" href="{{ route('password.request') }}">
                    {{ __('Access Key Lost?') }}
                </a>
            @endif
        </div>

        <!-- Tombol Submit & Daftar -->
        <div class="mt-8 opacity-0" style="animation: float-in 0.8s forwards 1.6s;">
            <x-primary-button class="w-full justify-center text-lg py-3 bg-cyan-500 hover:bg-cyan-400 text-black font-bold uppercase tracking-wider transition-all duration-300 shadow-[0_0_15px_rgba(0,225,255,0.5)] hover:shadow-[0_0_25px_rgba(0,225,255,0.8)] focus:bg-cyan-600 active:scale-95 border-none ring-offset-gray-900">
                {{ __('[ Login ]') }}
            </x-primary-button>
            
            @if (Route::has('register'))
                <p class="text-center mt-6 text-sm">
                    <span class="text-gray-400">Belum Punya Akun?</span>
                    <a class="font-bold underline text-pink-400 hover:text-pink-300 rounded-md focus:outline-none transition" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
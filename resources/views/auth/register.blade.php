<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-field" style="animation-delay: 0.8s;">
            <h2 class="text-center text-xl font-orbitron text-cyan-400 tracking-widest mb-4">
                // AGENT REGISTRATION PROTOCOL //
            </h2>
        </div>

        {{-- Layout Grid untuk kerapian --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <!-- Name -->
            <div class="form-field" style="animation-delay: 1.0s;">
                <x-input-label for="name" value="Full Name" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="name" class="cyber-input" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- NIM -->
            <div class="form-field" style="animation-delay: 1.0s;">
                <x-input-label for="nim" value="NIM" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="nim" class="cyber-input" type="text" name="nim" :value="old('nim')" required
                    autocomplete="nim" />
                <x-input-error :messages="$errors->get('nim')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Username -->
            <div class="form-field" style="animation-delay: 1.1s;">
                <x-input-label for="username" value="Agent ID (Username)"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="username" class="cyber-input" type="text" name="username" :value="old('username')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Program Studi -->
            <div class="form-field" style="animation-delay: 1.1s;">
                <x-input-label for="program_studi" value="Specialization"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <select id="program_studi" name="program_studi" class="cyber-input cyber-select" required>
                    <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Select Specialization...
                    </option>
                    <option value="D4 Manajemen Perhotelan"
                        {{ old('program_studi') == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen
                        Perhotelan</option>
                    <option value="D3 Keuangan dan Perbankan"
                        {{ old('program_studi') == 'D3 Keuangan dan Perbankan' ? 'selected' : '' }}>D3 Keuangan dan
                        Perbankan</option>
                    <option value="D3 Administrasi Bisnis"
                        {{ old('program_studi') == 'D3 Administrasi Bisnis' ? 'selected' : '' }}>D3 Administrasi Bisnis
                    </option>
                    <option value="D4 Desain Grafis" {{ old('program_studi') == 'D4 Desain Grafis' ? 'selected' : '' }}>
                        D4 Desain Grafis</option>
                    <option value="D3 Teknologi Informasi"
                        {{ old('program_studi') == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi
                    </option>
                </select>
                <x-input-error :messages="$errors->get('program_studi')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Angkatan -->
            <div class="form-field" style="animation-delay: 1.2s;">
                <x-input-label for="angkatan" value="Batch (e.g., 2025)"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="angkatan" class="cyber-input" type="text" name="angkatan" :value="old('angkatan')"
                    required />
                <x-input-error :messages="$errors->get('angkatan')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Nomor Telepon -->
            <div class="form-field" style="animation-delay: 1.2s;">
                <x-input-label for="nomor_telepon" value="Comms Number (Phone)"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="nomor_telepon" class="cyber-input" type="text" name="nomor_telepon"
                    :value="old('nomor_telepon')" required />
                <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-field" style="animation-delay: 1.3s;">
                <x-input-label for="tanggal_lahir" value="Manufacture Date"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="tanggal_lahir" class="cyber-input" type="date" name="tanggal_lahir"
                    :value="old('tanggal_lahir')" required />
                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-field" style="animation-delay: 1.3s;">
                <x-input-label for="jenis_kelamin" value="Model" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="cyber-input cyber-select" required>
                    <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Select Model...</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Model L
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Model P
                    </option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2 text-pink-400 text-xs" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="form-field" style="animation-delay: 1.4s;">
            <x-input-label for="email" value="Official Email" class="mb-1 text-sm text-cyan-300 tracking-wide" />
            <x-text-input id="email" class="cyber-input" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-400 text-xs" />
        </div>

        {{-- Layout Grid untuk Password --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <!-- Password -->
            <div class="form-field" style="animation-delay: 1.5s;">
                <x-input-label for="password" value="Set Access Key (Password)"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="password" class="cyber-input" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-400 text-xs" />
            </div>

            <!-- Confirm Password -->
            <div class="form-field" style="animation-delay: 1.5s;">
                <x-input-label for="password_confirmation" value="Confirm Access Key"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="password_confirmation" class="cyber-input" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-400 text-xs" />
            </div>
        </div>

        <x-primary-button
            class="w-full flex justify-center items-center bg-pink-500 hover:bg-pink-600 text-white font-bold uppercase tracking-wider transform hover:scale-105 transition-all duration-300 shadow-[0_0_15px_rgba(236,72,153,0.6)] hover:shadow-[0_0_25px_rgba(236,72,153,0.8)] focus:bg-pink-700 focus:ring-pink-500 border-none px-6 py-3">
            {{ __('Submit Registration') }}
        </x-primary-button>

        <div class="flex items-center justify-center mt-4 form-field w-full" style="animation-delay: 1.6s;">
            Already have an ID?
            <a class="font-bold underline text-pink-400 hover:text-pink-300 rounded-md focus:outline-none transition px-2"
                href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
<section>
    <header>
        <h2 class="text-2xl font-orbitron font-bold text-yellow-400 text-glow-yellow">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-cyan-300 font-mono">
            {{ __("Update your account's profile information and avatar.") }}
        </p>
    </header>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <!-- Profile Photo -->
        <div>
            <x-input-label for="photo" value="{{ __('Avatar') }}" class="text-cyan-400 font-bold" />
            <div class="mt-2 flex items-center gap-x-4">
                @if($user->photo)
                    <img src="{{ asset('storage/profile/'.$user->photo) }}" alt="Avatar" class="h-20 w-20 rounded-full object-cover border-2 border-yellow-400 shadow-lg shadow-yellow-500/30">
                @else
                    <div class="h-20 w-20 rounded-full bg-gray-800 border-2 border-cyan-500 flex items-center justify-center">
                        <svg class="h-12 w-12 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                @endif
                <input id="photo" name="photo" type="file" accept="image/*" class="cyber-input" />
            </div>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('photo')" />
        </div>

        <!-- Username (Read-only) -->
        <div>
            <x-input-label for="username" :value="__('Username')" class="text-cyan-400" />
            <div class="flex items-center">
                <x-text-input id="username" type="text" class="mt-1 block w-full cyber-input bg-gray-800/50" value="{{ $user->username }}" disabled readonly />
                <div class="ml-2 text-xs text-yellow-400 font-mono">[read-only]</div>
            </div>
            <p class="mt-1 text-xs text-gray-500 font-mono">{{ __('Usernames cannot be changed after registration.') }}</p>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-cyan-400" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full cyber-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nim" :value="__('NIM')" class="text-cyan-400" />
            <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full cyber-input" :value="old('nim', $user->nim)" required autocomplete="nim" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nim')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-cyan-400" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full cyber-input" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-red-400 font-mono">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button form="send-verification" class="mt-2 text-xs text-cyan-400 font-mono underline hover:text-yellow-400">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-yellow-400 font-mono">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div>
            <x-input-label for="program_studi" :value="__('Program Studi')" class="text-cyan-400" />
            <select id="program_studi" name="program_studi" class="mt-1 block w-full cyber-select" required>
                <option value="" disabled {{ !$user->program_studi ? 'selected' : '' }}>// Select Program</option>
                <option value="D3 Teknologi Informasi" {{ $user->program_studi == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi</option>
                <option value="D3 Keuangan Dan Perbankan" {{ $user->program_studi == 'D3 Keuangan Dan Perbankan' ? 'selected' : '' }}>D3 Keuangan Dan Perbankan</option>
                <option value="D4 Desain Grafis" {{ $user->program_studi == 'D4 Desain Grafis' ? 'selected' : '' }}>D4 Desain Grafis</option>
                <option value="D4 Manajemen Perhotelan" {{ $user->program_studi == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen Perhotelan</option>
            </select>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('program_studi')" />
        </div>

        <div>
            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" class="text-cyan-400" />
            <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full cyber-input" :value="old('nomor_telepon', $user->nomor_telepon)" autocomplete="tel" placeholder="e.g. 0812xxxxxxxx"/>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nomor_telepon')" />
        </div>

        <div>
            <x-input-label for="deskripsi" :value="__('Bio / Deskripsi Diri')" class="text-cyan-400" />
            <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full cyber-input" placeholder="> Ceritakan tentang dirimu dalam beberapa baris... ">{{ old('deskripsi', $user->deskripsi) }}</textarea>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('deskripsi')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="cyber-button bg-gradient-to-r from-yellow-500 to-yellow-400 hover:from-yellow-400 hover:to-yellow-300">
                {{ __('Update Profile') }}
            </button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-mono text-yellow-400"
                > >> Profile_Updated_Successfully</p>
            @endif
        </div>
    </form>
</section>

<section>
    {{-- Form ini hanya untuk mengirim email verifikasi, biarkan seperti apa adanya --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form utama untuk memperbarui profil --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Bagian Foto Profil -->
        <div class="flex flex-col gap-4 items-left">
            <label for="photo" class="font-semibold text-gray-300 sm:col-span-1">Foto Profil</label>
            <div class="sm:col-span-2 flex items-center gap-x-4">
                @if($user->photo)
                    <img src="{{ asset('profile-pictures/'.$user->photo) }}" alt="Foto Profil Saat Ini" class="h-16 w-16 rounded-full object-cover border-2 border-teal-400">
                @else
                    <div class="h-16 w-16 rounded-full bg-gray-800 flex items-center justify-center border-2 border-gray-700">
                        <svg class="h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                @endif
                <input id="photo" name="photo" type="file" accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-500/10 file:text-teal-300 hover:file:bg-teal-500/20 transition-colors cursor-pointer"/>
            </div>
            <div class="sm:col-start-2 sm:col-span-2">
                <x-input-error class="mt-1 text-red-400" :messages="$errors->get('photo')" />
            </div>
        </div>

        <!-- Username (Hanya Baca) -->
        <div>
            <x-input-label for="username" value="Username" class="font-semibold text-gray-400" />
            <div class="relative mt-1">
                <x-text-input id="username" type="text" class="block w-full bg-gray-800/50 border-gray-700/50 text-gray-400 cursor-not-allowed" :value="$user->username" disabled readonly />
                <span class="absolute inset-y-0 right-3 flex items-center text-xs text-amber-400 font-mono">[Hanya Baca]</span>
            </div>
            <p class="mt-1 text-xs text-gray-500">Username tidak dapat diubah setelah registrasi.</p>
        </div>

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-semibold text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nim" value="NIM" class="font-semibold text-gray-300" />
            <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" :value="old('nim', $user->nim)" required autocomplete="nim" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nim')" />
        </div>
        
        <div>
            <x-input-label for="email" value="Email" class="font-semibold text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-red-400">
                    <p>Alamat email Anda belum terverifikasi.</p>

                    <button form="send-verification" class="text-xs text-gray-400 underline hover:text-amber-300 transition-colors">
                        Kirim ulang email verifikasi.
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-green-400">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                @endif
            @endif
        </div>

        <div>
            <x-input-label for="program_studi" value="Program Studi" class="font-semibold text-gray-300" />
            <select id="program_studi" name="program_studi" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" required>
                <option value="" disabled {{ !$user->program_studi ? 'selected' : '' }}>-- Pilih Program Studi --</option>
                <option value="D3 Teknologi Informasi" {{ old('program_studi', $user->program_studi) == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi</option>
                <option value="D3 Keuangan Dan Perbankan" {{ old('program_studi', $user->program_studi) == 'D3 Keuangan Dan Perbankan' ? 'selected' : '' }}>D3 Keuangan Dan Perbankan</option>
                <option value="D4 Desain Grafis" {{ old('program_studi', $user->program_studi) == 'D4 Desain Grafis' ? 'selected' : '' }}>D4 Desain Grafis</option>
                <option value="D4 Manajemen Perhotelan" {{ old('program_studi', $user->program_studi) == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen Perhotelan</option>
            </select>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('program_studi')" />
        </div>

        <div>
            <x-input-label for="nomor_telepon" value="Nomor Telepon" class="font-semibold text-gray-300" />
            <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" :value="old('nomor_telepon', $user->nomor_telepon)" autocomplete="tel" placeholder="Contoh: 081234567890"/>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nomor_telepon')" />
        </div>

        <div>
            <x-input-label for="deskripsi" value="Bio Singkat" class="font-semibold text-gray-300" />
            <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full bg-gray-900/50 border-gray-700/50 text-gray-200 rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('deskripsi', $user->deskripsi) }}</textarea>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('deskripsi')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2 bg-teal-500 hover:bg-teal-600 text-black font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-teal-500/20 font-display focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-400">
                Simpan Perubahan
            </button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-mono text-green-400"
                >// Profil berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>
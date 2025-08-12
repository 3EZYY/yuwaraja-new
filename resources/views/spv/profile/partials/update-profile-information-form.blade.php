<section>
    {{-- Form ini hanya untuk mengirim email verifikasi, biarkan seperti apa adanya --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form utama untuk memperbarui profil --}}
    <form method="post" action="{{ route('spv.profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-teal-300 font-semibold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-800/50 border-gray-600 text-white placeholder-gray-400 focus:border-teal-400 focus:ring-teal-400" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-teal-300 font-semibold" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-800/50 border-gray-600 text-white placeholder-gray-400 focus:border-teal-400 focus:ring-teal-400" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-amber-400">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-amber-300 hover:text-amber-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Foto Profil -->
        <div>
            <x-input-label for="photo" :value="__('Foto Profil')" class="text-teal-300 font-semibold" />
            <div class="mt-2 flex items-center gap-4">
                @if($user->photo)
                    <img src="{{ asset('profile-pictures/' . $user->photo) }}" alt="Current Photo" class="w-16 h-16 rounded-full border-2 border-teal-400">
                @else
                    <div class="w-16 h-16 rounded-full bg-teal-400/20 flex items-center justify-center border-2 border-teal-400">
                        <span class="text-lg font-semibold text-teal-400">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                @endif
                <div class="flex flex-col gap-2">
                    <input id="photo" name="photo" type="file" accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-500/10 file:text-teal-300 hover:file:bg-teal-500/20 transition-colors cursor-pointer"/>
                    <p class="text-xs text-gray-500 mt-1">Note: File foto jangan lebih dari 2MB</p>
                    @if($user->photo)
                        <a href="{{ route('profile.crop-photo') }}" class="inline-flex items-center px-3 py-1 bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 text-xs rounded-lg transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Crop Foto
                        </a>
                    @endif
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <!-- Nomor Telepon -->
        <div>
            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" class="text-teal-300 font-semibold" />
            <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full bg-gray-800/50 border-gray-600 text-white placeholder-gray-400 focus:border-teal-400 focus:ring-teal-400" :value="old('nomor_telepon', $user->nomor_telepon)" placeholder="Contoh: 08123456789" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
        </div>

        <!-- Alamat -->
        <div>
            <x-input-label for="address" :value="__('Alamat')" class="text-teal-300 font-semibold" />
            <textarea id="address" name="address" rows="3" class="mt-1 block w-full bg-gray-800/50 border-gray-600 text-white placeholder-gray-400 focus:border-teal-400 focus:ring-teal-400 rounded-md" placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-teal-500 hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700">{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
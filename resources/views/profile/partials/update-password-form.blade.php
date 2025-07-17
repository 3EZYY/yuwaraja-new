<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Input Kata Sandi Saat Ini --}}
        <div>
            <x-input-label for="update_password_current_password" value="Kata Sandi Saat Ini" class="font-semibold text-gray-300" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-gray-800/50 border-gray-700 text-white rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" autocomplete="current-password" placeholder="Masukkan kata sandi Anda sekarang" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- Input Kata Sandi Baru --}}
        <div>
            <x-input-label for="update_password_password" value="Kata Sandi Baru" class="font-semibold text-gray-300" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-gray-800/50 border-gray-700 text-white rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" autocomplete="new-password" placeholder="Buat kata sandi yang kuat" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Input Konfirmasi Kata Sandi Baru --}}
        <div>
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Kata Sandi Baru" class="font-semibold text-gray-300" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-800/50 border-gray-700 text-white rounded-lg focus:border-teal-400 focus:ring-1 focus:ring-teal-400 transition" autocomplete="new-password" placeholder="Ulangi kata sandi baru Anda" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Tombol Aksi & Pesan Sukses --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-teal-500 hover:bg-teal-600 text-black font-bold font-display rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                </svg>
                {{ __('Simpan') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400 flex items-center gap-2"
                > 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                Berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
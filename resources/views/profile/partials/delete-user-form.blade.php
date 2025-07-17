<section class="space-y-6">
    {{-- Tombol untuk memicu modal --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600/90 hover:bg-red-700/90 text-white font-bold font-display rounded-lg border border-red-500/50 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-red-500"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        {{ __('Hapus Akun') }}
    </button>

    {{-- Modal Konfirmasi Penghapusan --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-900 border border-red-500/30 rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold font-display text-red-400 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                Konfirmasi Penghapusan Akun
            </h2>

            <p class="mt-2 text-sm text-red-300/80">
                Apakah Anda yakin ingin menghapus akun Anda? Semua data akan hilang secara permanen. Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Kata Sandi Anda" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full bg-gray-800/50 border-red-700/50 text-white rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition"
                    placeholder="Masukkan kata sandi untuk konfirmasi"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-semibold bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-lg transition-colors">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Ya, Hapus Akun Saya') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
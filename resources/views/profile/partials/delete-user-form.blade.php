<section class="space-y-6">
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="cyber-button bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 border-red-500"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        {{ __('Terminate Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-900 border border-red-500/30 rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-xl font-orbitron font-bold text-red-400 text-glow-red mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                {{ __('CRITICAL WARNING') }}
            </h2>

            <p class="mt-1 text-sm text-red-300 font-mono mb-6">
                {{ __('This operation will permanently delete your account and all associated data. This action cannot be undone. Enter your password to authorize termination.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Authorization Password') }}" class="text-red-400 font-bold" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full cyber-input border-red-500/50 focus:border-red-400"
                    placeholder="Enter password to confirm termination..."
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="cyber-button bg-gray-700 hover:bg-gray-600 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    {{ __('Abort') }}
                </button>

                <button type="submit" class="cyber-button bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    {{ __('TERMINATE ACCOUNT') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

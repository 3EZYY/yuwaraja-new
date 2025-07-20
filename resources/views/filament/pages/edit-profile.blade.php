<x-filament-panels::page>
    <form wire:submit="save">
        {{-- Ini akan merender form (input nama, email, password) dari file EditProfile.php --}}
        {{ $this->form }}

        <div class="mt-6">
            {{-- Ini adalah tombol untuk menyimpan perubahan --}}
            <x-filament::button type="submit">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>

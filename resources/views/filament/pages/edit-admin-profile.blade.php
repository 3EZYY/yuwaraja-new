<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit="save">
            {{ $this->form }}

            <div class="mt-6 flex justify-end">
                <x-filament::button type="submit" size="lg">
                    <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
                    Simpan Perubahan
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page>

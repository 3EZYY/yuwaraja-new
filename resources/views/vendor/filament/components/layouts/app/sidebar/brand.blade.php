<div class="flex items-center gap-3">
    @if (filled($logo = filament()->getBrandLogo()))
        <div class="flex">
            <img src="{{ $logo }}" alt="{{ filament()->getBrandName() }}" style="height: 50px; width: auto;">
        </div>
    @endif

    @if (filled($brandName = filament()->getBrandName()))
        <div style="font-size: 18px; font-weight: 700; color: #f59e0b;">
            {{ $brandName }}
        </div>
    @endif
</div>

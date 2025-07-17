<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}" class="antialiased bg-gray-50 filament js-focus-visible">
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook('head.start') }}

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @foreach (\Filament\Support\Facades\FilamentAsset::getStyles() as $style)
            <link rel="stylesheet" href="{{ $style }}" />
        @endforeach

        @foreach (\Filament\Support\Facades\FilamentAsset::getScripts() as $script)
            @if (\Illuminate\Support\Str::of($script)->startsWith(['http://', 'https://']))
                <script src="{{ $script }}" defer></script>
            @else
                <script src="{{ route('filament.asset', ['file' => $script]) }}" defer></script>
            @endif
        @endforeach

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @livewireStyles

        {{ \Filament\Support\Facades\FilamentView::renderHook('head.end') }}
    </head>

    <body class="filament-body bg-gray-50 text-gray-900 dark:text-gray-100">
        {{ \Filament\Support\Facades\FilamentView::renderHook('body.start') }}
        
        @include('vendor.filament.components.notification')

        <div class="flex w-full min-h-screen overflow-x-hidden">
            <!-- Sidebar -->
            <aside class="filament-sidebar fixed inset-y-0 left-0 z-20 flex flex-col h-screen overflow-hidden shadow-2xl transition-all bg-white lg:border-r rtl:border-r-0 rtl:lg:border-l w-72 lg:z-0 lg:translate-x-0 -translate-x-full">
                <header class="h-[4rem] shrink-0 flex items-center justify-center border-b">
                    @include('vendor.filament.components.layouts.app.sidebar.brand')
                </header>

                <nav class="flex-1 overflow-y-auto py-6">
                    {{ $navigation ?? '' }}
                </nav>
            </aside>

            <div class="filament-main flex-1 flex-col w-screen lg:w-auto lg:ml-72 rtl:lg:ml-0 rtl:lg:mr-72 flex min-h-screen overflow-x-hidden">
                <!-- Topbar -->
                @include('vendor.filament.components.topbar')

                <main class="filament-main-content flex-1 w-full px-4 mx-auto md:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Alpine.start()
            })
        </script>

        {{ \Filament\Support\Facades\FilamentView::renderHook('body.end') }}
    </body>
</html>
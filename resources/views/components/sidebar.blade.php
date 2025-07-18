@props(['role'])

<div x-data="{ sidebarOpen: false }" class="relative">
    <!-- Mobile Menu Button -->
    <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-black/20 backdrop-blur-sm border border-cyan-400/20">
        <svg class="h-6 w-6 text-cyan-400" x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg class="h-6 w-6 text-cyan-400" x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar Backdrop -->
    <div x-show="sidebarOpen"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm lg:hidden"
        @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar -->
    <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform lg:translate-x-0 bg-[#0A0F1A] border-r border-cyan-400/20">

        <!-- Logo & Title -->
        <a href="{{route('dashboard')}}" class="flex flex-col items-center justify-center h-36 px-4 bg-black/30 border-b border-cyan-400/20">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-16 mb-2">
            <h1 class="text-lg font-bold text-white font-orbitron">YUWARAJA XVII</h1>
        </a>

        <!-- Navigation -->
        <nav class="p-7 space-y-1.5">
            @if($role === 'mahasiswa')
                @if(Auth::user()->kelompok_id)
                    {{-- Menu untuk mahasiswa yang sudah bergabung dengan kelompok --}}
                    <x-sidebar.nav-link :href="route('mahasiswa.dashboard')" :active="request()->routeIs('mahasiswa.dashboard')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </x-slot>
                        Dashboard
                    </x-sidebar.nav-link>

                    <x-sidebar.nav-link :href="route('mahasiswa.tugas.index')" :active="request()->routeIs('mahasiswa.tugas.*')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </x-slot>
                        Tugas
                    </x-sidebar.nav-link>

                    <x-sidebar.nav-link :href="route('mahasiswa.pengumuman.index')" :active="request()->routeIs('mahasiswa.pengumuman.*')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
                            </svg>
                        </x-slot>
                        Pengumuman
                    </x-sidebar.nav-link>
                @else
                    {{-- Menu untuk mahasiswa yang belum bergabung dengan kelompok --}}
                    <x-sidebar.nav-link :href="route('mahasiswa.join-kelompok')" :active="request()->routeIs('mahasiswa.join-kelompok')">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8.257 3.099c.366-.446.957-.532 1.403-.166l.094.083 7 7a1 1 0 01.083 1.32l-.083.094-7 7a1 1 0 01-1.497-1.32l.083-.094L13.584 11H3a1 1 0 01-.993-.883L2 10a1 1 0 01.883-.993L3 9h10.584l-5.327-5.293a1 1 0 01-.083-1.32l.083-.094z" />
                            </svg>
                        </x-slot>
                        Join Kelompok
                    </x-sidebar.nav-link>
                    
                    {{-- Pesan informasi untuk mahasiswa yang belum bergabung --}}
                    <div class="mt-4 p-3 bg-yellow-400/10 border border-yellow-400/20 rounded-lg">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-.765 2.008-.765 2.773 0l6.364 6.364a.75.75 0 010 1.061L11.03 16.89a.75.75 0 01-1.061 0L3.605 10.525a.75.75 0 010-1.061L9.97 3.099zm1.414 7.425a.75.75 0 11-1.06-1.06.75.75 0 011.06 1.06z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-yellow-400">Bergabung dengan Kelompok</p>
                                <p class="text-xs text-yellow-400/70 mt-1">Untuk mengakses Dashboard, Tugas, dan Pengumuman, silakan bergabung dengan kelompok terlebih dahulu.</p>
                            </div>
                        </div>
                    </div>
                @endif

            @elseif($role === 'spv')
            <x-sidebar.nav-link :href="route('spv.dashboard')" :active="request()->routeIs('spv.dashboard')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </x-slot>
                Dashboard
            </x-sidebar.nav-link>

            <x-sidebar.nav-link :href="route('spv.cluster.index')" :active="request()->routeIs('spv.cluster.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </x-slot>
                Cluster
            </x-sidebar.nav-link>

            <x-sidebar.nav-link :href="route('spv.tugas.index')" :active="request()->routeIs('spv.tugas.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                </x-slot>
                Tugas
            </x-sidebar.nav-link>

            <x-sidebar.nav-link :href="route('spv.pengumpulan.index')" :active="request()->routeIs('spv.pengumpulan.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-slot>
                Pengumpulan
            </x-sidebar.nav-link>

            <x-sidebar.nav-link :href="route('spv.pengumuman.index')" :active="request()->routeIs('spv.pengumuman.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
                    </svg>
                </x-slot>
                Pengumuman
            </x-sidebar.nav-link>

            <x-sidebar.nav-link :href="route('spv.profile.edit')" :active="request()->routeIs('spv.profile.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                    </svg>
                </x-slot>
                Profile
            </x-sidebar.nav-link>
            @endif

            <!-- Bottom Actions -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-black/30 border-t border-cyan-400/20">
                {{-- Informasi Kelompok untuk Mahasiswa --}}
                @if($role === 'mahasiswa' && Auth::user()->kelompok_id)
                    <a href="{{ route('mahasiswa.friendship.index') }}" class="block mb-3 p-3 rounded-lg bg-green-400/10 border border-green-400/20 hover:bg-green-400/20 hover:border-green-400/40 transition-all duration-200 group">
                        <div class="flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400 group-hover:text-green-300" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            <h4 class="text-sm font-semibold text-green-400 group-hover:text-green-300">Kelompok</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-400/50 group-hover:text-green-300 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <p class="text-xs text-white font-medium group-hover:text-green-100">{{ Auth::userWithKelompok()->kelompok?->nama_kelompok ?? 'Kelompok tidak ditemukan' }}</p>
                            <p class="text-xs text-green-400/70 group-hover:text-green-300/80">Kode: {{ Auth::userWithKelompok()->kelompok?->code ?? 'N/A' }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-green-400 group-hover:text-green-300">
                                    {{ Auth::userWithKelompok()->kelompok?->users?->count() ?? 0 }} Anggota
                                </span>
                                <span class="text-xs text-green-400/70 group-hover:text-green-300/80">
                                    Klik untuk berteman →
                                </span>
                            </div>
                        </div>
                    </a>
                    
                    {{-- Tombol Keluar Kelompok --}}
                    <div class="mb-3">
                        <form method="POST" action="{{ route('mahasiswa.leave-kelompok') }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full text-xs text-red-400 hover:text-red-300 hover:bg-red-400/10 p-2 rounded border border-red-400/20 hover:border-red-400/40 transition-all" onclick="return confirm('Yakin ingin keluar dari kelompok?')">
                                Keluar dari Kelompok
                            </button>
                        </form>
                    </div>
                @endif

                <div class="flex items-center gap-3 px-2 py-2 mb-2 rounded-lg bg-cyan-400/5">
                    @if(Auth::user()->photo)
                    <img src="{{ asset('profile-pictures/' . Auth::user()->photo) }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-cyan-400/50">
                    @else
                    <div class="w-10 h-10 rounded-full bg-cyan-400/10 border-2 border-cyan-400/50 flex items-center justify-center">
                        <span class="text-lg font-semibold text-cyan-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-cyan-400/70 truncate">{{ Auth::user()->program_studi }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="text-cyan-400 hover:text-cyan-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" href="route('profile.edit')">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>

                </div>


                <form method="POST" action="{{ route('logout') }}" class="contents">
                    @csrf
                    <x-sidebar.nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="justify-center text-sm py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-300">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </x-slot>
                        Logout
                    </x-sidebar.nav-link>
                </form>
            </div>
        </nav>
    </aside>
</div>

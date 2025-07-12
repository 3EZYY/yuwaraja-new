<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengumuman
        </h2>
    </x-slot>

    <style>
        body { background: #0b101a; }
        .cyber-card-ann { background: #181825; border: 1px solid rgba(0,209,255,0.15); border-radius: 0.75rem; box-shadow: 0 2px 16px 0 #0004; }
        .cyber-card-ann:hover { border-color: #00d1ff; box-shadow: 0 4px 32px 0 #00d1ff22; }
        .ann-title { color: #00eaff; font-weight: 700; font-size: 1.15rem; }
        .ann-title:hover { color: #ffe066; text-decoration: underline; }
        .ann-date { color: #b2b2d6; font-size: 0.95rem; }
        .ann-snippet { color: #e0e6f0; font-size: 1rem; margin-top: 0.25rem; }
        .ann-divider { border-color: #232347; }

        /* Custom style for detail card */
        .detail-card {
            background: #fff;
            color: #222;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.15);
            padding: 32px 28px;
            margin: 0 auto 24px auto;
            max-width: 600px;
        }
        .detail-card h1 {
            color: #222;
            font-weight: bold;
        }
        .detail-label {
            color: #1976d2;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .detail-content {
            margin-top: 8px;
            color: #333;
            font-size: 16px;
        }
        .detail-back {
            margin-top: 18px;
        }
    </style>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="cyber-card-ann p-8">
                <h2 class="text-2xl font-bold mb-6 text-[#ffe066] tracking-wide">Pengumuman</h2>
                @if(isset($listMode) && $listMode && $pengumuman->count())
                    <ul>
                        @foreach($pengumuman as $item)
                            <li class="mb-6 last:mb-0">
                                <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="ann-title block transition">
                                    {{ $item->judul }}
                                </a>
                                <div class="ann-date">{{ $item->created_at->format('d M Y H:i') }}</div>
                                <div class="ann-snippet">{{ Str::limit($item->isi, 100) }}</div>
                                @if(!$loop->last)
                                    <hr class="my-5 ann-divider">
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-8">{{ $pengumuman->links() }}</div>
                @elseif(isset($detailMode) && $detailMode && $pengumuman)
                    <div class="detail-card">
                        <h1 class="text-2xl font-bold mb-4">{{ $pengumuman->judul }}</h1>
                        <div class="text-sm text-gray-500 mb-2">Diposting: {{ $pengumuman->created_at->format('d M Y H:i') }}</div>
                        <div class="detail-label">Tipe: <span>{{ $pengumuman->tipe }}</span></div>
                        <div class="detail-label mt-2"><b>Konten:</b></div>
                        <div class="detail-content">
                            @if(!empty($pengumuman->isi))
                                {!! nl2br(e($pengumuman->isi)) !!}
                            @elseif(!empty($pengumuman->konten))
                                {!! nl2br(e($pengumuman->konten)) !!}
                            @else
                                <span class="text-gray-400">(Belum ada konten pengumuman)</span>
                            @endif
                        </div>
                        <div class="detail-back">
                            <a href="{{ route('mahasiswa.pengumuman.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">← Kembali ke Daftar Pengumuman</a>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-500">Belum ada pengumuman.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

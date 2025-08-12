@php
    use Carbon\Carbon;
    
    $now = Carbon::now();
    $tanggal = $getRecord()->tanggal;
    $jamMulai = $getRecord()->jam_mulai;
    $jamSelesai = $getRecord()->jam_selesai;
    
    // Perbaikan: Parse tanggal dan waktu secara terpisah, lalu gabungkan
    $tanggalCarbon = Carbon::parse($tanggal);
    $tanggalAbsensi = $tanggalCarbon->copy()->setTimeFromTimeString($jamMulai);
    $batasAbsensi = $tanggalCarbon->copy()->setTimeFromTimeString($jamSelesai);
    
    $status = '';
    $countdownTarget = '';
    $badgeClass = '';
    
    if ($now < $tanggalAbsensi) {
        // Belum dimulai
        $status = 'Belum Dimulai';
        $countdownTarget = $tanggalAbsensi->toISOString();
        $badgeClass = 'bg-yellow-100 text-yellow-800';
    } elseif ($now->between($tanggalAbsensi, $batasAbsensi)) {
        // Sedang berlangsung
        $status = 'Berlangsung';
        $countdownTarget = $batasAbsensi->toISOString();
        $badgeClass = 'bg-green-100 text-green-800';
    } else {
        // Sudah berakhir
        $status = 'Berakhir';
        $countdownTarget = '';
        $badgeClass = 'bg-red-100 text-red-800';
    }
@endphp

<div class="space-y-1">
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
        {{ $status }}
    </span>
    
    @if($countdownTarget)
        <div class="text-xs text-gray-600 font-mono countdown-timer" 
             data-target="{{ $countdownTarget }}"
             data-record-id="{{ $getRecord()->id }}">
            <span class="countdown-display">Menghitung...</span>
        </div>
    @endif
</div>

@once
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateCountdowns() {
                document.querySelectorAll('.countdown-timer').forEach(function(element) {
                    const target = new Date(element.dataset.target);
                    const now = new Date();
                    const diff = target - now;
                    
                    if (diff > 0) {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        
                        let display = '';
                        if (days > 0) display += days + 'h ';
                        if (hours > 0) display += hours + 'j ';
                        display += minutes + 'm ' + seconds + 'd';
                        
                        element.querySelector('.countdown-display').textContent = display;
                    } else {
                        element.querySelector('.countdown-display').textContent = 'Waktu habis';
                        element.style.opacity = '0.5';
                    }
                });
            }
            
            // Update setiap detik
            updateCountdowns();
            setInterval(updateCountdowns, 1000);
            
            // Update saat halaman di-refresh oleh Filament
            document.addEventListener('livewire:navigated', updateCountdowns);
        });
    </script>
    @endpush
@endonce
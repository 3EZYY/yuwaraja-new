<div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
        <i class="fas fa-clock mr-2 text-blue-500"></i>
        Preview Waktu Absensi
    </h3>
    
    <div id="countdown-preview-container" class="space-y-3">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status Saat Ini</div>
                <div id="status-badge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    Menunggu Input
                </div>
            </div>
            
            <!-- Countdown Card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Countdown</div>
                <div id="countdown-display" class="font-mono text-sm font-medium text-gray-900 dark:text-white">
                    --:--:--
                </div>
            </div>
            
            <!-- Duration Card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Durasi</div>
                <div id="duration-display" class="font-mono text-sm font-medium text-gray-900 dark:text-white">
                    --:--
                </div>
            </div>
        </div>
        
        <!-- Timeline Visual -->
        <div class="bg-white dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-3">Timeline Absensi</div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mb-1"></div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 text-center">
                            <div>Mulai</div>
                            <div id="start-time" class="font-mono">--:--</div>
                        </div>
                    </div>
                    <div class="flex-1 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mb-1"></div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 text-center">
                            <div>Selesai</div>
                            <div id="end-time" class="font-mono">--:--</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let countdownInterval;
    
    function updatePreview() {
        const tanggalInput = document.querySelector('input[name="tanggal"]');
        const jamMulaiInput = document.querySelector('input[name="jam_mulai"]');
        const jamSelesaiInput = document.querySelector('input[name="jam_selesai"]');
        
        if (!tanggalInput || !jamMulaiInput || !jamSelesaiInput) return;
        
        const tanggal = tanggalInput.value;
        const jamMulai = jamMulaiInput.value;
        const jamSelesai = jamSelesaiInput.value;
        
        if (!tanggal || !jamMulai || !jamSelesai) {
            resetPreview();
            return;
        }
        
        try {
            const startTime = new Date(tanggal + 'T' + jamMulai);
            const endTime = new Date(tanggal + 'T' + jamSelesai);
            const now = new Date();
            
            // Update time displays
            document.getElementById('start-time').textContent = jamMulai;
            document.getElementById('end-time').textContent = jamSelesai;
            
            // Calculate duration
            const duration = (endTime - startTime) / (1000 * 60); // in minutes
            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;
            document.getElementById('duration-display').textContent = 
                hours + 'j ' + minutes + 'm';
            
            // Update status and countdown
            updateCountdown(now, startTime, endTime);
            
        } catch (error) {
            console.error('Error parsing dates:', error);
            resetPreview();
        }
    }
    
    function updateCountdown(now, startTime, endTime) {
        const statusBadge = document.getElementById('status-badge');
        const countdownDisplay = document.getElementById('countdown-display');
        
        if (now < startTime) {
            // Belum dimulai
            statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
            statusBadge.textContent = 'Belum Dimulai';
            
            const diff = startTime - now;
            updateCountdownDisplay(countdownDisplay, diff);
            
        } else if (now >= startTime && now <= endTime) {
            // Sedang berlangsung
            statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
            statusBadge.textContent = 'Berlangsung';
            
            const diff = endTime - now;
            updateCountdownDisplay(countdownDisplay, diff);
            
        } else {
            // Sudah berakhir
            statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
            statusBadge.textContent = 'Berakhir';
            countdownDisplay.textContent = 'Waktu Habis';
        }
    }
    
    function updateCountdownDisplay(element, diff) {
        if (diff > 0) {
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            let display = '';
            if (days > 0) display += days + 'h ';
            if (hours > 0) display += hours + 'j ';
            display += minutes + 'm ' + seconds + 'd';
            
            element.textContent = display;
        } else {
            element.textContent = 'Waktu Habis';
        }
    }
    
    function resetPreview() {
        document.getElementById('status-badge').className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800';
        document.getElementById('status-badge').textContent = 'Menunggu Input';
        document.getElementById('countdown-display').textContent = '--:--:--';
        document.getElementById('duration-display').textContent = '--:--';
        document.getElementById('start-time').textContent = '--:--';
        document.getElementById('end-time').textContent = '--:--';
    }
    
    // Listen for form changes
    document.addEventListener('input', function(e) {
        if (e.target.name === 'tanggal' || e.target.name === 'jam_mulai' || e.target.name === 'jam_selesai') {
            updatePreview();
        }
    });
    
    // Start real-time countdown
    countdownInterval = setInterval(updatePreview, 1000);
    
    // Initial update
    updatePreview();
});
</script>
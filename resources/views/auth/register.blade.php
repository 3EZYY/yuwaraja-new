<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-field" style="animation-delay: 0.8s;">
            <h2 class="text-center text-xl font-orbitron text-cyan-400 tracking-widest mb-4">
                // AGENT REGISTRATION PROTOCOL //
            </h2>
        </div>

        {{-- Layout Grid untuk kerapian --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <!-- Name -->
            <div class="form-field" style="animation-delay: 1.0s;">
                <x-input-label for="name" value="Nama Lengkap" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="name" class="cyber-input" type="text" name="name" :value="old('name')" placeholder="Masukan Nama Lengkap" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- NIM -->
            <div class="form-field" style="animation-delay: 1.0s;">
                <x-input-label for="nim" value="NIM" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="nim" class="cyber-input" type="text" name="nim" :value="old('nim')" required placeholder="Masukan NIM"
                    autocomplete="nim" />
                <x-input-error :messages="$errors->get('nim')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Username -->
            <div class="form-field" style="animation-delay: 1.1s;">
                <x-input-label for="username" value="Username"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="username" class="cyber-input" type="text" name="username" :value="old('username')" placeholder="Masukan Username"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Program Studi -->
            <div class="form-field" style="animation-delay: 1.1s;">
                <x-input-label for="program_studi" value="Program Studi"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <select id="program_studi" name="program_studi" class="cyber-input cyber-select" required>
                    <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Pilih Program Studi</option>
                    </option>
                    <option value="D4 Manajemen Perhotelan"
                        {{ old('program_studi') == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen
                        Perhotelan</option>
                    <option value="D3 Keuangan dan Perbankan"
                        {{ old('program_studi') == 'D3 Keuangan dan Perbankan' ? 'selected' : '' }}>D3 Keuangan dan
                        Perbankan</option>
                    <option value="D3 Administrasi Bisnis"
                        {{ old('program_studi') == 'D3 Administrasi Bisnis' ? 'selected' : '' }}>D3 Administrasi Bisnis
                    </option>
                    <option value="D4 Desain Grafis" {{ old('program_studi') == 'D4 Desain Grafis' ? 'selected' : '' }}>
                        D4 Desain Grafis</option>
                    <option value="D3 Teknologi Informasi"
                        {{ old('program_studi') == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi
                    </option>
                </select>
                <x-input-error :messages="$errors->get('program_studi')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Angkatan -->
            <div class="form-field" style="animation-delay: 1.2s;">
                <x-input-label for="angkatan" value="Angkatan"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="angkatan" class="cyber-input" type="text" name="angkatan" :value="old('angkatan')"
                    pattern="\d{4}" title="Angkatan harus berupa 4 digit angka"
                    autocomplete="off" minlength="4" maxlength="4"
                    placeholder="Masukan Angkatan"
                    required />
                <x-input-error :messages="$errors->get('angkatan')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Nomor Telepon -->
            <div class="form-field" style="animation-delay: 1.2s;">
                <x-input-label for="nomor_telepon" value="Nomor Telepon"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="nomor_telepon" class="cyber-input" type="text" name="nomor_telepon"
                    :value="old('nomor_telepon')" required placeholder="Masukan Nomor Telepon" />
                <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-field" style="animation-delay: 1.3s;">
                <x-input-label for="tanggal_lahir" value="Tanggal Lahir"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="tanggal_lahir" class="cyber-input" type="date" name="tanggal_lahir"
                    :value="old('tanggal_lahir')" required />
                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-field" style="animation-delay: 1.3s;">
                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="cyber-input cyber-select" required>
                    <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Model L
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Model P
                    </option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2 text-yellow-400 text-xs" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="form-field" style="animation-delay: 1.4s;">
            <x-input-label for="email" value="Email" class="mb-1 text-sm text-cyan-300 tracking-wide" />
            <x-text-input id="email" class="cyber-input" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="Masukan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-400 text-xs" />
        </div>

        {{-- Layout Grid untuk Password --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <!-- Password -->
            <div class="form-field" style="animation-delay: 1.5s;">
                <x-input-label for="password" value="Password"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="password" class="cyber-input" type="password" name="password" required
                    autocomplete="new-password" placeholder="Masukan Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-400 text-xs" />
            </div>

            <!-- Confirm Password -->
            <div class="form-field" style="animation-delay: 1.5s;">
                <x-input-label for="password_confirmation" value="Konfirmasi Password"
                    class="mb-1 text-sm text-cyan-300 tracking-wide" />
                <x-text-input id="password_confirmation" class="cyber-input" type="password"
                    name="password_confirmation" required autocomplete="new-password" placeholder="Masukan Konfirmasi Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-yellow-400 text-xs" />
            </div>
        </div>

        <x-primary-button
            class="w-full flex justify-center items-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold uppercase tracking-wider transform hover:scale-105 transition-all duration-300 shadow-[0_0_15px_rgba(247,212,38,0.6)] hover:shadow-[0_0_25px_rgba(247,212,38,0.8)] focus:bg-yellow-700 focus:ring-yellow-500 border-none px-6 py-3">
            {{ __('Daftar') }}
        </x-primary-button>
            
        <div class="flex items-center justify-center mt-4 form-field w-full" style="animation-delay: 1.6s;">
            Sudah Punya Akun?
            <a class="font-bold underline text-yellow-400 hover:text-yellow-300 rounded-md focus:outline-none transition px-2"
                href="{{ route('login') }}">
                {{ __('Masuk') }}
            </a>
        </div>
    </form>
</x-guest-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    
    // Create validation message elements
    function createValidationMessage(inputId) {
        const input = document.getElementById(inputId);
        const messageEl = document.createElement('div');
        messageEl.id = `${inputId}-validation-message`;
        messageEl.className = 'mt-1 text-xs';
        input.parentNode.appendChild(messageEl);
        return messageEl;
    }
    
    const usernameMessage = createValidationMessage('username');
    const emailMessage = createValidationMessage('email');
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Check username availability
    const checkUsername = debounce(async function(username) {
        if (username.length < 3) {
            usernameMessage.textContent = '';
            return;
        }
        
        try {
            const response = await fetch(`/api/check-username?username=${encodeURIComponent(username)}`);
            const data = await response.json();
            
            if (data.available) {
                usernameMessage.textContent = '✓ ' + data.message;
                usernameMessage.className = 'mt-1 text-xs text-green-400';
            } else {
                usernameMessage.textContent = '✗ ' + data.message;
                usernameMessage.className = 'mt-1 text-xs text-red-400';
            }
        } catch (error) {
            console.error('Error checking username:', error);
        }
    }, 500);
    
    // Check email availability
    const checkEmail = debounce(async function(email) {
        if (!email.includes('@')) {
            emailMessage.textContent = '';
            return;
        }
        
        try {
            const response = await fetch(`/api/check-email?email=${encodeURIComponent(email)}`);
            const data = await response.json();
            
            if (data.available) {
                emailMessage.textContent = '✓ ' + data.message;
                emailMessage.className = 'mt-1 text-xs text-green-400';
            } else {
                emailMessage.textContent = '✗ ' + data.message;
                emailMessage.className = 'mt-1 text-xs text-red-400';
            }
        } catch (error) {
            console.error('Error checking email:', error);
        }
    }, 500);
    
    // Add event listeners
    usernameInput.addEventListener('input', function() {
        checkUsername(this.value);
    });
    
    emailInput.addEventListener('input', function() {
        checkEmail(this.value);
    });
    
    // Form validation on submit
    form.addEventListener('submit', function(e) {
        const requiredFields = [
            'name', 'nim', 'username', 'program_studi', 'angkatan', 
            'nomor_telepon', 'tanggal_lahir', 'jenis_kelamin', 'email', 
            'password', 'password_confirmation'
        ];
        
        let hasEmptyFields = false;
        let emptyFieldNames = [];
        
        requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (field && (!field.value || field.value.trim() === '')) {
                hasEmptyFields = true;
                emptyFieldNames.push(field.previousElementSibling.textContent || fieldName);
            }
        });
        
        if (hasEmptyFields) {
            e.preventDefault();
            alert('Hayoo jangan lupa semua di isi yaa.. Yang masih kosong: ' + emptyFieldNames.join(', '));
            return false;
        }
        
        // Check if username or email is not available
        const usernameAvailable = !usernameMessage.textContent.includes('✗');
        const emailAvailable = !emailMessage.textContent.includes('✗');
        
        if (!usernameAvailable || !emailAvailable) {
            e.preventDefault();
            alert('Username atau email sudah dipakai. Silakan gunakan yang lain!');
            return false;
        }
    });
});
</script>

<x-guest-layout>
    {{-- Wrapper untuk membatasi lebar form dan membuatnya terpusat --}}
    <div class="mx-auto">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-8" style="animation-delay: 0.5s;">
                <h2 class="text-center text-xl font-orbitron text-cyan-400 tracking-widest">
                    // AGENT REGISTRATION PROTOCOL //
                </h2>
            </div>

            {{-- Grid utama untuk semua input, dengan jarak yang lebih rapat --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 lg:gap-x-6 gap-y-4">

                <!-- Nama Lengkap -->
                <div style="animation-delay: 0.8s;">
                    <x-input-label for="name" value="Nama Lengkap" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="name" class="cyber-input" type="text" name="name" :value="old('name')"
                        placeholder="Masukan Nama Lengkap" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- NIM -->
                <div style="animation-delay: 0.8s;">
                    <x-input-label for="nim" value="NIM" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="nim" class="cyber-input" type="text" name="nim" :value="old('nim')"
                        pattern="^(23|24|25)\d{13,14}$"
                        title="NIM harus 15-16 digit dan dimulai dengan 23, 24, atau 25" maxlength="16" minlength="15"
                        required placeholder="Masukan NIM (15-16 digit, awalan 23/24/25)" autocomplete="nim" />
                    <x-input-error :messages="$errors->get('nim')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Username -->
                <div style="animation-delay: 0.9s;">
                    <x-input-label for="username" value="Username" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="username" class="cyber-input" type="text" name="username"
                        :value="old('username')" pattern="^[a-zA-Z0-9]+$"
                        title="Username hanya boleh huruf dan angka"
                        placeholder="Masukan Username (huruf & angka)" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Program Studi -->
                <div style="animation-delay: 0.9s;">
                    <x-input-label for="program_studi" value="Program Studi"
                        class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="program_studi" name="program_studi" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Pilih Program Studi</option>
                        <option value="D4 Manajemen Perhotelan" {{ old('program_studi') == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen Perhotelan</option>
                        <option value="D3 Keuangan dan Perbankan" {{ old('program_studi') == 'D3 Keuangan dan Perbankan' ? 'selected' : '' }}>D3 Keuangan dan Perbankan</option>
                        <option value="D3 Administrasi Bisnis" {{ old('program_studi') == 'D3 Administrasi Bisnis' ? 'selected' : '' }}>D3 Administrasi Bisnis</option>
                        <option value="D4 Desain Grafis" {{ old('program_studi') == 'D4 Desain Grafis' ? 'selected' : '' }}>D4 Desain Grafis</option>
                        <option value="D3 Teknologi Informasi" {{ old('program_studi') == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi</option>
                    </select>
                    <x-input-error :messages="$errors->get('program_studi')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Angkatan -->
                <div style="animation-delay: 1.0s;">
                    <x-input-label for="angkatan" value="Angkatan" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="angkatan" name="angkatan" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('angkatan') ? '' : 'selected' }}>Pilih Angkatan</option>
                        <option value="2023" {{ old('angkatan') == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ old('angkatan') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ old('angkatan') == '2025' ? 'selected' : '' }}>2025</option>
                    </select>
                    <x-input-error :messages="$errors->get('angkatan')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Jalur Masuk -->
                <div style="animation-delay: 1.0s;">
                    <x-input-label for="jalur_masuk" value="Jalur Masuk" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="jalur_masuk" name="jalur_masuk" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('jalur_masuk') ? '' : 'selected' }}>Pilih Jalur Masuk</option>
                        <option value="SNBP" {{ old('jalur_masuk') == 'SNBP' ? 'selected' : '' }}>SNBP</option>
                        <option value="SNBT" {{ old('jalur_masuk') == 'SNBT' ? 'selected' : '' }}>SNBT</option>
                        <option value="Mandiri UB" {{ old('jalur_masuk') == 'Mandiri UB' ? 'selected' : '' }}>Mandiri UB</option>
                        <option value="Mandiri Vokasi" {{ old('jalur_masuk') == 'Mandiri Vokasi' ? 'selected' : '' }}>Mandiri Vokasi</option>
                    </select>
                    <x-input-error :messages="$errors->get('jalur_masuk')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Tempat Lahir -->
                <div style="animation-delay: 1.1s;">
                    <x-input-label for="tempat_lahir" value="Tempat Lahir" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="tempat_lahir" class="cyber-input" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required placeholder="Contoh: Malang" />
                    <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Tanggal Lahir -->
                <div style="animation-delay: 1.1s;">
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="tanggal_lahir" class="cyber-input" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Jenis Kelamin -->
                <div style="animation-delay: 1.1s;">
                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="jenis_kelamin" name="jenis_kelamin" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Asal Sekolah -->
                <div style="animation-delay: 1.4s;">
                    <x-input-label for="asal_sekolah_jenis" value="Asal Sekolah" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="asal_sekolah_jenis" name="asal_sekolah_jenis" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('asal_sekolah_jenis') ? '' : 'selected' }}>Pilih Jenis Sekolah</option>
                        <option value="SMA" {{ old('asal_sekolah_jenis') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMK" {{ old('asal_sekolah_jenis') == 'SMK' ? 'selected' : '' }}>SMK</option>
                        <option value="MAN" {{ old('asal_sekolah_jenis') == 'MAN' ? 'selected' : '' }}>MAN</option>
                        <option value="Lainnya" {{ old('asal_sekolah_jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <x-input-error :messages="$errors->get('asal_sekolah_jenis')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Nama Sekolah -->
                <div style="animation-delay: 1.4s;">
                    <x-input-label for="asal_sekolah_nama" value="Nama Sekolah" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="asal_sekolah_nama" class="cyber-input" type="text" name="asal_sekolah_nama" :value="old('asal_sekolah_nama')" required placeholder="Masukan Nama Sekolah" />
                    <x-input-error :messages="$errors->get('asal_sekolah_nama')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Jurusan/Bidang Minat -->
                <div style="animation-delay: 1.5s;">
                    <x-input-label for="jurusan_sekolah" value="Jurusan/Bidang Minat" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="jurusan_sekolah" class="cyber-input" type="text" name="jurusan_sekolah" :value="old('jurusan_sekolah')" placeholder="Contoh: IPS, Bahasa, Teknik" />
                    <x-input-error :messages="$errors->get('jurusan_sekolah')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Asal Kota -->
                <div style="animation-delay: 1.5s;">
                    <x-input-label for="asal_kota" value="Asal Kota" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="asal_kota" class="cyber-input" type="text" name="asal_kota" :value="old('asal_kota')" required placeholder="Contoh: Malang" />
                    <x-input-error :messages="$errors->get('asal_kota')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Provinsi Domisili -->
                <div style="animation-delay: 1.6s;">
                    <x-input-label for="provinsi" value="Provinsi" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="provinsi" class="cyber-input" type="text" name="provinsi" :value="old('provinsi')" required placeholder="Contoh: Jawa Timur" />
                    <x-input-error :messages="$errors->get('provinsi')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Kota/Kabupaten -->
                <div style="animation-delay: 1.6s;">
                    <x-input-label for="kota" value="Kota/Kabupaten" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <select id="kota" name="kota" class="cyber-input cyber-select" required>
                        <option value="" disabled {{ old('kota') ? '' : 'selected' }}>Pilih Kota/Kabupaten</option>
                        <option value="Kota" {{ old('kota') == 'Kota' ? 'selected' : '' }}>Kota</option>
                        <option value="Kabupaten" {{ old('kota') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                    </select>
                    <x-input-error :messages="$errors->get('kota')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Alamat Lengkap (Span 2 kolom) -->
                <div class="lg:col-span-2" style="animation-delay: 1.7s;">
                    <x-input-label for="alamat_domisili" value="Alamat Lengkap" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <textarea id="alamat_domisili" name="alamat_domisili" class="cyber-input" rows="3" required placeholder="Contoh: Jl. Veteran No. 10, RT 02/RW 05, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145">{{ old('alamat_domisili') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_domisili')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Password -->
                <div style="animation-delay: 1.8s;">
                    <x-input-label for="password" value="Password" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <div class="relative">
                        <x-text-input id="password" class="cyber-input pr-10" type="password" name="password" required autocomplete="new-password" placeholder="Masukan Password" />
                        <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-cyan-400 hover:text-cyan-300">
                            <svg id="password-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="password-eye-off" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Konfirmasi Password -->
                <div style="animation-delay: 1.8s;">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="cyber-input pr-10" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Masukan Konfirmasi Password" />
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-cyan-400 hover:text-cyan-300">
                            <svg id="password_confirmation-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="password_confirmation-eye-off" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Note Password -->
                <div class="lg:col-span-2" style="animation-delay: 2.0s;">
                    <div class="bg-yellow-900/20 border border-yellow-500/30 rounded-lg p-3 text-center">
                        <p class="text-yellow-300 text-sm font-medium">
                            <svg class="inline-block w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Mohon diingat untuk password nya
                        </p>
                    </div>
                </div>



                <!-- Email Pribadi -->
                <div style="animation-delay: 1.2s;">
                    <x-input-label for="email" value="Email Pribadi" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="email" class="cyber-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukan Email Pribadi" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Email Student -->
                <div style="animation-delay: 1.3s;">
                    <x-input-label for="email_student" value="Email Student (@student.ub.ac.id)" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="email_student" class="cyber-input" type="email" name="email_student" :value="old('email_student')" placeholder="Masukan Email Student (opsional)" />
                    <x-input-error :messages="$errors->get('email_student')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Nomor WhatsApp -->
                <div style="animation-delay: 1.2s;">
                    <x-input-label for="nomor_telepon" value="Nomor WhatsApp" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <x-text-input id="nomor_telepon" class="cyber-input" type="text" name="nomor_telepon" :value="old('nomor_telepon')" required placeholder="Masukan Nomor WhatsApp" />
                    <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2 text-yellow-400 text-xs" />
                </div>

                <!-- Foto Profil -->
                <div style="animation-delay: 1.3s;">
                    <x-input-label for="photo" value="Foto Profil (Opsional)" class="mb-1 text-sm text-cyan-300 tracking-wide" />
                    <input id="photo" type="file" name="photo" class="cyber-input w-full text-sm text-gray-300 file:mr-4 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-cyan-900 file:text-cyan-300 hover:file:bg-cyan-800" accept=".jpg,.jpeg,.png,.svg" />
                    <p class="mt-1 text-xs text-cyan-400">Format: JPG, JPEG, PNG, SVG (Maks. 5MB)</p>
                    <x-input-error :messages="$errors->get('photo')" class="mt-2 text-yellow-400 text-xs" />
                </div>

            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8" style="animation-delay: 1.9s;">
                <x-primary-button class="w-full flex justify-center items-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold uppercase tracking-wider transform hover:scale-105 transition-all duration-300 shadow-[0_0_15px_rgba(247,212,38,0.6)] hover:shadow-[0_0_25px_rgba(247,212,38,0.8)] focus:bg-yellow-700 focus:ring-yellow-500 border-none px-6 py-3">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>

            <div class="text-center mt-4" style="animation-delay: 2.0s;">
                Sudah Punya Akun?
                <a class="font-bold underline text-yellow-400 hover:text-yellow-300 rounded-md focus:outline-none transition px-2" href="{{ route('login') }}">
                    {{ __('Masuk') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const emailStudentInput = document.getElementById('email_student');
        const nimInput = document.getElementById('nim');

        // Fungsi untuk membuat elemen pesan validasi
        function createValidationMessage(inputId) {
            const input = document.getElementById(inputId);
            let messageEl = document.getElementById(`${inputId}-validation-message`);
            if (!messageEl) {
                messageEl = document.createElement('div');
                messageEl.id = `${inputId}-validation-message`;
                messageEl.className = 'mt-1 text-xs';
                const errorEl = input.nextElementSibling;
                if (errorEl && errorEl.classList.contains('text-yellow-400')) {
                    errorEl.after(messageEl);
                } else {
                    input.after(messageEl);
                }
            }
            return messageEl;
        }

        const usernameMessage = createValidationMessage('username');
        const emailMessage = createValidationMessage('email');
        const emailStudentMessage = createValidationMessage('email_student');
        const nimMessage = createValidationMessage('nim');

        // Fungsi Debounce
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

        // Validasi format NIM
        function validateNIM(nim) {
            if (nim.length === 0) {
                nimMessage.textContent = '';
                return true;
            }
            
            // Cek panjang NIM
            if (nim.length < 15) {
                nimMessage.textContent = '✗ NIM minimal 15 digit';
                nimMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            if (nim.length > 16) {
                nimMessage.textContent = '✗ NIM maksimal 16 digit';
                nimMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            
            // Cek awalan NIM
            const prefix = nim.substring(0, 2);
            if (!['23', '24', '25'].includes(prefix)) {
                nimMessage.textContent = '✗ NIM harus dimulai dengan 23, 24, atau 25';
                nimMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            
            // Cek format lengkap dengan regex
            if (!/^(23|24|25)\d{13,14}$/.test(nim)) {
                nimMessage.textContent = '✗ Format NIM tidak valid';
                nimMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            
            // Jika semua validasi berhasil
            nimMessage.textContent = `✓ NIM valid (${nim.length} digit, awalan ${prefix})`;
            nimMessage.className = 'mt-1 text-xs text-green-400';
            return true;
        }

        // Validasi format email student
        function validateEmailStudentFormat(email) {
            if (email.length === 0) {
                emailStudentMessage.textContent = '';
                return true;
            }
            if (!email.endsWith('@student.ub.ac.id')) {
                emailStudentMessage.textContent = '✗ Alamat email harus menggunakan @student.ub.ac.id';
                emailStudentMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            emailStudentMessage.textContent = '✓ Format email student valid';
            emailStudentMessage.className = 'mt-1 text-xs text-green-400';
            return true;
        }
        function validateUsernameFormat(username) {
            if (username.length === 0) {
                usernameMessage.textContent = '';
                return true;
            }
            if (!/^[a-zA-Z0-9]+$/.test(username)) {
                usernameMessage.textContent = '✗ Username hanya boleh huruf dan angka';
                usernameMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            if (username.length < 3) {
                usernameMessage.textContent = '✗ Username minimal 3 karakter';
                usernameMessage.className = 'mt-1 text-xs text-red-400';
                return false;
            }
            return true;
        }

        // Cek ketersediaan username
        const checkUsernameAvailability = debounce(async function(username) {
            if (!validateUsernameFormat(username)) {
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

        // Cek ketersediaan email
        const checkEmailAvailability = debounce(async function(email) {
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

        // Cek ketersediaan email student
        const checkEmailStudentAvailability = debounce(async function(email_student) {
            if (!validateEmailStudentFormat(email_student)) {
                return;
            }
            if (email_student.length === 0) {
                return;
            }
            try {
                const response = await fetch(`/api/check-email-student?email_student=${encodeURIComponent(email_student)}`);
                const data = await response.json();
                if (data.available) {
                    emailStudentMessage.textContent = '✓ ' + data.message;
                    emailStudentMessage.className = 'mt-1 text-xs text-green-400';
                } else {
                    emailStudentMessage.textContent = '✗ ' + data.message;
                    emailStudentMessage.className = 'mt-1 text-xs text-red-400';
                }
            } catch (error) {
                console.error('Error checking email student:', error);
            }
        }, 500);

        // Cek ketersediaan NIM
        const checkNimAvailability = debounce(async function(nim) {
            if (!validateNIM(nim)) {
                return;
            }
            try {
                const response = await fetch(`/api/check-nim?nim=${encodeURIComponent(nim)}`);
                const data = await response.json();
                if (data.available) {
                    nimMessage.textContent = '✓ ' + data.message;
                    nimMessage.className = 'mt-1 text-xs text-green-400';
                } else {
                    nimMessage.textContent = '✗ ' + data.message;
                    nimMessage.className = 'mt-1 text-xs text-red-400';
                }
            } catch (error) {
                console.error('Error checking nim:', error);
            }
        }, 500);

        // Tambahkan event listeners
        nimInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length >= 15) {
                checkNimAvailability(this.value);
            } else {
                validateNIM(this.value);
            }
        });

        usernameInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
            if (this.value.length >= 3) {
                checkUsernameAvailability(this.value);
            } else {
                validateUsernameFormat(this.value);
            }
        });

        emailInput.addEventListener('input', function() {
            checkEmailAvailability(this.value);
        });

        emailStudentInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                checkEmailStudentAvailability(this.value);
            } else {
                validateEmailStudentFormat(this.value);
            }
        });

        // Validasi form saat submit
        form.addEventListener('submit', function(e) {
            const requiredFields = [
                'name', 'nim', 'username', 'program_studi', 'angkatan', 'nomor_telepon',
                'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'asal_sekolah_jenis', 'asal_sekolah_nama',
                'asal_kota', 'alamat_domisili', 'provinsi', 'kota', 'jalur_masuk',
                'email', 'password', 'password_confirmation'
            ];
            let hasEmptyFields = false;
            let emptyFieldNames = [];

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && (!field.value || field.value.trim() === '')) {
                    hasEmptyFields = true;
                    const label = document.querySelector(`label[for="${fieldName}"]`);
                    emptyFieldNames.push(label ? label.textContent : fieldName);
                }
            });

            if (hasEmptyFields) {
                e.preventDefault();
                alert('Semua kolom wajib diisi. Kolom yang masih kosong: ' + emptyFieldNames.join(', '));
                return;
            }
            if (!validateNIM(nimInput.value)) {
                e.preventDefault();
                alert('Format NIM tidak valid. Silakan periksa kembali.');
                return;
            }
            if (!validateUsernameFormat(usernameInput.value)) {
                e.preventDefault();
                alert('Format Username tidak valid. Silakan periksa kembali.');
                return;
            }
        });

        // Function to toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            const eyeOffIcon = document.getElementById(fieldId + '-eye-off');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Make togglePassword function globally accessible
        window.togglePassword = togglePassword;
    });
</script>
<section>
    {{-- Form ini hanya untuk mengirim email verifikasi, biarkan seperti apa adanya --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form utama untuk memperbarui profil --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Wrapper untuk konsistensi spasi --}}
        <div class="space-y-6">

            <!-- Bagian Foto Profil -->
                <label for="photo" class="font-semibold text-gray-300">Foto Profil</label>
                <div class="sm:col-span-2 flex items-center gap-x-4">
                    @if($user->photo)
                        <img src="{{ asset('profile-pictures/'.$user->photo) }}" alt="Foto Profil Saat Ini" class="h-20 w-20 rounded-full object-cover border-2 border-cyan-400 flex-shrink-0">
                    @else
                        <div class="h-20 w-20 rounded-full bg-gray-800 flex items-center justify-center border-2 border-cyan-400 flex-shrink-0">
                            <svg class="h-10 w-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex flex-col gap-2 w-full">
                        <input id="photo" name="photo" type="file" accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-500/10 file:text-teal-300 hover:file:bg-teal-500/20 transition-colors cursor-pointer"/>
                        <div id="photo-error" class="text-sm text-red-400"></div> 
                        <p class="text-xs text-gray-500 mt-1">Note: File foto jangan lebih dari 2MB, Jangan lupa SIMPAN PERUBAHAN!</p>
                        @if($user->photo)
                            <a href="{{ route('profile.crop-photo') }}" class="w-max inline-flex items-center px-3 py-1 bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 text-xs rounded-lg transition-colors">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Crop Foto
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sm:col-start-2 sm:col-span-2">
                    <x-input-error class="mt-1 text-red-400" :messages="$errors->get('photo')" />
                </div>

            <!-- Username (Hanya Baca) -->
            <div>
                <x-input-label for="username" value="Username" class="font-semibold text-gray-300" />
                <div class="relative mt-1">
                    <x-text-input id="username" type="text" class="block w-full bg-gray-900/80 border border-cyan-500/50 p-2 text-gray-500 cursor-not-allowed rounded-lg" :value="$user->username" disabled readonly />
                    <span class="absolute inset-y-0 right-3 flex items-center text-xs text-amber-400 font-mono">[Hanya Baca]</span>
                </div>
                <p class="mt-1 text-xs text-gray-500">Username tidak dapat diubah setelah registrasi.</p>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <x-input-label for="name" value="Nama Lengkap" class="font-semibold text-gray-300" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
            </div>

            <!-- NIM -->
            <div>
                <x-input-label for="nim" value="NIM" class="font-semibold text-gray-300" />
                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('nim', $user->nim)" required autocomplete="nim" />
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nim')" />
            </div>
            
            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="font-semibold text-gray-300" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('email', $user->email)" required autocomplete="email" />
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 text-sm text-red-400">
                        <p>Alamat email Anda belum terverifikasi. 
                        <button form="send-verification" class="text-gray-400 underline hover:text-amber-300 transition-colors">Kirim ulang email verifikasi.</button>
                        </p>
                    </div>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-400">Tautan verifikasi baru telah dikirim ke alamat email Anda.</p>
                    @endif
                @endif
            </div>

            <!-- Email Student -->
            <div>
                <x-input-label for="email_student" value="Email Student" class="font-semibold text-gray-300" />
                <x-text-input id="email_student" name="email_student" type="email" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('email_student', $user->email_student)" autocomplete="email" placeholder="Contoh: nama@student.ub.ac.id"/>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email_student')" />
            </div>

            <!-- Program Studi -->
            <div>
                <x-input-label for="program_studi" value="Program Studi" class="font-semibold text-gray-300" />
                <select id="program_studi" name="program_studi" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" required>
                    <option value="" disabled {{ !$user->program_studi ? 'selected' : '' }}>-- Pilih Program Studi --</option>
                    <option value="D4 Manajemen Perhotelan" {{ old('program_studi', $user->program_studi) == 'D4 Manajemen Perhotelan' ? 'selected' : '' }}>D4 Manajemen Perhotelan</option>
                    <option value="D3 Keuangan dan Perbankan" {{ old('program_studi', $user->program_studi) == 'D3 Keuangan dan Perbankan' ? 'selected' : '' }}>D3 Keuangan dan Perbankan</option>
                    <option value="D3 Administrasi Bisnis" {{ old('program_studi', $user->program_studi) == 'D3 Administrasi Bisnis' ? 'selected' : '' }}>D3 Administrasi Bisnis</option>
                    <option value="D4 Desain Grafis" {{ old('program_studi', $user->program_studi) == 'D4 Desain Grafis' ? 'selected' : '' }}>D4 Desain Grafis</option>
                    <option value="D3 Teknologi Informasi" {{ old('program_studi', $user->program_studi) == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi</option>
                </select>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('program_studi')" />
            </div>

            <!-- Angkatan -->
            <div>
                <x-input-label for="angkatan" value="Angkatan" class="font-semibold text-gray-300" />
                <select id="angkatan" name="angkatan" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition">
                    <option value="" disabled {{ !$user->angkatan ? 'selected' : '' }}>-- Pilih Angkatan --</option>
                    <option value="2023" {{ old('angkatan', $user->angkatan) == '2023' ? 'selected' : '' }}>2023</option>
                    <option value="2024" {{ old('angkatan', $user->angkatan) == '2024' ? 'selected' : '' }}>2024</option>
                    <option value="2025" {{ old('angkatan', $user->angkatan) == '2025' ? 'selected' : '' }}>2025</option>
                </select>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('angkatan')" />
            </div>

            <!-- Nomor Telepon -->
            <div>
                <x-input-label for="nomor_telepon" value="Nomor Telepon" class="font-semibold text-gray-300" />
                <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('nomor_telepon', $user->nomor_telepon)" autocomplete="tel" placeholder="Contoh: 081234567890"/>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nomor_telepon')" />
            </div>

            <!-- Data Kelahiran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="tempat_lahir" value="Tempat Lahir" class="font-semibold text-gray-300" />
                    <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('tempat_lahir', $user->tempat_lahir)" placeholder="Contoh: Malang"/>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('tempat_lahir')" />
                </div>
                <div>
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" class="font-semibold text-gray-300" />
                    <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('tanggal_lahir', $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '')"/>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('tanggal_lahir')" />
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" class="font-semibold text-gray-300" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition">
                    <option value="" disabled {{ !$user->jenis_kelamin ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('jenis_kelamin')" />
            </div>

            <!-- Data Sekolah Asal -->
            <div class="space-y-6 p-6 bg-gray-900/30 rounded-2xl border border-cyan-500/30">
                <h3 class="text-lg font-semibold text-teal-300 -mt-1">Informasi Sekolah Asal</h3>
                <div>
                    <x-input-label for="asal_sekolah_jenis" value="Jenis Sekolah" class="font-semibold text-gray-300" />
                    <select id="asal_sekolah_jenis" name="asal_sekolah_jenis" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition">
                        <option value="" disabled {{ !$user->asal_sekolah_jenis ? 'selected' : '' }}>-- Pilih Jenis Sekolah --</option>
                        <option value="SMA" {{ old('asal_sekolah_jenis', $user->asal_sekolah_jenis) == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMK" {{ old('asal_sekolah_jenis', $user->asal_sekolah_jenis) == 'SMK' ? 'selected' : '' }}>SMK</option>
                        <option value="MAN" {{ old('asal_sekolah_jenis', $user->asal_sekolah_jenis) == 'MAN' ? 'selected' : '' }}>MAN</option>
                        <option value="Lainnya" {{ old('asal_sekolah_jenis', $user->asal_sekolah_jenis) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('asal_sekolah_jenis')" />
                </div>
                <div>
                    <x-input-label for="asal_sekolah_nama" value="Nama Sekolah" class="font-semibold text-gray-300" />
                    <x-text-input id="asal_sekolah_nama" name="asal_sekolah_nama" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('asal_sekolah_nama', $user->asal_sekolah_nama)" placeholder="Contoh: SMAN 1 Malang"/>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('asal_sekolah_nama')" />
                </div>
                <div>
                    <x-input-label for="jurusan_sekolah" value="Jurusan Sekolah" class="font-semibold text-gray-300" />
                    <x-text-input id="jurusan_sekolah" name="jurusan_sekolah" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('jurusan_sekolah', $user->jurusan_sekolah)" placeholder="Contoh: IPA, IPS, Teknik Informatika"/>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('jurusan_sekolah')" />
                </div>
            </div>

            <!-- Data Lokasi -->
            <div class="space-y-6 p-6 bg-gray-900/30 rounded-2xl border border-cyan-500/30">
                <h3 class="text-lg font-semibold text-teal-300 -mt-1">Informasi Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="asal_kota" value="Asal Kota" class="font-semibold text-gray-300" />
                        <x-text-input id="asal_kota" name="asal_kota" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('asal_kota', $user->asal_kota)" placeholder="Contoh: Malang"/>
                        <x-input-error class="mt-2 text-red-400" :messages="$errors->get('asal_kota')" />
                    </div>
                    <div>
                        <x-input-label for="provinsi" value="Provinsi" class="font-semibold text-gray-300" />
                        <x-text-input id="provinsi" name="provinsi" type="text" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" :value="old('provinsi', $user->provinsi)" placeholder="Contoh: Jawa Timur"/>
                        <x-input-error class="mt-2 text-red-400" :messages="$errors->get('provinsi')" />
                    </div>
                </div>
                <div>
                    <x-input-label for="kota" value="Kota / Kabupaten Domisili" class="font-semibold text-gray-300" />
                    <select id="kota" name="kota" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition">
                        <option value="" disabled {{ !$user->kota ? 'selected' : '' }}>-- Pilih Kota / Kabupaten --</option>
                        <option value="Kota" {{ old('kota', $user->kota) == 'Kota' ? 'selected' : '' }}>Kota</option>
                        <option value="Kabupaten" {{ old('kota', $user->kota) == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                    </select>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('kota')" />
                </div>
            </div>

            <!-- Jalur Masuk -->
            <div>
                <x-input-label for="jalur_masuk" value="Jalur Masuk" class="font-semibold text-gray-300" />
                <select id="jalur_masuk" name="jalur_masuk" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition">
                    <option value="" disabled {{ !$user->jalur_masuk ? 'selected' : '' }}>-- Pilih Jalur Masuk --</option>
                    <option value="SNBP" {{ old('jalur_masuk', $user->jalur_masuk) == 'SNBP' ? 'selected' : '' }}>SNBP (Seleksi Nasional Berdasarkan Prestasi)</option>
                    <option value="SNBT" {{ old('jalur_masuk', $user->jalur_masuk) == 'SNBT' ? 'selected' : '' }}>SNBT (Seleksi Nasional Berdasarkan Tes)</option>
                    <option value="Mandiri UB" {{ old('jalur_masuk', $user->jalur_masuk) == 'Mandiri UB' ? 'selected' : '' }}>Mandiri UB</option>
                    <option value="Mandiri Vokasi" {{ old('jalur_masuk', $user->jalur_masuk) == 'Mandiri Vokasi' ? 'selected' : '' }}>Mandiri Vokasi</option>
                </select>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('jalur_masuk')" />
            </div>

            <!-- Bio Singkat -->
            <div>
                <x-input-label for="deskripsi" value="Bio Singkat" class="font-semibold text-gray-300" />
                <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full bg-gray-800/50 border border-cyan-500/50 p-2 text-gray-200 rounded-lg focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400/50 transition" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('deskripsi', $user->deskripsi) }}</textarea>
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('deskripsi')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button id="submit-button" type="submit" class="inline-flex items-center justify-center px-6 py-2 bg-teal-500 hover:bg-teal-600 text-black font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-teal-500/20 font-display focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-400">
                Simpan Perubahan
            </button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-mono text-green-400"
                >// Profil berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const submitButton = document.getElementById('submit-button');
        const errorDiv = document.getElementById('photo-error');
        
        const maxSizeInMB = 2; // Batas ukuran file 2 MB
        const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            // Selalu reset kondisi setiap kali user memilih file baru
            errorDiv.textContent = '';
            submitButton.disabled = false;
            submitButton.style.opacity = '1';
            submitButton.style.cursor = 'pointer';

            if (file) {
                if (file.size > maxSizeInBytes) {
                    // Jika file terlalu besar
                    errorDiv.textContent = `Ukuran file tidak boleh lebih dari ${maxSizeInMB}MB.`;
                    submitButton.disabled = true; // Matikan tombol
                    submitButton.style.opacity = '0.5'; // Buat tombol terlihat redup
                    submitButton.style.cursor = 'not-allowed';

                    // Kosongkan value input agar file besar tidak terkirim
                    photoInput.value = '';
                }
            }
        });
    });
</script>
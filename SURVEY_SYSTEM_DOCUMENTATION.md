# Dokumentasi Sistem Survey YUWARAJA XVII

## Overview

Sistem survey telah berhasil ditambahkan ke aplikasi YUWARAJA XVII. Sistem ini memungkinkan admin untuk membuat survey dengan berbagai jenis pertanyaan dan melihat hasil survey dari responden.

## Struktur Database

### 1. Tabel `master_survey`
Tabel utama yang menyimpan informasi survey.

| Kolom | Tipe | Deskripsi |
|-------|------|----------|
| `id_master_survey` | BIGINT (PK) | ID unik survey |
| `judul_survey` | VARCHAR(255) | Judul survey |
| `deskripsi_survey` | TEXT | Deskripsi survey (opsional) |
| `status` | ENUM('aktif','nonaktif') | Status survey |
| `tanggal_mulai` | DATETIME | Tanggal mulai survey |
| `tanggal_selesai` | DATETIME | Tanggal selesai survey |
| `created_by` | BIGINT (FK) | ID admin pembuat survey |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 2. Tabel `detil_survey`
Tabel yang menyimpan pertanyaan-pertanyaan dalam survey.

| Kolom | Tipe | Deskripsi |
|-------|------|----------|
| `id_detil_survey` | BIGINT (PK) | ID unik pertanyaan |
| `id_master_survey` | BIGINT (FK) | ID survey |
| `pertanyaan` | TEXT | Teks pertanyaan |
| `tipe_pertanyaan` | ENUM | Jenis pertanyaan (text, textarea, radio, checkbox, select) |
| `opsi_jawaban` | JSON | Opsi jawaban untuk pertanyaan pilihan |
| `wajib_diisi` | BOOLEAN | Apakah pertanyaan wajib diisi |
| `urutan` | INTEGER | Urutan pertanyaan |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 3. Tabel `hasil_survey`
Tabel yang menyimpan jawaban responden.

| Kolom | Tipe | Deskripsi |
|-------|------|----------|
| `id_hasil_survey` | BIGINT (PK) | ID unik jawaban |
| `id_master_survey` | BIGINT (FK) | ID survey |
| `id_detil_survey` | BIGINT (FK) | ID pertanyaan |
| `user_id` | BIGINT (FK) | ID responden |
| `jawaban` | TEXT | Jawaban responden |
| `created_at` | TIMESTAMP | Waktu dijawab |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

## Relasi Database

```
master_survey (1) -----> (N) detil_survey
master_survey (1) -----> (N) hasil_survey
detil_survey (1) ------> (N) hasil_survey
users (1) -------------> (N) hasil_survey
users (1) -------------> (N) master_survey (sebagai creator)
```

## Model Eloquent

### 1. MasterSurvey Model
- **File**: `app/Models/MasterSurvey.php`
- **Relasi**:
  - `detilSurvey()` - HasMany ke DetilSurvey
  - `hasilSurvey()` - HasMany ke HasilSurvey
  - `creator()` - BelongsTo ke User
- **Scope**:
  - `aktif()` - Filter survey aktif
  - `berjalan()` - Filter survey yang sedang berjalan
- **Accessor**:
  - `total_responden` - Menghitung jumlah responden

### 2. DetilSurvey Model
- **File**: `app/Models/DetilSurvey.php`
- **Relasi**:
  - `masterSurvey()` - BelongsTo ke MasterSurvey
  - `hasilSurvey()` - HasMany ke HasilSurvey
- **Method**:
  - `hasOpsiJawaban()` - Cek apakah pertanyaan memiliki opsi
  - `getStatistikJawaban()` - Mendapatkan statistik jawaban

### 3. HasilSurvey Model
- **File**: `app/Models/HasilSurvey.php`
- **Relasi**:
  - `masterSurvey()` - BelongsTo ke MasterSurvey
  - `detilSurvey()` - BelongsTo ke DetilSurvey
  - `user()` - BelongsTo ke User
- **Method**:
  - `simpanJawaban()` - Static method untuk menyimpan jawaban
  - `isValidJawaban()` - Validasi jawaban

## Controller

### SurveyController
- **File**: `app/Http/Controllers/SurveyController.php`
- **Method**:
  - `index()` - Daftar survey (admin)
  - `create()` - Form buat survey baru
  - `store()` - Simpan survey baru
  - `show()` - Detail survey dan statistik
  - `edit()` - Form edit survey
  - `update()` - Update survey
  - `destroy()` - Hapus survey
  - `showForUser()` - Tampilkan survey untuk diisi user
  - `storeAnswers()` - Simpan jawaban user
  - `exportResults()` - Export hasil survey

## Jenis Pertanyaan yang Didukung

### 1. Text Input (`text`)
- Input teks satu baris
- Cocok untuk nama, email, dll

### 2. Textarea (`textarea`)
- Input teks multi-baris
- Cocok untuk saran, komentar, dll

### 3. Radio Button (`radio`)
- Pilihan tunggal dari beberapa opsi
- Hanya bisa memilih satu jawaban

### 4. Checkbox (`checkbox`)
- Pilihan ganda dari beberapa opsi
- Bisa memilih lebih dari satu jawaban
- Jawaban disimpan dalam format JSON array

### 5. Select Dropdown (`select`)
- Pilihan tunggal dalam bentuk dropdown
- Hemat ruang untuk banyak opsi

## Format Opsi Jawaban

Untuk pertanyaan dengan opsi (radio, checkbox, select), format JSON:

```json
[
  {"value": "1", "label": "Sangat Baik"},
  {"value": "2", "label": "Baik"},
  {"value": "3", "label": "Cukup"}
]
```

## Fitur Sistem

### 1. Manajemen Survey (Admin)
- ✅ Membuat survey baru dengan multiple pertanyaan
- ✅ Edit informasi survey (judul, deskripsi, tanggal)
- ✅ Mengatur status survey (aktif/nonaktif)
- ✅ Menghapus survey
- ✅ Melihat statistik dan hasil survey

### 2. Pengisian Survey (User)
- ✅ Melihat daftar survey yang tersedia
- ✅ Mengisi survey dengan validasi
- ✅ Mencegah pengisian ganda
- ✅ Validasi pertanyaan wajib

### 3. Laporan dan Statistik
- ✅ Statistik jawaban per pertanyaan
- ✅ Jumlah total responden
- ✅ Export hasil survey
- ✅ Grafik untuk pertanyaan pilihan ganda

## Data Seeder

### SurveySeeder
- **File**: `database/seeders/SurveySeeder.php`
- **Data yang dibuat**:
  - 1 survey contoh: "Survey Kepuasan Mahasiswa PKKMB 2025"
  - 5 pertanyaan dengan berbagai jenis
  - Jawaban contoh dari 2 user (Wawa dan Rafif)

### Contoh Survey yang Dibuat
1. **Pertanyaan Radio**: Penilaian keseluruhan (1-5)
2. **Pertanyaan Checkbox**: Kegiatan yang bermanfaat (multiple choice)
3. **Pertanyaan Select**: Kepuasan fasilitas
4. **Pertanyaan Textarea**: Saran perbaikan
5. **Pertanyaan Text**: Nama lengkap

## Keamanan dan Validasi

### 1. Validasi Input
- Validasi tipe data sesuai field
- Validasi pertanyaan wajib
- Validasi opsi jawaban untuk pertanyaan pilihan
- Validasi tanggal (tanggal selesai > tanggal mulai)

### 2. Kontrol Akses
- Hanya admin yang bisa membuat/edit survey
- User hanya bisa mengisi survey yang aktif dan berjalan
- Mencegah pengisian survey ganda per user

### 3. Integritas Data
- Foreign key constraints
- Unique constraint untuk mencegah duplikasi jawaban
- Cascade delete untuk menjaga konsistensi

## Instalasi dan Setup

### 1. Migrasi Database
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=SurveySeeder
```

### 3. Tambahkan Route (jika diperlukan)
Route untuk survey perlu ditambahkan ke `routes/web.php`

## Status Implementasi

✅ **Selesai**:
- Database schema dan migrasi
- Model Eloquent dengan relasi
- Controller dengan CRUD operations
- Seeder dengan data contoh
- Validasi dan keamanan dasar

⏳ **Belum Implementasi**:
- View/UI untuk admin dan user
- Route definitions
- Middleware untuk authorization
- Export ke Excel/PDF
- Dashboard analytics

## Langkah Selanjutnya

1. **Buat Views**: Implementasi antarmuka untuk admin dan user
2. **Tambah Routes**: Definisikan routing untuk semua endpoint
3. **Middleware**: Tambahkan middleware untuk kontrol akses
4. **Testing**: Buat unit test dan feature test
5. **Documentation**: Lengkapi dokumentasi API

---

**Catatan**: Sistem survey telah siap digunakan dari sisi backend. Tinggal implementasi frontend (views) dan routing untuk melengkapi fungsionalitas.

**Dibuat pada**: $(Get-Date)
**Versi**: 1.0.0
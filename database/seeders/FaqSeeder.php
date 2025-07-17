<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu PKKMB Yuwaraja?',
                'answer' => 'PKKMB Yuwaraja adalah serangkaian kegiatan orientasi untuk memperkenalkan dunia perkuliahan, budaya, dan nilai-nilai inovasi di Fakultas Vokasi Universitas Brawijaya.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana Cara Mendapatkan KTM?',
                'answer' => 'Informasi pengambilan KTM akan diumumkan secara resmi melalui SIAM dan website ini. Pastikan untuk selalu memeriksa pembaruan.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'Di mana saya mendapatkan info tentang UKM?',
                'answer' => 'Akan ada "Expo UKM" yang jadwalnya akan diumumkan di bagian Informasi. Kamu bisa bertanya, mencoba, dan mendaftar langsung untuk mengasah skill di luar akademik.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Bagaimana cara mengakses dashboard mahasiswa?',
                'answer' => 'Setelah login dengan akun yang telah diberikan, Anda akan diarahkan ke dashboard mahasiswa dimana Anda dapat melihat tugas, pengumuman, dan jadwal acara.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'Apa yang harus dilakukan jika lupa password?',
                'answer' => 'Silakan hubungi panitia PKKMB atau admin sistem untuk reset password. Pastikan Anda menyertakan NIM dan nama lengkap saat menghubungi.',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

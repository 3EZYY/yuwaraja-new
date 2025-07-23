<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Insert master survey
        $masterSurveyId = DB::table('master_survey')->insertGetId([
            'judul_survey' => 'Survey Kepuasan Mahasiswa PKKMB 2025',
            'deskripsi_survey' => 'Survey untuk mengetahui tingkat kepuasan mahasiswa terhadap kegiatan PKKMB 2025',
            'status' => 'aktif',
            'tanggal_mulai' => Carbon::now(),
            'tanggal_selesai' => Carbon::now()->addDays(30),
            'created_by' => 1, // Admin
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert detail survey (pertanyaan-pertanyaan)
        $detailSurvey = [
            [
                'id_master_survey' => $masterSurveyId,
                'pertanyaan' => 'Bagaimana penilaian Anda terhadap kegiatan PKKMB secara keseluruhan?',
                'tipe_pertanyaan' => 'radio',
                'opsi_jawaban' => json_encode([
                    ['value' => '5', 'label' => 'Sangat Baik'],
                    ['value' => '4', 'label' => 'Baik'],
                    ['value' => '3', 'label' => 'Cukup'],
                    ['value' => '2', 'label' => 'Kurang'],
                    ['value' => '1', 'label' => 'Sangat Kurang']
                ]),
                'wajib_diisi' => true,
                'urutan' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'pertanyaan' => 'Kegiatan mana saja yang menurut Anda paling bermanfaat? (Pilih semua yang sesuai)',
                'tipe_pertanyaan' => 'checkbox',
                'opsi_jawaban' => json_encode([
                    ['value' => 'orientasi', 'label' => 'Orientasi Kampus'],
                    ['value' => 'seminar', 'label' => 'Seminar Motivasi'],
                    ['value' => 'games', 'label' => 'Games dan Ice Breaking'],
                    ['value' => 'diskusi', 'label' => 'Diskusi Kelompok'],
                    ['value' => 'presentasi', 'label' => 'Presentasi Kelompok']
                ]),
                'wajib_diisi' => true,
                'urutan' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'pertanyaan' => 'Seberapa puas Anda dengan fasilitas yang disediakan?',
                'tipe_pertanyaan' => 'select',
                'opsi_jawaban' => json_encode([
                    ['value' => 'sangat_puas', 'label' => 'Sangat Puas'],
                    ['value' => 'puas', 'label' => 'Puas'],
                    ['value' => 'cukup_puas', 'label' => 'Cukup Puas'],
                    ['value' => 'kurang_puas', 'label' => 'Kurang Puas'],
                    ['value' => 'tidak_puas', 'label' => 'Tidak Puas']
                ]),
                'wajib_diisi' => true,
                'urutan' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'pertanyaan' => 'Apa saran Anda untuk perbaikan kegiatan PKKMB di masa mendatang?',
                'tipe_pertanyaan' => 'textarea',
                'opsi_jawaban' => null,
                'wajib_diisi' => false,
                'urutan' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'pertanyaan' => 'Nama lengkap Anda',
                'tipe_pertanyaan' => 'text',
                'opsi_jawaban' => null,
                'wajib_diisi' => true,
                'urutan' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('detil_survey')->insert($detailSurvey);

        // Insert contoh hasil survey (jawaban dari beberapa user)
        $detailIds = DB::table('detil_survey')
            ->where('id_master_survey', $masterSurveyId)
            ->pluck('id_detil_survey', 'urutan');

        // Jawaban dari user Wawa (id: 3)
        $hasilSurvey = [
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[1], // Pertanyaan 1
                'user_id' => 3,
                'jawaban' => '4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[2], // Pertanyaan 2
                'user_id' => 3,
                'jawaban' => json_encode(['orientasi', 'seminar', 'games']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[3], // Pertanyaan 3
                'user_id' => 3,
                'jawaban' => 'puas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[4], // Pertanyaan 4
                'user_id' => 3,
                'jawaban' => 'Kegiatan sudah bagus, mungkin bisa ditambah sesi networking dengan alumni.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[5], // Pertanyaan 5
                'user_id' => 3,
                'jawaban' => 'Wawa Ponorogo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Jawaban dari user Rafif (id: 4)
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[1], // Pertanyaan 1
                'user_id' => 4,
                'jawaban' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[2], // Pertanyaan 2
                'user_id' => 4,
                'jawaban' => json_encode(['seminar', 'diskusi', 'presentasi']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[3], // Pertanyaan 3
                'user_id' => 4,
                'jawaban' => 'sangat_puas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[4], // Pertanyaan 4
                'user_id' => 4,
                'jawaban' => 'Semua kegiatan sangat bermanfaat. Terima kasih!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_master_survey' => $masterSurveyId,
                'id_detil_survey' => $detailIds[5], // Pertanyaan 5
                'user_id' => 4,
                'jawaban' => 'Rafif Nabiha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('hasil_survey')->insert($hasilSurvey);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
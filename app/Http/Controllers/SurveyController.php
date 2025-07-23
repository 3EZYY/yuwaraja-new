<?php

namespace App\Http\Controllers;

use App\Models\MasterSurvey;
use App\Models\DetilSurvey;
use App\Models\HasilSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SurveyController extends Controller
{
    /**
     * Display a listing of surveys
     */
    public function index()
    {
        $surveys = MasterSurvey::with(['creator', 'detilSurvey'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new survey
     */
    public function create()
    {
        return view('admin.survey.create');
    }

    /**
     * Store a newly created survey
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_survey' => 'required|string|max:255',
            'deskripsi_survey' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'pertanyaan' => 'required|array|min:1',
            'pertanyaan.*.text' => 'required|string',
            'pertanyaan.*.tipe' => 'required|in:text,textarea,radio,checkbox,select',
            'pertanyaan.*.wajib' => 'boolean',
            'pertanyaan.*.opsi' => 'nullable|array'
        ]);

        DB::beginTransaction();
        try {
            // Create master survey
            $masterSurvey = MasterSurvey::create([
                'judul_survey' => $request->judul_survey,
                'deskripsi_survey' => $request->deskripsi_survey,
                'status' => 'aktif',
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'created_by' => Auth::id()
            ]);

            // Create detail survey (questions)
            foreach ($request->pertanyaan as $index => $pertanyaan) {
                $opsiJawaban = null;
                if (in_array($pertanyaan['tipe'], ['radio', 'checkbox', 'select']) && !empty($pertanyaan['opsi'])) {
                    $opsiJawaban = collect($pertanyaan['opsi'])->map(function ($opsi, $key) {
                        return [
                            'value' => $key,
                            'label' => $opsi
                        ];
                    })->values()->toArray();
                }

                DetilSurvey::create([
                    'id_master_survey' => $masterSurvey->id_master_survey,
                    'pertanyaan' => $pertanyaan['text'],
                    'tipe_pertanyaan' => $pertanyaan['tipe'],
                    'opsi_jawaban' => $opsiJawaban,
                    'wajib_diisi' => $pertanyaan['wajib'] ?? false,
                    'urutan' => $index + 1
                ]);
            }

            DB::commit();
            return redirect()->route('admin.survey.index')
                ->with('success', 'Survey berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal membuat survey: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified survey
     */
    public function show(MasterSurvey $survey)
    {
        $survey->load(['detilSurvey' => function ($query) {
            $query->orderBy('urutan');
        }, 'creator']);

        $totalResponden = $survey->total_responden;
        $statistik = [];

        foreach ($survey->detilSurvey as $pertanyaan) {
            $statistik[$pertanyaan->id_detil_survey] = $pertanyaan->getStatistikJawaban();
        }

        return view('admin.survey.show', compact('survey', 'totalResponden', 'statistik'));
    }

    /**
     * Show the form for editing the specified survey
     */
    public function edit(MasterSurvey $survey)
    {
        $survey->load(['detilSurvey' => function ($query) {
            $query->orderBy('urutan');
        }]);

        return view('admin.survey.edit', compact('survey'));
    }

    /**
     * Update the specified survey
     */
    public function update(Request $request, MasterSurvey $survey)
    {
        $request->validate([
            'judul_survey' => 'required|string|max:255',
            'deskripsi_survey' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $survey->update([
            'judul_survey' => $request->judul_survey,
            'deskripsi_survey' => $request->deskripsi_survey,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status
        ]);

        return redirect()->route('admin.survey.index')
            ->with('success', 'Survey berhasil diperbarui!');
    }

    /**
     * Remove the specified survey
     */
    public function destroy(MasterSurvey $survey)
    {
        try {
            $survey->delete();
            return redirect()->route('admin.survey.index')
                ->with('success', 'Survey berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus survey: ' . $e->getMessage()]);
        }
    }

    /**
     * Show survey for users to fill
     */
    public function showForUser(MasterSurvey $survey)
    {
        // Check if survey is active and running
        if (!$survey->isBerjalan()) {
            return redirect()->back()->withErrors(['error' => 'Survey tidak tersedia atau sudah berakhir.']);
        }

        $survey->load(['detilSurvey' => function ($query) {
            $query->orderBy('urutan');
        }]);

        // Check if user already filled this survey
        $sudahMengisi = HasilSurvey::where('id_master_survey', $survey->id_master_survey)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahMengisi) {
            return redirect()->back()->with('info', 'Anda sudah mengisi survey ini.');
        }

        return view('survey.fill', compact('survey'));
    }

    /**
     * Store user's survey answers
     */
    public function storeAnswers(Request $request, MasterSurvey $survey)
    {
        // Check if survey is active and running
        if (!$survey->isBerjalan()) {
            return redirect()->back()->withErrors(['error' => 'Survey tidak tersedia atau sudah berakhir.']);
        }

        // Check if user already filled this survey
        $sudahMengisi = HasilSurvey::where('id_master_survey', $survey->id_master_survey)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahMengisi) {
            return redirect()->back()->with('info', 'Anda sudah mengisi survey ini.');
        }

        $survey->load('detilSurvey');

        // Validate required questions
        $rules = [];
        foreach ($survey->detilSurvey as $pertanyaan) {
            if ($pertanyaan->wajib_diisi) {
                $rules['jawaban.' . $pertanyaan->id_detil_survey] = 'required';
            }
        }

        $request->validate($rules, [
            'required' => 'Pertanyaan ini wajib diisi.'
        ]);

        // Save answers
        $berhasil = HasilSurvey::simpanJawaban(
            $survey->id_master_survey,
            Auth::id(),
            $request->jawaban ?? []
        );

        if ($berhasil) {
            return redirect()->route('dashboard')
                ->with('success', 'Terima kasih! Jawaban Anda telah tersimpan.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan jawaban. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Export survey results
     */
    public function exportResults(MasterSurvey $survey)
    {
        $survey->load([
            'detilSurvey' => function ($query) {
                $query->orderBy('urutan');
            },
            'hasilSurvey.user',
            'hasilSurvey.detilSurvey'
        ]);

        $results = [];
        $responden = $survey->hasilSurvey->groupBy('user_id');

        foreach ($responden as $userId => $jawaban) {
            $user = $jawaban->first()->user;
            $row = [
                'Nama' => $user->name,
                'NIM' => $user->nim,
                'Email' => $user->email,
                'Tanggal Mengisi' => $jawaban->first()->created_at->format('d/m/Y H:i')
            ];

            foreach ($survey->detilSurvey as $pertanyaan) {
                $jawabanUser = $jawaban->where('id_detil_survey', $pertanyaan->id_detil_survey)->first();
                $row[$pertanyaan->pertanyaan] = $jawabanUser ? $jawabanUser->formatted_jawaban : '-';
            }

            $results[] = $row;
        }

        return response()->json([
            'survey' => $survey->judul_survey,
            'total_responden' => count($results),
            'data' => $results
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DataDiri;
use App\Models\Question;
use App\Models\Response;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    // ===============================
    // 🌍 HALAMAN UTAMA PUBLIK
    // ===============================
    public function halamanUtama()
    {
        // 👉 Publik selalu pakai default (bukan dari DB)
        $survey = (object) [
            'judul'       => 'Survey Kepuasan Masyarakat',
            'deskripsi'   => 'Selamat datang di halaman survey publik. Silakan isi data diri Anda untuk melanjutkan.',
        ];

        $counts = [
            'tidak_memuaskan'    => Response::where('jawaban', 1)->count(),
            'kurang_memuaskan'   => Response::where('jawaban', 2)->count(),
            'memuaskan'          => Response::where('jawaban', 3)->count(),
            'sangat_memuaskan'   => Response::where('jawaban', 4)->count(),
        ];

        return view('surveys.halaman-utama', compact('survey', 'counts'));
    }

    // ===============================
    // 🧑‍💼 HALAMAN UTAMA MULTI ADMIN
    // ===============================
    public function halamanUtamaMultiAdmin(User $user)
    {
        $survey = Survey::where('user_id', $user->id)->where('active', true)->first();

        $counts = [
            'tidak_memuaskan'    => Response::whereHas('question', fn($q) => $q->where('user_id', $user->id))->where('jawaban', 1)->count(),
            'kurang_memuaskan'   => Response::whereHas('question', fn($q) => $q->where('user_id', $user->id))->where('jawaban', 2)->count(),
            'memuaskan'          => Response::whereHas('question', fn($q) => $q->where('user_id', $user->id))->where('jawaban', 3)->count(),
            'sangat_memuaskan'   => Response::whereHas('question', fn($q) => $q->where('user_id', $user->id))->where('jawaban', 4)->count(),
        ];

        return view('surveys.halaman-utama', compact('survey', 'counts', 'user'));
    }

    // ===============================
    // 🗂️ INDEX SURVEY PUBLIK
    // ===============================
    public function index()
    {
        $category = Category::where('aktif', 1)->with('questions')->first();
        return view('survey.index', compact('category'));
    }

    // ===============================
    // 🧾 FORM DATA DIRI PUBLIK
    // ===============================
    public function formDataDiri()
    {
        $data = session('data_diri_id') ? DataDiri::find(session('data_diri_id')) : null;
        return view('surveys.data-diri', compact('data'));
    }

    // ===============================
    // 💾 SIMPAN DATA DIRI PUBLIK
    // ===============================
    public function simpanDataDiri(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required|string',
            'umur'           => 'required|integer',
        ]);

        $dataDiri = DataDiri::create($validated);
        session(['data_diri_id' => $dataDiri->id]);
        $request->session()->forget('_old_input');

        return redirect()->route('kuesioner')->with('success', 'Data diri berhasil disimpan');
    }

    // ===============================
    // 📝 FORM KUESIONER PUBLIK
    // ===============================
    public function formKuesioner()
    {
        if (!session('data_diri_id')) {
            return redirect()->route('data.diri')->with('warning', 'Isi Data Diri dulu ya.');
        }

        $category = Category::where('aktif', 1)->with('questions')->first();

        if (!$category) {
            return redirect()->route('data.diri')->with('error', 'Belum ada kategori aktif untuk survey.');
        }

        $questions = $category->questions()->orderBy('id')->get();
        $jawabanLama = Response::where('data_diri_id', session('data_diri_id'))->pluck('jawaban', 'question_id');

        return view('surveys.kuesioner', compact('category', 'questions', 'jawabanLama'));
    }

    // ===============================
    // 💾 SIMPAN KUESIONER PUBLIK
    // ===============================
    public function simpanKuesioner(Request $request)
    {
        $request->validate([
            'jawaban'   => 'required|array',
            'jawaban.*' => 'required|integer|min:1|max:4',
        ]);

        if (!session('data_diri_id')) {
            return redirect()->route('data.diri')->with('warning', 'Isi Data Diri dulu ya.');
        }

        foreach ($request->jawaban as $question_id => $nilai) {
            $question = Question::find($question_id);

            Response::updateOrCreate(
                [
                    'data_diri_id' => session('data_diri_id'),
                    'question_id'  => $question_id,
                ],
                [
                    'jawaban'     => $nilai,
                    'category_id' => $question?->category_id,
                    'user_id'     => $question?->user_id,
                ]
            );
        }

        return redirect()->route('halaman.utama')->with('success', 'Terima kasih! Kuesioner berhasil dikirim.');
    }

    // ======================================================
    // 🎯 MULTI ADMIN: DATA DIRI & KUESIONER PER ADMIN
    // ======================================================
    public function formDataDiriMulti(User $user)
    {
        $data = session('data_diri_id') ? DataDiri::find(session('data_diri_id')) : null;

        // 🟩 Ambil survey aktif untuk pewarnaan
        $activeSurvey = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->first();

        return view('surveys.data-diri', compact('data', 'user', 'activeSurvey'));
    }

    public function simpanDataDiriMulti(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required|string',
            'umur'           => 'required|integer',
        ]);

        $dataDiri = DataDiri::create([
            'nama_lengkap'   => $validated['nama_lengkap'],
            'jenis_kelamin'  => $validated['jenis_kelamin'],
            'umur'           => $validated['umur'],
            'user_id'        => $user->id,
        ]);

        session(['data_diri_id' => $dataDiri->id]);
        $request->session()->forget('_old_input');

        return redirect()
            ->route('kuesioner.multi', ['user' => $user->id])
            ->with('success', 'Data diri berhasil disimpan.');
    }

    public function formKuesionerMulti(User $user)
    {
        if (!session('data_diri_id')) {
            return redirect()->route('data.diri.multi', $user->id)->with('warning', 'Isi Data Diri dulu ya.');
        }

        $categories = Category::where('user_id', $user->id)->where('aktif', true)->pluck('id');
        $questions  = Question::whereIn('category_id', $categories)->orderBy('id')->get();
        $jawabanLama = Response::where('data_diri_id', session('data_diri_id'))->pluck('jawaban', 'question_id');

        // 🟩 Ambil warna dari survey aktif juga untuk halaman kuesioner
        $activeSurvey = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->first();

        return view('surveys.kuesioner', compact('user', 'questions', 'jawabanLama', 'activeSurvey'));
    }

    public function simpanKuesionerMulti(Request $request, User $user)
    {
        $request->validate([
            'jawaban'   => 'required|array',
            'jawaban.*' => 'required|integer|min:1|max:4',
        ]);

        if (!session('data_diri_id')) {
            return redirect()->route('data.diri.multi', $user->id)->with('warning', 'Isi Data Diri dulu ya.');
        }

        foreach ($request->jawaban as $question_id => $nilai) {
            $question = Question::find($question_id);

            Response::updateOrCreate(
                [
                    'data_diri_id' => session('data_diri_id'),
                    'question_id'  => $question_id,
                ],
                [
                    'jawaban'     => $nilai,
                    'category_id' => $question?->category_id,
                    'user_id'     => $user->id,
                ]
            );
        }

        return redirect()->route('halaman.utama.multi', $user->id)->with('success', 'Terima kasih! Kuesioner berhasil dikirim.');
    }
}

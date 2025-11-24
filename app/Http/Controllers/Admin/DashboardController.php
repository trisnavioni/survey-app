<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    /**
     * 🔹 Dashboard umum
     */
    public function index()
    {
        $user = auth()->user();

        // === STATUS SETTING & SURVEY ===
        $activeSurvey = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->first();

        $hasSetting = Survey::where('user_id', $user->id)->exists();
        $settingActive = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->exists();

        // === STATUS KUESIONER ===
        $totalCategories = Category::where('user_id', $user->id)->count();
        $totalQuestions = Question::whereIn(
            'category_id',
            Category::where('user_id', $user->id)->pluck('id')
        )->count();

        $hasCategories = $totalCategories > 0;
        $hasQuestions = $totalQuestions > 0;

        // === CEK kategori aktif ===
        $hasActiveCategories = Category::where('user_id', $user->id)
            ->where('aktif', true)
            ->exists();

        // === CEK pertanyaan aktif ===
        $questionsActive = Question::whereIn(
            'category_id',
            Category::where('user_id', $user->id)->pluck('id')
        )
        ->where('aktif', true)
        ->exists();

        // === kategori aktif yang punya pertanyaan aktif ===
        $hasActiveQuestions = Category::where('user_id', $user->id)
            ->where('aktif', true)
            ->whereHas('questions', function ($q) {
                $q->where('aktif', true);
            })
            ->exists();

        // === QR diberikan jika survei aktif + kategori aktif + pertanyaan aktif ===
        $surveyLink = null;
        $qrCode = null;
        $hasActiveSurvey = false;

        if ($activeSurvey && $hasActiveQuestions) {
            $hasActiveSurvey = true;
            $surveyLink = route('survey.form', ['admin' => $user->id]);
            $qrCode = QrCode::size(200)->generate($surveyLink);
        }

        // === TOTAL RESPONDEN ===
        $totalResponses = Response::whereIn(
            'question_id',
            Question::whereIn(
                'category_id',
                Category::where('user_id', $user->id)->pluck('id')
            )->pluck('id')
        )->count();

        // === KATEGORI AKTIF ===
        $categories = Category::with(['questions.responses'])
            ->where('user_id', $user->id)
            ->where('aktif', true)
            ->get();

        // === DATA GRAFIK ===
        $chartData = [];
        foreach ($categories as $category) {
            foreach ($category->questions as $qIndex => $question) {
                $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0];

                foreach ($question->responses as $response) {
                    if (isset($counts[$response->jawaban])) {
                        $counts[$response->jawaban]++;
                    }
                }

                $total = array_sum($counts);
                $percentages = $total > 0
                    ? array_map(fn ($c) => round(($c / $total) * 100, 2), $counts)
                    : [0, 0, 0, 0];

                $chartData[] = [
                    'id'     => "chart_{$category->id}_{$qIndex}",
                    'counts' => array_values($percentages),
                ];
            }
        }

        return view('surveys.admin-dashboard', compact(
            'user',
            'totalCategories',
            'totalQuestions',
            'totalResponses',
            'categories',
            'chartData',
            'surveyLink',
            'qrCode',
            'activeSurvey',
            'hasActiveSurvey',

            // === NOTIFIKASI ===
            'hasSetting',
            'settingActive',
            'hasCategories',
            'hasQuestions',
            'hasActiveCategories',
            'hasActiveQuestions',
            'questionsActive'
        ));
    }

    /**
     * 🔹 Dashboard berdasarkan slug admin
     */
    public function personal($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        if (auth()->id() !== $user->id) {
            abort(403, 'Kamu tidak punya izin mengakses halaman ini.');
        }

        // === STATUS SETTING & SURVEY ===
        $activeSurvey = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->first();

        $hasSetting = Survey::where('user_id', $user->id)->exists();
        $settingActive = Survey::where('user_id', $user->id)
            ->where('active', true)
            ->exists();

        // === STATUS KUESIONER ===
        $totalCategories = Category::where('user_id', $user->id)->count();
        $totalQuestions = Question::whereIn(
            'category_id',
            Category::where('user_id', $user->id)->pluck('id')
        )->count();

        $hasCategories = $totalCategories > 0;
        $hasQuestions = $totalQuestions > 0;

        // === CEK kategori aktif ===
        $hasActiveCategories = Category::where('user_id', $user->id)
            ->where('aktif', true)
            ->exists();

        // === CEK pertanyaan aktif ===
        $questionsActive = Question::whereIn(
            'category_id',
            Category::where('user_id', $user->id)->pluck('id')
        )
        ->where('aktif', true)
        ->exists();

        // === kategori aktif yang punya pertanyaan aktif ===
        $hasActiveQuestions = Category::where('user_id', $user->id)
            ->where('aktif', true)
            ->whereHas('questions', function ($q) {
                $q->where('aktif', true);
            })
            ->exists();

        // === QR ===
        $surveyLink = null;
        $qrCode = null;
        $hasActiveSurvey = false;

        if ($activeSurvey && $hasActiveQuestions) {
            $hasActiveSurvey = true;
            $surveyLink = route('survey.form', ['admin' => $user->id]);
            $qrCode = QrCode::size(200)->generate($surveyLink);
        }

        // === TOTAL RESPONDEN ===
        $totalResponses = Response::whereIn(
            'question_id',
            Question::whereIn(
                'category_id',
                Category::where('user_id', $user->id)->pluck('id')
            )->pluck('id')
        )->count();

        // === KATEGORI AKTIF ===
        $categories = Category::where('user_id', $user->id)
            ->where('aktif', true)
            ->with('questions.responses')
            ->get();

        // === DATA GRAFIK ===
        $chartData = [];
        foreach ($categories as $category) {
            foreach ($category->questions as $qIndex => $question) {
                $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0];

                foreach ($question->responses as $response) {
                    if (isset($counts[$response->jawaban])) {
                        $counts[$response->jawaban]++;
                    }
                }

                $total = array_sum($counts);
                $percentages = $total > 0
                    ? array_map(fn ($c) => round(($c / $total) * 100, 2), $counts)
                    : [0, 0, 0, 0];

                $chartData[] = [
                    'id'     => "chart_{$category->id}_{$qIndex}",
                    'counts' => array_values($percentages),
                ];
            }
        }

        return view('surveys.admin-dashboard', compact(
            'user',
            'totalCategories',
            'totalQuestions',
            'totalResponses',
            'categories',
            'chartData',
            'surveyLink',
            'qrCode',
            'activeSurvey',
            'hasActiveSurvey',

            // === NOTIFIKASI ===
            'hasSetting',
            'settingActive',
            'hasCategories',
            'hasQuestions',
            'hasActiveCategories',
            'hasActiveQuestions',
            'questionsActive'
        ));
    }

    public function personalDashboard($slug)
    {
        return $this->personal($slug);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller
{
    public function total(Request $request)
    {
        $userId = Auth::id(); // hanya kategori milik admin yang login

        // Ambil kategori admin ini
        $categories = Category::where('user_id', $userId)
                        ->orderBy('name')
                        ->get();

        $selectedCategory = $request->get('category_id');

        $query = DB::table('questions')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->leftJoin('responses', 'questions.id', '=', 'responses.question_id')
            ->select(
                'questions.id',
                'questions.pertanyaan',
                'categories.id as kategori_id',
                'categories.name as kategori',
                DB::raw('COUNT(responses.id) as total')
            )
            ->whereIn('categories.id', $categories->pluck('id')) // hanya kategori milik admin
            ->groupBy('questions.id', 'questions.pertanyaan', 'categories.id', 'categories.name');

        if ($selectedCategory) {
            $query->where('categories.id', $selectedCategory);
        }

        $data = $query->get();

        // kelompokkan berdasarkan kategori
        $grouped = $data->groupBy('kategori');

        return view('admin.grafik.total', compact('categories', 'grouped', 'selectedCategory'));
    }

    public function exportPdf(Request $request)
    {
        $userId = Auth::id();

        $categoryIds = $request->input('category_id') ? [$request->input('category_id')] : Category::where('user_id', $userId)->pluck('id')->toArray();

        $data = DB::table('questions')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->leftJoin('responses', 'questions.id', '=', 'responses.question_id')
            ->select(
                'questions.id',
                'questions.pertanyaan',
                'categories.name as kategori',
                DB::raw('COUNT(responses.id) as total')
            )
            ->whereIn('categories.id', $categoryIds)
            ->groupBy('questions.id', 'questions.pertanyaan', 'categories.name')
            ->get()
            ->groupBy('kategori');

        $charts = $request->input('charts', []);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.grafik.pdf', [
            'grouped' => $data,
            'charts' => $charts,
            'category' => $request->input('category_id') ? Category::find($request->input('category_id'))->name : null
        ])->setPaper('a4', 'portrait');

        return $pdf->download('grafik_total.pdf');
    }
}

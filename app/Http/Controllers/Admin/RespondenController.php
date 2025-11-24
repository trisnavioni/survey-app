<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    // Menampilkan halaman responden admin
    public function index(Request $request, $adminSlug)
    {
        // Ambil admin dari slug
        $admin = User::where('slug', $adminSlug)->firstOrFail();

        // Ambil semua kategori aktif milik admin ini
        $categories = Category::where('user_id', $admin->id)
                ->orderBy('name')
                ->get();


        $selectedCategory = $request->get('category');
        $search = $request->get('search');

        // Ambil responses berdasarkan kategori admin ini
        $query = Response::with(['dataDiri', 'question.category'])
                    ->whereHas('question', function($q) use ($admin) {
                        $q->where('user_id', $admin->id); // filter admin
                    });

        if ($selectedCategory) {
            $query->whereHas('question', function($q) use ($selectedCategory) {
                $q->where('category_id', $selectedCategory);
            });
        }

        if ($search) {
            $query->whereHas('dataDiri', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            });
        }

        $responses = $query->get()->groupBy('data_diri_id');

        return view('surveys.responden-admin', compact(
            'categories', 
            'selectedCategory', 
            'responses', 
            'search', 
            'admin'
        ));
    }

    // Export PDF multi-admin
    public function exportPdf(Request $request, $adminSlug)
    {
        $admin = User::where('slug', $adminSlug)->firstOrFail();

        // Semua kategori milik admin ini
        $categories = Category::where('user_id', $admin->id)
                        ->where('aktif', true)
                        ->pluck('id');

        // Jika user memilih kategori, ambil dari request
        $categoryIds = $request->categories ?? $categories;

        $responses = Response::with(['dataDiri', 'question.category'])
                        ->whereHas('question', function($q) use ($admin, $categoryIds) {
                            $q->where('user_id', $admin->id)
                              ->whereIn('category_id', $categoryIds);
                        })
                        ->get()
                        ->groupBy('data_diri_id');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('surveys.responden-pdf', [
            'groupedResponses' => $responses
        ])->setPaper('a4', 'landscape');

        return $pdf->download('responden.pdf');
    }
}

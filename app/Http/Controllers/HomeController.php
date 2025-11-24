<?php

namespace App\Http\Controllers;

use App\Models\Survey;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil survey aktif, atau survey terbaru
        $survey = Survey::where('active', true)->latest()->first();

        // Kirim ke blade
        return view('surveys.halaman-utama', compact('survey'));
    }
}

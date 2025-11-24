<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        // Ambil kategori milik admin yang login beserta pertanyaannya
        $categories = Category::with('questions')
            ->where('user_id', Auth::id())
            ->get();

        // Ambil pertanyaan flat milik admin yang login
        $questions = Question::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.questions.index', compact('categories', 'questions'));
    }

    public function create()
    {
        // Ambil kategori milik admin yang login
        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('admin.questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan'   => 'required|string|max:500',
            'tipe_jawaban' => 'required|in:emoji4,skala4',
            'category_id'  => 'required|exists:categories,id',
        ]);

        // Tambahkan user_id admin yang login
        $validated['user_id'] = Auth::id();

        Question::create($validated);

        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan ditambahkan.');
    }

    public function edit(Question $question)
    {
        // Pastikan hanya admin pemilik pertanyaan yang bisa edit
        if ($question->user_id != Auth::id()) abort(403);

        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('admin.questions.edit', compact('question', 'categories'));
    }

    public function update(Request $request, Question $question)
    {
        if ($question->user_id != Auth::id()) abort(403);

        $validated = $request->validate([
            'pertanyaan'   => 'required|string|max:500',
            'tipe_jawaban' => 'required|in:emoji4,skala4',
            'category_id'  => 'required|exists:categories,id',
        ]);

        $question->update($validated);

        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan diperbarui.');
    }

    public function destroy(Question $question)
    {
        if ($question->user_id != Auth::id()) abort(403);

        $question->delete();

        return back()->with('success', 'Pertanyaan dihapus.');
    }

    // ==========================
    // 🔹 Tambah Kategori Langsung dari Halaman Ini
    // ==========================
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cek apakah kategori sudah ada untuk user yang sama (case-insensitive)
        $exists = Category::where('user_id', Auth::id())
            ->whereRaw('LOWER(name) = ?', [strtolower($request->name)])
            ->exists();

        if ($exists) {
            // Jika sudah ada kategori dengan nama sama untuk user ini
            return back()->with('error', 'Kategori dengan nama tersebut sudah ada.');
        }

        // Simpan kategori baru
        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }
}

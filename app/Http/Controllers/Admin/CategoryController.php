<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Validasi unik per user
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ], [
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['aktif'] = false; // default nonaktif

        Category::create($validated);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $category)
    {
        // Pastikan hanya pemilik kategori yang bisa hapus
        if ($category->user_id != Auth::id()) {
            abort(403);
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function setActive(Category $category)
{
    if ($category->user_id != Auth::id()) {
        abort(403);
    }

    // 🔥 CEK jika kategori belum punya pertanyaan
    if ($category->questions()->count() === 0) {
        return back()->with('toggle_error', 'Tidak bisa mengaktifkan kategori yang belum memiliki pertanyaan.');
    }

    // Toggle ON / OFF
    $category->aktif = !$category->aktif;
    $category->save();

    return back()->with('success', 'Status kategori diperbarui.');
}

}

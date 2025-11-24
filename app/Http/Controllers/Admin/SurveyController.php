<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('admin.surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'wave_color' => 'nullable|string|max:20',
            'button_color' => 'nullable|string|max:20',
            'navbar_color' => 'nullable|string|max:20',
            'background_color' => 'nullable|string|max:20',
        ]);

        $survey = new Survey([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'wave_color' => $request->wave_color ?? '#1E90FF',
            'button_color' => $request->button_color ?? '#007BFF',
            'navbar_color' => $request->navbar_color ?? '#0d6efd',
            'background_color' => $request->background_color ?? '#ffffff',
        ]);

        // ✅ Simpan logo ke public/logos/
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $filename);
            $survey->logo = $filename; // Simpan nama file saja
        }

        $survey->save();

        return redirect()->route('admin.surveys.index')->with('success', 'Survey berhasil ditambahkan!');
    }

    public function edit(Survey $survey)
    {
        $this->authorizeSurvey($survey);
        return view('admin.surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $this->authorizeSurvey($survey);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'wave_color' => 'nullable|string|max:20',
            'button_color' => 'nullable|string|max:20',
            'navbar_color' => 'nullable|string|max:20',
            'background_color' => 'nullable|string|max:20',
        ]);

        $survey->update([
            'title' => $request->title,
            'description' => $request->description,
            'wave_color' => $request->wave_color ?? '#1E90FF',
            'button_color' => $request->button_color ?? '#007BFF',
            'navbar_color' => $request->navbar_color ?? '#0d6efd',
            'background_color' => $request->background_color ?? '#ffffff',
        ]);

        // ✅ Ganti logo jika diupload baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($survey->logo && file_exists(public_path('logos/' . $survey->logo))) {
                unlink(public_path('logos/' . $survey->logo));
            }

            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $filename);
            $survey->logo = $filename;
            $survey->save();
        }

        return redirect()->route('admin.surveys.index')->with('success', 'Survey berhasil diperbarui!');
    }

    public function destroy(Survey $survey)
    {
        $this->authorizeSurvey($survey);

        // ✅ Hapus logo jika ada
        if ($survey->logo && file_exists(public_path('logos/' . $survey->logo))) {
            unlink(public_path('logos/' . $survey->logo));
        }

        $survey->delete();

        return redirect()->route('admin.surveys.index')->with('success', 'Survey berhasil dihapus!');
    }

    public function activate(Survey $survey)
    {
        $this->authorizeSurvey($survey);

        Survey::where('user_id', Auth::id())->update(['active' => false]);

        $survey->update(['active' => true]);

        return redirect()->route('admin.surveys.index')->with('success', 'Survey berhasil diaktifkan.');
    }

    public function halamanUtama()
    {
        $survey = Survey::where('user_id', Auth::id())
            ->where('active', true)
            ->first();

        return view('surveys.halaman-utama', compact('survey'));
    }

    private function authorizeSurvey(Survey $survey)
    {
        if ($survey->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke survey ini.');
        }
    }

    public function showSurveyForm($adminId)
    {
        $admin = \App\Models\User::findOrFail($adminId);
        return view('surveys.form', compact('admin'));
    }

    public function toggle(Survey $survey)
{
    $this->authorizeSurvey($survey);

    // Jika sedang aktif → matikan saja
    if ($survey->active) {
        $survey->update(['active' => false]);
    } 
    else {
        // Matikan semua survey milik user ini saja
        Survey::where('user_id', $survey->user_id)
            ->where('id', '!=', $survey->id)
            ->update(['active' => false]);

        // Aktifkan survey yg dipilih
        $survey->update(['active' => true]);
    }

    return redirect()->back()->with('success', 'Status survey berhasil diubah.');
}


    // ✅ Hapus logo manual
    public function removeLogo(Survey $survey)
    {
        $this->authorizeSurvey($survey);

        if ($survey->logo && file_exists(public_path('logos/' . $survey->logo))) {
            unlink(public_path('logos/' . $survey->logo));
            $survey->logo = null;
            $survey->save();
        }

        return back()->with('success', 'Logo berhasil dihapus.');
    }
}

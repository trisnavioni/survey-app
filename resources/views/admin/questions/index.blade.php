@extends('layouts.app')

@push('styles')
<style>
  /* === SWITCH MODERN === */
  .switch { position: relative; display: inline-block; width: 52px; height: 28px; }
  .switch input { opacity: 0; width: 0; height: 0; }
  .slider {
    position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
    background: #ddd; transition: .4s; border-radius: 34px;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
  }
  .slider:before {
    position: absolute; content: ""; height: 22px; width: 22px;
    left: 3px; bottom: 3px; background-color: #fff; transition: .4s;
    border-radius: 50%; box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  }
  .switch input:checked + .slider { background: linear-gradient(135deg, #0d6efd, #00bcd4); }
  .switch input:checked + .slider:before { transform: translateX(24px); }
  .switch-label { font-size: 0.8rem; font-weight: 600; margin-left: 8px; user-select: none; }

  /* === MODAL FIX === */
  .modal { z-index: 99999 !important; }
  .modal-backdrop { z-index: 99998 !important; }

  /* === PERTANYAAN PANJANG RAPIH === */
  .list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }
  .question-wrapper {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
  }
  .question-number { font-weight: 600; display: block; margin-bottom: 2px; }
  .question-text { white-space: normal; word-wrap: break-word; overflow-wrap: break-word; max-width: 95%; }
  .btn-group-question {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    gap: 6px;
    white-space: nowrap;
  }
  .bg-primary {
    background-color: rgba(var(--bs-primary-rgb), var(--bs-bg-opacity)) !important;
    width: 70px;
  }

  /* === RESPONSIVE === */
  @media (max-width: 767.98px) {
    .list-group-item { flex-direction: column; align-items: stretch; }
    .question-wrapper { margin-bottom: 10px; }
    .btn-group-question { flex-direction: column; align-items: stretch; gap: 6px; }
    .btn-group-question button { width: 100%; }
    .badge.bg-primary { align-self: flex-start; margin-top: 6px; }
  }

  @media (min-width: 768px) {
    .btn-group-question { flex-direction: row; align-items: center; gap: 8px; }
  }

  /* 🔹 Ukuran modal lebih kecil di HP */
@media (max-width: 576px) {
    .modal-dialog {
        max-width: 85% !important;
        margin: auto;
    }

    .modal-content {
        padding: 10px;
        border-radius: 12px;
    }
}

/* 🔹 Tablet */
@media (min-width: 577px) and (max-width: 768px) {
    .modal-dialog {
        max-width: 400px !important;
    }
}

/* 🔹 Desktop biasa */
@media (min-width: 769px) {
    .modal-dialog {
        max-width: 500px !important;
    }
}

</style>
@endpush

@section('content')
<div class="breadcrumb">📝 Kuesioner</div>

{{-- ✅ Pesan sukses --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif



@php
    $hasCategories = $categories->count() > 0;

    // Hitung kategori aktif (PERBAIKAN)
    $activeCategories = $categories->where('aktif', true)->count();

    // Hitung total pertanyaan
    $totalQuestions = 0;
    $activeQuestions = 0;

    foreach ($categories as $cat) {
        $totalQuestions += $cat->questions->count();
        $activeQuestions += $cat->questions->where('active', true)->count();
    }
@endphp


@if(!$hasCategories)
    <div class="alert alert-warning shadow-sm alert-container">
        📁 Belum ada kategori dibuat.<br>
        Silakan tambah kategori sebelum membuat pertanyaan.
    </div>

@elseif($activeCategories == 0)
    <div class="alert alert-warning shadow-sm alert-container">
        🚫 Belum ada kategori yang diaktifkan.<br>
        Silahkan aktifkan salah satu kategori yang sudah berisi pertanyaan.
    </div>

@elseif($totalQuestions == 0)
    <div class="alert alert-warning shadow-sm alert-container">
        ❓ Belum ada pertanyaan yang dibuat.<br>
        Tambahkan pertanyaan pada kategori yang tersedia.
    </div>
@endif





{{-- Tombol Tambah --}}
<div class="mb-3 d-flex gap-2">
  <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#formCreate" style="box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <i class="bi bi-plus-lg"></i> Tambah Pertanyaan
  </button>
  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalKategori" style="box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <i class="bi bi-folder-plus"></i> Tambah Kategori
  </button>
</div>

{{-- Form Tambah Pertanyaan --}}
<div class="collapse mb-4" id="formCreate">
  <div class="card card-body shadow-sm">
    <h5 class="mb-3">Tambah Pertanyaan</h5>

    <form id="formTambahPertanyaan" method="POST" action="{{ route('admin.questions.store') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select id="kategoriInput" name="category_id" class="form-select" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Pertanyaan</label>
        <input id="pertanyaanInput" type="text" name="pertanyaan" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tipe Jawaban</label>
        <select id="tipeJawabanInput" name="tipe_jawaban" class="form-select" required>
          <option value="emoji4">Emoji 4 Skala</option>
          <option value="skala4">Angka 1–4</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success" id="btnSimpanPertanyaan">Simpan</button>
    </form>

  </div>
</div>


{{-- Accordion Kategori --}}
<div class="accordion" id="accordionKategori">
  @forelse($categories as $category)
    <div class="accordion-item mb-3 shadow-sm rounded-3 overflow-hidden">
      <h2 class="accordion-header d-flex align-items-center justify-content-between">

        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cat{{ $category->id }}">
          <i class="bi bi-folder-fill text-warning me-2"></i> {{ $category->name }}
        </button>

        <div class="pe-3 d-flex align-items-center gap-2">

          {{-- 🔥 Toggle kategori (SUDAH DITAMBAH class="toggle-kategori") --}}
          <form action="{{ route('admin.categories.setActive', $category) }}" method="POST" class="d-flex align-items-center">
            @csrf
            <label class="switch mb-0">
              <input type="checkbox" class="toggle-kategori" onchange="this.form.submit()" {{ $category->aktif ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
            <span class="switch-label">{{ $category->aktif ? 'ON' : 'OFF' }}</span>
          </form>

          {{-- Tombol hapus kategori --}}
          <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="form-delete-category">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
          </form>
        </div>
      </h2>

      <div id="cat{{ $category->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionKategori">
        <div class="accordion-body">
          @if($category->questions->count() > 0)
            <ul class="list-group list-group-flush">
              @foreach($category->questions as $q)
                <li class="list-group-item">
                  <div class="question-wrapper">
                    <span class="question-number">{{ $loop->iteration }}.</span>
                    <span class="question-text">{{ $q->pertanyaan }}</span>
                    <span class="badge bg-primary mt-1">{{ $q->tipe_jawaban }}</span>
                    @if(isset($q->aktif) && $q->aktif == 0)
                      <span class="badge bg-secondary mt-1">Q Nonaktif</span>
                    @endif
                  </div>

                  <div class="btn-group-question">
                    <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#editForm{{ $q->id }}">
                      <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <form method="POST" action="{{ route('admin.questions.destroy', $q) }}" class="form-delete-question">
                      @csrf @method('DELETE')
                      <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                  </div>
                </li>

                {{-- Form Edit --}}
                <div class="collapse mt-3" id="editForm{{ $q->id }}">
                  <div class="card card-body border shadow-sm">
                    <h6 class="mb-3">Edit Pertanyaan</h6>
                    <form method="POST" action="{{ route('admin.questions.update', $q->id) }}">
                      @csrf @method('PUT')
                      <div class="mb-2">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                          @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $q->category_id) == $cat->id ? 'selected' : '' }}>
                              {{ $cat->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-2">
                        <label class="form-label">Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" value="{{ old('pertanyaan', $q->pertanyaan) }}" required>
                      </div>
                      <div class="mb-2">
                        <label class="form-label">Tipe Jawaban</label>
                        <select name="tipe_jawaban" class="form-select">
                          <option value="emoji4" {{ old('tipe_jawaban', $q->tipe_jawaban) == 'emoji4' ? 'selected' : '' }}>Emoji 4 Skala</option>
                          <option value="skala4" {{ old('tipe_jawaban', $q->tipe_jawaban) == 'skala4' ? 'selected' : '' }}>Skala 1–4</option>
                        </select>
                      </div>
                      <button class="btn btn-primary btn-sm mt-1">Update</button>
                    </form>
                  </div>
                </div>

              @endforeach
            </ul>
          @else
            <p class="text-muted">Belum ada pertanyaan untuk kategori ini.</p>
          @endif
        </div>
      </div>
    </div>
  @empty
    <p class="text-muted">Kategori yang baru ditambahkan akan muncul disini.</p>
  @endforelse
</div>

{{-- Modal Tambah Kategori --}}
@push('modals')
<div class="modal fade" id="modalKategori" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="modal-header bg-gradient text-white rounded-top-4" style="background: linear-gradient(135deg, #0d6efd, #00bcd4);">
          <h5 class="modal-title fw-semibold text-dark">
            <i class="bi bi-folder-plus me-2"></i> Tambah Kategori
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <label class="form-label fw-semibold">Nama Kategori</label>
          <input type="text" name="name" class="form-control rounded-pill shadow-sm border-1" placeholder="Masukkan nama kategori..." required>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-between px-4 pb-4">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="bi bi-check-circle me-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush

{{-- SCRIPT SWEETALERT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ⚠️ SweetAlert jika toggle gagal
    @if(session('toggle_error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal Mengaktifkan',
        text: '{{ session("toggle_error") }}',
    });
    @endif

    // 🔄 Kembalikan toggle OFF jika gagal
    document.querySelectorAll(".toggle-kategori").forEach(input => {
        input.addEventListener("change", function () {
            setTimeout(() => {
                @if(session('toggle_error'))
                    this.checked = false;
                @endif
            }, 200);
        });
    });

    // Konfirmasi hapus pertanyaan
    document.querySelectorAll(".form-delete-question").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin hapus pertanyaan ini?',
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Konfirmasi hapus kategori
    document.querySelectorAll(".form-delete-category").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin hapus kategori ini?',
                text: "Semua pertanyaan di dalam kategori ini juga akan terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Error validasi kategori
    @if ($errors->has('name'))
    Swal.fire({
      icon: 'error',
      title: 'Gagal Menambahkan Kategori',
      text: '{{ $errors->first("name") }}',
      confirmButtonText: 'OK'
    });
    @endif

    // Auto close alert sukses
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            const alert = bootstrap.Alert.getOrCreateInstance(alertSuccess);
            alert.close();
        }, 3000);
    }
});
</script>

<script>
// ➕ VALIDASI SWEETALERT FORM TAMBAH PERTANYAAN
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById('btnSimpanPertanyaan');
    const form = document.getElementById('formTambahPertanyaan');

    if (btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const totalKategori = {{ $categories->count() }};
            const kategoriVal = document.getElementById('kategoriInput').value;
            const pertanyaanVal = document.getElementById('pertanyaanInput').value.trim();

            // 1. Tidak ada kategori sama sekali
            if (totalKategori === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada kategori',
                    text: 'Silakan buat kategori terlebih dahulu.'
                });
                return;
            }

            // 2. Kategori ada tapi belum dipilih
            if (kategoriVal === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Kategori belum dipilih',
                    text: 'Silakan pilih kategori terlebih dahulu.'
                });
                return;
            }

            // 3. Pertanyaan kosong
            if (pertanyaanVal === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pertanyaan kosong',
                    text: 'Silakan isi pertanyaan terlebih dahulu.'
                });
                return;
            }

            // 4. Semua valid, submit form
            form.submit();
        });
    }
});
</script>

@endpush

@endsection

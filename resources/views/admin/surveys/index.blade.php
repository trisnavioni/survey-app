@extends('layouts.app')

@push('styles')
<style>
/* === SWITCH MODERN === */
.switch {
  position: relative;
  display: inline-block;
  width: 52px;
  height: 28px;
}
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

/* === ALIGN CONTENT LIKE KUESIONER === */
.accordion-item {
  border-radius: 10px !important;
}

.accordion-button::after { display: none !important; }

.survey-header {
  border: 1px solid #dee2e6;
  border-radius: 8px;
  transition: background 0.2s;
}
.survey-header:hover {
  background-color: #f8f9fa;
  cursor: pointer;
}

.dropdown-toggle-icon {
  border: none;
  background: transparent;
  color: #6c757d;
  font-size: 1.2rem;
  transition: color 0.2s;
}
.dropdown-toggle-icon:hover {
  color: #000;
}

.page-container {
  margin-top: -18px;
}

.modal { z-index: 99999 !important; }
.modal-backdrop { z-index: 99998 !important; }

img.rounded-circle.border.shadow-sm {
  object-fit: cover;
  display: inline-block;
}

/* 🔹 Alert sejajar breadcrumb */
.alert-container {
  max-width: 100%;
  margin: 0 auto;
  margin-top: 35px;
}

/* Custom margin start di antara ms-1 dan ms-2 */
.ms-1-5 {
  margin-left: 0.01rem !important;
  margin-top: -50px;
}
</style>
@endpush

@section('content')
<div class="breadcrumb">⚙️ Setting</div>

<div class="page-container">

  {{-- ✅ FLASH MESSAGE (MUNCUL SEKALI) --}}
  @if(session()->has('success'))
    <div class="alert-container">
      <div class="alert alert-success alert-dismissible shadow-sm show" id="successAlert" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

{{-- ⚠️ CEK SURVEI --}}
@php
    $hasSurvey = $surveys->count() > 0;
    $activeSurvey = $surveys->firstWhere('active', true);
@endphp

@if(!$hasSurvey)
    <div class="alert alert-warning shadow-sm alert-container">
        📄 Belum ada survei yang dibuat.<br>
        Silakan buat survei baru terlebih dahulu.
    </div>
@elseif(!$activeSurvey)
    <div class="alert alert-warning shadow-sm alert-container">
        🚫 Belum ada survei yang diaktifkan.<br>
        Silakan aktifkan salah satu survei agar muncul di halaman utama dan dashboard.
    </div>
@endif


  {{-- HEADER TAMBAH SURVEY --}}
  <button class="btn btn-primary btn-sm my-3 ms-1-5" type="button" data-bs-toggle="collapse" data-bs-target="#formTambahSurvey">
    <i class="bi bi-plus-lg"></i> Tambah Survey
  </button>

  {{-- FORM TAMBAH --}}
  <div class="collapse mb-4" id="formTambahSurvey">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body">
        <h5 class="fw-bold mb-3">Tambah Survey</h5>
        <form action="{{ route('admin.surveys.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Judul Survey</label>
            <input type="text" name="title" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Logo (opsional)</label>
            <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewTambah(event)">
            <img id="previewTambahImage" class="mt-2 border rounded" style="max-height: 100px; display:none;" alt="Preview logo">
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-3">
              <label class="form-label">Warna Wave</label>
              <input type="color" name="wave_color" class="form-control form-control-color" value="#0099ff">
            </div>
            <div class="col-md-3">
              <label class="form-label">Warna Tombol</label>
              <input type="color" name="button_color" class="form-control form-control-color" value="#0099ff">
            </div>
            <div class="col-md-3">
              <label class="form-label">Warna Navbar</label>
              <input type="color" name="navbar_color" class="form-control form-control-color" value="#ffffff">
            </div>
            <div class="col-md-3">
              <label class="form-label">Warna Background</label>
              <input type="color" name="background_color" class="form-control form-control-color" value="#ffffff">
            </div>
          </div>

          <button class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>

  {{-- LIST SURVEY --}}
  <div class="accordion" id="surveyAccordion">
    @forelse($surveys as $survey)
      <div class="accordion-item mb-3 border-0 shadow-sm rounded-3 overflow-hidden">
        {{-- HEADER --}}
        <div class="survey-header d-flex justify-content-between align-items-center p-3 bg-light"
             onclick="toggleSurvey('{{ $survey->id }}')">

          <div class="d-flex align-items-center">
            <i class="bi bi-folder-fill text-warning me-2 fs-5"></i>
            <span class="fw-semibold">{{ $survey->title }}</span>
          </div>

          <div class="d-flex align-items-center gap-2">

            <button class="dropdown-toggle-icon" type="button"
                    onclick="toggleSurvey('{{ $survey->id }}', true); event.stopPropagation();">
              <i class="bi bi-chevron-down"></i>
            </button>

            {{-- SWITCH --}}
            <form action="{{ route('admin.surveys.toggle', $survey) }}" method="POST" class="d-flex align-items-center mb-0" onclick="event.stopPropagation();">
              @csrf
              @method('PATCH')
              <label class="switch mb-0">
                <input type="checkbox" onchange="this.form.submit()" {{ $survey->active ? 'checked' : '' }}>
                <span class="slider"></span>
              </label>
              <span class="switch-label ms-2">{{ $survey->active ? 'ON' : 'OFF' }}</span>
            </form>

            {{-- DELETE --}}
            <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" class="form-delete mb-0" onclick="event.stopPropagation();">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </div>
        </div>

        {{-- BODY --}}
        <div id="collapse{{ $survey->id }}" class="accordion-collapse collapse" data-bs-parent="#surveyAccordion">
          <div class="accordion-body">
            <div class="d-flex align-items-center gap-3 mb-4">
              @if($survey->logo)
                <img src="{{ asset('logos/' . $survey->logo) }}" width="70" height="70"
                     class="rounded-circle border shadow-sm" style="object-fit:cover;" alt="Logo {{ $survey->title }}">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($survey->user->name) }}&size=70"
                     class="rounded-circle border shadow-sm" alt="Avatar {{ $survey->user->name }}">
              @endif
              <div class="lh-sm">
                <div class="small text-muted">Admin</div>
                <div class="fw-semibold">{{ $survey->user->name }}</div>
              </div>
            </div>

            <p class="text-secondary mb-4">
    <strong style="color: #3b3b3b">Deskripsi :</strong> {{ $survey->description ?? 'Tidak ada deskripsi.' }}
</p>


            <div class="row g-3 mb-4">
              @foreach(['wave_color'=>'Wave','button_color'=>'Tombol','navbar_color'=>'Navbar','background_color'=>'Background'] as $field=>$label)
                <div class="col-6 col-md-3">
                  <label class="small text-muted">{{ $label }}</label>
                  <div class="rounded border" style="height: 30px; background: {{ $survey->$field }}"></div>
                </div>
              @endforeach
            </div>

            {{-- EDIT --}}
            <button class="btn btn-warning btn-sm mb-3" data-bs-toggle="collapse" data-bs-target="#editForm{{ $survey->id }}">
              <i class="bi bi-pencil"></i> Edit
            </button>

            <div class="collapse" id="editForm{{ $survey->id }}">
              <div class="border rounded p-3 bg-light">
                <h6 class="fw-bold mb-3">Edit Survey</h6>
                <form action="{{ route('admin.surveys.update', $survey) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label class="form-label">Judul Survey</label>
                    <input type="text" name="title" value="{{ $survey->title }}" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ $survey->description }}</textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ganti Logo (opsional)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*"
                      onchange="previewEdit(event, {{ $survey->id }})">
                    @if($survey->logo)
                      <img src="{{ asset('logos/' . $survey->logo) }}" id="previewEditImage{{ $survey->id }}"
                        class="mt-2 border rounded" style="max-height: 100px;" alt="Preview edit logo">
                    @else
                      <img id="previewEditImage{{ $survey->id }}" class="mt-2 border rounded"
                        style="max-height: 100px; display:none;" alt="Preview edit logo">
                    @endif
                  </div>

                  <div class="row g-3 mb-3">
                    @foreach(['wave_color'=>'Wave','button_color'=>'Tombol','navbar_color'=>'Navbar','background_color'=>'Background'] as $field=>$label)
                    <div class="col-md-3">
                      <label class="form-label">{{ $label }}</label>
                      <input type="color" name="{{ $field }}" class="form-control form-control-color" value="{{ $survey->$field }}">
                    </div>
                    @endforeach
                  </div>

                  <button class="btn btn-success">Simpan Perubahan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted text-start">Survey yang baru dibuat akan muncul disini.</p>
    @endforelse
  </div>
</div>

<script>
function toggleSurvey(id) {
  const collapse = document.getElementById('collapse' + id);
  const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapse);
  collapse.classList.contains('show') ? bsCollapse.hide() : bsCollapse.show();
}

document.querySelectorAll('.form-delete').forEach(form => {
  form.addEventListener('submit', e => {
    e.preventDefault();
    Swal.fire({
      title: 'Hapus survey?',
      text: 'Survey yang anda hapus tidak dapat dikembalikan lagi!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then(result => { if (result.isConfirmed) form.submit(); });
  });
});

function previewTambah(event) {
  const img = document.getElementById('previewTambahImage');
  if (!event.target.files[0]) return;
  img.src = URL.createObjectURL(event.target.files[0]);
  img.style.display = 'block';
}

function previewEdit(event, id) {
  const img = document.getElementById('previewEditImage' + id);
  if (!event.target.files[0]) return;
  img.src = URL.createObjectURL(event.target.files[0]);
  img.style.display = 'block';
}

// Hilangkan alert sukses otomatis (tanpa efek fade)
const alertSuccess = document.getElementById('successAlert');
if (alertSuccess) {
  setTimeout(() => {
    alertSuccess.remove();
  }, 3000);
}
</script>
@endsection

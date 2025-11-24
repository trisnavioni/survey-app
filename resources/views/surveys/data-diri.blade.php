<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Kepuasan Masyarakat</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background: {{ $activeSurvey->background_color ?? '#ffffff' }};
    opacity: 0;
    transition: opacity 0.8s ease-in-out; /* 🌟 efek fade in */
  }

  body.loaded {
    opacity: 1;
  }

  nav.navbar {
    background-color: {{ $activeSurvey->navbar_color ?? '#ffffff' }} !important;
  }

  /* === STEP INDICATOR FIX === */
  .stepper.d-flex.align-items-center.justify-content-center {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    color: #5B5A5A;
    font-weight: 600;
    font-size: 26px;
    flex-wrap: wrap !important;
    gap: 10px;
    text-align: center;
    width: 100%;
  }

  .step-line {
    width: 250px;
    border-bottom: 3px solid #5B5A5A;
  }

  .stepper span {
    margin: 0 10px;
    white-space: nowrap;
  }

  /* === RESPONSIVE ADJUSTMENTS === */
  @media (max-width: 992px) {
    .navbar>.container, .navbar>.container-fluid, .navbar>.container-lg, 
    .navbar>.container-md, .navbar>.container-sm, .navbar>.container-xl, .navbar>.container-xxl {
        display: flex;
        flex-wrap: inherit;
        align-items: center;
        margin-top: -8px;
        justify-content: space-between;
    }
    .stepper.d-flex.align-items-center.justify-content-center {
      font-size: 18px !important;
    }
    .step-line {
      width: 140px !important;
    }
  }

  @media (max-width: 768px) {
    .stepper.d-flex.align-items-center.justify-content-center {
      font-size: 16px !important;
    }
    .step-line {
      width: 100px !important;
    }
  }

  @media (max-width: 576px) {
    .stepper.d-flex.align-items-center.justify-content-center {
      flex-direction: row !important;
      font-size: 18px !important;
      flex-wrap: nowrap !important;
    }
    .step-line {
      display: inline-block !important;
      width: 100px !important;
      border-bottom: 2px solid #5B5A5A;
    }
  }

  /* === CARD & PETUNJUK === */
  .box-petunjuk {
    border: 2px solid #d6d6d6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    margin-top: 40px;
    background: #fff;
    box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
  }

  .box-petunjuk h6 {
    font-weight: 600;
    margin-bottom: 10px;
  }

  .card-custom {
    border-radius: 10px;
    border: 2px solid #d6d6d6;
    margin-top: 30px;
    background: #fff;
    padding: 25px;
    box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
  }

  .btn-next {
    background-color: #2570e2;
    color: #fff;
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 500;
  }

  .btn-next:hover {
    background-color: #0b5ed7;
  }

  .my-4 {
    margin-top: 120px !important;
    margin-bottom: 1.5rem !important;
  }

  /* ======== ANIMASI FADE IN ======== */
  .fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  }
  .fade-in.show {
    opacity: 1;
    transform: translateY(0);
  }
  </style>
</head>

<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom px-4 py-3 fixed-top"
     style="height:80px; z-index:9999; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center fw-semibold fs-5" href="#" style="margin-left: 20px;">
      <img src="{{ asset('image/logo_survey.png') }}" width="50" height="50" class="me-2">
      IKM
    </a>
    <div class="d-flex ms-auto" style="margin-right: 20px;">
      <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3">Login</a>
    </div>
  </div>
</nav>

<div class="container my-4">
  <!-- Step Indicator -->
  <div class="stepper d-flex align-items-center justify-content-center mt-5 mb-4 fade-in">
    <span>1) Data Diri</span>
    <div class="mx-6 step-line"></div>
    <span>2) Kuesioner</span>
  </div>

  <!-- Petunjuk -->
  <div class="box-petunjuk fade-in">
    <h6>Petunjuk</h6>
    <p class="mb-0">Harap isi informasi pribadi Anda dengan lengkap. Setelah selesai, silahkan lanjutkan dengan menekan tombol "Selanjutnya".</p>
  </div>

  <!-- Form Data Diri -->
  <div class="card card-custom p-4 fade-in">
    <h5 class="text-center mb-3">Data Diri</h5>

    @if (session('warning'))
      <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <form method="POST" action="{{ route('data.diri.multi', ['user' => $user->id]) }}">
      @csrf

      <div class="mb-3">
        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="namaLengkap" class="form-control"
               value="{{ old('nama_lengkap') }}" required>
        @error('nama_lengkap')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenisKelamin" class="form-select" required>
          <option value="">-Pilih-</option>
          <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
          <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
        </select>
        @error('jenis_kelamin')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="umur" class="form-label">Umur</label>
        <input type="number" name="umur" id="umur" class="form-control" min="1" max="120"
               value="{{ old('umur') }}" required>
        @error('umur')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <input type="hidden" name="user_id" value="{{ $user->id }}">

      <div class="text-end">
        <button type="submit" class="btn btn-next">Selanjutnya</button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🌟 Script untuk fade-in saat halaman selesai dimuat -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.body.classList.add("loaded");
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach((el, i) => {
      setTimeout(() => el.classList.add('show'), 150 * i);
    });
  });
</script>

</body>
</html>

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
      background: white;
    }

    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .ikm h2 {
      margin-top: 0px;
      font-weight: 600;
    }

.mx-auto {
    margin-right: auto !important;
    margin-left: auto !important;
    margin-top: 0px;
}

    .hero .card-body {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
      height: 500px;
    }

    .hero-left {
      text-align: center;
      flex: 1 1 350px;
    }

    .hero-left img {
      width: auto;
      height: 200px;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .hero-left h5 {
      font-weight: 600;
      color: #333;
      margin-top: 0;
    }

    .hero-right {
      flex: 2 1 400px;
      text-align: left;
      margin-left: -30px;
    }

    .hero-right h2 {
      font-weight: 800;
      font-size: 2.7rem;
      line-height: 1.2;
      margin-bottom: 15px;
    }

    .hero-right p {
      color: #5B5A5A;
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .my-btn:hover {
      opacity: 0.85;
      background: #cfcfcf;
    }

/* 🌊 Wave bergerak halus seperti boomerang */
    .wave {
      position: absolute;
      bottom: -200px;
      left: 0;
      width: 200%;
      height: 130%;
      z-index: 1;
      margin-bottom: 70px;
      animation: waveMove 18s ease-in-out infinite alternate;
    }

    @keyframes waveMove {
      from { transform: translateX(0); }
      to { transform: translateX(-50%); }
    }

    /* 🎡 Logo berputar */
    .logo-berputar {
      animation: spin 8s linear infinite;
      transform-origin: center;
      display: inline-block;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* ✅ Responsif */
    @media (max-width: 992px) {

      .mx-auto {
    margin-right: auto !important;
    margin-left: auto !important;
    width: 90%;
    margin-top: 10px !important;
}

          .wave {
      position: absolute;
      bottom: -200px;
      left: 0;
      width: 200%;
      height: 100%;
      z-index: 1;
      margin-bottom: 70px;
      animation: waveMove 18s linear infinite;
    }

.hero-card {
    position: relative;
    z-index: 2;
    width: 300px;
    margin-top: -70px;
}

.navbar>.container, .navbar>.container-fluid, .navbar>.container-lg, .navbar>.container-md, .navbar>.container-sm, .navbar>.container-xl, .navbar>.container-xxl {
    display: flex;
    flex-wrap: inherit;
    align-items: center;
    justify-content: space-between;
    margin-top: -8px;
}


.text-center {
    text-align: center !important;
    margin-top: -30px;
}

      .hero .card-body {
        flex-direction: column;
        height: auto;
        gap: 10px;
        padding: 1.5rem;
      }
      .hero-left img {
        height: 140px;
      }
      .hero-right {
        margin: 0 !important;
        margin-top: 0px !important;
        text-align: center !important;
        flex: 2 1 280px;
        max-width: 280px;
      }
      .hero-right h2 {
        font-size: 1.9rem;
      }
      .hero-right p {
        font-size: 0.95rem;
      }
      .my-btn {
        font-size: 0.9rem;
        padding: 8px 18px;
      }
      .wave {
        width: 300%;
        margin-bottom: 200px;
      }
      .logo-berputar {
        height: 80px !important;
      }
    }

    @media (max-width: 576px) {


      .hero-left
 {
  margin-bottom: -250px;
    text-align: center;
    flex: 1 1 400px;
    margin-top: 40px;
}
      .hero {
        padding: 20px 0;
      }
      .hero-left img {
        height: 120px;
      }
      .hero-right h2 {
        font-size: 1.5rem;
      }
      .hero-right p {
        font-size: 0.9rem;
      }
      .logo-berputar {
        height: 70px !important;
      }
    }

    /* Emoji Section */
    .emoji-container .emoji-icon {
      font-size: 2rem;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
    }

    .bg-soft-red { color: #dc3545; }
    .bg-soft-orange { color: #fd7e14; }
    .bg-soft-yellow { color: #ffc107; }
    .bg-soft-green { color: #28a745; }

    .emoji-container .card {
      transition: transform .3s, box-shadow .3s;
    }
    .emoji-container .card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
  </style>

@if(Route::is('halaman.utama.multi'))
<style>

  .mx-auto {
    margin-right: auto !important;
    margin-left: auto !important;
    margin-top: 150px;
}

  @media (max-width: 576px) {

        .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-top: 70px;
    }

      .hero-left
 {
  margin-bottom: -150px;
    text-align: center;
    flex: 1 1 350px;

}

.text-center {
    text-align: center !important;
    margin-top: -90px;
}

      .wave {
        width: 300%;
        margin-bottom: 270px;
      }

          .hero-card {
      position: relative;
      z-index: 2;
      width: 1000px;
      margin-top: -70px;
    }
  }


nav.navbar {
  background-color: {{ $survey->navbar_color ?? '#ffffff' }} !important;
  
}
.wave path {
  fill: {{ $survey->wave_color ?? '#3366ff' }};
}
.my-btn {
  background-color: {{ $survey->button_color ?? '#007BFF' }};
}

    .hero-card {
      position: relative;
      z-index: 2;
      width: 1000px;
      margin-top: -70px;
    }

        .my-btn {
      padding: 10px 25px;
      font-size: 1rem;
      border: none;
      color: #fff;
      border-radius: 5px;
      transition: 0.3s;
      box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
    }
</style>
@else
<style>
.wave path { fill: #3f6cff; }
.my-btn { background-color: #3f6cff; }
    .hero-card {
      position: relative;
      z-index: 2;
      width: 1000px;

    }

        .my-btn {
      padding: 10px 25px;
      font-size: 1rem;
      border: none;
      color: #fff;
      border-radius: 5px;
      transition: 0.3s;
      width: 150px;
      box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
    }
</style>
@endif

</head>
<body>

<!-- ✅ Navbar hanya di halaman multi -->
@if(Route::is('halaman.utama.multi'))
<nav class="navbar navbar-expand-lg navbar-light border-bottom px-4 py-3 fixed-top"
     style="height:80px; z-index:9999; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">


  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center fw-semibold fs-5" href="#" style="margin-left: 10px;">
      <img src="{{ asset('image/logo_survey.png') }}" width="50" height="50" class="me-2">
      IKM
    </a>
    <div class="d-flex ms-auto" style="margin-right: 20px;">
      <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3">Login</a>
    </div>
  </div>
</nav>
@endif

<!-- 🌟 Hero Section -->
<section class="hero">
  <div class="container hero-card">
    <div class="card shadow-lg border-0 mx-auto">
      <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center">

        {{-- ✅ Kiri: Logo --}}
        <div class="hero-left d-flex flex-column align-items-center">
          @if(Route::is('halaman.utama.multi'))
            @if($survey->logo && file_exists(public_path('logos/' . $survey->logo)))
    <img src="{{ asset('logos/' . $survey->logo) }}" alt="Logo Perusahaan" class="img-fluid mb-2">
@else
    <img src="https://ui-avatars.com/api/?name={{ isset($user) ? urlencode($user->name) : 'Admin' }}&background=random"
         alt="Default Avatar" class="img-fluid mb-2">
@endif

            @if(isset($user))
                <h5>{{ $user->name }}</h5>
            @endif
          @else
            <img src="{{ asset('image/logo_survey.png') }}" alt="Logo IKM" class="logo-berputar mb-2">
          <div class="ikm">
            <h2>
              IKM
            </h2>
          </div>
          @endif
        </div>

        {{-- ✅ Kanan: Teks --}}
        <div class="hero-right flex-grow-1">
          @php
            if(isset($user) && $survey) {
                $title = $survey->title;
                $description = $survey->description;
            } else {
                $title = 'Indek Kepuasan Masyarakat';
                $description = 'Penilaian Anda membantu kami memberikan pelayanan yang lebih baik. Isi survei ini dan bantu kami berkembang bersama Anda!';
            }
            $words = explode(' ', $title);
            $titleFormatted = (count($words) > 2)
                ? implode(' ', array_slice($words, 0, 2)) . '<br>' . implode(' ', array_slice($words, 2))
                : $title;
          @endphp

          <h2>{!! $titleFormatted !!}</h2>
          <p>{{ $description }}</p>

          @if(isset($user))
            <a href="{{ route('data.diri.multi', $user->id) }}" class="btn my-btn">
              Beri Penilaian <i class="bi bi-star"></i>
            </a>
          @else
            <a href="{{ route('login') }}" class="btn my-btn">
              Login
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Wave -->
  <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="wave">
    <path d="M0,240 C360,320 720,-150 1080,220 C1260,300 1440,260 1440,250 L1440,320 L0,320 Z"></path>
  </svg>
</section>

<!-- Emoji Section -->
<section class="container text-center py-5">
  <h3 class="fw-semibold">Indek Kepuasan Masyarakat</h3>
  <p class="halaman2">Terimakasih atas kepercayaan dan dukungan Anda. Kami berkomitmen untuk terus meningkatkan layanan bagi Anda.</p>

  @php
    $count1 = $counts['tidak_memuaskan'] ?? 0;
    $count2 = $counts['kurang_memuaskan'] ?? 0;
    $count3 = $counts['memuaskan'] ?? 0;
    $count4 = $counts['sangat_memuaskan'] ?? 0;
    $total  = $count1 + $count2 + $count3 + $count4;
  @endphp

  <div class="emoji-container">
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 p-3">
          <div class="emoji-icon bg-soft-red"><i class="bi bi-emoji-frown-fill"></i></div>
          <span class="fw-semibold small text-danger">TIDAK MEMUASKAN</span>
          <div class="fs-4 fw-bold mt-2">{{ $count1 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 p-3">
          <div class="emoji-icon bg-soft-orange"><i class="bi bi-emoji-neutral-fill"></i></div>
          <span class="fw-semibold small text-orange">KURANG MEMUASKAN</span>
          <div class="fs-4 fw-bold mt-2">{{ $count2 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 p-3">
          <div class="emoji-icon bg-soft-yellow"><i class="bi bi-emoji-smile-fill"></i></div>
          <span class="fw-semibold small text-warning">MEMUASKAN</span>
          <div class="fs-4 fw-bold mt-2">{{ $count3 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 p-3">
          <div class="emoji-icon bg-soft-green"><i class="bi bi-emoji-laughing-fill"></i></div>
          <span class="fw-semibold small text-success">SANGAT MEMUASKAN</span>
          <div class="fs-4 fw-bold mt-2" >{{ $count4 }}</div>
        </div>
      </div>
    </div>
    <div class="mt-4"><h5 class="fw-semibold">Total Responden: {{ $total }}</h5></div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
  title: '🎉 Survey Terkirim!',
  text: '{{ session('success') }}',
  icon: 'success',
  confirmButtonText: 'OK',
  background: '#f8f9fa',
  confirmButtonColor: '#3085d6',
});
</script>
@endif

</body>
</html>

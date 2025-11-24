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
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body { 
      font-family: 'Poppins', sans-serif; 
      background: {{ $activeSurvey->background_color ?? 'white' }};
    }
    nav.navbar {
      background-color: {{ $activeSurvey->navbar_color ?? '#ffffff' }} !important;
    }

    /* ======== STEP & STYLE ======== */
    .stepper {
      display: flex;
      justify-content: center;
      align-items: center;
      color: #5B5A5A;
      font-weight: 500;
      font-size: 22px;
      text-align: center;
      flex-wrap: wrap;
    }
    .stepper .active {
      color: #0d6efd;
      font-weight: 600;
    }
    .step-line {
      width: 200px;
      border-bottom: 2px solid #5B5A5A;
    }

    /* ======== PETUNJUK ======== */
    .box-petunjuk {
      border: 2px solid #d6d6d6;
      border-radius: 8px;
      padding: 15px;
      margin-top: 30px;
      background: #fff;
      margin-bottom: 25px;
      word-wrap: break-word;
      overflow-wrap: break-word;
      box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
    }

    /* ======== EMOJI DAN ANGKA ======== */
    .emoji {
      font-size: 40px;
      margin: 10px;
      cursor: pointer;
      transition: transform 0.2s, border-bottom 0.2s;
      padding: 5px 10px;
    }
    .emoji:hover { transform: scale(1.2); }
    .emoji.active { border-bottom: 4px solid #0d6efd; }

    .angka {
      font-size: 30px;
      font-weight: 600;
      cursor: pointer;
      padding: 8px 15px;
      border-radius: 6px;
      border: 2px solid transparent;
      transition: all 0.2s;
    }
    .angka:hover { background: #f0f0f0; }
    .angka.active {
      border: 2px solid #0d6efd;
      color: #0d6efd;
      background: #eaf2ff;
    }

    /* ======== KOTAK PERTANYAAN ======== */
    .jawaban {
      border: 2px solid #d6d6d6;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 25px;
      word-wrap: break-word;
      overflow-wrap: break-word;
      max-width: 100%;
      box-sizing: border-box;
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 12px 2px rgba(0, 0, 0, 0.15);
    }

    .jawaban p {
      white-space: normal;
      word-break: break-word;
    }

    .jawaban .d-flex {
      flex-wrap: nowrap;
      gap: 10px;
    }

    /* ======== RESPONSIVE TWEAKS ======== */
    .container {
      max-width: 90%;
      padding: 0 15px;
    }

    #confirmBtn {
      margin-top: 30px;
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

    @media (max-width: 576px) {
      .emoji { font-size: 35px; }
      .angka { font-size: 25px; }
      .step-line { width: 47px; }
      .stepper { font-size: 19px; }

      .navbar>.container, .navbar>.container-fluid {
        display: flex;
        flex-wrap: inherit;
        align-items: center;
        margin-top: -8px;
        justify-content: space-between;
      }

      .container {
        max-width: 100%;
        padding: 0 15px;
      }

      .jawaban .d-flex {
        flex-wrap: nowrap;
        gap: 10px;
        margin-left: -15px;
      }
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

<div class="container my-4 fade-in">
  <!-- Step Indicator -->
  <div class="stepper d-flex align-items-center justify-content-center mt-5 mb-4 fade-in">
    <span class="active"><i class="bi bi-check-circle-fill"></i> Data Diri</span>
    <div class="mx-3 step-line"></div>
    <span>2) Kuesioner</span>
  </div>

  <!-- Petunjuk -->
  <div class="box-petunjuk fade-in">
    <strong>Petunjuk Pengisian:</strong><br>
    <ul>
      <li><i class="bi bi-emoji-angry text-danger"></i> / <b>1</b> = Tidak Baik</li>
      <li><i class="bi bi-emoji-neutral text-warning"></i> / <b>2</b> = Kurang Baik</li>
      <li><i class="bi bi-emoji-smile text-success"></i> / <b>3</b> = Baik</li>
      <li><i class="bi bi-emoji-laughing text-primary"></i> / <b>4</b> = Sangat Baik</li>
    </ul>
  </div>

  <form id="kuesionerForm" 
        action="{{ isset($user) 
          ? route('kuesioner.simpan.multi', ['user' => $user->id]) 
          : route('kuesioner.simpan') }}" 
        method="POST">
    @csrf

    @foreach($questions as $index => $q)
      <div class="jawaban fade-in" style="transition-delay: {{ $index * 0.15 }}s;">
        <p class="fw-semibold">{{ $index+1 }}. {{ $q->pertanyaan }}</p>

        @if($q->tipe_jawaban == 'emoji4')
          <div class="d-flex gap-1">
            @for($i=1; $i<=4; $i++)
              <label>
                <input type="radio" name="jawaban[{{ $q->id }}]" value="{{ $i }}" class="d-none"
                       {{ (isset($jawabanLama[$q->id]) && $jawabanLama[$q->id] == $i) ? 'checked' : '' }}>
                @if($i==1)
                  <i class="bi bi-emoji-angry text-danger emoji" data-bs-toggle="tooltip" title="Tidak Baik"></i>
                @elseif($i==2)
                  <i class="bi bi-emoji-neutral text-warning emoji" data-bs-toggle="tooltip" title="Kurang Baik"></i>
                @elseif($i==3)
                  <i class="bi bi-emoji-smile text-success emoji" data-bs-toggle="tooltip" title="Baik"></i>
                @elseif($i==4)
                  <i class="bi bi-emoji-laughing text-primary emoji" data-bs-toggle="tooltip" title="Sangat Baik"></i>
                @endif
              </label>
            @endfor
          </div>
        @elseif($q->tipe_jawaban == 'skala4')
          <div class="d-flex gap-3">
            @for($i=1; $i<=4; $i++)
              <label>
                <input type="radio" name="jawaban[{{ $q->id }}]" value="{{ $i }}" class="d-none"
                       {{ (isset($jawabanLama[$q->id]) && $jawabanLama[$q->id] == $i) ? 'checked' : '' }}>
                <span class="angka" data-bs-toggle="tooltip"
                      title="@if($i==1)Tidak Baik @elseif($i==2)Kurang Baik @elseif($i==3)Baik @else Sangat Baik @endif">
                  {{ $i }}
                </span>
              </label>
            @endfor
          </div>
        @endif
      </div>
    @endforeach

    <div class="text-center fade-in">
      <button type="submit" id="confirmBtn" class="btn btn-primary">Konfirmasi</button>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Klik EMOJI
  document.querySelectorAll('.emoji').forEach(el => {
    el.addEventListener('click', function() {
      let parent = this.closest('label');
      parent.querySelector('input[type=radio]').checked = true;
      parent.closest('.d-flex').querySelectorAll('.emoji').forEach(e => e.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Klik ANGKA
  document.querySelectorAll('.angka').forEach(el => {
    el.addEventListener('click', function() {
      let parent = this.closest('label');
      parent.querySelector('input[type=radio]').checked = true;
      parent.closest('.d-flex').querySelectorAll('.angka').forEach(e => e.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Tooltip bootstrap
  document.addEventListener("DOMContentLoaded", () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].forEach(el => new bootstrap.Tooltip(el, { container: 'body' }));
  });

  // Animasi fade-in hanya sekali
  document.addEventListener("DOMContentLoaded", function() {
    const fadeElements = document.querySelectorAll('.fade-in');
    const sudahFadeIn = sessionStorage.getItem('sudahFadeIn');

    if (!sudahFadeIn) {
      fadeElements.forEach((el, i) => {
        setTimeout(() => el.classList.add('show'), 150 * i);
      });
      sessionStorage.setItem('sudahFadeIn', 'true');
    } else {
      fadeElements.forEach(el => el.classList.add('show'));
    }
  });

  // Validasi sebelum submit
  document.getElementById('kuesionerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let totalPertanyaan = document.querySelectorAll('.jawaban').length;
    let unanswered = 0;

    document.querySelectorAll('.jawaban').forEach((block) => {
      let radios = block.querySelectorAll('input[type="radio"]');
      let checked = false;
      radios.forEach(r => { if (r.checked) checked = true; });
      if (!checked) { unanswered++; }
    });

    if (unanswered > 0) {
      let pesan = unanswered === totalPertanyaan 
        ? 'Anda belum merespon semua pertanyaan' 
        : 'Anda belum merespon ' + unanswered + ' pertanyaan';
      Swal.fire({ icon: 'warning', title: 'Oops...', text: pesan, confirmButtonText: 'Lanjutkan Mengisi Survey' });
    } else {
      this.submit();
    }
  });

  // SweetAlert setelah submit sukses
  @if(session('success'))
    Swal.fire({
      title: 'Terima Kasih!',
      text: '{{ session('success') }}',
      icon: 'success',
      confirmButtonText: 'Lanjutkan Mengisi Survey'
    }).then((result) => {
      if (result.isConfirmed) {
        sessionStorage.setItem('sudahFadeIn', 'true'); // 🔥 Pastikan tidak animasi ulang
        window.location.href = "{{ route('kuesioner.multi', ['user' => $user->id]) }}";
      }
    });
  @endif
</script>
</body>
</html>

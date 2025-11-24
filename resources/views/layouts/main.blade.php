<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Survey Kepuasan Masyarakat')</title>

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

    /* Navbar persis seperti halaman utama */
    nav.navbar {
      height: 80px;
      border-bottom: 1px solid #dee2e6;
    }

    .navbar-brand img {
      width: 50px;
      height: 50px;
    }

    .navbar .btn {
      border-radius: 50px;
      padding: 8px 20px;
    }

    @media (max-width: 992px) {
      .navbar>.container,
      .navbar>.container-fluid {
        display: flex;
        flex-wrap: inherit;
        align-items: center;
        margin-top: -8px;
        justify-content: space-between;
      }
    }

    @yield('style')
  </style>

  @yield('extra-style')
</head>
<body>

<!-- Navbar (sama persis seperti halaman utama) -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom px-4 py-3" style="height:80px;">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center fw-semibold fs-5" href="#" style="margin-left: 20px;">
      <img src="{{ asset('image/logo_survey.png') }}" class="me-2" alt="Logo">
      IKM
    </a>
    <div class="d-flex ms-auto" style="margin-right: 20px;">
      <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3">Login</a>
    </div>
  </div>
</nav>

<!-- Konten halaman -->
@yield('content')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Kepuasan Masyarakat</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  @stack('styles')

  <style>

    .breadcrumb {
      font-size: 25px;
      background: #fff;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: #f8f9fa;
    }

    /* NAVBAR dari halaman utama */
    nav.navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 80px;
      background-color: #ffffff !important;
      border-bottom: 1px solid #ddd;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      z-index: 1100;
      padding: 0.75rem 1.25rem;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      font-weight: 600;
      font-size: 1.3rem;
      color: #000;
      text-decoration: none;
    }

    .navbar-brand img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }

    .btn-logout {
      background-color: #dc3545;
      color: #fff;
      border: none;
      transition: background 0.2s ease;
      border-radius: 50px;
      padding: 8px 20px;
      font-weight: 500;
    }

    .btn-logout:hover {
      background-color: #b02a37;
      color: white;
    }

    /* SIDEBAR */
    .sidebar-desktop {
      position: fixed;
      top: 80px;
      left: 0;
      width: 240px;
      height: calc(100vh - 80px);
      background: linear-gradient(180deg, #ffffff, #f8f9fa);
      border-right: 1px solid #e0e0e0;
      padding-top: 1rem;
      overflow-y: auto;
      z-index: 1000;
      transition: all 0.3s ease;
    }

    .sidebar-desktop a {
      position: relative;
      display: flex;
      align-items: center;
      padding: 12px 20px;
      margin: 5px 12px;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 500;
      color: #495057;
      text-decoration: none;
      transition: all 0.25s ease;
    }

    .sidebar-desktop a i {
      font-size: 18px;
      margin-right: 12px;
      transition: all 0.25s ease;
    }

    .sidebar-desktop a:hover {
      background: #f5f7fb;
      color: #0d6efd;
      transform: translateX(4px);
    }

    .sidebar-desktop a:hover i {
      color: #0d6efd;
      transform: scale(1.1);
    }

    .sidebar-desktop a::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background: linear-gradient(180deg, #0d6efd, #5a9bff);
      border-radius: 0 4px 4px 0;
      transform: scaleY(0);
      transition: transform 0.3s ease;
    }

    .sidebar-desktop a.active {
      background: #e0ecff;
      color: #0d6efd !important;
      font-weight: 600;
    }

    .sidebar-desktop a.active i {
      color: #0d6efd;
    }

    .sidebar-desktop a.active::before {
      transform: scaleY(1);
    }

    .content {
      margin-left: 240px;
      padding: 20px;
      margin-top: 80px;
      opacity: 0;
      transform: translateY(15px);
      animation: fadeSlideIn 0.6s ease forwards;
    }

    @keyframes fadeSlideIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    #offcanvasSidebar {
      background-color: #fff;
      color: #333;
    }

    #offcanvasSidebar .nav-link {
      color: #333;
      font-weight: 500;
      padding: 10px 15px;
    }

    #offcanvasSidebar .nav-link:hover {
      background-color: #f0f0f0;
      border-radius: 8px;
    }

    

    @media (max-width: 991.98px) {
      .content {
        margin-left: 0;
      }

      .navbar-brand {
    display: flex;
    align-items: center;
    font-weight: 600;
    font-size: 1.3rem;
    color: #000;
    text-decoration: none;
    margin-left: -5px;
    }

    [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}

.navbar-brand img
 {
    width: 45px;
    height: 45px;
    margin-right: 10px;
}

    

    .breadcrumb {
      font-size: 25px;
      background: #fff;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    }

  
  </style>
</head>
<body>

<!-- Navbar (tampilan seperti halaman utama, tapi fungsi logout) -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom">
  <div class="container-fluid px-4">
    <button class="btn btn-outline-secondary d-lg-none me-3" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
      <i class="bi bi-list"></i>
    </button>

    <a class="navbar-brand fw-semibold" href="#">
      <img src="{{ asset('image/logo_survey.png') }}" alt="Logo">
      IKM
    </a>

    <div class="d-flex ms-auto align-items-center">
      <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="mb-0">
        @csrf
        <button type="button" id="btnLogout" class="btn btn-logout">
          Log-Out
        </button>
      </form>
    </div>
  </div>
</nav>

@php
  $slug = auth()->check() ? auth()->user()->slug : '';
@endphp

<!-- Sidebar Desktop -->
<div class="sidebar-desktop d-none d-lg-block">
  <a href="{{ route('admin.personal.dashboard', ['slug' => $slug]) }}" 
     class="{{ request()->routeIs('admin.personal.dashboard') ? 'active' : '' }}">
    <i class="bi bi-grid-3x3-gap-fill"></i> Dashboard
  </a>

  <a href="{{ route('admin.personal.questions.index', ['slug' => $slug]) }}" 
   class="{{ Str::contains(request()->path(), 'questions') ? 'active' : '' }}">
    <i class="bi bi-journal-text"></i> Kuesioner
</a>



  <a href="{{ route('admin.personal.responden', ['slug' => $slug]) }}" 
     class="{{ request()->routeIs('admin.personal.responden') ? 'active' : '' }}">
    <i class="bi bi-people-fill"></i> Responden
  </a>

  <a href="{{ route('admin.personal.grafik.total', ['slug' => $slug]) }}" 
   class="{{ request()->routeIs('admin.personal.grafik.total') || request()->routeIs('admin.grafik.total') ? 'active' : '' }}">
    <i class="bi bi-bar-chart"></i> Grafik
  </a>

  <a href="{{ route('admin.personal.surveys.index', ['slug' => $slug]) }}" 
   class="{{ request()->routeIs('admin.personal.surveys.*') || request()->routeIs('admin.surveys.*') ? 'active' : '' }}">
   <i class="bi bi-gear-fill"></i> Setting
  </a>

</div>

<!-- Sidebar Mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-semibold">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.personal.dashboard', ['slug' => $slug]) }}" 
           class="nav-link {{ request()->routeIs('admin.personal.dashboard') ? 'active' : '' }}">
          <i class="bi bi-ui-checks-grid me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.personal.questions.index', ['slug' => $slug]) }}" 
           class="nav-link {{ request()->routeIs('admin.personal.questions.*') ? 'active' : '' }}">
          <i class="bi bi-journal-text"></i> Kuesioner
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.personal.responden', ['slug' => $slug]) }}" 
           class="nav-link {{ request()->routeIs('admin.personal.responden') ? 'active' : '' }}">
          <i class="bi bi-people-fill me-2"></i> Responden
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.personal.grafik.total', ['slug' => $slug]) }}" 
        class="nav-link {{ request()->routeIs('admin.personal.grafik.total') || request()->routeIs('admin.grafik.total') ? 'active' : '' }}">
        <i class="bi bi-bar-chart"></i> Grafik
        </a>

      </li>
      <li class="nav-item">
        <a href="{{ route('admin.personal.surveys.index', ['slug' => $slug]) }}" 
   class="nav-link {{ request()->routeIs('admin.personal.surveys.*') || request()->routeIs('admin.surveys.*') ? 'active' : '' }}">
   <i class="bi bi-gear-fill"></i> Setting
</a>

      </li>
    </ul>
  </div>
</div>

<!-- Content -->
<div class="content">
  @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Logout SweetAlert -->
<script>
document.getElementById('btnLogout').addEventListener('click', function () {
  Swal.fire({
    title: 'Yakin ingin keluar?',
    text: "Sesi Anda akan berakhir.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, Logout',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('logoutForm').submit();
    }
  });
});
</script>

@stack('modals')
@stack('scripts')
</body>
</html>

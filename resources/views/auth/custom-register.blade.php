<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
      * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

      body {
        display: flex; justify-content: center; align-items: center;
        min-height: 100vh; background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
      }

      /* 🔧 Hilangkan ikon mata bawaan browser */
input::-ms-reveal,
input::-ms-clear {
  display: none;
}

input[type="password"]::-webkit-credentials-auto-fill-button,
input[type="password"]::-webkit-clear-button,
input[type="password"]::-webkit-reveal {
  display: none !important;
  appearance: none;
}


      .container {
        position: relative; width: 420px; background: #fff;
        border-radius: 30px; box-shadow: 0 8px 30px rgba(0, 0, 0, .15);
        padding: 40px; animation: fadeInUp 0.8s ease-in-out;
      }

      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
      }

      h1.judul {
        text-align: center; font-family: 'Righteous', cursive; font-size: 36px;
        margin-bottom: 25px; color: #333; font-weight: 700;
      }

      .input-box { position: relative; margin: 20px 0; }

      .input-box input {
        width: 100%; padding: 13px 50px 13px 20px;
        background: #f5f5f5; border-radius: 10px; border: none;
        font-size: 16px; color: #333; font-weight: 500;
        box-shadow: inset 0 0 0 1px #ddd; transition: all 0.3s ease;
      }

      .input-box input:focus {
        background: #fff; box-shadow: 0 0 8px rgba(116,148,236,0.4); transform: scale(1.02);
      }

      .input-box i {
        position: absolute; right: 20px; top: 50%; transform: translateY(-50%);
        font-size: 20px; color: #888; transition: color 0.3s;
        cursor: pointer;
      }

      .input-box input:focus + i { color: #7494ec; }

      .input-box small.text-danger {
        position: absolute; left: 2px; bottom: -18px;
        font-size: 12px; color: #e74a3b;
      }

      .btn {
        width: 100%; height: 48px; background: #7494ec; border-radius: 10px;
        border: none; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600;
        transition: all 0.3s ease;
      }

      .btn:hover {
        background: #5e7de0 !important; box-shadow: 0 8px 18px rgba(116,148,236,0.4);
        transform: translateY(-2px);
      }

      p.text-center a { color: #7494ec; text-decoration: none; font-weight: 600; }
      p.text-center a:hover { text-decoration: underline; }

      @media (max-width: 992px) {
        .container { width: 85%; }
      }
    </style>
  </head>

  <body>
    <div class="container">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="judul">REGISTER</h1>

        <div class="input-box">
          <input type="text" name="name" placeholder="Nama Perusahaan" value="{{ old('name') }}" required>
          <i class="bi bi-person-fill"></i>
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="input-box">
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
          <i class="bi bi-envelope-fill"></i>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

  <div class="input-box">
  <input 
    type="password" 
    name="password" 
    id="password"
    placeholder="Password" 
    required 
    autocomplete="new-password">
  <i class="bi bi-eye-slash-fill toggle-password" data-target="password"></i>
  @error('password') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="input-box">
  <input 
    type="password" 
    name="password_confirmation" 
    id="password_confirmation"
    placeholder="Konfirmasi Password" 
    required 
    autocomplete="new-password">
  <i class="bi bi-eye-slash-fill toggle-password" data-target="password_confirmation"></i>
</div>

        <button type="submit" class="btn">Daftar</button>

        <p class="text-center mt-3">Sudah punya akun?
          <a href="{{ route('login') }}">Login di sini</a>
        </p>
      </form>
    </div>

    <!-- Bootstrap + SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ Toggle Password Visibility -->
<script>
  // Ambil semua ikon mata
  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const targetId = icon.getAttribute('data-target');
      const input = document.getElementById(targetId);
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      icon.classList.toggle('bi-eye-fill');
      icon.classList.toggle('bi-eye-slash-fill');
    });
  });
</script>

    <!-- ✅ Kosongkan hanya saat validasi gagal -->
    @if ($errors->any())
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[name="password"]').value = '';
        document.querySelector('input[name="password_confirmation"]').value = '';
      });
    </script>
    @endif

    @if(session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
      });
    </script>
    @endif
  </body>
</html>

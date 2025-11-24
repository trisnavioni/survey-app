<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
      * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
      body {
        display: flex; justify-content: center; align-items: center;
        min-height: 100vh; background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
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
      }
      .input-box input:focus + i { color: #7494ec; }
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
        .container {
          width: 85%;
        }
      }

      input::-ms-reveal,
      input::-ms-clear { display: none; }
      input[type="password"]::-webkit-credentials-auto-fill-button,
      input[type="password"]::-webkit-clear-button,
      input[type="password"]::-webkit-reveal {
        display: none !important;
        appearance: none;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <h1 class="judul">LOGIN</h1>

        <div class="input-box">
          <input 
            type="email" 
            name="email" 
            placeholder="Email" 
            value="{{ session('registered_email') ?? '' }}" 
            autocomplete="off"
            id="emailField"
            required>
          <i class="bi bi-envelope-fill"></i>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="input-box">
          <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            id="passwordField"
            autocomplete="new-password"
            required>
          <i class="bi bi-eye-slash-fill toggle-password" data-target="passwordField"></i>
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn">Login</button>

        <p class="text-center mt-3">Belum punya akun?
          <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('login_error') === 'EMAIL_TIDAK_TERDAFTAR')
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Email Tidak Terdaftar',
        text: 'Pastikan Anda memasukkan email yang benar.'
      });
    </script>
    @endif

    @if(session('login_error') === 'PASSWORD_SALAH')
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Password Salah',
        text: 'Silakan periksa kembali kata sandi Anda.'
      });
    </script>
    @endif

    @if(session('login_error') === 'BUKAN_ADMIN')
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Akses Ditolak',
        text: 'Hanya admin yang dapat login.'
      });
    </script>
    @endif

    <script>
      window.onload = function() {
        const emailField = document.getElementById('emailField');
        const passwordField = document.getElementById('passwordField');

        @if(!session('registered_email'))
          emailField.value = '';
        @endif

        passwordField.value = '';
      };
    </script>

    <script>
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
  </body>
</html>

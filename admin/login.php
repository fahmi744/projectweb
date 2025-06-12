<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>::. Login Administrator .::</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      html, body {
        height: 100%;
        font-family: 'Poppins', sans-serif;
        background: #F2F5F9;
        color: #333;
      }

      .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 1rem;
      }

      .login-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem 2rem 3rem;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        animation: zoomIn 0.6s ease forwards;
      }

      @keyframes zoomIn {
        from {
          opacity: 0;
          transform: scale(0.9);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }

      h3 {
        text-align: center;
        margin-bottom: 2rem;
        font-weight: 600;
        font-size: 1.75rem;
        color: #222;
      }

      label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: #555;
      }

      input[type="email"],
      input[type="password"] {
        background: #f9f9f9;
        border: 1.5px solid #ccc;
        border-radius: 12px;
        padding: 0.85rem 1.2rem;
        font-size: 1rem;
        width: 100%;
        margin-bottom: 1.25rem;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
      }

      input:focus {
        outline: none;
        border-color: #4e91fc;
        box-shadow: 0 0 8px rgba(78, 145, 252, 0.3);
        background: #fff;
      }

      .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
      }

      .btn-custom {
        background: #4e91fc;
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        cursor: pointer;
        flex: 1;
        transition: background 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(78, 145, 252, 0.3);
      }

      .btn-custom:hover {
        background: #2e75e0;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(46, 117, 224, 0.5);
      }

      .btn-reset {
        background: #f0f0f0;
        border: none;
        color: #555;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        cursor: pointer;
        flex: 1;
        transition: background 0.3s ease;
      }

      .btn-reset:hover {
        background: #e0e0e0;
      }

      .swal2-popup {
        font-family: 'Poppins', sans-serif !important;
        background: #ffffff !important;
        color: #333 !important;
        border-radius: 16px !important;
        padding: 2rem !important;
      }

      .swal2-title {
        font-weight: 700;
        font-size: 1.7rem;
      }

      @media (max-width: 480px) {
        .login-card {
          padding: 2rem 1.5rem 2.5rem;
        }

        .button-group {
          flex-direction: column;
        }
      }
    </style>
  </head>

  <body>
    <div class="wrapper">
      <div class="login-card">
        <h3><i class="fas fa-user-lock"></i>Masukan Akun</h3>
        <form id="loginForm" method="post" action="proses-login.php">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Masukan Email" required>

          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Masukan Password" required>

          <div class="button-group">
            <button type="submit" class="btn-custom"><i class="fas fa-sign-in-alt"></i> Login</button>
            <button type="button" class="btn-reset" onclick="window.location.href='../index.php'">
              <i class="fas fa-undo"></i> Batal
            </button>
          </div>
        </form>
        <p style="margin-top: 1rem; text-align: center;">
          Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>
      </div>
    </div>

    <!-- JS Font Awesome -->
    <script src="../assets/font-awesome/js/all.min.js"></script>

    <script>
      document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.email.value.trim();
        const pass  = this.password.value.trim();

        if (!email || !pass) {
          return Swal.fire({
            title: 'Oops...',
            text: 'Email dan Password tidak boleh kosong!',
            icon: 'warning',
            customClass: { popup: 'animate__animated animate__fadeInDown' }
          });
        }

        const controller = new AbortController();
        const timeoutId  = setTimeout(() => controller.abort(), 5000);

        const body = new URLSearchParams({ email, password: pass });

        fetch(this.action, {
          method: this.method.toUpperCase(),
          body,
          signal: controller.signal
        })
        .then(res => {
          clearTimeout(timeoutId);
          if (!res.ok) throw new Error('HTTP ' + res.status);
          return res.json();
        })
        .then(data => {
          if (data.success) {
            return Swal.fire({
              icon: 'success',
              title: 'Login Berhasil',
              showConfirmButton: false,
              timer: 1200
            }).then(() => window.location.href = 'dashboard.php');
          }
          return Swal.fire({
            title: '<strong>Login <u>Gagal</u></strong>',
            html: data.message || 'Email atau password salah.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Coba Lagi',
            cancelButtonText: 'Batal',
            customClass: {
              popup: 'animate__animated animate__shakeX',
              confirmButton: 'swal2-confirm',
              cancelButton: 'swal2-cancel'
            },
            backdrop: 'rgba(34,40,49,0.8) no-repeat'
          }).then(result => {
            if (result.isConfirmed) this.reset();
          });
        })
        .catch(err => {
          const isTimeout = err.name === 'AbortError';
          Swal.fire({
            icon: 'error',
            title: isTimeout ? 'Timeout!' : 'Error',
            text: isTimeout
              ? 'Server tidak merespon dalam 5 detik. Coba lagi nanti.'
              : 'Gagal terhubung ke server.',
            confirmButtonText: 'OK',
            customClass: { popup: 'animate__animated animate__fadeInDown' }
          });
        });
      });
    </script>
  </body>
</html>

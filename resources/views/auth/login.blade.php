<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>ingresar</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/icon/logo.jpg') }}" rel="icon">
  <link href="{{ asset('assets/img/icon/logo.jpg') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fonts/css/all.css') }}">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/jquery-3.3.1.js') }}"></script>
</head>
<body>
<div id="spinner-overlay">
    <div class="spinner"></div>
</div>
<div class="container-fluid vh-100">
    <div class="row vh-100 justify-content-stretch">
        <div class="col-12 col-lg-5 col-sm-6 h-100 d-flex justify-content-center align-items-center">
                <div class="container p-3" style="max-width: 450px;">
                    @if(session('success'))
                        <div class="p-4 text-center fw-bold bg-light">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="p-4 text-center text-white fw-bold" style="background: red;">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('confirm'))
                        <div class="p-4 text-center text-white fw-bold" style="background: #0caf0c;">
                            {{ session('confirm') }}
                        </div>
                    @endif

                    <h4 class="text-center mb-4">Iniciar Sesión</h4>

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email"
                                    class="@error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus placeholder="Dirección de correo electrónico">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="field">
                            <label for="password">Contraseña</label>
                            <div class="input-wrap">
                            <input id="passwordInput" name="password" type="password" placeholder="Contraseña" autocomplete="current-password" required aria-describedby="pwdHelp" class="@error('password') is-invalid @enderror">
                            <button type="button" class="icon-btn" id="togglePassword" aria-label="Mostrar contraseña" title="Mostrar contraseña">
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
                            {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input"  {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-check-label">Recordarme</label>
                        </div>
                        <div class="mb-3">
                             <button type="submit" class="rounded-pill btn-shop-submit w-100 py-3">Ingresar</button>
                        </div>

                        <p class="text-center mb-3">
                            ¿No tienes una cuenta?
                            <a href="{{ route('users.create') }}">Regístrate aquí</a>
                        </p>

                        <p class="text-center">
                            <a href="{{ route('shop.index') }}"  class="text-info">volver al inicio</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="flex-grow-1 col-sm-6 col-lg-7 p-4 d-none d-sm-flex justify-content-center align-items-center loginIcon">
                <img src="{{ asset('assets/img/profile/logo.png') }}" class="img-fluid" alt="logo">
            </div>
    </div>
</div>

{!! NoCaptcha::renderJs() !!}

<script>
    // Capturar los elementos del DOM
const togglePassword = document.querySelector('#togglePassword');
const passwordInput = document.querySelector('#passwordInput');
const icon = togglePassword.querySelector('i');

// Añadir un listener de eventos al icono para detectar clics
togglePassword.addEventListener('click', function (e) {
    // Alternar el tipo del input entre 'password' y 'text'
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Alternar la clase del icono para cambiar el diseño del ojo
    icon.classList.toggle('fa-eye-slash');
    icon.classList.toggle('fa-eye');
});
</script>
<script src="{{ asset('assets/js/loader.js') }}"></script>
</body>
</html>
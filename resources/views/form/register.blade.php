<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Registrarse</title>
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
<body class="loginIcon">
<div class="container-fluid vh-100">
    <div class="row vh-100 justify-content-stretch">
        <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="container p-3">
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

                    <div class="card p-4">

                    <h4 class="text-center mb-4">Registrarse</h4>

                    <form method="POST" action="{{ route('users.store') }}" class="row">
                            @csrf

                            <div class="col-12 col-md-6 p-3">
                                <input type="text" style="text-transform: uppercase;" name="name" placeholder="Nombre" required
                                    class="@error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="text" style="text-transform: uppercase;" name="lastName" placeholder="Apellido" required
                                    class="@error('lastName') is-invalid @enderror"
                                    value="{{ old('lastName') }}">
                                @error('lastName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 p-3">
                                <input type="phone" name="phone" placeholder="teléfono o celular" required
                                    class="@error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="email" name="email" placeholder="Correo electrónico" required
                                    class="@error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="password" name="password" placeholder="Contraseña" required
                                    class="@error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required
                                    class="form-control">
                            </div>

                            <div class="col-12 p-3">
                                <input type="text" name="direccion" placeholder="Dirección"
                                    class="@error('direccion') is-invalid @enderror"
                                    value="{{ old('direccion') }}">
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="text" name="ciudad" placeholder="Ciudad"
                                    class="@error('ciudad') is-invalid @enderror"
                                    value="{{ old('ciudad') }}">
                                @error('ciudad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3">
                                <input type="text" name="departamento" placeholder="Departamento"
                                    class="@error('departamento') is-invalid @enderror"
                                    value="{{ old('departamento') }}">
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 p-3 d-none">
                                <input type="text" name="pais" placeholder="País"
                                    class="@error('pais') is-invalid @enderror"
                                    value="{{ old('pais') }}">
                                @error('pais')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="ubicacion-mensaje" class="php-email-form"></div>

                            <input type="hidden" name="latitud" id="latitud">
                            <input type="hidden" name="longitud" id="longitud">



                            <div class="col-12 mb-3">
                                <div id="not">

                                </div>

                            


                            </div>


                            <div class="col-12 mb-3">
                                <button type="submit" class="rounded-pill btn-shop-submit w-100 py-3">Registrarse</button>
                            </div>
                            <p class="text-center">
                                ¿tienes una cuenta?
                                <a href="{{ route('login') }}">inicia sesión aquí</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mensajeDiv = document.getElementById('ubicacion-mensaje');
        const latitudInput = document.getElementById('latitud');
        const longitudInput = document.getElementById('longitud');

        function solicitarUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        latitudInput.value = position.coords.latitude;
                        longitudInput.value = position.coords.longitude;

                        mensajeDiv.innerHTML = "<p class='sent-message d-block text-success'>Tu ubicación fue detectada correctamente.</p>";
                        
                            const latitud = latitudInput.value;
                            const longitud = longitudInput.value;
                            let urlMapa;

                            if (!latitud || !longitud || latitud.trim() === "" || longitud.trim() === "") {
                            //urlMapa = "https://maps.google.com/maps?q=0,0&z=1&output=embed";
                            $('#not').html('<div class="bg-danger text-white p-3 text-center">NO ESTA REGISTRADO SU LOCALIZACION</div>');

                            } else {
                                const lat = parseFloat(latitud);
                                const lon = parseFloat(longitud);

                                if (isNaN(lat) || isNaN(lon)) {
                                    //urlMapa = "https://maps.google.com/maps?q=0,0&z=1&output=embed";
                                    $('#not').html('<div class="bg-danger text-white p-3 text-center">NO ESTA REGISTRADO SU LOCALIZACION</div>');
                                } else {
                                    let urlMapa = `https://maps.google.com/maps?q=${lat},${lon}&z=15&output=embed`;
                                    let ifra = '<div class="d-flex justify-content-center overflow-x-auto">';
                                    ifra += '<iframe ';
                                    ifra += 'width="600" ';
                                    ifra += 'height="450" ';
                                    ifra += 'style="border:0;" ';
                                    ifra += 'allowfullscreen ';
                                    ifra += 'loading="lazy" ';
                                    ifra += 'referrerpolicy="no-referrer-when-downgrade" ';
                                    ifra += 'src="' + urlMapa + '" ';
                                    ifra += '></iframe>';
                                    ifra += '</div>';

                                    $('#not').html(ifra);
                                }
                            }



                    },
                    function (error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            mensajeDiv.innerHTML = "<p class='error-message d-block text-danger'>⚠️ No proporcionaste acceso a tu ubicación. Esto nos ayuda a realizar entregas a domicilio.</p>";
                            
                        } else {
                            mensajeDiv.innerHTML = "<p class='error-message d-block text-danger'>⚠️ Error al obtener la ubicación. Intenta nuevamente.</p>";
                        }
                    }
                );
            } else {
                mensajeDiv.innerHTML = "<p class='text-danger'>🚫 Tu navegador no admite geolocalización.</p>";
            }
        }

        solicitarUbicacion();

        const form = document.querySelector("form");
        const submitButton = form.querySelector("button[type='submit']");

        form.addEventListener("submit", function () {
            submitButton.disabled = true;
            submitButton.innerText = "Procesando...";
        });
    
    });
</script>

</body>
</html>
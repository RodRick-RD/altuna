<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>NATURAL TUNAS</title>
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
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/jquery-3.3.1.js') }}"></script>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">NATURALTUNAS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#inicio" class="active">Inicio</a></li>
          <li><a href="#nuestros-productos">Nuestros Productos</a></li>
          <li><a href="#contact">Contactos</a></li>
          <li><a href="{{ route('login') }}">iniciar sesión</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links position-relative d-inline-block">
        <a class="position-relative" onclick="MostrarCarrito()">
          <i class="h4 bi bi-cart3"></i>
          <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidadCarrito">
            0
          </span> -->
        </a>
      </div>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="inicio" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h2>NATURAL TUNAS</h2>
            <p class="lead">atrévete y experimenta nuevos productos hechos a base de <b>"Tunas"</b>.</p>
            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
              <a href="#nuestros-productos" class="btn btn-primary">Ver productos</a>
              <a href="#contact" class="btn btn-outline">contáctate</a>
            </div>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
              <div class="stat-item">
                <span class="stat-number">1+</span>
                <span class="stat-label">año de experiencia</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">100+</span>
                <span class="stat-label">pedidos atendidos</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">clientes satisfechos</span>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image">
              <img src="{{ asset('assets/img/profile/logo.png') }}" alt="logo Image" class="img-fluid" data-aos="zoom-out" data-aos-delay="300">
              <div class="shape-1"></div>
              <div class="shape-2"></div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Section -->


    <!-- Portfolio Section -->
    <section id="nuestros-productos" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>NUESTROS PRODUCTOS</h2>
        <div class="title-shape">
          <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
          </svg>
        </div>
        <p>conoce y experimenta a lo máximo.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="portfolio-filters-container" data-aos="fade-up" data-aos-delay="200">
            <ul class="portfolio-filters isotope-filters">
              <li data-filter="*" class="filter-active">Todos los productos</li>
              <li data-filter=".filter-licor">LICORES</li>
              <li data-filter=".filter-coctel">COCTEL</li>
              <li data-filter=".filter-mermelada">MERMELADAS</li>
            </ul>
          </div>

          <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

          @foreach ($productos as $product)
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-{{ $product->categoria->categoria }}">
              <div class="portfolio-card">
                <div class="portfolio-image">
                  <img src="{{ $product->img }}" class="img-fluid" alt="" loading="lazy">
                  <div class="portfolio-overlay">
                    <div class="portfolio-actions">
                      <a href="{{ $product->img }}" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a>
                      <!-- <a href="producto.php?producto={{ $product->id }}" class="details-link"><i class="bi bi-arrow-right"></i></a> -->
                    </div>
                  </div>
                </div>
                <div class="portfolio-content">
                  <span class="category">{{ $product->categoria->categoria }}</span>
                  <h3>{{ $product->nombre }}</h3>
                  <p class="fw-bold" style="font-size: 2rem;">bs. {{ $product->descuento }}<?php //if($fila['descuento']>0){ echo (int)$fila['descuento']; }else{ echo (int)$fila['precio'];} ?></p>
                  <div class="d-flex justify-content-between gap-2 align-items-center">
                    <p><span class="info-descuento p-2 text-white fw-bold"> antes Bs. {{ $product->precio }}</span><?php //if($fila['descuento']>0){ echo '<span class="bg-warning p-2 text-white fw-bold"> antes Bs. '.(int)$fila["precio"].'</span>'; } ?></p>
                    <button class="btn btn-warning rounded-pill btn-agregar" data-id="{{ $product->id }}">Agregar</button>
                  </div>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            @endforeach

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>LO MEJOR PARA TI</h2>
        <div class="title-shape">
          <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
          </svg>
        </div>
        <p class="text-secondary">Nos esforzamos para entregarte productos de la mejor calidad.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="testimonials-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "slidesPerView": 1,
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>

          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-12 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="assets/img/proccess/tuna1.jpeg" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-12 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="assets/img/proccess/tuna2.jpeg" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-12 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="assets/img/proccess/tuna3.jpg" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Item -->

          </div>

          <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Preguntas frecuentes</h2>
        <div class="title-shape">
          <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
          </svg>
        </div>
        <!-- <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur vel illum qui dolorem</p> -->
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">
              <div class="faq-item">
                <h3>¿ Es bueno consumir licor de tunas ?</h3>
                <div class="faq-content">
                  <p>Un licor artesanal con siglos de tradición, es una forma perfecta para realzar tus momentos especiales. teniendo conciencia y evitar el consumo excesivo que pone en riesgo tu salud.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->


              <div class="faq-item">
                <h3>¿ tiene beneficios consumir jarabe de tunas ?</h3>
                <div class="faq-content">
                  <p>el jarabe de tuna no es solo un endulzante. Es un producto que aporta el sabor exótico de la tuna, un color vibrante y, lo más importante, una concentración de compuestos antioxidantes y beneficiosos de la fruta original, lo que lo hace una opción interesante para enriquecer tus comidas y bebidas.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->
            </div>



          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5">
          <div class="col-lg-6">
            <div class="content" data-aos="fade-up" data-aos-delay="200">
              <div class="section-category mb-3">Contacto</div>
              <h2 class="display-5 mb-4">ESTAMOS A TU SERVICIO</h2>
              <p class="lead mb-4">envia un mensaje y realiza tu pedido.</p>

              <div class="contact-info mt-5">
                <div class="info-item d-flex mb-3">
                  <i class="bi bi-envelope-at me-3"></i>
                  <span>naturaltunas@gmail.com</span>
                </div>

                <div class="info-item d-flex mb-3">
                  <i class="bi bi-telephone me-3"></i>
                  <span>+591 75908153</span>
                </div>

                <div class="info-item d-flex mb-4">
                  <i class="bi bi-geo-alt me-3"></i>
                  <span>Cercado, Cochabamba, Bolivia</span>
                </div>

                <!-- <a href="#" class="map-link d-inline-flex align-items-center">
                  Open Map
                  <i class="bi bi-arrow-right ms-2"></i>
                </a> -->
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="contact-form card" data-aos="fade-up" data-aos-delay="300">
              <div class="card-body p-4 p-lg-5">

                <form action="{{ route('enviar.mensaje') }}" method="POST" class="php-email-form">
                  @csrf
                  <div class="row gy-4">

                    <div class="col-12">
                      <input type="text" name="name" class="form-control" placeholder="Nombres" required="">
                    </div>

                    <div class="col-12">
                      <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required="">
                    </div>

                    <div class="col-12">
                      <input type="text" class="form-control" name="subject" placeholder="Asunto" required="">
                    </div>

                    <div class="col-12">
                      <textarea class="form-control" name="message" rows="6" placeholder="Mensaje" required=""></textarea>
                    </div>
                    <div class="col-12">
                      <div id="idcontacto"></div>

                    </div>

                    <div class="col-12 text-center">

                      <button type="submit" id="submitBtn" class="btn btn-submit w-100">Enviar mensaje</button>
                    </div>

                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->

 <?php
      //require_once 'carrito.php';
    ?>
    <div id="shop">
    <div id="box-shop">
        <div id="cart">
            <div class="d-flex justify-content-between">
                <h3>🛒 Carrito de Compras</h3>
                <button class="remove-btn" onclick="ocultarCarrito()"><i class="fa-solid fa-xmark"></i></button>

            </div>
            <ul id="cart-items">
                
            </ul>
        </div>
    </div>
</div>
<div id="resultado">

</div>



  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">ABEJITAS</strong> <span>Todos los derechos reservados.</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-tiktok"></i></a>
        <a href="https://www.facebook.com/profile.php?id=61577622187187" target="_blank"><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> -->
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>

  <script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.php-email-form');
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnText = submitBtn.innerHTML;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const mensajeDiv = document.getElementById('idcontacto');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Enviando...`;

        mensajeDiv.innerHTML = ''; // Limpiar mensajes anteriores

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en el servidor');
            return response.json();
        })
        .then(data => {
          $("#idcontacto").html('<div class="bg-success text-center text-white p-3">Mensaje enviado, en breve le llegará un mensaje a su correo.</div>');
            
            form.reset();

            submitBtn.innerHTML = `</span><i class="fa-solid fa-check"></i> Mensaje enviado.`;

            setTimeout(() => {
                $("#idcontacto").html('');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }, 10000);
        })
        .catch(error => {
            $("#idcontacto").html('<div class="bg-danger text-center text-white">Ocurrió un error al enviar el mensaje.</div>');
      
            setTimeout(() => {
                $("#idcontacto").html('');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }, 3000);
        });
    });


    const botones = document.querySelectorAll('.btn-agregar');
    const carritoDiv = document.getElementById('cart-items');

    botones.forEach(boton => {
        boton.addEventListener('click', function () {
            const idProducto = this.dataset.id;

            // Deshabilita temporalmente el botón
            this.disabled = true;
            this.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;

            fetch("{{ route('carrito.agregar') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: idProducto })
            })
            .then(response => response.text())
            .then(html => {
                carritoDiv.innerHTML = html;
                this.disabled = false;
                this.innerHTML = 'Agregar al carrito';
            })
            .catch(() => {
                alert("Error al agregar al carrito.");
                this.disabled = false;
                this.innerHTML = 'Agregar al carrito';
            });
        });
    });

    // Cargar el carrito al iniciar
    fetch("{{ route('carrito.ver') }}")
        .then(res => res.text())
        .then(html => carritoDiv.innerHTML = html);

    

    carritoDiv.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-eliminar');
      if (btn) {
          const id = btn.dataset.id;

          btn.disabled = true;
          btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;

          fetch("{{ route('carrito.eliminar') }}", {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({ id: id })
          })
          .then(res => res.text())
          .then(html => {
              carritoDiv.innerHTML = html;
          })
          .catch(() => {
              alert("Error al eliminar del carrito.");
              btn.disabled = false;
              btn.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
          });
      }
  });


});
</script>

</body>

</html>
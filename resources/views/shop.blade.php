<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ALTUNA</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/icon/logo-altuna.webp') }}" rel="icon">
    <link href="{{ asset('assets/img/icon/logo-altuna.webp') }}" rel="apple-touch-icon">

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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

    <script src="{{ asset('assets/js/jquery-3.3.1.js') }}"></script>
</head>
<body>
        <div class="header">
            <h3>ALTUNA</h3>
            <span class="text-muted"><i class="fa-solid fa-location-dot"></i> Cochabamba</span>
            <ul>
                <li><a href="#inicio" class="active">Inicio</a></li>
                <li><a href="#catalogo">Nuestros Productos</a></li>
                <li><a href="#contact">Contactos</a></li>
            </ul>
            <div class="mr-2">
                <div class="header-social-links position-relative d-inline-block">
                    <a class="position-relative" onclick="MostrarCarrito()">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidadCarrito">
                            0
                        </span>
                    <i class="h4 bi bi-cart3"></i>
                    </a>
                </div>
            </div>
            <div class="mr-2">
                <i class="fa-solid fa-user"></i>
                <a href="{{ route('login') }}">iniciar sesión</a> 
            </div>
        </div>
<div id="inicio">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="{{ asset('assets/img/portfolio/tuna1.jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('assets/img/portfolio/tuna2.jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('assets/img/portfolio/tuna3.jpg') }}" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</div>


    <div class="container">
    
        <div class="py-4">
            <div class="row" id="catalogo">
                <div class="text-center py-4">
                    <h2>NUESTROS PRODUCTOS</h2>
                </div>
                @foreach ($productos as $producto)
                    <div class="col-md-4 mb-4 p-2 position-relative overflow-hidden">
                        
                        <div class="card h-100 shadow-sm border-0">

                            <img src="{{ $producto['img'] }}" 
                                class="card-img-top img-click" 
                                alt="{{ $producto['nombre'] }}" 
                                style="height: 180px; object-fit: cover; cursor:pointer;"
                                data-toggle="modal" 
                                data-target="#imagenModal" 
                                data-img="{{ $producto['img'] }}">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="text-primary-out">{{ $producto['nombre'] }}</h5>
                                
                                <div class="mb-3">
                                    <p class="fw-bold" style="font-size: 2rem;">bs. {{ $producto['descuento'] }}</p>
                                    <div class="d-flex justify-content-between gap-2 align-items-center">
                                        <p><span class="info-descuento p-2 text-white fw-bold"> antes Bs. {{ $producto['precio'] }}</span></p>
                                    </div>
                                </div>
                                
                                <button 
                                    class="btn btn-primary mt-auto anadir-producto" 
                                    data-id="{{ $producto['id'] }}"
                                    
                                >
                                    @if ($producto['stock'] == 0)
                                        🚫 Agotado
                                    @else
                                        🛒 Añadir al Carrito
                                    @endif
                                </button>
                            </div>
                        </div>
                        @if (isset($producto['tipo']) && $producto['tipo'] == 'P')
                                <div class="position-absolute top-0 end-0 z-4">
                                    <span class="ribbon">Promoción</span>
                                </div>
                            @endif
                            @if (isset($producto['tipo']) && $producto['tipo'] == 'N')
                                <div class="position-absolute top-0 end-0 z-index-1">
                                    <span class="ribbon bg-danger">¡ Nuevo !</span>
                                </div>
                            @endif



                    </div>
                @endforeach





                <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <img id="imagenAmpliada" src="" class="img-fluid rounded" alt="Imagen del producto">
                    </div>
                    </div>
                </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#imagenModal').on('show.bs.modal', function (event) {
                            var trigger = $(event.relatedTarget); // el elemento que disparó el modal
                            var imgSrc = trigger.data('img'); // obtenemos la ruta
                            $(this).find('#imagenAmpliada').attr('src', imgSrc);
                        });
                    });
                </script>

            </div>

        </div>

        
    </div>


<div id="shop">
    <div id="box-shop">
        <div id="cart" class="d-flex flex-column">
            <div class="d-flex justify-content-between">
                <h3>🛒 Carrito de Compras</h3>
                <button class="remove-btn" onclick="ocultarCarrito()"><i class="fa-solid fa-xmark"></i></button>

            </div>
            <div id="items-carrito" class="flex-grow-1">
                </div>
        
        <div class="">
             <a href="{{ route('venta.pago') }}"><button class="btn-shop-submit rounded-pill w-100" id="btn-comprar">Comprar</button></a>
        </div>
        </div>
    </div>
</div>
<div id="resultado">

</div>

<footer class="pt-5 pb-4">
  <div class="container">
    <div class="row">

      <!-- Logo y descripción -->
      <div class="col-md-4 mb-4">
        <h5 class="text-warning fw-bold">Altuna</h5>
        <p>Tienda de productos de alta calidad. Descubre nuestras novedades y promociones.</p>
      </div>

      <!-- Enlaces útiles -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase fw-bold mb-3">Enlaces</h6>
        <ul class="list-unstyled">
          <li><a href="#inicio" class="text-decoration-none">Inicio</a></li>
          <li><a href="#catalogo" class="text-decoration-none">Productos</a></li>
          <!-- <li><a href="#contact" class="text-light text-decoration-none">Contacto</a></li> -->
          <li><a href="{{ route('login') }}" class="text-decoration-none">Iniciar sesión</a></li>
        </ul>
      </div>

      <!-- Contacto -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase fw-bold mb-3">Contacto</h6>
        <p class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i>Cochabamba, Bolivia</p>
        <p class="mb-2"><i class="bi bi-telephone-fill me-2"></i>+591 60763676</p>
        <p class="mb-2"><i class="bi bi-envelope-fill me-2"></i>info@altuna.com</p>
      </div>

      <!-- Redes sociales -->
      <div class="col-md-2 mb-4">
        <h6 class="text-uppercase fw-bold mb-3">Redes</h6>
        <a href="https://www.facebook.com/profile.php?id=61577622187187" class="fs-5 me-3"><i class="fab fa-facebook-f"></i></a>
        <a href="" class="fs-5 me-3"><i class="fab fa-instagram"></i></a>
        <a href="" class="fs-5 me-3"><i class="fab fa-whatsapp"></i></a>
        <a href="" class="fs-5"><i class="fab fa-tiktok"></i></a>
      </div>

    </div>

    <hr class="bg-secondary">

    <div class="row">
      <div class="col text-center">
        <p class="mb-0">&copy; 2025 Altuna. Todos los derechos reservados.</p>
      </div>
    </div>

  </div>
</footer>






<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="altuna"
  agent-id="168187b2-41ad-43fc-89f0-4647d20e3e55"
  language-code="es"
></df-messenger>
    
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
      // Archivo app.js (Usando jQuery y LocalStorage)

// 1. Catálogo de Productos (Datos)
const productos = @json($productos ?? []); 

// 2. Estado del Carrito y Clave de LocalStorage
const GUARDAR_CARRITO = 'carritoCompra';
let carrito = [];

// 3. Funciones de Persistencia (LocalStorage) 💾

/**
 * Guarda el estado actual del carrito en localStorage.
 */
function guardarCarrito() {
    localStorage.setItem(GUARDAR_CARRITO, JSON.stringify(carrito));
}

/**
 * Carga el carrito guardado desde localStorage.
 */
function cargarCarrito() {
    const carritoGuardado = localStorage.getItem(GUARDAR_CARRITO);
    
    if (carritoGuardado !== null) {
        // Usa jQuery.extend(true,...) para asegurar que 'carrito' es un array manipulable
        carrito = $.extend(true, [], JSON.parse(carritoGuardado));
    }
}

// 4. Funciones Principales

/**
 * Pinta todos los productos disponibles en el catálogo usando jQuery.
 */
function renderizarCatalogo() {
    const $catalogo = $('#catalogo');
    $catalogo.empty(); // Vaciar antes de pintar

    productos.forEach((info) => {
        const nodoProducto = `
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="${info.img}" class="card-img-top" alt="${info.nombre}" style="height: 180px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="text-primary-out">${info.nombre}</h5>
                        
                        <div class="mb-3">
                            <h4 class="font-weight-bold text-success">$${info.precio.toFixed(2)}</h4>
                            <p class="card-text text-muted mb-0">
                                Stock: <span class="font-weight-bold ${info.stock > 0 ? 'text-success' : 'text-danger'}">${info.stock}</span>
                            </p>
                        </div>
                        
                        <button 
                            class="btn btn-primary mt-auto anadir-producto" 
                            data-id="${info.id}"
                            ${info.stock === 0 ? 'disabled' : ''} 
                        >
                            ${info.stock === 0 ? '🚫 Agotado' : '🛒 Añadir al Carrito'}
                        </button>
                    </div>
                </div>
            </div>
        `;
        $catalogo.append(nodoProducto); // Inyectar al DOM
    });
}

/**
 * Gestiona el evento de añadir un producto al carrito.
 */
function anadirAlCarrito() {
    // Referencia al botón que fue clickeado (usando jQuery)
    const $boton = $(this);
    const textoOriginal = $boton.html(); // Guardamos el contenido HTML original del botón

    const idProducto = parseInt($boton.data('id'));
    
    // Obtener información del producto y su stock
    const productoInfo = productos.find(p => p.id === idProducto);
    
    // Buscar si el producto ya existe en el carrito
    const productoExistente = carrito.find(item => item.id === idProducto);
    
    // Función para manejar el estado del botón durante la carga
    const mostrarCargando = (cargando) => {
        if (cargando) {
            // 1. Deshabilitar
            $boton.prop('disabled', true);
            // 2. Mostrar Spinner y texto "Agregando..."
            $boton.html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Agregando...
            `);
        } else {
            // 3. Habilitar
            $boton.prop('disabled', false);
            // 4. Restaurar texto original
            $boton.html(textoOriginal);
        }
    };
    
    let debeContinuar = false;

    // --- Lógica de control de stock local ---
    if (productoExistente) {
        if (productoExistente.cantidad < productoInfo.stock) {
            productoExistente.cantidad++;
            debeContinuar = true;
        } else {
            alert(`🚫 No puedes añadir más. Stock máximo de ${productoInfo.nombre} es ${productoInfo.stock}.`);
        }
    } else {
        if (productoInfo.stock > 0) {
            carrito.push({
                id: idProducto,
                cantidad: 1
            });
            debeContinuar = true;
        } else {
             alert(`🚫 Producto sin stock disponible.`);
        }
    }

    // --- Si se modificó el carrito local, procedemos con la petición al servidor ---
    if (debeContinuar) {
        
        mostrarCargando(true); // 👈 INICIA EL SPINNER

        fetch("{{ route('carrito.agregar') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                // Nota: Los tokens CSRF son específicos de Laravel y deben estar disponibles globalmente o en el HTML
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ id: productoInfo.id })
        })
        .then(response => {
            // Verifica si la respuesta fue exitosa (código 200-299)
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.text();
        })
        .then(html => {
            // Éxito:
            console.log(`Añadido al carrito: ${productoInfo.nombre}.`);
            // Aquí puedes actualizar la vista del carrito pequeño si el servidor devuelve el HTML
        })
        .catch(error => {
            // Error en la petición (red, servidor, etc.)
            console.error(error);
            alert("Error al agregar al carrito. Inténtalo de nuevo.");
            
            // Opcional: Revertir el cambio local si la API falla
            if (productoExistente && productoExistente.cantidad > 1) {
                productoExistente.cantidad--;
            } else if (!productoExistente) {
                 carrito = carrito.filter(item => item.id !== idProducto);
            }
        })
        .finally(() => {
            mostrarCargando(false); // 👈 DETIENE EL SPINNER Y RESTAURA EL BOTÓN
            renderizarCarrito(); // Actualiza la vista del carrito y el total
            guardarCarrito();    // Guarda el estado del carrito (con o sin reversión)
        });
        
    } else {
        // Si no se pudo añadir por falta de stock (solo actualiza la vista)
        renderizarCarrito();
        guardarCarrito();
    }
}

function renderizarCarrito() {
    const $itemsCarrito = $('#items-carrito');
    $itemsCarrito.empty(); // vaciar antes de pintar

    let cantidadTotal = 0;

    carrito.forEach(item => {
        const productoInfo = productos.find(p => p.id === item.id);

        const tarjeta = $(`
            <div class="card mb-2 d-flex flex-row align-items-center p-2 border-0" data-id="${item.id}">
                <img src="${productoInfo.img}" class="img-fluid" style="width:80px; height:80px; object-fit:cover; margin-right:10px;">
                
                <div class="flex-grow-1">
                    <h6 class="mb-1">${productoInfo.nombre}</h6>
                    <p class="mb-1">Bs. ${productoInfo.precio.toFixed(2)}</p>
                    <div class="input-group input-group-sm" style="max-width:120px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary disminuir" data-id="${item.id}">-</button>
                        </div>
                        <input type="text" class="form-control border-0 text-center cantidad-input" value="${item.cantidad}" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary aumentar" data-id="${item.id}">+</button>
                        </div>
                    </div>
                </div>

                <div class="ml-2 text-right">
                    <p class="mb-1">Bs. ${(productoInfo.precio * item.cantidad).toFixed(2)}</p>
                    <button class="btn btn-outline-danger btn-sm eliminar-producto" data-id="${item.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `);

        $itemsCarrito.append(tarjeta);
        cantidadTotal += item.cantidad;
    });

    $("#cantidadCarrito").text(cantidadTotal);
    calcularTotal();
    if (cantidadTotal > 0) {
        $('#btn-comprar').prop('disabled', false); // desbloqueado
    } else {
        $('#btn-comprar').prop('disabled', true); // bloqueado
        var carempty = `<div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <div>
                        <img src="assets/img/canasta-vacio.png" class="img-fluid" />
                    </div>
                    <p class="text-muted">Carrito vacío</p>
                </div>`;
                
        $('#items-carrito').html(carempty);
    }
}

// Aumentar cantidad
$('#items-carrito').on('click', '.aumentar', function() {
    const idProducto = parseInt($(this).data('id'));
    const productoInfo = productos.find(p => p.id === idProducto);
    const item = carrito.find(i => i.id === idProducto);

    if (item.cantidad < productoInfo.stock) {
        item.cantidad++;
        renderizarCarrito();
        guardarCarrito();
    } else {
        alert(`🚫 No puedes superar el stock disponible (${productoInfo.stock})`);
    }
});

// Disminuir cantidad
$('#items-carrito').on('click', '.disminuir', function() {
    const idProducto = parseInt($(this).data('id'));
    const item = carrito.find(i => i.id === idProducto);

    if (item.cantidad > 1) {
        item.cantidad--;
    } else {
        carrito = carrito.filter(i => i.id !== idProducto);
    }

    renderizarCarrito();
    guardarCarrito();
});

/**
 * Calcula el precio total del carrito y lo actualiza en el DOM.
 */
function calcularTotal() {
    let total = 0;
    
    carrito.forEach((item) => {
        const productoInfo = productos.find(p => p.id === item.id);
        total += productoInfo.precio * item.cantidad;
    });

    // Muestra el total en el elemento HTML usando jQuery
    $('#total-carrito').text(`Bs. ${total.toFixed(2)}`);
}

function vaciarCarrito() {
    carrito = []; 
    renderizarCarrito(); 
    guardarCarrito();
}

/**
 * Elimina un producto del carrito.
 */
function eliminarProducto() {
    // Usamos el delegado del evento para obtener el data-id del botón
    const idProducto = parseInt($(this).data('id')); 
    
    // Filtrar el carrito
    carrito = carrito.filter(item => item.id !== idProducto);

    renderizarCarrito();
    guardarCarrito(); // Guardamos los cambios
}


// 5. Inicialización y Event Listeners con jQuery

// El código se ejecuta cuando el DOM está completamente cargado, equivalente a DOMContentLoaded
$(document).ready(function() {
    // 1. Cargar el carrito guardado al inicio
    cargarCarrito();
    
    // 2. Renderizar la vista
    //renderizarCatalogo();
    renderizarCarrito();

    // 3. Añadir listeners con jQuery

    // Listener para Añadir al Carrito (delegación de eventos en el catálogo)
    $('#catalogo').on('click', '.anadir-producto', anadirAlCarrito);

    // Listener para Vaciar Carrito
    $('#vaciar-carrito').on('click', vaciarCarrito);
    
    // Listener delegado para los botones de eliminar dentro del carrito
    $('#items-carrito').on('click', '.eliminar-producto', eliminarProducto);
});
    </script>
</body>
</html>
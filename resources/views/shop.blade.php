<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ALTUNA</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
</head>
<body>
        <div class="header">
            <h3>ALTUNA</h3>
            <span class="text-white"><i class="fa-solid fa-location-dot text-white"></i> Cochabamba</span>
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


    <div class="container">
    
        <div class="py-4">
            <div class="row" id="catalogo">
                <div class="text-center py-4">
                    <h2>NUESTROS PRODUCTOS</h2>
                </div>
                @foreach ($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            
                            {{-- Imagen del Producto --}}
                            <img src="{{ $producto['img'] }}" class="card-img-top" alt="{{ $producto['nombre'] }}" style="height: 180px; object-fit: cover;">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="text-primary-out">{{ $producto['nombre'] }}</h5>
                                
                                <div class="mb-3">
                                    <p class="fw-bold" style="font-size: 2rem;">bs. {{ $producto['descuento'] }}<?php //if($fila['descuento']>0){ echo (int)$fila['descuento']; }else{ echo (int)$fila['precio'];} ?></p>
                                    <div class="d-flex justify-content-between gap-2 align-items-center">
                                        <p><span class="info-descuento p-2 text-white fw-bold"> antes Bs. {{ $producto['precio'] }}</span><?php //if($fila['descuento']>0){ echo '<span class="bg-warning p-2 text-white fw-bold"> antes Bs. '.(int)$fila["precio"].'</span>'; } ?></p>
                                    </div>
                                </div>
                                
                                <button 
                                    class="btn btn-primary mt-auto anadir-producto" 
                                    data-id="{{ $producto['id'] }}"
                                    {{-- Deshabilitar si el stock es 0 --}}
                                    @if ($producto['stock'] == 0) disabled @endif
                                >
                                    @if ($producto['stock'] == 0)
                                        🚫 Agotado
                                    @else
                                        🛒 Añadir al Carrito
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        
    </div>


<div id="shop">
    <div id="box-shop">
        <div id="cart">
            <div class="d-flex justify-content-between">
                <h3>🛒 Carrito de Compras</h3>
                <button class="remove-btn" onclick="ocultarCarrito()"><i class="fa-solid fa-xmark"></i></button>

            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody id="items-carrito">
                </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="4">Total Carrito:</th>
                    <td id="total-carrito" class="font-weight-bold">$0.00</td>
                    <td>
                        <button class="btn btn-light btn-sm" id="vaciar-carrito">Vaciar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        
        <div class="text-right">
             <button class="btn btn-primary btn-lg">Comprar</button>
        </div>
        </div>
    </div>
</div>
<div id="resultado">

</div>



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
/**
 * Dibuja todos los elementos del carrito en el HTML usando jQuery.
 */
function renderizarCarrito() {
    const $itemsCarrito = $('#items-carrito');
    $itemsCarrito.empty(); // Vaciar antes de dibujar de nuevo

    var cantidadCarrito=0;
    carrito.forEach((item) => {
        // Encontrar los datos completos del producto a partir del ID
        const productoInfo = productos.find(p => p.id === item.id);
        
        const filaItem = `
            <tr>
                <th scope="row"></th>
                <td>${productoInfo.nombre}</td>
                <td>${item.cantidad}</td>
                <td>Bs. ${productoInfo.precio.toFixed(2)}</td>
                <td>Bs. ${(productoInfo.precio * item.cantidad).toFixed(2)}</td>
                <td>
                    <button class="btn btn-outline-danger btn-sm eliminar-producto" data-id="${item.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $itemsCarrito.append(filaItem);
        cantidadCarrito++;
    });

    $("#cantidadCarrito").html(cantidadCarrito);

    calcularTotal();
}

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
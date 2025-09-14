<div>

    <!-- Iframe de Google Maps -->
    <iframe
        width="100%"
        height="400"
        frameborder="0"
        style="border:0"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps?q={{ $pedido->latitud }},{{ $pedido->longitud }}&hl=es;z=14&output=embed">
    </iframe>

    <div class="d-flex align-items-center justify-content-center p-3">
        <button class="rounded-pill btn-shop-submit" id="btncopyMsg" onclick="copiarUrl()">copiar ubicación en el portapapeles <i class="fa-solid fa-map-location-dot"></i></button>
    </div>

    <script>
        function copiarUrl(){
            const latVal = "{{ $pedido->latitud }}";
        const lngVal = "{{ $pedido->longitud }}";

        // Construir URL de Google Maps
        const url = `https://www.google.com/maps?q=${latVal},${lngVal}`;
           copyToClipboard(url); 
        }
        
    </script>
</div>
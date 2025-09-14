function MostrarCarrito(){
    $("#shop").toggle();
}
function ocultarCarrito(){
    $("#shop").toggle();
}
function removeThis(button) {
  const li = button.closest('li');
  if (li) {
    li.remove();
  }
}

function actualizarCarrito() {
    $.post("actualizar-carrito.php",{},function(result){
      
      $("#cart-items").html(result);
      $('#cart-items').show();

    });
  }

function realizarCompra(){
    $.post("vaciar-carrito.php",{},function(result){
      
      $("#cart-items").html(result);
      $('#cart-items').show();

    });
}

//actualizarCarrito();


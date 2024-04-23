<?php

//funciones para el carrito del cliente

// Función para agregar un plato al carrito
function agregarPlato($resultado, $id, $cantidad = 1) {
    // Si el carro no tiene ningun valor, lo inicia
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Verificar si el plato ya está en el carrito
    if (array_key_exists($id, $_SESSION['carrito'])) {
        // Si el plato ya está en el carrito, simplemente incrementa la cantidad
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
        // Si el plato no está en el carrito, lo agrega
        $_SESSION['carrito'][$id] = array(
            'id' => $resultado['ID_PLA'],
            'titulo' => $resultado['TITU_PLA'],
            'foto' => $resultado['FOT_PLA'],
            'precio' => $resultado['PRE_PLA'],
            'cantidad' => $cantidad
        );
    }

}





//acumulo lo que tengo el precio por la cantidad
function calcularTotal(){
      $total = 0;
      if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice=>$value){
                    $total += $value['precio'] * $value['cantidad'];
                  
            }
      }

      return $total;

}
function cantidadPlatos(){
      $cantidad = 0;
      if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice=>$value){
                    $cantidad++;
                  
            }
      }

      return $cantidad;

}
?>
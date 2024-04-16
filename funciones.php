<?php

function agregarPlato($resultado , $id, $cantidad=1){
                 
                        $_SESSION['carrito'][$id]=array(
                          'id' => $resultado['ID_PLA'],
                           'titulo' => $resultado['TITU_PLA'],
                            'foto' => $resultado['FOT_PLA'],
                             'precio' => $resultado['PRE_PLA'],
                              'cantidad' => $cantidad

                   );

}
function actualizarPlato($id, $cantidad = FALSE) {
    if ($cantidad !== FALSE) {
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    } else {
        // Verificar si la cantidad está inicializada
        if (!isset($_SESSION['carrito'][$id]['cantidad'])) {
            $_SESSION['carrito'][$id]['cantidad'] = 0;
        } else {
            $_SESSION['carrito'][$id]['cantidad'] += 1;
        }
    }
}




function calcularTotal(){


}
function cantidadPlatos(){


}
?>
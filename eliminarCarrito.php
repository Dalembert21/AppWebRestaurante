<?php
    session_start();
    //aseguramos que el valor que viene por la url sea numerico
    if(isset($_GET['id']) or ! is_numeric($_GET['id']))
    header('Location: carrito.php');
     $id = $_GET['id'];
    //aseguro que la sesion exista
    if(isset($_SESSION['carrito'])){
        //remuevo el arreglo dentro de la session
        unset($_SESSION['carrito'][$id]);

        header('Location: carrito.php');
    }else{
        header('Location: index.php');
      
    }
   
?>
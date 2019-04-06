<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];


    try {
        require_once("bd_conexion.php");
        $sql = "UPDATE categoria_medicamento SET cat_estado = 0 WHERE cat_id ={$id}";
        $resultado = $conn->query($sql);
        $mensaje = "Categoría eliminada";
    } catch (Exception $e) {
        $error = $e . getMessage();
        $mensaje = "Hubo un error";
    }

    header("Location:../../configuracion.php?msg=$mensaje");
}

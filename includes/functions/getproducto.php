<?php
require('funciones.php');

try {
    require_once("bd_conexion.php");
    $sql = "SELECT med_id,med_nombre,med_stock,pre_nombre,cat_nombre,med_fechaV from medicamentos
    JOIN presentacion ON presentacion.pre_id=medicamentos.pre_id
    JOIN categoria_medicamento ON categoria_medicamento.cat_id=medicamentos.cat_id where med_id={$id};";
    $producto = $conn->query($sql);
} catch (Exception $e) {
    $error = $e . getMessage();
}
?>
?>
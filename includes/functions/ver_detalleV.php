<?php

if(isset($_POST["id"])){
$id=$_POST["id"];
try {
    require_once("bd_conexion.php");
    $sql= "SELECT med_nombre, det_venta_cantidad,venta_fecha,det_venta_subtotal,med_precioV,
    venta_total total
    FROM detalle_venta
    JOIN medicamentos ON medicamentos.med_id=detalle_venta.med_id 
    JOIN venta ON venta.venta_id=detalle_venta.venta_id 
    WHERE venta.venta_id={$id};";
    $ventas = $conn->query($sql);
    $d = array();
while ($r = $ventas->fetch_assoc()) {
  $d[]=$r;
}
print(json_encode($d));
} catch (Exception $e) {
    $error = $e . getMessage();
}
}
?>
<?php

if(isset($_POST["id"])){
$id=$_POST["id"];
try {
    require_once("bd_conexion.php");
    $sql= "SELECT med_nombre, det_compra_cantidad,compra_fecha,det_compra_subtotal,med_precioC,
    compra_total total
    FROM detalle_compra
    JOIN medicamentos ON medicamentos.med_id=detalle_compra.med_id 
    JOIN compra ON compra.compra_id=detalle_compra.compra_id 
    WHERE compra.compra_id={$id};";
    $compras = $conn->query($sql);
    $d = array();
while ($r = $compras->fetch_assoc()) {
  $d[]=$r;
}
print(json_encode($d));
} catch (Exception $e) {
    $error = $e . getMessage();
}
}
?>
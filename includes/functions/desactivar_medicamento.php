<?php

if(isset($_GET["id"])){
    $id=$_GET["id"];


try{
    require_once("bd_conexion.php");
$sql="UPDATE medicamentos set med_estado=0 WHERE med_id ={$id}";
    $resultado=$conn->query($sql);
}catch (Exception $e){
    $error=$e.getMessage();
}

Header("Location:../../inventario.php");
}
?>
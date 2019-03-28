<?php

if(isset($_GET["id"])){
    $id=$_GET["id"];



try{
    require_once("bd_conexion.php");
$sql="DELETE FROM presentacion WHERE pre_id ={$id}";
    $resultado=$conn->query($sql);
}catch (Exception $e){
    $error=$e.getMessage();
}

Header("Location:../../configuracion.php");
}
?>
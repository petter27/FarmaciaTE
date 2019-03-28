<?php

if (isset($_GET["txtPresentacion"])){
    $presentacion=$_GET["txtPresentacion"];
    $estado=1;

    try{
        require_once("includes/functions/bd_conexion.php");
        $stmt=$conn->prepare("INSERT INTO presentacion (pre_nombre)
         values (?)");
        $stmt->bind_param("s", $presentacion);
        $stmt->execute();

        if($stmt->error){
        $mensaje= "Hubo un error";
        
    }else {
        
        $mensaje="Presentacion agregada correctamente";    
    }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $mensaje= "Error: " . $e->getMessage();
    }
}


Header("Location: configuracion.php?msgp=$mensaje"); 
?>
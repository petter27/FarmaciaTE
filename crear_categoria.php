
<?php

if (isset($_GET["txtCategoria"])){
    $categoria=$_GET["txtCategoria"];
    $estado=1;

    try{
        require_once("includes/functions/bd_conexion.php");
        $stmt=$conn->prepare("INSERT INTO categoria_medicamento (cat_nombre,cat_estado)
         values (?,?)");
        $stmt->bind_param("si", $categoria,$estado);
        $stmt->execute();

        if($stmt->error){
        
        $mensaje= "Hubo un error";
        
    }else {
        
        $mensaje="Categoria agregada correctamente";    
    }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $mensaje= "Error: " . $e->getMessage();
    }
}


Header("Location: configuracion.php?msg=$mensaje"); 
?>
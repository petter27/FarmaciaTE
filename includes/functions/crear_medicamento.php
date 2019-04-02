<?php

if (isset($_POST["btnAgregarMed"])){
    $nombre=$_POST["txtMedicamento"];
    $precio_compra=$_POST["txtPrecioCompra"];
    $precio_venta=$_POST["txtPrecioVenta"];
    $presentacion=$_POST["comboP"];
    $categoria=$_POST["comboC"];
    $fechaV=$_POST["fechaMed"];
    $stock=$_POST["txtStock"];
    $estado=1;
    $imagen=$_FILES["file"]["tmp_name"];
    $url_img=$_FILES["file"]["name"];
    $targetPath="../../img/".$_FILES["file"]["name"];
    


    if($nombre=="" || $precio_compra=="" || $precio_venta==""  ){
        $mensaje= "Ingrese los campos requeridos";
    
}

    try{
        require_once("bd_conexion.php");
        $stmt=$conn->prepare("INSERT INTO medicamentos (med_nombre,med_stock,med_precioC,med_precioV,cat_id, pre_id, med_fechaV, med_estado,med_img)
         values (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sissiisis", $nombre,$stock,$precio_compra,$precio_venta,$categoria,$presentacion,$fechaV,$estado,$url_img);
        $stmt->execute();

        move_uploaded_file($imagen,$targetPath);
        if($stmt->error){
        
        $mensaje= $stmt->error;
        
        
    }else {
        
        $mensaje="Medicamento registrado correctamente";    
    }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $mensaje= "Error: " . $e->getMessage();
    }
}


Header("Location: ../../agg_medicamento.php?mensaje=$mensaje"); 
?>
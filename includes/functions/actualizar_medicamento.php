<?php 

if(isset($_POST['EditMedicamento'])){
	$id=$_POST['med_id'];
    $nom=$_POST['med_nombre'];
    $sto=$_POST['med_stock'];
    $categoria=$_POST['cat_id'];
    $precioC=$_POST['med_precioC'];
    $precioV=$_POST['med_precioV'];
    $presentacion=$_POST['pre_id'];
    $fecha=$_POST['med_fechaV'];
    $mensaje = '';

    echo "puta";
    try{
        require_once("bd_conexion.php");
        $sql="UPDATE medicamentos SET med_nombre='{$nom}', med_stock='{$sto}', cat_id='{$categoria}', pre_id='{$presentacion}', 
        med_precioC='{$precioC}', med_precioV='{$precioV}', med_fechaV='{$fecha}' WHERE med_id ={$id}";
        $resultado=$conn->query($sql);

        if ($resultado->error) {
            $mensaje = "BD ERROR: " . $resultado->error;
          } else {
            $mensaje = "Medicamento registrado correctamente";
          }

        //header('Location:../../inventario.php?exito=exito');
    }catch (Exception $e){
        $mensaje=$e.getMessage();

    }

    header("Location:../../inventario.php?msg={$mensaje}");
}


 ?>
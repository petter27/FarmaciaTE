
<?php 

if(isset($_POST['pre_id']) && isset($_POST['pre_nombre'])){
	$id=$_POST['pre_id'];
	$n=$_POST['pre_nombre'];

    try{
        require_once("bd_conexion.php");
    $sql="UPDATE presentacion SET pre_nombre='{$n}' WHERE pre_id ={$id}";
        $resultado=$conn->query($sql);
    }catch (Exception $e){
        $error=$e.getMessage();
    }

}
 ?>
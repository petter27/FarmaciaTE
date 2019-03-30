
<?php 

if(isset($_POST['cat_id']) && isset($_POST['cat_nombre'])){
	$id=$_POST['cat_id'];
	$n=$_POST['cat_nombre'];

    try{
        require_once("bd_conexion.php");
    $sql="UPDATE categoria_medicamento SET cat_nombre='{$n}' WHERE cat_id ={$id}";
        $resultado=$conn->query($sql);
    }catch (Exception $e){
        $error=$e.getMessage();
    }

}
 ?>
<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();
?>
<?php 
require('includes/templates/master_header.php');
?>


<?php

if(isset($_GET["id"])){
    $id=$_GET["id"];

try {
    require_once("includes/functions/bd_conexion.php");
    $sql = "SELECT * FROM usuario where usr_id={$id};";
    $resultado = $conn->query($sql);
    $usuario=$resultado->fetch_assoc();
} catch (Exception $e) {
    $error = $e . getMessage();
}
}
?>

<div class="card-body card-block " >

                <div class="login-form col-sm-6 " >
                    <form action="./includes/functions/CRUD_usuario.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre de usuario</label>
                            <input name="user_name" type="text" class="form-control" placeholder="Usuario" value="<?php echo $usuario["usr_nombre"]; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input name="user_email" type="email" class="form-control" placeholder="Correo Electronico" value="<?php echo $usuario["usr_email"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="user_pass" type="password" class="form-control" placeholder="Contrasena">
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="user_pass2" type="password" class="form-control" placeholder="Repita la Contrasena">
                        </div>
                        <div class="form-group">
                            <label for="categoria" class=" form-control-label">Tipo de usuario</label>
                            <select name="user_idtipo" id="ddlTipo" class="form-control">
                                <option value="1" <?php if( $usuario["usr_tipo"]==1){echo 'selected="true"';} ?> >Admin</option>
                                <option value="2" <?php if( $usuario["usr_tipo"]==2){echo 'selected="true"';} ?>>Empleado</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" form-control-label">Una imagen .png, .jpg, jpeg no mayor a 10mb</label>
                                <input id="subirImg" onchange="PreviewImage(this);" class="form-control" type="file" name="user_img">
                            </div>
                            <div class="col-md-6">
                                <img id="imagen" width="100" src="" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                            <button type="submit" name="agg_user" class="btn btn-info btn-block">Agregar usuario
                            </button>
                        </div>
                    </form>

                </div>

            </div>

<h4> <?php var_dump($usuario); ?> </h4>



<?php 
require('includes/templates/master_footer.php');
?>
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
                            <input name="usr_id" type="text" class="form-control" hidden="true" placeholder="Usuario" value="<?php echo $usuario["usr_id"]; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Nombre de usuario</label>
                            <input name="usr_name" type="text" class="form-control" placeholder="Usuario" value="<?php echo $usuario["usr_nombre"]; ?>" required >
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input name="usr_email" type="email" class="form-control" placeholder="Correo Electronico" value="<?php echo $usuario["usr_email"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="usr_pass" type="password" class="form-control" placeholder="Contrasena(Opcional)">
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="usr_pass2" type="password" class="form-control" placeholder="Repita la Contrasena(Opcional) ">
                        </div>
                        <div class="form-group">
                            <label for="categoria" class=" form-control-label">Tipo de usuario</label>
                            <select name="usr_tipo" id="ddlTipo" class="form-control">
                                <option value="1" <?php if( $usuario["usr_tipo"]==1){echo 'selected="true"';} ?> >Admin</option>
                                <option value="2" <?php if( $usuario["usr_tipo"]==2){echo 'selected="true"';} ?>>Empleado</option>
                            </select>
                        </div>
                        <div class="mensaje">
                        <?php if(isset($_GET["msj"])){ echo $_GET["msj"]; } ?>
                        </div>
                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                            <button type="submit" name="editar_usuario" class="btn btn-info btn-block">Agregar usuario
                            </button>
                        </div>
                    </form>

                </div>

            </div>




<?php 
require('includes/templates/master_footer.php');
?>
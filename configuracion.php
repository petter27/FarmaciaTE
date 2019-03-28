

<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();
?>
<?php 
require('includes/templates/master_header.php');
?>

<?php 
$mensaje='';
if(isset($_GET['msg'])){
    $mensaje=$_GET['msg'];
};

$mensajeU='';
if(isset($_GET['mensaje'])){
    $mensajeU=$_GET['mensaje'];
};


$mensajeP='';
if(isset($_GET['msgp'])){
    $mensajeP=$_GET['msgp'];
};
?>
?>

<?php
try{
    require_once("includes/functions/bd_conexion.php");
    $sqlUsuarios="SELECT case when usr_tipo=1 then 'Administrador' else 'usuario' end tipo, usr_nombre, usr_email 
    FROM usuario where usr_estado=1;";
    $resultado=$conn->query($sqlUsuarios);

    $sqlCat="SELECT cat_id,cat_nombre FROM categoria_medicamento WHERE cat_estado=1;";
    $cat_result=$conn->query($sqlCat);    

    $sqlPre="SELECT pre_id,pre_nombre FROM presentacion;";
    $pre_result=$conn->query($sqlPre);

}catch (Exception $e){
    $error=$e.getMessage();
}
?>

<!-- Usuarios -->
<div class="row">
    <div class="col-md-6">
        <div class="card border-left-info">
            <div class="card-header"><strong>Usuario nuevo</strong>
                <small> -Usuario-</small>
            </div>
            <div class="card-body card-block">

                <div class="login-form">
                    <form  action="crear_usuario.php" method="POST" >
                        <div class="form-group">
                            <label>Nombre de usuario</label>
                            <input name="user" type="text" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input name="email" type="email" class="form-control" placeholder="Correo Electronico">
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="pass1" type="password" class="form-control" placeholder="Contrasena">
                        </div>
                        <div class="form-group">
                            <label>Contrasena</label>
                            <input name="pass2" type="password" class="form-control" placeholder="Repita la Contrasena">
                        </div>
                        <div class="form-group">
                            <label for="categoria" class=" form-control-label">Tipo de usuario</label>
                            <select name="ddlTipo" id="ddlTipo" class="form-control">
                                <option  value="1">Admin</option>
                                <option value="2" selected="true">Empleado</option>
                            </select>
                        </div>
                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                            <button type="submit" name="btnAgregar" class="btn btn-info btn-block">Agregar usuario
                            </button>
                        </div>
                        <?php echo $mensajeU; ?>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Lista de Usuarios</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th><b>Editar</b></th>
                            <th><b>Tipo</b></th>
                            <th><b>Usuario</b></th>
                            <th><b>e-mail</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($usuarios=$resultado->fetch_assoc()){  ?>
                        <tr>
                            <td align="center">
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?php echo $usuarios["tipo"] ?></td>
                            <td><?php echo $usuarios["usr_nombre"] ?></td>
                            <td><?php echo $usuarios["usr_email"] ?></td>
                        </tr>
                        <?php  }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Categorías -->
<div class="row">
    <div class="col-md-6">
        <div class="card border-left-warning">
            <div class="card-header"><strong>Categoria nueva</strong>
                <small> -Categoria-</small>
            </div>
            <div class="card-body card-block">
                <form action="crear_categoria.php" method="GET">
                    <div class="form-group">
                        <label for="cat_nombre" class=" form-control-label">Nombre</label>
                        <input type="text" name="txtCategoria" placeholder="Categoria" class="form-control">
                    </div>

                    <!-- boton de agregar -->
                    <div class="row">
                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                            <button type="submit" name="btnCategoria" class="btn btn-warning btn-block">Agregar
                            </button>
                        </div>

                    </div>
                    <?php echo $mensaje; ?>
                </form><!-- row -->

            </div>
        </div>
    </div>
    <!-- tabla categorías -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Lista de Categorias</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered ">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th> <b> Editar </b></th>
                            <th><b>ID</b></th>
                            <th><b>Categoría</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($categorias=$cat_result->fetch_assoc()){  ?>
                        <tr role="row" class="odd">
                            <td align="center">
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?php echo $categorias["cat_id"]; ?></td>
                            <td><?php echo $categorias["cat_nombre"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Presentaciones -->
<div class="row">
    <div class="col-md-6">
        <div class="card border-left-success">
            <div class="card-header"><strong>Presentación nueva</strong>
                <small> -Presentación-</small>
            </div>
            <div class="card-body card-block">
                <form action="crear_presentacion.php" method="GET">
                    <div class="form-group">
                        <label for="cat_nombre" class=" form-control-label">Nombre</label>
                        <input type="text" name="txtPresentacion" placeholder="Presentación" class="form-control">
                    </div>

                    <!-- boton de agregar -->
                    <div class="row">
                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                            <button type="submit" name="btnPresentacion" class="btn btn-success btn-block">Agregar
                            </button>
                        </div>

                    </div>
                    <?php echo $mensajeP; ?>
                </form><!-- row -->

            </div>
        </div>
    </div>
    <!-- tabla Presentación -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Lista de Presentaciones</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered ">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th> <b> Editar </b></th>
                            <th><b>ID</b></th>
                            <th><b>Presentación</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($presentacion=$pre_result->fetch_assoc()){  ?>
                        <tr role="row" class="odd">
                            <td align="center">
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?php echo $presentacion["pre_id"] ?></td>
                            <td><?php echo $presentacion["pre_nombre"] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
require('includes/templates/master_footer.php');
?>

</html> 
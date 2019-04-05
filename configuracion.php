<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();
?>
<?php
require('includes/templates/master_header.php');
?>

<?php
$mensaje = '';
if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
};

$mensajeU = '';
if (isset($_GET['mensaje'])) {
    $mensajeU = $_GET['mensaje'];
};


$mensajeP = '';
if (isset($_GET['msgp'])) {
    $mensajeP = $_GET['msgp'];
};
?>


<?php
try {
    require_once("includes/functions/bd_conexion.php");
    $sqlUsuarios = "SELECT usr_id, case when usr_tipo=1 then 'Administrador' else 'usuario' end tipo, usr_nombre, usr_email 
    FROM usuario where usr_estado=1;";
    $resultado = $conn->query($sqlUsuarios);

    $sqlCat = "SELECT cat_id,cat_nombre FROM categoria_medicamento WHERE cat_estado=1;";
    $cat_result = $conn->query($sqlCat);

    $sqlPre = "SELECT pre_id,pre_nombre FROM presentacion;";
    $pre_result = $conn->query($sqlPre);
} catch (Exception $e) {
    $error = $e . getMessage();
}
?>

<!-- Accordion -->
<div class="accordion" id="accordionExample">
    <!-- Usuarios -->
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h3>USUARIOS</h3>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-left-info">
                            <div class="card-header"><strong>Usuario nuevo</strong>
                                <small> -Usuario-</small>
                            </div>
                            <div class="card-body card-block">

                                <div class="login-form">
                                    <form action="./includes/functions/CRUD_usuario.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nombre de usuario</label>
                                            <input name="user_name" type="text" class="form-control" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo Electrónico</label>
                                            <input name="user_email" type="email" class="form-control" placeholder="Correo Electronico">
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
                                                <option value="1">Admin</option>
                                                <option value="2" selected="true">Empleado</option>
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
                                        <?php while ($usuarios = $resultado->fetch_assoc()) {  ?>
                                            <tr>
                                                <td align="center">
                                                    <a href="editar_usuario.php?id=<?php echo $usuarios['usr_id']; ?>" class="btn btn-success btn-circle btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="includes/functions/CRUD_usuario.php?delete_user=<?php echo $usuarios['usr_id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $usuarios["tipo"] ?></td>
                                                <td><?php echo $usuarios["usr_nombre"] ?></td>
                                                <td><?php echo $usuarios["usr_email"] ?></td>
                                            </tr>
                                        <?php
                                    }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Empleados -->
    <div class="card">
        <div class="card-header" id="headingEmp" data-toggle="collapse" data-target="#collapseEmp" aria-controls="collapseEmp">
            <h3>EMPLEADOS</h3>
        </div>

        <div id="collapseEmp" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-left-info">
                            <div class="card-header"><strong>Empleado nuevo</strong>
                                <small> -Empleado-</small>
                            </div>
                            <div class="card-body card-block">

                                <div class="login-form">
                                    <form action="./includes/functions/CRUD_usuario.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nombres de empleado</label>
                                            <input name="uemp_name" type="text" class="form-control" placeholder="Nombres">
                                        </div>
                                        <div class="form-group">
                                            <label>Apellidos de empleado</label>
                                            <input name="emp_lname" type="text" class="form-control" placeholder="Apellidos">
                                        </div>
                                        <div class="form-group">
                                            <label>Fecha de nacimiento empleado</label>
                                            <input name="emp_bdate" type="date" class="form-control">
                                        </div>
                                        <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                                            <button type="submit" name="agg_user" class="btn btn-info btn-block">Agregar usuario
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
                                        <?php while ($usuarios = $resultado->fetch_assoc()) {  ?>
                                            <tr>
                                                <td align="center">
                                                    <a href="editar_usuario.php?id=<?php echo $usuarios['usr_id']; ?>" class="btn btn-success btn-circle btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="includes/functions/CRUD_usuario.php?delete_user=<?php echo $usuarios['usr_id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $usuarios["tipo"] ?></td>
                                                <td><?php echo $usuarios["usr_nombre"] ?></td>
                                                <td><?php echo $usuarios["usr_email"] ?></td>
                                            </tr>
                                        <?php
                                    }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Categorías -->
    <div class="card">
        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
            <h3>CATEGORIAS</h3>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
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
                                        <?php while ($categorias = $cat_result->fetch_assoc()) {  ?>
                                            <tr role="row" class="odd">
                                                <td align="center">
                                                    <button class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#modalEdicionC" onclick="agregaformC('<?php echo $categorias['cat_nombre'] ?>',<?php echo $categorias['cat_id'] ?>)">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <a href="includes/functions/borrar_categoria.php?id=<?php echo $categorias['cat_id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $categorias["cat_id"]; ?></td>
                                                <td><?php echo $categorias["cat_nombre"]; ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Presentaciones -->
    <div class="card">
        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
            <h3>PRESENTACIONES</h3>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
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
                                        <?php while ($presentacion = $pre_result->fetch_assoc()) {  ?>
                                            <tr role="row" class="odd">
                                                <td align="center">
                                                    <button class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#modalEdicionP" onclick="agregaformP('<?php echo $presentacion['pre_nombre'] ?>',<?php echo $presentacion['pre_id'] ?>)">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <a href="includes/functions/borrar_pre.php?id=<?php echo $presentacion['pre_id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $presentacion["pre_id"] ?></td>
                                                <td><?php echo $presentacion["pre_nombre"] ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Accordion -->


<?php
require('includes/templates/master_footer.php');
?>

<!-- modal categorias -->
<div class="modal fade" id="modalEdicionC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
            </div>
            <div class="modal-body">
                <input type="text" hidden="" id="cat_id" name="">
                <label>Categoria</label>
                <input type="text" name="" id="cat_nombre" class="form-control input-sm">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="EditCategoria" data-dismiss="modal">Actualizar</button>

            </div>
        </div>
    </div>
</div>
<!-- fin modal categorias -->

<!-- modal presentaciones -->
<div class="modal fade" id="modalEdicionP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
            </div>
            <div class="modal-body">
                <input type="text" hidden="" id="id_pre" name="">
                <label>Presentación</label>
                <input type="text" name="" id="nombreP" class="form-control input-sm">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="EditPresentacion" data-dismiss="modal">Actualizar</button>

            </div>
        </div>
    </div>
</div>
<!-- fin modal presentaciones -->



<script src="js/funciones.js"></script>

<script>
    $('#EditPresentacion').click(function() {
        actualizaPre();
    });

    $('#EditCategoria').click(function() {
        actualizaCat();
    });
</script>

<script type="text/javascript">
    function PreviewImage(_img) {

        var uploadFile = _img.files[0];

        if (!(/\.(jpg|png|jpeg)$/i).test(uploadFile.name)) {
            alert('El archivo a adjuntar no es una imagen');

        } else {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("subirImg").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("imagen").src = oFREvent.target.result;
            };
        };
    }
</script>

</html>
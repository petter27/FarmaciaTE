<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();

?>

<?php 
require('includes/templates/master_header.php');
?>

<!-- Agregar Producto -->
<div class="container">
    <h1 class="h4 text-gray-900 mb-4">Nuevo Medicamento</h1>
    <div class="card mb-4 py-3 border-left-info">
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-sm-7 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="" placeholder="Nombre medicamento">
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control">
                            <option>Presentación</option> 

                            <?php
                            require_once("includes/functions/bd_conexion.php");

                            $sql="SELECT pre_id,pre_nombre from presentacion";
                            $result = $conn->query($sql);

                            while ($valores = mysqli_fetch_array($result)) {
                        
                                echo '<option value="'.$valores[pre_id].'">'.$valores[pre_nombre].'</option>';
                              }
                        ?>       
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select class="form-control">
                            <option>Categoría</option>

                            <?php
                            require_once("includes/functions/bd_conexion.php");

                            $sql="SELECT cat_id,cat_nombre from categoria_medicamento where cat_estado=1";
                            $result = $conn->query($sql);

                            while ($valores = mysqli_fetch_array($result)) {
                        
                                echo '<option value="'.$valores[cat_id].'">'.$valores[cat_nombre].'</option>';
                              }
                        ?>    

                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="date" class="form-control form-control-user" id="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="" placeholder="Precio Compra">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="" placeholder="Precio Venta">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class=" form-control-label">Una imagen .png, .jpg, jpeg no mayor a 10mb</label>
                        <input id="subirImg" onchange="PreviewImage(this);" class="form-control" type="file" name="file">
                    </div>
                    <div class="col-md-6">
                        <img id="imagen" width="100" src="" alt="">
                    </div>
                </div>
                <hr>
                <div>
                    <a href="#" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Agregar medicamento</span>
                    </a>
                </div>
                <hr>
            </form>
        </div>
    </div>


</div>

<?php 
require('includes/templates/master_footer.php');
?>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
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
</body>

</html> 
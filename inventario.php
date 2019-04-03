<?php 
session_start();
require('includes/templates/master_header.php');
require('includes/functions/funciones.php');
admin_autenticado();
?>

<!-- Listar Inventario -->
<?php
try {
    require_once("includes/functions/bd_conexion.php");
    $sqlMed = "SELECT m.med_id, m.med_img, m.med_nombre, m.med_stock, c. cat_nombre, p.pre_nombre, m.med_precioC, m.med_precioV, m.med_fechaV 
    FROM medicamentos m INNER JOIN categoria_medicamento c ON m.cat_id= c.cat_id INNER JOIN presentacion p ON m.pre_id=p.pre_id where m.med_estado=1;";
    $resultado = $conn->query($sqlMed);
} catch (Exception $e) {
    $error = $e . getMessage();
}
?>

<!-- DataTale Inventario -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Inventario de producto</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Imagen</th>
                        <th>Medicamento</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Presentación</th>
                        <th>P Compra</th>
                        <th>P Venta</th>
                        <th>Expira</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php while ($medicamentos = $resultado->fetch_assoc()) {  ?>

                        <td>
                            <button class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#modalEdicionM" onclick="agregaformM('<?php echo $medicamentos['med_nombre'] ?>',<?php echo $medicamentos['med_stock'] ?>,'<?php echo $medicamentos['cat_nombre'] ?>','<?php echo $medicamentos['pre_nombre'] ?>','<?php echo $medicamentos['med_precioC'] ?>','<?php echo $medicamentos['med_precioV'] ?>','<?php echo $medicamentos['med_fechaV'] ?>',<?php echo $medicamentos['med_id'] ?>)">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="includes/functions/desactivar_medicamento.php?id=<?php echo $medicamentos['med_id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td><?php echo '<img src="img/' . $medicamentos["med_img"] . '" width="100px" height="100px"/>' ?></td>
                        <td><?php echo $medicamentos["med_nombre"] ?></td>
                        <td><?php echo $medicamentos["med_stock"] ?></td>
                        <td><?php echo $medicamentos["cat_nombre"] ?></td>
                        <td><?php echo $medicamentos["pre_nombre"] ?></td>
                        <td>$<?php echo $medicamentos["med_precioC"] ?></td>
                        <td>$<?php echo $medicamentos["med_precioV"] ?></td>
                        <td><?php echo $medicamentos["med_fechaV"] ?></td>
                    </tr>
                    <?php 
                }  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal medicamentos -->
<div class="modal fade" id="modalEdicionM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Medicamento</h4>
            </div>
            <div class="modal-body">
                <input type="text" hidden="" id="med_id" name="">
                <label>Nombre:</label>
                <input type="text" name="" id="nombreM" class="form-control input-sm">

                <label>Stock:</label>
                <input type="text" name="" id="stockM" class="form-control input-sm">

                <label>Categoria:</label>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select class="form-control" name="categoriaM">

                            <?php
                            require_once("includes/functions/bd_conexion.php");

                            $sql = "SELECT cat_id,cat_nombre from categoria_medicamento where cat_estado=1";
                            $result = $conn->query($sql);

                            while ($valores = mysqli_fetch_array($result)) {

                                echo '<option value="' . $valores[cat_id] . '">' . $valores[cat_nombre] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <label>Presentacion:</label>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select class="form-control" name="presentacionM">

                            <?php
                            require_once("includes/functions/bd_conexion.php");

                            $sql = "SELECT pre_id,pre_nombre from presentacion";
                            $result = $conn->query($sql);

                            while ($valores = mysqli_fetch_array($result)) {

                                echo '<option value="' . $valores[pre_id] . '">' . $valores[pre_nombre] . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                </div>

                <label>Precio Compra:</label>
                <input type="text" name="" id="precioCompraM" class="form-control input-sm">

                <label>Precio Venta:</label>
                <input type="text" name="" id="precioVentaM" class="form-control input-sm">

                <label>Fecha Expiracion:</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control form-control-user" name="fechaV">
                </div>


            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="EditMedicamento" data-dismiss="modal">Actualizar</button>

            </div>
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

<script src="js/funciones.js"></script>

<script>
    $('#EditMedicamento').click(function() {
        actualizaMed();
    });
</script>


</body>

</htm l> 
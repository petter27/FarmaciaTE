<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();

?>

<!-- Listar Inventario -->
<?php
try{
    require_once("includes/functions/bd_conexion.php");
    $sqlMed="SELECT m.med_img, m.med_nombre, m.med_stock, c. cat_nombre, p.pre_nombre, m.med_precioC, m.med_precioV, m.med_fechaV 
    FROM medicamentos m INNER JOIN categoria_medicamento c ON m.cat_id= c.cat_id INNER JOIN presentacion p ON m.pre_id=p.pre_id where m.med_estado=1;";
    $resultado=$conn->query($sqlMed);


}catch (Exception $e){
    $error=$e.getMessage();
}
?>

<?php 
require('includes/templates/master_header.php');
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
                <tfoot>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>Imagen</td>
                        <td>Medicamento</td>
                        <td>Stock</td>
                        <td>Categoría</td>
                        <td>Presentación</td>
                        <td>P Compra</td>
                        <td>P Venta</td>
                        <td>Expira</td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                    <?php while ($medicamentos=$resultado->fetch_assoc()){  ?>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td><?php echo'<img src="'.$medicamentos["med_img"].'" width="100px" height="100px"/>'?></td>
                        <td><?php echo $medicamentos["med_nombre"] ?></td>
                        <td><?php echo $medicamentos["med_stock"] ?></td>
                        <td><?php echo $medicamentos["cat_nombre"] ?></td>
                        <td><?php echo $medicamentos["pre_nombre"] ?></td>
                        <td>$<?php echo $medicamentos["med_precioC"] ?></td>
                        <td>$<?php echo $medicamentos["med_precioV"] ?></td>
                        <td><?php echo $medicamentos["med_fechaV"] ?></td>
                    </tr>
                    <?php  }  ?>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>Imagen</td>
                        <td>Medicamento</td>
                        <td>Stock</td>
                        <td>Categoría</td>
                        <td>Presentación</td>
                        <td>P Compra</td>
                        <td>P Venta</td>
                        <td>Expira</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>Imagen</td>
                        <td>Medicamento</td>
                        <td>Stock</td>
                        <td>Categoría</td>
                        <td>Presentación</td>
                        <td>P Compra</td>
                        <td>P Venta</td>
                        <td>Expira</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>Imagen</td>
                        <td>Medicamento</td>
                        <td>Stock</td>
                        <td>Categoría</td>
                        <td>Presentación</td>
                        <td>P Compra</td>
                        <td>P Venta</td>
                        <td>Expira</td>
                    </tr>
                </tbody>
            </table>
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
</body>

</html> 
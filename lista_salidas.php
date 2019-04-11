<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();
?>

<?php
require('includes/templates/master_header.php');
?>

<?php
try {
    require_once("includes/functions/bd_conexion.php");
    $sql = "SELECT venta_id,venta_fecha,venta_total,emp_nombre FROM venta
    JOIN empleado ON empleado.emp_id=venta.emp_id
    ORDER BY venta_fecha DESC;";
    $ventas = $conn->query($sql);
} catch (Exception $e) {
    $error = $e . getMessage();
}
?>

<!-- DataTales salidas -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de salidas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- DataTable salidas -->
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ver</th>
                        <th>Fecha</th>
                        <th>Empleado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($venta = $ventas->fetch_assoc()) {  ?>
                        <tr>
                            <td>
                                <a href="#" data="<?php echo $venta["venta_id"] ?>" id="btndetalle" class="btn btn-success btn-circle btn-sm detalle">
                                    <i class="fas fa-eye" data-toggle="modal" data-target="#modalDetalle"></i>
                                </a>
                            </td>
                            <td><?php echo $venta["venta_fecha"] ?></td>
                            <td><?php echo $venta["emp_nombre"] ?></td>
                            <td><?php echo $venta["venta_total"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal detalle -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de salida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableM" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Medicamento</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                </table>
                <div class="">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1" id="fechaV">Total salida 01/01/2019</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVenta">$215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<script>
    $(document).on('click', '.detalle', function() {
        var id2 = $(this).attr("data");

        $.ajax({
            url: "includes/functions/ver_detalleV.php",
            method: "POST",
            data: {
                id: id2
            },
            dataType: "json",
            success: function(data) {
                $('#dataTableM').DataTable().clear();
                var t = $("#dataTableM").DataTable();
                for (var i in data) {

                    t.row.add([
                        data[i]["med_nombre"],
                        data[i]["med_precioV"],
                        data[i]["det_venta_cantidad"],
                        data[i]["det_venta_subtotal"]
                    ]).draw(false);

                    $("#totalVenta").html("$" + data[0]["total"]);
                    $("#fechaV").html("Total salida " + data[0]["venta_fecha"]);
                }
            }
        });

    });
</script>


</body>

</html>
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
    $sqlEntradas = "SELECT * FROM compra ORDER BY compra_fecha DESC;";
    $compras = $conn->query($sqlEntradas);
} catch (Exception $e) {
    $error = $e . getMessage();
}
?>

<!-- DataTales Entradas -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de entradas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- DataTable Entradas -->
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ver</th>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($compra = $compras->fetch_assoc()) {  ?>
                        <tr>
                            <td>
                                <a href="#" data="<?php echo $compra["compra_id"] ?>" class="btn btn-success btn-circle btn-sm detalle">
                                    <i class="fas fa-eye" data-toggle="modal" data-target="#modalDetalle"></i>
                                </a>
                            </td>
                            <td><?php echo $compra["compra_id"] ?></td>
                            <td><?php echo $compra["compra_fecha"] ?></td>
                            <td> <?php echo $compra["compra_total"] ?></td>
                        </tr>
                    <?php }  ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Detalle de entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableC" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Medicamento</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
                <div class="">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div id="FechaC" class="text-xs font-weight-bold text-success text-uppercase mb-1 ">Total entrada 01/01/2019</div>
                                    <div id="totalCompra" class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
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
            url: "includes/functions/ver_detalleC.php",
            method: "POST",
            data: {
                id: id2
            },
            dataType: "json",
            success: function(data) {
                $('#dataTableC').DataTable().clear();
                var t = $("#dataTableC").DataTable();
                for (var i in data) {

                    t.row.add([
                        data[i]["med_nombre"],
                        data[i]["med_precioC"],
                        data[i]["det_compra_cantidad"],
                        data[i]["det_compra_subtotal"]
                    ]).draw(false);

                    $("#totalCompra").html("$" + data[0]["total"]);
                    $("#fechaC").html("Total entrada " + data[0]["compra_fecha"]);
                }
            }
        });

    });
</script>
</body>

</html>
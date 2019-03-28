<?php 
require('includes/templates/master_header.php');
?>


<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Compra de medicamentos</h6>
</div>
<form action="" method="POST">
    <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
        <div class="card mb-4 py-3 border-left-success">
            <div class="card-body">
                <div class="form-group">
                    <label class=" form-control-label">Categoria del medicamento:</label>
                    <select id="ddlCat" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Presentación del medicamento:</label>
                    <select id="ddlCat" class="form-control">

                    </select>
                </div>
                <div class="form-group ddls">
                    <label class=" form-control-label">Medicamento:</label>
                    <select name="ddlPro" id="ddlPro" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label id="lblCant" class=" form-control-label">Cantidad</label>
                    <input type="text" autocomplete="off" id="txtCant" placeholder="Cantidad" class="form-control">
                </div>
                <div class="form-group">
                    <button id='agg' name="agg" type="button" onclick="" class="btn btn-success btn-lg btn-block">
                        Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- tabla -->
    <div class="card border-left-success">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Medicamento</th>
                            <th>Categoría</th>
                            <th>Presentación</th>
                            <th>Fecha vencimiento</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="lista"></tbody>
                </table>
            </div>
            <h2 id="lblTotal">Total: </h2>
            <!-- boton agregar -->
            <div class="row">
                <div class="col-lg-6 offset-md-3 mr-auto ml-auto">
                    <div class="card">
                        <div class="card-body card-block">
                            <button type="button" id="btnDesc" onclick="" class="btn btn-success btn-lg btn-block">
                                Agregar al inventario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

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
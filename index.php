<?php
require('includes/functions/funciones.php');
session_start();
admin_autenticado();
?>

<?php
require('includes/templates/master_header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Cards  -->
    <div class="row">

        <!-- total productos vendidos-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Medicamentos vendidos (Mes)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total dinero vendido -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total dinero</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Grafico productos más vendidos -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Productos más vendidos</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="top_medicamentos"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categorías más vendidas -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Categorías más consumidas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="top_categorias"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
require('includes/templates/master_footer.php');
?>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<script src="js/graficos.js"></script>

<script type="text/javascript">
    function meds_mas_usados() {
        //llamando grafico
        post_string = "top_meds=yes";
        g = "";
        $.ajax({
            url: "includes/functions/get_GDATA.php",
            type: "POST",
            data: post_string,
            success: function(data) {
                // alert("Success: " + data);
                $('#top_medicamentos').empty();
                var ctx = document.getElementById("top_medicamentos").getContext('2d');
                g = JSON.parse(data);
                top_meds(ctx, g.label, g.data, g.max);
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    }

    function cats_mas_usados() {
        //llamando grafico
        post_string = "top_cats=yes";
        g = "";
        $.ajax({
            url: "includes/functions/get_GDATA.php",
            type: "POST",
            data: post_string,
            success: function(data) {
                //alert("Success: " + data);
                $('#top_medicamentos').empty();
                var ctx = document.getElementById("top_categorias").getContext('2d');
                g = JSON.parse(data);
                top_cats(ctx, g.label, g.data, g.max);
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    }

    meds_mas_usados();
    cats_mas_usados();
</script>

<!-- Page level custom scripts -->
<!-- <script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>
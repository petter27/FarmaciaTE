<?php
require('includes/functions/funciones.php');
#session_start();
#emp_autenticado();
?>

<?php
require('includes/templates/master_header_emp.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="height:75%">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>



</div>
<!-- /.container-fluid -->

<?php
require('includes/templates/master_footer.php');
?>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
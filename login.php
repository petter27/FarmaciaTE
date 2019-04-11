<?php
session_start();
$resultado = "";
if (isset($_POST["login"])) {
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];

  $error = "";

  if ($usuario == "" || $password == "") {
    $error = "Ingrese usuario o contraeña correctamente";
  } else {

    try {
      require_once("includes/functions/bd_conexion.php");
      $stmt = $conn->prepare("SELECT usr_id, usr_nombre, usr_password, usr_tipo,usr_img FROM usuario WHERE usr_nombre=? 
                AND usr_estado=1;");
      $stmt->bind_param("s", $usuario);
      $stmt->execute();

      $stmt->bind_result($id, $nombre_usr, $password_usr, $tipo_usr, $usr_img);


      while ($stmt->fetch()) {
        if (password_verify($password, $password_usr)) {

          $user = array(
            'id' => $id,
            'nombre' => $nombre_usr,
            'tipo' => $tipo_usr,
            'imagen' => $usr_img
          );

          if ($tipo_usr == 1) {
            $_SESSION['usr_admin'] = $user;
            header('Location: index.php');
          } elseif ($tipo_usr == 2) {
            $_SESSION['usr_emp'] = $user;
            header('Location: index_emp.php');
          }
        } else $error = "El usuario no existe o la contraseña es incorrecta";
      }

      if (!isset($_SESSION['usr_emp']) && !isset($_SESSION['usr_admin'])) {
        $error = "El usuario no existe o la contraseña es incorrecta";
      }

      $stmt->close();
      $conn->close();
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Farmacia TE - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="img/login_img.png"></img>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Farmacia TE</h1>
                  </div>
                  <form class="user" action="login.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="usuario" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingrese su usuario...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="contraseña">
                    </div>

                    <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="iniciar sesion">
                    <hr>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script>
    error = "<?php echo $error; ?>";
    if (error != "") {
      alert(error);
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
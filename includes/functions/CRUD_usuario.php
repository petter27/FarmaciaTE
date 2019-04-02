<?php 
require_once("bd_conexion.php");

#user image
$user_img = "";
$targetPath = "";
$user_img_name = "";

$mensaje = "";

if (isset($_POST['agg_user']) && isset($_FILES['user_img'])) {
  if (validarIMG()) {
    #datos
    $usuario = $_POST["user_name"];
    $pass1 = $_POST["user_pass"];
    $email = $_POST["user_email"];
    $pass2 = $_POST["user_pass2"];
    $tipo = $_POST["user_idtipo"];

    if (strlen($usuario) < 4 || $pass1 != $pass2 || strlen($pass1) < 5) {
      $mensaje .= "El nombre del usuario debe ser mas largo o la contraseña no coincide";
    } else {
      #subir img
      $img = mysqli_real_escape_string($conn, $_FILES["user_img"]["name"]);
      move_uploaded_file($user_img, $targetPath); // Moving Uploaded user_img

      $opciones = array(
        'cost' => 12
      );
      $hashed_password = password_hash($pass1, PASSWORD_BCRYPT, $opciones);

      try {
        $stmt = $conn->prepare("INSERT INTO usuario (usr_nombre,usr_password,usr_email,usr_tipo,usr_img)
                 values (?,?,?,?,?)");
        $stmt->bind_param("sssis", $usuario, $hashed_password, $email, $tipo, $user_img_name);

        $stmt->execute();

        if ($stmt->error) {
          $mensaje .= "BD ERROR: " . $stmt->error;
        } else {
          $mensaje .= "Usuario registrado correctamente";
        }
      } catch (Exception $e) {
        $mensaje .= "Error: " . $e->getMessage();
      }
    }
    Header("Location:../../configuracion.php?mensaje=$mensaje");
  } else echo "error";
}

if (isset($_POST['edit_user'])) { }

if (isset($_GET['delete_user'])) {
  $id = $_GET["delete_user"];
  try {
    require_once("bd_conexion.php");
    $sql = "UPDATE usuario set usr_estado=0 WHERE usr_id ={$id}";
    $resultado = $conn->query($sql);
  } catch (Exception $e) {
    $error = $e . getMessage();
  }

  Header("Location:../../configuracion.php");
}


function validarIMG()
{
  global $user_img, $targetPath, $mensaje, $user_img_name;

  #user image
  $user_img = $_FILES['user_img']['tmp_name'];
  $targetPath = "../../img/users/" . $_FILES["user_img"]["name"];
  $user_img_name = $_FILES["user_img"]["name"];

  $validextensions = array("jpeg", "jpg", "png", "JPG", "PNG");
  $temporary = explode(".", $_FILES["user_img"]["name"]);
  $file_extension = end($temporary);
  if (
    (($_FILES["user_img"]["type"] == "image/png") || ($_FILES["user_img"]["type"] == "image/jpg") || ($_FILES["user_img"]["type"] == "image/jpeg")) && ($_FILES["user_img"]["size"] < 5000000) //Approx. 5MB files can be uploaded.
    && in_array($file_extension, $validextensions)
  ) {
    if ($_FILES["user_img"]["error"] > 0) {
      $mensaje .=  "Código de Error: " . $_FILES["user_img"]["error"];
      die($mensaje);
    } else {
      if (file_exists("../../img/users/" . $_FILES["user_img"]["name"])) {
        $mensaje .=  'La imagen ' . $_FILES["user_img"]["name"] . " ya existe.";
        die($mensaje);
      } else {
        return true;
      }
    }
  } else {
    $mensaje .= " La Imagen que intenta subir es demasiado grande o no es una imagen";
    die($mensaje);
  }
}

<?php
require('./funciones.php');

session_start();
admin_autenticado();

require_once("bd_conexion.php");

$mensaje = "";

if (isset($_POST['agg_emp'])) {
  $nombre = $_POST['emp_name'];
  $apellido = $_POST['emp_lname'];
  $fechaN = $_POST['emp_bdate'];
  $usr_id = $_POST['emp_usrid'];

  if (strlen($nombre) < 4 || strlen($apellido) < 4 || $usr_id <= 0) {
    $mensaje .= "El nombre y apelido debe ser mas largo o seleccione un usuario válido";
  } else {
    try {
      $stmt = $conn->prepare("INSERT INTO empleado(emp_nombre,emp_apellido,emp_fechaN,usr_id) values (?,?,?,?)");
      $stmt->bind_param("sssi", $nombre, $apellido, $fechaN, $usr_id);

      $stmt->execute();

      if ($stmt->error) {
        $mensaje .= "BD ERROR: " . $stmt->error;
      } else {
        $mensaje = "Empleado registrado correctamente";
      }
    } catch (Exception $e) {
      $mensaje .= "Error: " . $e->getMessage();
    }
  }
  Header("Location:../../configuracion.php?msgemp=$mensaje");
}

if (isset($_POST['edit_emp'])) {
  $current_emp = $_POST['current_emp'];
  $nombre = $_POST['emp_name'];
  $apellido = $_POST['emp_lname'];
  $fechaN = $_POST['emp_bdate'];
  $usr_id = $_POST['emp_usrid'];

  if (strlen($nombre) < 4 || strlen($apellido) < 4 || $usr_id <= 0) {
    $mensaje .= "El nombre y apelido debe ser mas largo o seleccione un usuario válido";
  } else {
    try {
      $stmt = $conn->prepare("UPDATE empleado SET emp_nombre = ?, emp_apellido = ?, emp_fechaN = ?, usr_id = ? WHERE emp_id = ?");
      $stmt->bind_param("sssii", $nombre, $apellido, $fechaN, $usr_id, $current_emp);

      $stmt->execute();

      if ($stmt->error) {
        $mensaje .= "BD ERROR: " . $stmt->error;
      } else {
        $mensaje = "Empleado editado correctamente";
      }
    } catch (Exception $e) {
      $mensaje .= "Error: " . $e->getMessage();
    }
  }

  header("Location:../../configuracion.php?msgemp=$mensaje");
}

if (isset($_GET['delete_emp'])) {
  $emp_id = $_GET['delete_emp'];

  if ($emp_id > 0) {
    try {
      $stmt = $conn->prepare("UPDATE empleado SET emp_estado = 0 WHERE emp_id = ?");
      $stmt->bind_param("i", $emp_id);

      $stmt->execute();

      if ($stmt->error) {
        $mensaje .= "BD ERROR: " . $stmt->error;
      } else {
        $mensaje = "Empleado eliminado correctamente";
      }
    } catch (Exception $e) {
      $mensaje .= "Error: " . $e->getMessage();
    }
  } else {
    $mensaje = "El id es inválido";
  }

  header("Location:../../configuracion.php?msgemp=$mensaje");
}

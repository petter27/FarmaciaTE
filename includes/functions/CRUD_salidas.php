<?php
require('funciones.php');
require_once("bd_conexion.php");
session_start();
admin_autenticado();

if (isset($_POST['getmeds'])) {
  $idcat = $_POST['idcat'];

  $query = "SELECT med_id, med_nombre, med_stock, med_precioV FROM medicamentos WHERE cat_id = {$idcat} AND med_estado = 1;";
  $resultado = $conn->query($query);

  $meds = array();
  $meds_d = array();
  while (($row = mysqli_fetch_array($resultado))) {
    $meds_d['med'] = $row['med_nombre'];
    $meds_d['stock'] = $row['med_stock'];
    $meds_d['precio'] = $row['med_precioV'];

    $meds[$row['med_id']] = $meds_d;
  }
  print_r(json_encode($meds));
}

if (isset($_POST['agg_salida'])) {
  #obteniendo datos
  $data = json_decode($_POST['agg_salida']);
  #print_r(count($data));
  #id de la venta
  $id_venta = agg_salida($data[count($data) - 1]->total);

  $mensaje = "EXITO";

  for ($i = 0; $i < count($data) - 1; $i++) {
    if (agg_det_salida($data[$i]->id, $data[$i]->cant, $data[$i]->subtotal, $id_venta)) {
      #print_r($data[$i]);
      $act = disminuir_inventario($data[$i]->id,  $data[$i]->cant);
      if ($act != true) {
        $mensaje =  "ERROR disminuir_inv " . $act;
        break;
      }
    } else {
      $mensaje =  "ERROR agg_det";
      break;
    }
  }

  echo $mensaje;
}

#agrega a la tabla venta
function agg_salida($total)
{
  global $conn;
  if (isset($_SESSION['usr_admin'])) {
    $id_emp = $_SESSION['usr_admin']['id'];
  } else $id_emp = $_SESSION['usr_emp']['id'];

  $query = "INSERT INTO venta(emp_id,venta_fecha, venta_total) VALUES({$id_emp},current_timestamp(), {$total});";
  if (!$conn->query($query)) {
    return $conn->error;
  }
  return $conn->insert_id;
}

#agrega a la tabla detalle_venta
function agg_det_salida($med_id, $cantidad, $subtotal, $id_venta)
{
  global $conn;
  $query = "INSERT INTO detalle_venta(venta_id, med_id,det_venta_cantidad,det_venta_subtotal) 
          VALUES(?,?,?,?);";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('iidd', $id_venta, $med_id, $cantidad, $subtotal);
  $stmt->execute();

  if ($stmt->error) {
    return $stmt->error;
  }
  return true;
}

#disminuir los medicamentos
function disminuir_inventario($id_med, $cant)
{
  global $conn;
  $query = "UPDATE medicamentos SET med_stock = med_stock - {$cant} WHERE med_id = {$id_med};";
  #echo $query;
  try {
    $conn->query($query);
  } catch (Exception $e) {
    return $e->getMessage();
  }
  return true;
}

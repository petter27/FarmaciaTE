<?php
require('funciones.php');
require_once("bd_conexion.php");
session_start();
admin_autenticado();

if (isset($_POST['getmeds'])) {
  $idcat = $_POST['idcat'];

  $query = "SELECT med_id, med_nombre, med_stock, med_precioC FROM medicamentos WHERE cat_id = {$idcat} AND med_estado = 1;";
  $resultado = $conn->query($query);

  $meds = array();
  $meds_d = array();
  while (($row = mysqli_fetch_array($resultado))) {
    $meds_d['med'] = $row['med_nombre'];
    $meds_d['stock'] = $row['med_stock'];
    $meds_d['precio'] = $row['med_precioC'];

    $meds[$row['med_id']] = $meds_d;
  }
  print_r(json_encode($meds));
}

if (isset($_POST['agg_entrada'])) {
  #obteniendo datos
  $data = json_decode($_POST['agg_entrada']);
  #print_r(count($data));
  #id de la compra
  $id_compra = agg_entrada($data[count($data) - 1]->total);

  $mensaje = "EXITO";

  for ($i = 0; $i < count($data) - 1; $i++) {
    if (agg_det_entrada($data[$i]->id, $data[$i]->cant, $data[$i]->subtotal, $id_compra)) {
      #print_r($data[$i]);
      $act = aumentar_inventario($data[$i]->id,  $data[$i]->cant);
      if ($act != true) {
        $mensaje =  "ERROR aumentar_inv " . $act;
        break;
      }
    } else {
      $mensaje =  "ERROR agg_det";
      break;
    }
  }

  echo $mensaje;
}

#agrega a la tabla compra
function agg_entrada($total)
{
  global $conn;
  $query = "INSERT INTO compra(compra_fecha, compra_total) VALUES(current_timestamp(), {$total});";
  if (!$conn->query($query)) {
    return $conn->error;
  }
  return $conn->insert_id;
}

#agrega a la tabla detalle_compra
function agg_det_entrada($med_id, $cantidad, $subtotal, $id_compra)
{
  global $conn;
  $query = "INSERT INTO detalle_compra(compra_id, med_id,det_compra_cantidad,det_compra_subtotal) 
          VALUES(?,?,?,?);";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('iidd', $id_compra, $med_id, $cantidad, $subtotal);
  $stmt->execute();

  if ($stmt->error) {
    return $stmt->error;
  }
  return true;
}

#aumenta los medicamentos
function aumentar_inventario($id_med, $cant)
{
  global $conn;
  $query = "UPDATE medicamentos SET med_stock = med_stock + {$cant} WHERE med_id = {$id_med};";
  #echo $query;
  try {
    $conn->query($query);
  } catch (Exception $e) {
    return $e->getMessage();
  }
  return true;
}

<?php
session_start();
require_once('./funciones.php');
require_once('./bd_conexion.php');
admin_autenticado();


#Gráfico medicamentos más vendidos
if (isset($_POST['top_meds'])) {

  $query = "SELECT m.med_nombre medicamento, sum(dv.det_venta_cantidad) total FROM detalle_venta dv
	INNER JOIN medicamentos m on m.med_id = dv.med_id
    GROUP BY m.med_nombre
    ORDER BY total DESC
    LIMIT 6;";

  $aLabels = array();
  $aDatos = array();

  $error = "";
  try {
    $resultado = $conn->query($query);
    while ($top_med = $resultado->fetch_assoc()) {
      array_push($aLabels, "{$top_med['medicamento']}");
      array_push($aDatos, $top_med['total']);
    }
  } catch (Exception $e) {
    $error = $e . getMessage();
  }

  $json = array();
  $json['label'] = $aLabels;
  $json['data'] = $aDatos;
  $json['max'] = $aDatos[0] + 10;
  if ($error) {
    print_r($error);
  } else print_r(json_encode($json));
}

#gráfico categorías más usadas
if (isset($_POST['top_cats'])) {

  $query = "SELECT c.cat_nombre categoria, COUNT(c.cat_id) total FROM categoria_medicamento c
	INNER JOIN medicamentos m ON m.cat_id = c.cat_id
	INNER JOIN detalle_venta dv ON dv.med_id = m.med_id
    GROUP BY c.cat_nombre
    ORDER BY total DESC
    LIMIT 6;";

  $aLabels = array();
  $aDatos = array();

  $error = "";
  try {
    $resultado = $conn->query($query);
    while ($top_med = $resultado->fetch_assoc()) {
      array_push($aLabels, "{$top_med['categoria']}");
      array_push($aDatos, $top_med['total']);
    }
  } catch (Exception $e) {
    $error = $e . getMessage();
  }

  $json = array();
  $json['label'] = $aLabels;
  $json['data'] = $aDatos;
  if ($error) {
    print_r($error);
  } else print_r(json_encode($json));
}

<?php

#user image
$med_img = ""; #temp name
$targetPath = ""; #path
$med_img_name = ""; #real name

$mensaje = "";

if (isset($_POST["btnAgregarMed"])) {

    $nombre = $_POST["txtMedicamento"];
    $precio_compra = $_POST["txtPrecioCompra"];
    $precio_venta = $_POST["txtPrecioVenta"];
    $presentacion = $_POST["comboP"];
    $categoria = $_POST["comboC"];
    $fechaV = $_POST["fechaMed"];
    $stock = $_POST["txtStock"];
    $estado = 1;

    $targetPath = "../../img/products/" . $url_img;

    if ($nombre == "" || $precio_compra == "" || $precio_venta == "" || validarIMG() == false) {
        $mensaje .= " - Ingrese los campos requeridos";
    } else {

        try {
            require_once("bd_conexion.php");
            $stmt = $conn->prepare("INSERT INTO medicamentos (med_nombre,med_stock,med_precioC,med_precioV,cat_id, pre_id, med_fechaV, med_estado,med_img)
             values (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sissiisis", $nombre, $stock, $precio_compra, $precio_venta, $categoria, $presentacion, $fechaV, $estado, $med_img_name);
            $stmt->execute();

            move_uploaded_file($med_img, $targetPath);

            $mensaje .= $imagen . ' - ' . $targetPath . ' - ' . $med_img_name;

            if ($stmt->error) {

                $mensaje = $stmt->error;
            } else {

                $mensaje .= " Medicamento registrado correctamente";
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $mensaje .= "Error: " . $e->getMessage();
        }
    }
}


Header("Location: ../../agg_medicamento.php?mensaje=$mensaje");

function validarIMG()
{
    global $med_img, $targetPath, $mensaje, $med_img_name;

    #user image
    $med_img = $_FILES['file']['tmp_name'];
    $targetPath = "../../img/products/" . $_FILES["file"]["name"];
    $med_img_name = $_FILES["file"]["name"];

    $validextensions = array("jpeg", "jpg", "png", "JPG", "PNG");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if (
        (($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 5000000) //Approx. 5MB files can be uploaded.
        && in_array($file_extension, $validextensions)
    ) {
        if ($_FILES["file"]["error"] > 0) {
            $mensaje .=  "Código de Error: " . $_FILES["file"]["error"];
            die($mensaje);
        } else {
            if (file_exists("../../img/products/" . $_FILES["file"]["name"])) {
                $mensaje .=  'La imagen ' . $_FILES["file"]["name"] . " ya existe.";
                die($mensaje);
            } else {
                return true;
            }
        }
    } else {
        $mensaje .= " La Imagen que intenta subir es demasiado grande o no es una imagen";
        die($mensaje);
        return false;
    }
}

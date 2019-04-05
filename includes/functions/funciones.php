<?php

function admin_autenticado()
{
    if (!revisar_admin()) {
        header("Location:login.php");
    }
}


function emp_autenticado()
{
    if (!revisar_emp()) {
        header("Location:login.php");
    }
}

function revisar_admin()
{
    return isset($_SESSION["usr_admin"]);
}

function revisar_emp()
{
    return isset($_SESSION["usr_emp"]);
}

#Función que valida el formato y peso de una imagen
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

<?php

if (isset($_POST["btnAgregar"])) {
    $usuario = $_POST["user"];
    $pass1 = $_POST["pass1"];
    $email = $_POST["email"];
    $pass2 = $_POST["pass2"];
    $tipo = $_POST["ddlTipo"];
    $estado = 1;

    if (strlen($usuario) < 4 || $pass1 != $pass2 || strlen($pass1) < 5) {
        $mensaje = "El nombre del usuario debe ser mas largo o la contraseña no coincide";
    } else {
        $opciones = array(
            'cost' => 12
        );
        $hashed_password = password_hash($pass1, PASSWORD_BCRYPT, $opciones);

        try {
            require_once("includes/functions/bd_conexion.php");
            $stmt = $conn->prepare("INSERT INTO usuario (usr_nombre,usr_password,usr_email,usr_tipo,usr_estado)
                 values (?,?,?,?,?)");
            $stmt->bind_param("sssii", $usuario, $hashed_password, $email, $tipo, $estado);
            $stmt->execute();

            if ($stmt->error) {

                $mensaje = "Hubo un error";
            } else {

                $mensaje = "Usuario registrado correctamente";
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
    }
    Header("Location:configuracion.php?mensaje=$mensaje");
}
 
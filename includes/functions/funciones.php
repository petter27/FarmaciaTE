<?php

function admin_autenticado(){
    if(!revisar_admin()){
        header("Location:login.php");
    }
}

function revisar_admin(){
    return isset($_SESSION["usr_admin"]);
}

?>
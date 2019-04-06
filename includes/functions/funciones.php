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

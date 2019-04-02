<?php

session_start();

if (isset($_POST['logout'])) {
if (isset($_SESSION["usr_emp"])) {
session_destroy();
}
if (isset($_SESSION["usr_admin"])) {
session_destroy();
}

Header("Location:../../login.php");
} 
?>
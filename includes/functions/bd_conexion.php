<?php
$conn=new mysqli("localhost","root","","farmacia_te");

if($conn->connect_error){
    echo $error -> $conn->connect_error;
}
?>
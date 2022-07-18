<?php

$hostname='localhost';
$database='login_php';
$userDb='root';
$passwordDb='';

$conexion=new mysqli($hostname,$userDb,$passwordDb,$database);

if($conexion->connect_errno){
    echo "El sitio web está experimentando problemas";
}

?>
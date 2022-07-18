<?php
include 'conexion.php';

$sha2 = $_GET["key"];
$estado = "activa";

$consulta = "UPDATE usuario SET estado='" . $estado . "' WHERE codigo_hash='" . $sha2 ."'";

mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

mysqli_close($conexion);

echo '<h1 style="text-align:center;margin-top:8rem">La cuenta ha sido Activada, ya puede iniciar sesión.</h1>';

/* header("Location: /login/index.html"); */

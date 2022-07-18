<?php
include 'conexion.php';

$id_usuario = $_SESSION['id_usuario'];
$pass = $_SESSION['pass'];

$hash = password_hash($pass, PASSWORD_BCRYPT);

$consulta = "UPDATE usuario SET password='" . $hash . "' WHERE id_usuario='" . $id_usuario . "'";

mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
mysqli_close($conexion);

echo '<script language="javascript">
alert("Se ha cambiado la contraseña de manera satisfactoria!");

window.location.href = "../index.html";
</script>';

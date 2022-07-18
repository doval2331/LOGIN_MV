<?php
include 'conexion.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$sha2 = $_GET["key"];

$sentencia = $conexion->prepare("SELECT * FROM usuario WHERE codigo_hash=?");
$sentencia->bind_param('s', $sha2);
$sentencia->execute();

$resultado = $sentencia->get_result();

if ($fila = $resultado->fetch_assoc()) {
  $found = json_encode($fila, JSON_UNESCAPED_UNICODE);
}

$_SESSION['id_usuario'] = $fila['id_usuario'];

$sentencia->close();
$conexion->close();

echo '<script language="javascript">
  window.location.href = "../Vista/cambiar_pass.html";
</script>'; 

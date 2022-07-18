<?php
include 'conexion.php';

$user = $_SESSION['user'];
$pass = $_SESSION['pass'];

$sentencia = $conexion->prepare("SELECT * FROM usuario WHERE username=?");
$sentencia->bind_param('s', $user);
$sentencia->execute();

$resultado = $sentencia->get_result();

if ($fila = $resultado->fetch_assoc()) {
  json_encode($fila, JSON_UNESCAPED_UNICODE);
}

$hash = $fila["password"];
$tipo_usuario = $fila["tipo"];

$sentencia->close();
$conexion->close();

if ($fila["estado"] == "activa") {

  if (password_verify($pass, $hash)) {

    if ($tipo_usuario == "1") {
      echo '<script language="javascript">
        window.location.href = "../Vista/home_user.html";
      </script>';
    } else {
      if ($tipo_usuario == "2") {
        echo '<script language="javascript">
          window.location.href = "../Vista/home_admin.html";
        </script>';
      }
    }
  } else {
    echo '<script language="javascript">
      alert("Contraseña Incorrecta!");

      history.back();
    </script>';
    return;
  }
} else {
  echo '<script language="javascript">
    alert("No posee una cuenta Activa. Si ya creó una por favor, verifíquela ingresando a tu correo electrónico!");

    history.back();
  </script>';
}
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if ($_POST['modo'] == 'correo') {
  $_SESSION['campo'] = 'email';
  $_SESSION['valor'] = $_POST['correo'];
} else {
  if ($_POST['modo'] == 'usuario') {
    $_SESSION['campo'] = 'username';
    $_SESSION['valor'] = $_POST['usuario'];
  }
}


include '../Modelo/restaurar.php';

?>
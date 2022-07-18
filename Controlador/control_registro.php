<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION['id'] = $_POST['id'];
$_SESSION['nombres'] = $_POST['nombres'];
$_SESSION['apellidos'] = $_POST['apellidos'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['tipo'] = $_POST['tipo'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['dependencia'] = $_POST['dependencia'];
$_SESSION['estado'] = 'desactiva';

include '../Modelo/mailer.php';

?>
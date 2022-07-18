<?php

include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$id = $_SESSION['id'];
$nombres = $_SESSION['nombres'];
$apellidos = $_SESSION['apellidos'];
$email = $_SESSION['email'];
$tipo = $_SESSION['tipo'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dependencia = $_SESSION['dependencia'];
$estado = $_SESSION['estado'];

$sha2 = hash('sha256', $id);


$link = "http://localhost/login/Modelo/activar.php?key=" . $sha2;


$hash = password_hash($password, PASSWORD_BCRYPT);

$consulta = "INSERT INTO usuario(id_usuario, nombres, apellidos, email, tipo, username, password, dependencia, estado, codigo_hash)
   VALUES('" . $id . "','" . $nombres . "','" . $apellidos . "','" . $email . "','" . $tipo . "','" . $username . "','" . $hash . "','" . $dependencia . "','" . $estado . "','" . $sha2 . "')";

mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

mysqli_close($conexion);


/* ________________________________________________________________________________________________________ */



require 'C:\xampp\htdocs\login\Modelo\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\login\Modelo\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\login\Modelo\PHPMailer-master\src\SMTP.php';


$mail = new PHPMailer(true);

try {

  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  //Server settings
  $mail->SMTPDebug = 0;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->CharSet = 'UTF-8';
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'bmanerios@gmail.com';                     //SMTP username
  $mail->Password   = 'txbtborkqqsoagow';//'Password0*';                               //SMTP password
  $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('bmanerios@gmail.com', 'Mailer');
  $mail->addAddress($email, $username);     //Add a recipient
  //$mail->addAddress('ellen@example.com');               //Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //Attachments
  //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Confirmación de Creación de Cuenta';
  $mail->Body = "<br><br>Hola, " . $nombres . " " . $apellidos . "!<br><br>" . "Aquí está el Link de activación de tu cuenta: " . $link . ".<br><br>" . "Por favor, dale Click para poder continuar con tu inicio de sesión.";
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'El Mensaje ha sido enviado con éxito!';
} catch (Exception $e) {
  echo "El Mensaje no puso ser enviado. Error: {$mail->ErrorInfo}";
}

echo '<script language="javascript">
  alert("Se han ingresado los datos. Por favor, revisar su correo electrónico para activar su cuenta!");

  window.location.href = "../index.html";
</script>';
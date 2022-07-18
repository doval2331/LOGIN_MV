<?php
include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$campo = $_SESSION['campo'];
$valor = $_SESSION['valor'];

$sentencia = $conexion->prepare("SELECT * FROM usuario WHERE $campo =?");
$sentencia->bind_param('s', $valor);
$sentencia->execute();

$resultado = $sentencia->get_result();

if ($fila = $resultado->fetch_assoc()) {
  $found = json_encode($fila, JSON_UNESCAPED_UNICODE);
} else {
  echo '<script language="javascript">
  alert("El Usuario No Existe!");

  history.back();
  </script>'; 
}

$sentencia->close();
$conexion->close();

$email = $fila["email"]; 
$sha2 = $fila["codigo_hash"];

//Enviar código al correo para su posterior revisión
$link = "http://localhost/login/Modelo/reset.php?key=" . $sha2;



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
  $mail->addAddress($email, 'User');     //Add a recipient
  //$mail->addAddress('ellen@example.com');               //Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //Attachments
  //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Recuperación de la Cuenta';
  $mail->Body = "<br><br>Hola, Aquí está el Link para obtener tu nueva contraseña: " . $link . ".<br><br>" . "Por favor, dale Click para poder continuar el proceso.";
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'El Mensaje ha sido enviado con éxito!';
} catch (Exception $e) {
  echo "El Mensaje no puso ser enviado. Error: {$mail->ErrorInfo}";
}

echo '<script language="javascript">
  alert("Por favor, revisar su correo electrónico para restaurar su contraseña!");

  history.back();
</script>';
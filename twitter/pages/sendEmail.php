<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='yourmail@gmail.com';
// application password goes here, not the actual email password
$mail->Password='appPassword';
$mail->SMTPSecure='ssl';
$mail->Port=465;

$mail->setFrom('yourmail@gmail.com');
$mail->addAddress('receiveremail@gmail.com');
$mail->isHTML(true);
$mail->Subject='Test from php';
$mail->Body='<h1>Prueba de correo desde PHP</h1>';
$mail->send();

?>

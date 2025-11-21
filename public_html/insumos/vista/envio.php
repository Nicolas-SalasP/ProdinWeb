<?php
require("class.phpmailer.php");
require("class.smtp.php");

$mail = new PHPMailer();

$mail->IsSMTP(); // set mailer to

$mail->Host = "mail.gtd.cl";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "printer@insuban.cl";  // SMTP username
$mail->Password = "insuban391"; // SMTP password

$mail->From = "dtrigo@insuban.cl";
$mail->FromName = "remitente";        // remitente
$mail->AddAddress("dtrigo@insuban.cl", "destinatario");        // destinatario

$mail->AddReplyTo("dtrigo@insuban.cl", "respuesta a");    // responder a

//$mail->WordWrap = 50;     // set word wrap to 50 characters
$mail->IsHTML(true);     // set email

$mail->Subject = "Asunto .....";
$mail->Body    = "This is the HTML message body <b>in bold!</b>";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";                                                                                                 
?>  
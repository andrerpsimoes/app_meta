
<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Europe/Lisbon');
require 'php/phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail servers
$mail->Host = 'tls://smtp.gmail.com:587';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "carlos.girao77@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "gmdtai11";
//Set who the message is to be sent from
$mail->setFrom('carlos.girao77@gmail.com', 'Teste Mail');
//Set an alternative reply-to address
$mail->addReplyTo('carlos.girao77@gmail.com', 'Teste Mail');
//Set who the message is to be sent to
$email='carlos.girao77@gmail.com'; $nome='Carlos';
$mail->addAddress($email, $nome);
//Set the subject line
$mail->Subject = 'Metaveiro - Testes';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('email.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'A equipa do TECLA 2017 agradece o seu registo.';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
?>
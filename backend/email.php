<?php
$mail = new PHPMailer();

$mail->Host = 'smtp.mailersend.net';

$mail->Port = 465;

$mail->SMTPAuth = true;

$mail->SMTPSecure = ssl;

$mail->Username = 'fromaddress@mailersend.com';

$mail->Password = 'yoursmtppassword';

$mail->send();

if (!$mail->send()) {

    echo 'Email could not be sent.';

    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo 'Email was successfully sent.';

}
?>
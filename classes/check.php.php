<?php
echo "hello";
require 'phpmailer/PHPMailerAutoload.php';
echo "hello";
$mail = new PHPMailer();


$mail->Host = "smtp.gmail.com";
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Username = 'kiryanoonlineshopping@gmail.com';
$mail->Password = 'kiryanO1@#';
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Subject = 'SMTP email test';
$mail->Body = 'this is some body';
$mail->setFrom('k173705@nu.edu.pk', 'Senaid Bacinovic');
$mail->addAddress('neerajjb1@gmail.com');
if ($mail->send())
{
    echo "Mail sent";
}
    
else
{
echo "something happend";    
}


?>
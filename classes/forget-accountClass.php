<?php
require 'phpmailer/PHPMailerAutoload.php';
include ("dbClass.php");


class forget_account
{
    function __construct()
	{
		 $this->conn= db::connect();
	}
    
    function check_email($user_email)
    {
        global $password;
        global $var1;
        $var1 = "Neeraj";
        $sql="SELECT email,f_name,pass from customer where email ='$user_email' ";
        $result=mysqli_query($this->conn,$sql);
        $num_rows = mysqli_num_rows($result);
        $row = $result->fetch_object();
        $password = $row->pass;
        
        if($num_rows)
        {
            
          return 1;
        }  
        else
        {
            return 0;
        }
        
    }
    
    
    
    function send_password($user_email)
    
    {   
        
        
        $mail = new PHPMailer();


$mail->Host = "mail.kiryano.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'no-reply@kiryano.com';
$mail->Password = 'kiryanO1@#';

$mail->setFrom('no-reply@kiryano.com', 'kiryano');
$mail->addAddress($user_email);
$mail->Subject = 'Kiryano PASSWORD RECOVERY';
$mail->isHTML(true);
$mail->Body = "Dear Customer, Your Account Password is 4 {$var1} " ;

    if ($mail->send())
    {
    
    return 1;
    }
    else
    {
    return 0;
        
    }
        
        
}
    
    
    
}
    
    




?>
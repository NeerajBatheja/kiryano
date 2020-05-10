<?php
	
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'greenfarm');

$email=$_POST['Vmail'];
$pass =$_POST['Vpass'];

$s = "select * from usertable where email ='$email' and password = '$pass'";

$result = mysqli_query($con,$s);
$num = mysqli_num_rows($result);

if($num ==1){
	echo "login successfull";
}else{
		echo "either email or passwrod is wrong";
}

?>
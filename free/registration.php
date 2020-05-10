<?php
	
session_start();
//header('location:login-registrer.php');

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'greenfarm');

$first =$_POST['first'];
$last =$_POST['last'];
$email=$_POST['mail'];
$pass =$_POST['pass'];
$pass_C =$_POST['pass_C'];

if($pass == $pass_C){
	echo "'$first','$last','$email','$pass'";

	$s = "select * from usertable where email ='$email'";

	$result = mysqli_query($con,$s);

	$num = mysqli_num_rows($result);

	if($num ==1){
		echo "Email already Exist";
	}else{
		
		$reg = "insert into usertable (first,last,email,password) values ('$first','$last','$email','$pass')";
		if(mysqli_query($con,$reg))
			echo "registration sucessfull";
		}

}else{
	echo "password do not match";
}


?>
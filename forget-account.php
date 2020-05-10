<?php
include_once('classes/forget-accountClass.php');

                                        

?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Password Recovery-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
	<meta name="description" content="Kiryano is Pakistan based online shopping store . Kiryano Serve  Gorcery,latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" href="assets/images/favicon.ico">

	<!-- CSS
	============================================ -->
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- FontAwesome CSS -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- Elegent CSS -->
	<link href="assets/css/elegent.min.css" rel="stylesheet">

	<!-- Plugins CSS -->
	<link href="assets/css/plugins.css" rel="stylesheet">

	<!-- Helper CSS -->
	<link href="assets/css/helper.css" rel="stylesheet">

	<!-- Main CSS -->
	<link href="assets/css/main.css" rel="stylesheet">

	<!-- Modernizer JS -->
	<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>

	<!--=============================================
	=            Header         =
	=============================================-->

	<?php
		$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
		include($IPATH."header.php");
		
	?>

	<!--=====  End of Header  ======-->

	<!--=============================================
	=            Login register page content         =
	=============================================-->
<div class="page-content mb-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
					<!-- Login Form s-->
					<form name="Login" action="" method="post" >

						<div class="login-form">
							<h4 class="login-title">Enter Your Registered Email</h4>
								<div class="row">
								<div class="col-md-12 col-12 mb-20">
									<label>Phone*</label>
									<input class="mb-0" name='Vmail' type="number" placeholder="Enter Phone Number - 03XXXXXXXXX" size="30" required>
									
								</div>
								
								<div class="col-md-8">
								<?php
									$user1= new forget_account();

							if(isset($_POST['login']))
									{
									    $user_email=$_POST['Vmail'];
								if($user1->check_email($user_email) ==1)
									    {
									         
									   if($user1->send_password($user_email))
									   {
									   echo '<font color="green">We Have Sent Password To Your Email! </font>';    
									   echo '<br><font color="red">Check Spam Folder Also!</font>';
									   
									       
							
									    }
									   else{ 
									       echo '<font color="red">Somthing Wrong Happend,Try Again.<br> Check Spelling: <font>';echo $user_email;
									        }
									    }
								else
								 {
								 echo '<font color="red">Please Enter Correct Email.</font>';
								 }
									}
									else
									{
									    
									     echo '<font color="blue">Pro Tip: Change Password Immediately After Receiving It.</font>';
									} 
                                        

?>

									
								</div>

								<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
									<a href="#"> Forget Email?</a>
								</div>

								<div class="col-md-12">
									<button type="submit" name="login" class="register-button mt-0">Submit</button>
									
									
									
								</div>
								
								</div>

							
							
						</div>

					</form>
				</div>
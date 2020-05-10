<?php
if(session_start()){
    unset($_SESSION['aemail']);
    unset($_SESSION['apass']);
}
include_once("classes/adminClass.php");
$user1 = new admin();
	
if(isset($_POST['login'])){

	$email=$_POST['Vmail'];
	$pass =$_POST['Vpass'];

	if($user1->validate($email,$pass) ==1){
		//echo "login successfull";
		$_SESSION["aemail"]=$email;
		$_SESSION["apass"]=$pass;
		
		if(!header("location: admin.php"))
		   echo 'yaha tak chal gaya'; 
		
	}else{
			echo "either email or passwrod is wrong";
	}
}
	
?>

<!--  registration -->
<?php
	if(isset($_POST['register'])){

		$first =$_POST['first'];
		$email=$_POST['mail'];
		$pass =$_POST['pass'];
		$pass_C =$_POST['pass_C'];

		if($pass == $pass_C){
			
			if($user1->insert($first,$email,$pass)){
				echo "registered successfully";
			}else{
				echo "email already exist";
			}
		}else{
				echo "	password do not match";
		}
	}

?>

<head class="no-js" lang="zxx"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Admin Login-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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

	<!--=============================================
	=            Header         =
	=============================================-->

	<header>

		<!--=======  header bottom  =======-->

		<div class="header-bottom header-bottom-one header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
						<!-- logo -->
						<div class="logo mt-15 mb-15">
							<a href="index.html">
								<img src="assets/images/logo.png" class="img-fluid" alt="">
							</a>
						</div>
						<!-- end of logo -->
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
							
							</div>
						</div>
					</div>
					<div class="col-12">
						<!-- Mobile Menu -->
						<div class="mobile-menu d-block d-lg-none"></div>
					</div>
				</div>
			</div>
		</div>

		<!--=======  End of header bottom  =======-->
	</header>

	<body>
		<!-- My Account Tab Menu Start -->
	<div class="page-content mb-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
					<!-- Login Form s-->
					<form name="Login" action="" method="post" >

						<div class="login-form">
							<h4 class="login-title">Login</h4>
								<div class="row">
								<div class="col-md-12 col-12 mb-20">
									<label>Email Address*</label>
									<input class="mb-0" name='Vmail' type="email" placeholder="Email Address">
								</div>
								<div class="col-12 mb-20">
									<label>Password</label>
									<input class="mb-0" name="Vpass" type="password" placeholder="Password">
								</div>
								<div class="col-md-8">
									
									<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
										<input type="checkbox" id="remember_me">
										<label for="remember_me">Remember me</label>
									</div>
									
								</div>

								<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
									<a href="#"> Forgot password?</a>
								</div>

								<div class="col-md-12">
									<button type="submit" name="login" class="register-button mt-0">Login</button>
								</div>
								

								</div>

							
							
						</div>

					</form>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
					<form name="registration" action="" method="post">

						<div class="login-form">
							<h4 class="login-title">Register</h4>
							<div class="row">
								<div class="col-md-6 col-12 mb-20">
									<label>Name</label>
									<input class="mb-0" name="first" type="text" placeholder="Name">
								</div>
								<div class="col-md-12 mb-20">
									<label>Email Address*</label>
									<input class="mb-0" name="mail" type="email" placeholder="Email Address">
								</div>
								<div class="col-md-6 mb-20">
									<label>Password</label>
									<input class="mb-0" name="pass" type="password" placeholder="Password">
								</div>
								<div class="col-md-6 mb-20">
									<label>Confirm Password</label>
									<input class="mb-0" name="pass_C" type="password" placeholder="Confirm Password">
								</div>
								<div class="col-12">
									<button type="submit" name= "register" class="register-button mt-0" >Register</button>
								</div>
							</div>
							
							
						</div>


					</form>
					
				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of Login register page content  ======-->
	<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."footer.php");
	?>

	
	<!--=====  End of Footer  ======-->
	</body>

	<!--=====  End of Header  ======-->
	<script src="assets/js/vendor/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js"></script>

	<!-- Main JS -->
	<script src="assets/js/main.js"></script>
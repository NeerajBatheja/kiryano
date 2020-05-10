<?php
session_start();
include_once("classes/userClass.php");
 
	$user1 = new user();
	    if(isset($_GET['logout']))
	    {   setcookie("email",$email , time()-3600);
	        setcookie("pass",$pass , time()-3600);
	        session_unset();
	        session_destroy();
	    }
		if(isset($_SESSION['email']) && isset($_SESSION['pass'])){
			// header("location: my-account.php");
            echo "<script async>window.location.href='my-account.php';</script>";
                exit;

		}
		
		
		
		
	if(isset($_POST['login'])){

		$email=$_POST['Vmail'];
		$pass =$_POST['Vpass'];
		if($user1->validate($email,$pass) ==1){
			//echo "login successfull";
			
			$_SESSION['email']=$email;
			$_SESSION['pass']=$pass;
			
			if(isset($_POST['remember_me']))
			{
			  setcookie('email',$email,time()+60*60*24*180);
			  setcookie('pass',$pass,time()+60*60*24*180);
			}
		
			if($_GET['loc']==1){
				//header("location: wishlist.php");
		        echo "<script async>window.location.href='wishlist.php';</script>";
                exit;}
                else if($_GET['loc']==2){
				//header("location: contact.php");
				echo "<script async>window.location.href='contact.php';</script>";
                exit;}
				else if($_GET['loc']==3){
				//header("location: compare.php");
				echo "<script async>window.location.href='compare.php';</script>";
                exit;
			}else if($_GET['loc']==4){
				echo "<script async>window.location.href='cart.php';</script>";
				exit;
			}else
			{
			    //header("location: my-account.php");   
			    echo "<script async>window.location.href='my-account.php';</script>";
				exit;
			}
			
			
		}else{
		    $invalid_login = 1;
		}
	}
	
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Login and Registration-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
	<script src="assets/js/vendor/modernizr-2.8.3.min.js" async></script>

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
						    <?php 
						    if(isset($_GET['loc'])){ 
echo'<h5><font color="#2f21ff">Please Login To Continue...<br> Not Have a Account? Take a Minute And Create a New Account.</font></h5>';
    
}
?>
							<h4 class="login-title">Login</h4>
							<?php  if($invalid_login)echo '<h5 style="color:red;">Either email or passwrod is wrong</h5>'; ?>
								<div class="row">
								    
								<div class="col-md-12 col-12 mb-20">
									<label>Phone*</label>
									<input class="mb-0" name='Vmail' type="tel" placeholder="03XXXXXXXXX" maxlength="11" size="30" required>
								</div>
								<div class="col-12 mb-20">
									<label>Password</label>
									<input class="mb-0" name="Vpass" type="password" placeholder="Password" minlength="4" maxlength="20" required>
								</div>
								<div class="col-md-8">
									
									<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
										<input type="checkbox" id="remember_me" name="remember_me" method="post">
										<label for="remember_me">Remember me</label>
									</div>
									
								</div>

								<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
									<a href="forget-account.php"> Forgot password?</a>
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
							<h4 class="login-title">Create Account</h4>
							<!--  registration -->
<?php
	if(isset($_POST['register'])){

		$first =$_POST['first'];
		$last =$_POST['last'];
		$email="none@gmail.com";
		$pass =$_POST['pass'];
		$pass_C =$_POST['pass_C'];
		$phone = $_POST['phone'];

		if($pass == $pass_C){
			
			if($user1->insert($first,$phone,$pass,$email)){
			$_SESSION['email']=$phone;
			$_SESSION['pass']=$pass;
			setcookie('Phone',$phone,time()+60*60*30);
			setcookie('pass',$pass,time()+60*60*30);
			if($_GET['loc']==1){
				//header("location: wishlist.php");
		        echo "<script async>window.location.href='wishlist.php';</script>";
                exit;}
                else if($_GET['loc']==2){
				//header("location: contact.php");
				echo "<script async>window.location.href='contact.php';</script>";
                exit;}
				else if($_GET['loc']==3){
				//header("location: compare.php");
				echo "<script async>window.location.href='compare.php';</script>";
                exit;
			}else if($_GET['loc']==4){
				echo "<script async>window.location.href='cart.php';</script>";
				exit;
			}else
			{
			    //header("location: my-account.php");   
			    echo "<script async>window.location.href='my-account.php';</script>";
				exit;
			}
			}else{
				echo '<h4><font color="green" >Email Already Exist</font></h4>';
			}
		}else{
				
				echo '<h4><font color="green" >Password Do Not Match</font></h4>';
		}
	}

?>

							<div class="row">
								<div class="col-md-12 col-12 mb-20">
									<label>Full Name</label>
									<input class="mb-0" name="first" type="text" placeholder="First Name" pattern ="[A-Za-z].{3,}" title="Only alphabates are allowed. and name size must be between 3 and 30 characters" size="30"  required>
								</div>
								<br>
								<div class="col-md-6 mb-20">
									<label>Password</label>
									<input class="mb-0" name="pass" type="password" placeholder="Password"  minlength="4" maxlength="20" title="Password must be between 4 to 20 characters" required>
								</div>
								<div class="col-md-6 mb-20">
									<label>Confirm Password</label>
									<input class="mb-0" name="pass_C" type="password" placeholder="Confirm Password"  minlength="4" maxlength="20" title="Password must be between 4 to 20 characters" required>
								</div>
								
								<div class="col-md-6 mb-20">
									<label>Phone</label>
									<input class="mb-0" name="phone" type="tel" placeholder="03XXXXXXXXX" maxlength="11" size="12" title="please enter number in given pattern '03XXXXXXXXX'" required>
								</div>
								<!--<div class="col-md-12 mb-20">
									<label>Email Address*</label>
									<input class="mb-0" name="mail" type="email" placeholder="Email Address" size="30" required>
								</div>-->
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
	<!-- scroll to top  -->
	<a href="#" class="scroll-top"></a>
	<!-- end of scroll to top -->
	<!-- JS
	============================================ -->
	<!-- jQuery JS -->
	<script src="assets/js/vendor/jquery.min.js" async></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js" async></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js" async></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js" async></script>

	<!-- Main JS -->
	<script src="assets/js/main.js" async></script>
		<!--Retain scroll position -->  
<script async>
$(document).ready(function(){
var saveScroll = 0;
$(window).scroll(function(){
var saveScroll = $(window).scrollTop();
//setting cookie for saving javascript variable as we can get it after refreshing the page
document.cookie = "saveScroll = " + saveScroll

    
});

});
</script>
<script async>
    //getting cookie back to javascript variable using php cookie function
    getcookie = '<?php echo $_COOKIE['saveScroll']; ;?>';
    $(window).scrollTop(getcookie);
    // destroying cookie
    document.cookie = "saveScroll=; max-age=0";
</script>    

</body>


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:15 GMT -->
</html>
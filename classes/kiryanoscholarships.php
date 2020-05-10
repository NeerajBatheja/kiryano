<?php
$check = session_start();
include_once("classes/userClass.php");
$user2 = new user();
if(isset($_POST['cv']) || isset($_POST['appemail']) )
{
    $mail=$_POST['appemail'];
    $cv = $_POST['cv'];
    $user2->jobs_update($mail,$cv);


}
 ?>
 
 <!DOCTYPE html>
<html class="no-js" lang="zxx">
<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
	
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Kiryano-Delivery And Shipping Details</title>
	<meta name="description" content="Kiryano Online Shopping in Pakistan Shipping details">
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

	<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."header.php");
	?>
	<!--=============================================
	=            Contact page content         =
	=============================================-->
	
	<div class="page-content mb-50">

		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 mb-xs-35">
					<!--=======  contact page side content  =======-->
					
					<div class="contact-page-side-content">
						<h3 class="contact-page-title"></h3>

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
							<h5><B><img src="assets/images/icons/jobs.png" alt=""> <br><br></B></h5>
							
						</div>
						
						<!--=======  End of single contact block  =======-->

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
						    <h4><img src="assets/images/icons/contact-icon1.png" alt=""> Address</h4>
							<p>A-816 Sindhu chock, Karachi, Pakistan</p>
							
						</div>
						
						<!--=======  End of single contact block  =======-->

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
							
							
						</div>
						
						<!--=======  End of single contact block  =======-->
					</div>
					
					<!--=======  End of contact page side content  =======-->

				</div>
				<div class="col-lg-9 col-md-8 pl-100 pl-xs-15">
					<!--=======  contact form content  =======-->
					
					<div class="contact-form-content"><br><br>
						<h3 class="contact-page-title">KIRYANO JOBS</h3>

						<div class="contact-form">
							<form  id="contact-form" action="https://demo.hasthemes.com/greenfarm-preview/greenfarm/assets/php/mail.php" method="post"></form>
								<div class="form-group">
									<ul style="list-style-type:circle;">
   <h4> <li>For Any Query: <strong>SCHOLARSHIPS@KIRYANO.COM</strong</li><br></h4>
   <h5><strong>Keep Update Regarding Kiryano Scholarships</strong></h5>
                                <div class="col-md-12 col-12 mb-20">
								<form name="jobs" action="" method="post" >
									<label>Email Address*</label>
									<input class="mb-0" name='cv' type="text" placeholder="Provide Electronic CV" size="30" >
									<br><br>
									<h4><strong><li></li></strong></h4>
									<label>Why You Need Kiryano Scholarship?</label>
									<input class="mb-0" name='appmail' type="email" placeholder="Email Address" size="30" >
								
								</div>
								<div class="col-md-12">
									<button type="submit" name="jobs" class="register-button mt-0">Submit</button>
								</div>
								
								</div>
								</form>
</ul>


								</div>
								<div class="form-group">
									
								</div>
								<div class="form-group">
									
								</div>
								<div class="form-group">
									
								</div>
								<div class="form-group">
									
								</div>
							</form>
						</div>
						<p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
					</div>
					
					<!--=======  End of contact form content =======-->
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	<!--=====  End of Contact page content  ======-->

	<!-- scroll to top  -->
	<a href="#" class="scroll-top"></a>
	<!-- end of scroll to top -->
	
	<!-- JS
	============================================ -->
	<!-- jQuery JS -->
	<script src="assets/js/vendor/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js"></script>

	<!-- Main JS -->
	<script src="assets/js/main.js"></script>

	<!-- AJAX mail JS -->
	<script src="assets/js/ajax-mail.js"></script>
						<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."footer.php");
	?>

	
	<!--=====  End of Footer  ======-->

</body>

<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:17 GMT -->
</html>
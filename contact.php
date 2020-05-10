<?php
session_start();
include_once('classes/userClass.php');
$user;
$user1= new user();

    if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){

        $email=$_SESSION['email'];
        if ($result=$user1->fetch_data($email))
          {
            foreach ($result as $row) {
                $user=$row;
            }

        }else{
            echo "didnt fetched";
        }
    }
    else{
        //header('location:login-registrer.php?loc=2');
echo "<script>window.location.href='login-registrer.php?loc=2';</script>";
exit;
        
    }



?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:15 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Contact-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
						<h3 class="contact-page-title">Contact Us</h3>

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
							<h4><img src="assets/images/icons/contact-icon1.png" alt=""> Address</h4>
							<p>A-816 Sindhu chock, Karachi, Pakistan</p>
						</div>
						
						<!--=======  End of single contact block  =======-->

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
							<h4><img src="assets/images/icons/contact-icon2.png" alt=""> Phone</h4>
							<p>Mobile: (+92) 335-1368515</p>
						</div>
						
						<!--=======  End of single contact block  =======-->

						<!--=======  single contact block  =======-->
						
						<div class="single-contact-block">
							<h4><img src="assets/images/icons/contact-icon3.png" alt=""> Email</h4>
							<p>ajaychawla804@gmail.com</p>
							
						</div>
						
						<!--=======  End of single contact block  =======-->
					</div>
					
					<!--=======  End of contact page side content  =======-->

				</div>
				<div class="col-lg-9 col-md-8 pl-100 pl-xs-15">
					<!--=======  contact form content  =======-->
					
					<div class="contact-form-content">
						<h3 class="contact-page-title">Tell Us Your Message</h3>

						<div class="contact-form">
							<form  id="contact-form" action="https://demo.hasthemes.com/greenfarm-preview/greenfarm/assets/php/mail.php" method="post">
								<div class="form-group">
									<label>Your Name <span class="required">*</span></label>
									<input type="text" name="customerName" id="customername" required>
								</div>
								<div class="form-group">
									<label>Your Email <span class="required">*</span></label>
									<input type="email" name="customerEmail" id="customerEmail" required>
								</div>
								<div class="form-group">
									<label>Subject</label>
									<input type="text" name="contactSubject" id="contactSubject">
								</div>
								<div class="form-group">
									<label>Your Message</label>
									<textarea name="contactMessage" id="contactMessage" ></textarea>
								</div>
								<div class="form-group">
									<button type="submit" value="submit" id="submit" class="contact-form-btn" name="submit">send</button>
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
<?php
session_start();

	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."header.php");
include_once('classes/userClass.php');
if(isset($_POST['check'])){
    if(isset($_SESSION['check_coupan'])) 
   {
       if($_SESSION['coupan_value']){
            $user1->insert_coupan_used($_SESSION['check_coupan'],$user[0]);
            $coupon_code = $_SESSION['check_coupan'];  
       }
      
   }
   $successfull = $user1->check_out($_SESSION['check1'],$coupon_code);
   
    unset($_SESSION['coupan_value']);
    unset($_SESSION['check_coupan']);
    unset($_SESSION['check1']);
}
/*
else
{
    if(isset($_GET['aid'])){
        $aid =$_GET['aid'];
    }else
        $aid = $user['D_address'];
    if(!is_null($aid)){
        $ad= new Address();
    	if($row = $ad->select_address_by_id($aid)){
    	    $aid = $row['a_id'];
    	    //print_r($row);
    	}else{
    		//header('location:address.php?aid=0');
    	}
    }
	
}
*/
?>


<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
	
	
<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Order Status-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
							<h5><B><img src="assets/images/icons/shipping.png" alt=""> <br><br>Your Ease,Our Responsibility</B></h5>
							
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
					<?php
					
						    if(!is_null($successfull)){
						        
						        if($successfull!=0)
						        echo '
					<div class="contact-form-content">
						<h3 class="contact-page-title"><font color = "green">Your Order Has Been Placed.<br> Your Order No# is '.$successfull.' ,Now You can Track Your Order From My Orders</font></h3>
						
						
						<h3 class="contact-page-title">Kiryano Delivery And Shipping Details</h3>

						<div class="contact-form">
						    <div class="form-group">
									<ul style="list-style-type:circle;">
                                          <li><font color="red">We Blocklist the people (computer ip) who place orders and refuses at the time of delivery </font>.
                                        </li><br>
                                          <li>Free Shipping on all orders over the value of <strong>Rs.500</strong>.
                                        </li><br>
                                          <li>We charge Rs.30 on all orders under the value of <strong>Rs.500</strong>.</li><br>
                                          <li>Orders received after <strong>7:00 pm</strong> will be dispatched the next day.</li><br>
                                          <li>Delivery Can Take upto <strong>4 hours</strong>  (larkana only).</li><br>
                                          <li>We Accepts Returns For more info <a href="returnpolicy.php"><strong>Click Here</strong></a></li><br>
                                          <li>For More Info Visit Our <a href="faq.php"><strong>QNA Section</strong></a> Or You can Also <strong>Chat With Us</strong> (click On Chat Icon Appear in Right Bottom Corner)</li>
                                    </ul>

								</div>
							
								
							
						</div>
						<p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
					</div>';
					else echo '	<div class="contact-form-content">
						<h3 class="contact-page-title"><font color = "red">Your Order Has Not Been Placed. some of the products may have been out of stock. please call on given number for further details</font></h3>
						
						
						<h3 class="contact-page-title">Kiryano Delivery And Shipping Details</h3>

						
						<p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
					</div>';
					
						    }
							
						    ?>
					
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
 <?php
 session_start();
 ?>
 <!DOCTYPE html>
<html class="no-js" lang="zxx">
<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
	
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Order Details-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
					
					<div class="contact-form-content">
					    <br>
						<h3 class="contact-page-title">Kiryano - Order Details And Invoice</h3>

						 <div class="col-lg-6 col-12 d-flex">
						     <div class="col-12 mb-60">
									
										<h4 class="checkout-title">Cart Total</h4>
								
										<div class="checkout-cart-total">
	
											<h4>Product <span>Total</span></h4>
											
											
											<ul>
												<?php
			                                    $sub_total=0;
		                                        if($arr = $user1->get_cart($user[0])){
		                                            foreach ($arr as $item) {
		                                                echo '<li>'.$item[2].' X '.$item[5].' <span>'.$item[3]*$item[5].'</span></li>';
		                                                $sub_total=$sub_total+$item[3]*$item[5];
		                                            }
		                                        }
		                                        if($sub_total > 500){
                                                    $shipping_fee = 0;
                                                }else
                                                    $shipping_fee = 30;
			                                      
			                                    ?>
											</ul>
											
											<p>Sub Total <span><?php echo $sub_total; ?></span></p>
											<p><?php if($shipping_fee) echo 'Shipping Cost <span>'.$shipping_fee.'</span>'; else echo 'Free Shipping!!';  ?></p>
											<h4>Grand Total <span><?php echo $sub_total+$shipping_fee; ?></span></h4>
											
										</div>
										<?php
											if($sub_total+$sub_total*0.1 and !is_null($aid)){
												echo '<button class="place-order"><a href="checkout.php?check='.$aid.'">Place order</a></button>';
											}
										?>
										
									</div>
                            <!--=======  Cart summery  =======-->
                        
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span>$1250.00</span></p>
                                    <p>Shipping Cost <span>$00.00</span></p>
                                    <h2>Grand Total <span>$1250.00</span></h2>
                                </div>
                                <div class="cart-summary-button">
                                    
                                </div>
                            </div>
                        
                            <!--=======  End of Cart summery  =======-->
                            
                        </div>
							
								
									
									 <div class="col-lg-6 col-12 d-flex">
                            <!--=======  Ready to ship and print invoice buttons  =======-->
                        
                            <div class="cart-summary">
                                
                                <div class="cart-summary-button">
                                    <a href = "invoice.php"><button class="update-btn">Ready To Ship</button></a>
                                    <a href = "invoice.php"><button class="update-btn" a href="invoice.php">Print Invoice</button>
                                </div>
                            </div>
                        
                            <!--=======  End of buttons  =======-->
                            
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
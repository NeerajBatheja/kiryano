<?php

	include_once('classes/categoryClass.php');
	include_once 'classes/userClass.php';
	
	$user;
	$user1= new user();
	
	// show hierarchy of category
	function showCategory($parent = NULL){
        $cat = new category();
        if ($result=$cat->fetch_by_parent($parent)){
            foreach($result as $category){
                if($cat->fetch_by_parent($category[0])){
                    echo '<li class="menu-item-has-children"><a href="home.php"><li><a href="home.php?pid='.$category[0].'">'.$category[1].'</a>';
                    echo '<ul class="sub-menu">';
                    showCategory($category[0]);
                    echo '</ul>';
                }else{
                     echo '<li><a href="home.php?pid='.$category[0].'">'.$category[1].'</a></li>';
                }
            }
            return 1;
        }else
        return 0;

    }

?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-164778861-1"></script>
<script async>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-164778861-1');
</script>
<head class="no-js" lang="zxx"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	

	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<meta name="description" content="Kiryano is Pakistan based online shopping store . Kiryano Serve  Gorcery,latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	

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
	<script src="assets/js/vendor/modernizr-2.8.3.min.js" async ></script>

</head>

	<!--=============================================
	=            Header         =
	=============================================-->

	<header>

        
		<!--=======  header top  =======-->
		

		<div class="header-top pt-10 pb-10 pt-lg-10 pb-lg-10 pt-md-10 pb-md-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center text-sm-left">
						<!-- currncy language dropdown -->
						<div class="lang-currency-dropdown">
							
							<ul>
								<li> <a href="#">Select Language <i class="fa fa-chevron-down"></i></a>
								
								
									<ul>
										<li><div id="google_translate_element"></div>
                                            
                                            <script type="text/javascript" async>
                                            function googleTranslateElementInit() {
                                                  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                                                }
                                                </script>
                                                
                                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async></script> 
                                        </li>
										
									</ul>
								</li>
								<!--switch account buttons -->
								<!--<li><a href="#">Switch Account <i class="fa fa-chevron-down"></i></a>
									<ul>
									    <li><a href="seller_account">Seller</a></li>
										
										
										<li><a href="home">Buyer</a></li>
									</ul>
								</li>-->
							</ul>
						</div>
						<!-- end of currncy language dropdown -->
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  text-center text-sm-right">
						<!-- header top menu -->
						<div class="header-top-menu">
							<ul>
								<li><a href="faq.php">Help Centre</a></li>
								<li><a href="deliveryinfo.php">Delivery Information</a></li>
								<li><a href="returnpolicy.php">Return Policy</a></li>
							</ul>
						</div>
						<!-- end of header top menu -->
					</div>
				</div>
			</div>
		</div>

		<!--=======  End of header top  =======-->

        
		<!--=======  header bottom  =======-->

		<div class="header-bottom header-bottom-one header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
						<!-- logo -->
						
						<div class="logo mt-15 mb-15">
						    <?php
						    $var1=1;
							echo'<a href="home.php?keyword_not_set='.$var1.'">';
								?><img src="assets/images/logo1.png" class="img-fluid" alt="">
							</a>
						</div>
						<!-- end of logo -->
					</div>
					
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
							<!-- header phone number -->
								<div class="header-contact d-flex">
								<div class="phone-icon">
									<img src="assets/images/icon-phone.png" class="img-fluid" alt="">
								</div>
								<div class="phone-number">
									<h4>فون پر آرڈر دیں</h4> <span class="number">03488311613</span>
								</div>
							</div>
							<!-- end of header phone number -->
							<!-- search bar -->
							<div class="header-advance-search" >
								<form action="home" method="post">
									<input type="text" name="keywords" autocomplete="off" placeholder="Search your product" pattern ="[A-Za-z0-9].{0,}" title="please do not use special characher" >
									<button type="submit" name="search" ><span class="icon_search"></span></button>
								</form>
							</div>
							<!-- end of search bar -->
							
							
							<!-- shopping cart -->
							<div class="shopping-cart" id="shopping-cart">
								<a href="cart.php">
									<div class="cart-icon d-inline-block">
										<span class="icon_bag_alt"></span>
									</div>
									<div class="cart-info d-inline-block">
										<?php
										
										if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){
											$email=$_SESSION['email'];
											if ($result1=$user1->fetch_data($email))
											  {
											       
											     
											  	foreach ($result1 as $row) {
											  		$user=$row;
											  		$data = $user1->show_total_items_and_total($user[0]);
											  		echo '<p>'.$user[1].'
															<span>
																'.$data['items'].' items - Rs.'.$data['total'].' 
															</span>
														</p>';
											  	}

											}else{
												echo "didnt fetched";
											}
										}else
											echo '<p>Shopping Cart 
														<span>
															0 items - Rs.0.00 
														</span>
													</p>';

										?>
										
									</div>
								</a>
							<!-- end of shopping cart -->
							<?php 
							 if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){

							
						echo'	<div class="cart-floating-box" id="cart-floating-box">
								<div class="cart-items">
									<div class="cart-float-single-item d-flex">
										
										<h4><a href="my-account.php" data-toggle="tab"><i class="fa fa-acc"></i>Manage Account</a></h4>
										
										
									</div>
									<div class="cart-float-single-item d-flex">
										
										
										<div class="cart-float-single-item-desc">
										    <h4><a href="#account-info" data-toggle="tab"><i class="fa fa-acc"></i> Account Details</a></h4>	
											
										</div>
									</div>
									<div class="cart-float-single-item d-flex">
										
										
										<div class="cart-float-single-item-desc">
										<h4><a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> Address Book</a></h4>	
										</div>
									</div>
								</div>
								<div class="cart-calculation">
									<div class="calculation-details">
										<p class="total">Subtotal <span></span></p>
									</div>
									<div class="floating-cart-btn text-center">
										<a href="checkout.php">Checkout</a>
										<form action="login-registrer.php" method="POST" >
										<a ><input type="submit" value="logout" name="logout" class="fa fa-sign-out" width="48" height="48"></a></form>
									</div>
								</div>
							</div>';
        
    }
    else
        {
            echo'	<div class="cart-floating-box" id="cart-floating-box">
								<div class="cart-items">
									<div class="cart-float-single-item d-flex">
										
										<a href="returnpolicy.php" data-toggle="tab"><h4><i class="fa fa-acc"></i>Return Policy</h4></a>
										
										
									</div>
									<div class="cart-float-single-item d-flex">
										
										
										<div class="cart-float-single-item-desc">
										    <h4><a href="contact.php" data-toggle="tab"><i class="fa fa-acc"></i> Contact US</a></h4>	
											
										</div>
									</div>
									<div class="cart-float-single-item d-flex">
										
										
										<div class="cart-float-single-item-desc">
										<h4><a href="deliveryinfo.php" data-toggle="tab"><i class="fa fa-map-marker"></i>DELIVERY INFORMATION</a></h4>	
										</div>
									</div>
								</div>
								<div class="cart-calculation">
									<div class="calculation-details">
									
									</div>
									<div class="floating-cart-btn text-center">
										<a href="faq.php">Help Centre</a>
										<a href="login-registrer.php">LOGIN</a>
									</div>
								</div>
							</div>';
            
            
            
        }
							
							
							
							?>

							
							<!-- end of cart floating box -->
							</div>
						</div>
                          
						<!-- navigation section -->
                        <div class="main-menu">
							<nav>
								<ul>  <?php
						    $var1=1;
							echo'<li><a href="home.php?keyword_not_set='.$var1.'">HOME</a></li>';
								?>
									
									<li class="menu-item-has-children"><a href="#">Category</a>
										<ul class="sub-menu">

											<!-- category list data fetched from category and sub-category -->
											 <!-- category list data fetched from category -->
                                            <?php
                                                showCategory();
                                            ?>
										</ul>
									</li>
									<li><a href="compare.php">compare</a></li>
									<li><a href="wishlist.php">my wishlist</a></li>
										<?php 
							 if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){
								echo'	<li><a href="my-account.php">MY ACCOUNT</a></li>';
							 }
							 else
							 echo'	<li><a href="login-registrer.php">LOG IN</a></li>';
							 ?>
									<li><a href="contact.php">CONTACT</a></li>
								</ul>
							</nav>
						</div>
						<!-- end of navigation section -->
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
	<br>

	<!--=====  End of Header  ======-->
	<script src="assets/js/vendor/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js" async></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js" async></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js" async></script>

	<!-- Main JS -->
	<script src="assets/js/main.js" async></script>
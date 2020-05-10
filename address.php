<?php
session_start();
include_once('classes/addressClass.php');
include_once('classes/provinceClass.php');
include_once('classes/cityClass.php');
// including header
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."header.php");
$address = new address();
$p =1;
if(isset($_GET['aid'])){
	$aid=$_GET['aid'];
	$add = $address->select_address_by_id($aid);
}else{
    $p =0;
}

// this will show province dropdown options
function show_province(){
    $cityObj = new province();
    $result = $cityObj->fetch_province();
    foreach($result as $row){
        echo '<option value="'.$row['province_id'].'">'.$row['name'].'</option>';
    }
}

// this will show city dropdown options
function show_city(){
    $cityObj = new city();
    $result = $cityObj->fetch_city();
    foreach($result as $row){
        echo '<option value="'.$row['city_id'].'">'.$row['name'].'</option>';
    }
}


?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Adress Book-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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

	

	<!--=============================================
	=            Checkout page content         =
	=============================================-->
	
	<div class="page-section section mb-50">
		<div class="container">
			<div class="row">
				<div class="col-12">
					
					<!-- Checkout Form s-->
					
						<div class="row row-40">
							<div class="myaccount-content">
							<div class="col-lg-7 mb-20">
                            
                            
								<div id="billing-form" class="mb-40">
									<h4 class="checkout-title">Address</h4>
									<form name="addAddress" action="my-account.php" method="post" class="checkout-form">
	
									<div class="row">
									    
									    
									    <div class="col-12 mb-20">
											<label>Full Name*</label>
											<input name="fname" type="text" placeholder="Full Name" <?php if($aid) echo 'value = "'.$add['name'].'"'; ?>  required>
										</div>
									    
									    <div class="col-12 mb-20">
											<label>Address*</label>
											<input name="s_address" type="text" placeholder="Address" <?php if($aid) echo 'value = "'.$add['address'].'"'; ?>  required>
										</div>
										
										
										<div class="col-md-6 col-12 mb-20">
											<label>province*</label>
            								<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
            									<select name="province" id="sort-by"   class="nice-select">
            										<?php show_province(); ?>
            									</select>
            								</div>
										</div>
										
										<div class="col-md-6 col-12 mb-20">
											<label>City*</label>
											<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
            									<select name="city" id="sort-by" <?php if($aid) echo 'value = "'.$add['city'].'"'; ?>  class="nice-select">
            										<?php show_city(); ?>
            									</select>
            								</div>
										</div>
										
										<div class="col-md-6 col-12 mb-20">
											<label>Phone no*</label>
											<input name="s_phone" type="text"  placeholder="Phone number" <?php if($aid) echo 'value = "'.$add['phone'].'"'; ?> required>
										</div>
										
										

										<div class="col-12 mb-20">
										    <?php
										    if($aid){
										         echo '<input type="hidden" name="aid" value = "'.$add['a_id'].'" ><button type ="submit" name ="editAddress" class="place-order">edit</button>';
										    }
										   
										    else
										    echo '<button type ="submit" name ="addAddress" class="place-order">add</button>';
											
										    
										    ?>
										    
										</div>
										
									</div>
	                        	    </form>
								</div>
								
							
							</div>

							</div>
						</div>
					
					
					<div class="myaccount-content">
						<h3>Address</h3>
						<?php 
						
						$ad= new Address();
						$ctyObj = new city();
						$prvObj = new province();
						if($result = $ad->select_address($user['c_id'])){

							foreach ($result as $row) {
							    $cty = $ctyObj->get_city($row['city_id']);
							    $prv = $prvObj->get_province($cty['prov_id']);
								echo '<address>
									<p><strong>'.$row['name'].'</strong>';
									echo '
									<p>'.$row['address'].'<br>
										'.$cty['name'].' , '.$prv['name'].'</p>
									<p>Mobile: '.$row['phone'].'</p>
								</address>';
								if($user['D_address'] == $row['a_id'])
								echo'
								<a href="address.php?default_id='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>set as default</a>';
								echo '
								<a href="address.php?aid='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>edit</a>';

							}
							
						}

						?>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of Checkout page content  ======-->
	



	<!-- scroll to top  -->
	<a href="#" class="scroll-top"></a>
	<!-- end of scroll to top -->
	
	<!-- JS
	============================================ -->
	<!-- jQuery JS 
	<script src="assets/js/vendor/jquery.min.js"></script>
-->
	<!-- Popper JS
	<script src="assets/js/popper.min.js"></script>
 -->
	<!-- Bootstrap JS 
	<script src="jq/jquery-2.1.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
-->
	<!-- Plugins JS
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/plugins.js"></script>
 -->
	<!-- Main JS 
	<script src="assets/js/main.js"></script>
-->
</body>


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>
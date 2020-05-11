<?php
session_start();
include_once('classes/addressClass.php');
include_once('classes/userClass.php');
include_once('classes/provinceClass.php');
include_once('classes/cityClass.php');
$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
include($IPATH."header.php");
// show message if the checkout is complete
if(isset($_GET['check'])){
    
	if($user1->check_out($_SESSION['customer']))
	    unset($_SESSION['customer']);
    //	echo "<script>window.location.href='ordersuccess.php';</script>";
    	exit;
}else
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



if(isset($_POST['addAddress'])){
    $addr = new address();
    if($addr->insert_address($_POST['fname'],$user['c_id'],$_POST['s_address'],$_POST['city'],$_POST['s_phone'])){
        if(!$aid){
            $adrs = new address();
            $result = $adrs->select_address($user['c_id']);
            foreach($result as $row);
            if($user1->update_default_address($user['c_id'],$row['a_id'])){
                echo 'default address updated'.'<br>';;
                $aid = $row['a_id'];
            }
        }
        //header('location:my-account.php');
        echo 'Address has been added';
    }
}



?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Checkout-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
							
							<div class="col-lg-7 mb-20">
								
								<div class="myaccount-content">
										<h3>Address Selected</h3>
										<?php
										    if($aid){
										        $ctyObj = new city();
                						        $prvObj = new province();
												$cty = $ctyObj->get_city($row['city_id']);
                							    $prv = $prvObj->get_province($cty['prov_id']);
                								echo '<address>
                									<p><strong>'.$row['name'].'</strong>';
                									echo '
                									<p>'.$row['address'].'<br>
                										'.$cty['name'].' , '.$prv['name'].'</p>
                									<p>Mobile: '.$row['phone'].'</p>
                								</address>';
                								
											//	echo '<a href="address.php?aid='.$addres[0].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>Edit Address</a>';

										    }else{
										        echo '<div id="billing-form" class="mb-40">
                									<h4 class="checkout-title">Address</h4>
                									<form name="addAddress" action="checkout" method="post" class="checkout-form">
                	
                									<div class="row">
                									    
                									    
                									    <div class="col-12 mb-20">
                											<label>Full Name*</label>
                											<input name="fname" type="text" placeholder="Full Name"'; if($aid) echo 'value = "'.$add['name'].'"'; echo 'required>
                										</div>
                									    
                									    <div class="col-12 mb-20">
                											<label>Address*</label>
                											<input name="s_address" type="text" placeholder="Address"'; if($aid) echo 'value = "'.$add['address'].'"'; echo 'required>
                										</div>
                										
                										
                										<div class="col-md-6 col-12 mb-20">
                											<label>province*</label>
                            								<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
                            									<select name="province" id="sort-by"   class="nice-select">';
                            										show_province();
                            								echo'</select>
                            								</div>
                										</div>
                										
                										<div class="col-md-6 col-12 mb-20">
                											<label>City*</label>
                											<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
                            									<select name="city" id="sort-by"'; if($aid) echo 'value = "'.$add['city'].'"'; echo 'class="nice-select">';
                            										show_city();
                            									echo '</select>
                            								</div>
                										</div>
                										
                										<div class="col-md-6 col-12 mb-20">
                											<label>Phone no*</label>
                											<input name="s_phone" type="text"  placeholder="Phone number"'; if($aid) echo 'value = "'.$add['phone'].'"'; echo  'required>
                										</div>
                										
                										
                
                										<div class="col-12 mb-20">';
                										    
                										    if($aid){
                										         echo '<input type="hidden" name="aid" value = "'.$add['a_id'].'" ><button type ="submit" name ="editAddress" class="place-order">edit</button>';
                										    }
                										   
                										    else
                										    echo '<button type ="submit" name ="addAddress" class="place-order">add</button>';
                											
                										    
                										echo '    
                										</div>
                										
                									</div>
                	                        	    </form>
                								</div>';
										        //echo '<h4><font color="red">Note: Order Will Be Deliver To the selected address, However You Can Select Different Address From Other Addresses Section Below. Currently no address is selected</font></h5>';
										    }
												

										?>
									</div>
									
									<div class="myaccount-content">
                						<h3>Other Addresses</h3>
                						<?php 
                						
                						$ad= new Address();
                						$ctyObj = new city();
                						$prvObj = new province();
                						if($result = $ad->select_address($user['c_id'])){
                
                							foreach ($result as $row) {
                							    $cty = $ctyObj->get_city($row['city_id']);
                							    $prv = $prvObj->get_province($cty['prov_id']);
                								echo '<div class="myaccount-content"><address>
                									<p><strong>'.$row['name'].'</strong>';
                									echo '
                									<p>'.$row['address'].'<br>
                										'.$cty['name'].' , '.$prv['name'].'</p>
                									<p>Mobile: '.$row['phone'].'</p>
                								</address>';
                							//	echo '
                							//	<a href="address.php?aid='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>edit</a>';
                								if($aid != $row['a_id'])
                								echo'
                								<a href="checkout.php?aid='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>select</a>';
                								echo '</div>';
                
                							}
                							
                						}

                						?>
                						 <div class="myaccount-content"><a href="address.php" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>Add Address</a></div>
                					</div>

							</div>
							
							




							
							<div class="col-lg-5">
								<div class="row">
									<br>
										<!--=======  Discount Coupon  =======-->
                            
                            <div class="discount-coupon">
                                <h4>Discount Coupon Code</h4>
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" name="coupan" placeholder="Coupon Code">
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="submit" name="applycode" value="Apply Code">
                                        </div>
                                    </div>
                                </form>
                            <?php 
                            
                            //coupan code validation

    if(isset($_POST['applycode']))
    {
       if(isset($_POST['coupan']))
       {
           $coupan_code = $_POST['coupan'];
           
           if($coupanData=($user1->coupan_validate($coupan_code)))
           {    
                $coupan_usage_limit = 3;
               if(($usageCount=$user1->validate_coupan_user_email($coupan_code,$user[0])) <= $coupan_usage_limit)
               {
                   
                $coupan_value = $coupanData['coupanValue']; 
                $array=$user1->show_total_items_and_total($user[0]);
                if( $array['total'] - 30 >= $coupanData['amount_condition'])
                {
                echo '<script src="assets\js\sweetalert.min.js"></script>';
echo '<script>swal("Good job!", "Your coupan has been applied!", "success");</script>';
                echo '<h5>Your coupan has been applied!</h5><br>';
                
                }
                else
                {
                    
                    echo '<h5>For using this coupan, Your Subtotal<br> should be greater than or equal to '.$coupanData['amount_condition'].'</h5><br>';
                    echo '<script src="assets\js\sweetalert.min.js"></script>';
echo '<script type="text/javascript">
swal({
  title: "Meet the Coupon Condition!",
  text: "your coupon is valid but cart amount is less than required",
  icon: "warning",
  button: true,
  dangerMode: true,
})</script>';
                    
                }
                 
               }
               else
               {    echo '<script src="assets\js\sweetalert.min.js"></script>';
echo '<script type="text/javascript">
swal({
  title: "Coupon Usage Limit Reached",
  text: "You cannot use same coupon again and again",
  icon: "warning",
  button: true,
  dangerMode: true,
})</script>';
                   echo '<h5>You Have Reached Coupan Usage Limit.</h5><br>';
               }
              
           }
           else
           {
echo '<script src="assets\js\sweetalert.min.js"></script>';
echo '<script>swal("Please enter valid coupan", "your coupon is invalid,misspelled or may be expired", "error");</script>';
               echo '<h5>Please enter valid coupan.</h5><br>';
               
           }
       }
       
    }
    
                            
                            ?>
                            </div>
                            
                            
                            <!--=======  End of Discount Coupon  =======-->
									<!-- Cart Total -->
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
                                                    //$shipping_fee = 30;
                                                    $shipping_fee = 30;
			                                      
			                                    ?>
											</ul>
											<?php 
											if($sub_total < $coupanData['amount_condition']){
											    $coupan_value = 0; 
											    
											}
											
											?>
											<p>Sub Total <span><?php echo $sub_total; ?></span></p>
											<p><?php if($shipping_fee) echo 'Shipping Cost <span>'.$shipping_fee.'</span>'; else echo 'Free Shipping!!';  ?></p>
											<p>Coupan Code Discount <span><?php if($sub_total >= $coupanData['amount_condition']) { echo $coupan_value;} ?></span></p>
											<h4>Grand Total <span><?php echo $sub_total+$shipping_fee-$coupan_value ?></span></h4>
											
										</div>
										
                            
										<?php
											if($sub_total+$sub_total*0.1 and !is_null($aid)){
											    $_SESSION['coupan_value'] = $coupan_value;
											    $_SESSION['check_coupan'] = $coupan_code;
											    $_SESSION['check1'] = $aid;
											    echo '<form action="ordersuccess.php" method="post">
												<button type="submit" name="check" class="place-order">Place order</button>
												</form>';
												/*
												<input type="hidden" name="coupan_value" value='.$coupan_value.'>
											    <input type="hidden" name="check_coupan" value='.$coupan_code.'>
											    <input type="hidden" name="check" value='.$aid.'>*/
											}
										?>
										
									</div>

								</div>
							</div>
							
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
		<!--Retain scroll position -->  
<script>
$(document).ready(function(){
var saveScroll = 0;
$(window).scroll(function(){
var saveScroll = $(window).scrollTop();
//setting cookie for saving javascript variable as we can get it after refreshing the page
document.cookie = "saveScroll = " + saveScroll

    
});

});
</script>
<script>
    //getting cookie back to javascript variable using php cookie function
    getcookie = '<?php echo $_COOKIE['saveScroll']; ;?>';
    $(window).scrollTop(getcookie);
</script>    

</body>


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>
<?php 
session_start();
include_once('classes/addressClass.php');
include_once 'classes/userClass.php';
include_once('classes/provinceClass.php');
include_once('classes/cityClass.php');
$user1= new user();
$acc;
if(isset($_SESSION['email']) && isset($_SESSION['pass']))
	{
		
		$email=$_SESSION['email'];
		if ($result=$user1->fetch_data($email))
		  	{
		  	foreach ($result as $row) 
		  		{
		  		$acc=$row;
		  		}

			}
		else{
			echo "didnt fetched";
			}
	}
	else{
	//	header('location:login-registrer.php');
	echo "<script>window.location.href='login-registrer.php';</script>";
    exit;
	    
	}

if(isset($_POST['addAddress'])){
    $addr = new address();
    if($addr->insert_address($_POST['fname'],$acc['c_id'],$_POST['s_address'],$_POST['city'],$_POST['s_phone'])){
        if(!$acc['D_address']){
            $adrs = new address();
            $result = $adrs->select_address($acc['c_id']);
            foreach($result as $row);
            if($user1->update_default_address($acc['c_id'],$row['a_id'])){
                echo 'default address updated'.'<br>';;
                $aid = $row['a_id'];
            }
        }
        //header('location:my-account.php');
        echo 'address has been added';
        
    }
}

if(isset($_POST['editAddress'])){
    $addr = new address();
    if($addr->update_address($_POST['aid'],$_POST['fname'],$_POST['s_address'],$_POST['city'],$_POST['s_phone'])){
        //header('location:my-account.php');
        echo 'address updated';
        
    }
}
if(isset($_GET['defaultAddressId'])){
    if($user1->update_default_address($acc['c_id'],$_GET['defaultAddressId'])){
        echo 'default address updated';
    }
}

$first= $acc[1];
$last= $acc[2];	

if(isset($_POST['update'])){
	if(!is_null($_POST['pass']) and !is_null($_POST['Vpass'])){
		if( $_POST['pass']==$_POST['Vpass']){
			$user1->update($acc[0],$_POST['email'],$_POST['first'],$_POST['phone'],$_POST['pass']);
			$_SESSION['email']= $_POST['email'];
			$_SESSION['pass']= $_POST['pass'];
			echo'changed';
			unset($_POST['update']);
	//		header('location: my-account.php');
			echo "<script>window.location.href=' my-account.php';</script>";
exit;
			
		}else{
			echo "passwords do not matches";
		}

	}else{
		$user1->update($acc[0],$_POST['email'],$_POST['first'],$_POST['phone'],$acc['pass']);
		$_SESSION['email']= $_POST['email'];
		echo'changed';
		unset($_POST['update']);
	//	header('location: my-account.php');
	echo "<script>window.location.href=' my-account.php';</script>";
exit;
	    
	}
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>My Account-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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

	<!--=============================================
	=            My account page section         =
	=============================================-->
	
	<div class="my-account-section section position-relative mb-50 fix">
		<div class="container">
			<div class="row">
				<div class="col-12">

					<div class="row">

						<!-- My Account Tab Menu Start -->
						<div class="col-lg-3 col-12">
							<div class="myaccount-tab-menu nav" role="tablist">
								<a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
									Dashboard</a>

								<a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>My Orders</a>
<!--
								<a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a>

								<a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
									Method</a>
-->
								<a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
								
								<a href="#account-info" data-toggle="tab"><i class="fa fa-acc"></i> Account Details</a>
								
								<a href="login-registrer.php?logout=1"><i class="fa fa-sign-out"></i>logout</a>
                                  
								 
							</div>
						</div>
						<!-- My Account Tab Menu End -->

						<!-- My Account Tab Content Start -->
						<div class="col-lg-9 col-12">
							<div class="tab-content" id="myaccountContent">
								<!-- Single Tab Content Start -->
								<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
									<div class="myaccount-content">
										<h3>Dashboard</h3>

										<div class="welcome">

											<p>Hello, <strong><?php echo "$first"; ?></strong></p>


										</div>

										<p class="mb-0">From your account dashboard. you can easily check &amp; view your
											recent orders, manage your shipping and billing addresses and edit your
											password and account details.</p>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="orders" role="tabpanel">
									<div class="myaccount-content">
										<h3>Orders</h3>
								<div class="row">
									
									<!-- Cart Total -->
									
										<?php
										if($arr = $user1->get_orders($acc[0])){

											foreach ($arr as $arr2) {
												$odr = new order_details();
												$odr_data = $odr->fetch_data($arr2[0]['order_no']);
												echo '<div class="col-12 mb-60"><div class="checkout-cart-total">
											<table style="width:100%">
        										<h4 class="checkout-title">OrderNO:'.$arr2[0]['order_no'];
        										if($user1->check_order_status($arr2[0]['order_no'])){
        											echo '<span>COMPLETED</span>';
        										}else
        											echo '<span>PENDING</span>';
        											
    										    echo'</h4>
    										    <h4 class="checkout-title">Address:<span>'.$odr_data['name'].','.$odr_data['address'].' '.$odr_data['phone'].'</span></h4>
        											<tr>
        											    <th><h4>Product <span>Total</span></h4></th>
        											    <th><h4><span>Status</span></h4></th>
        											</tr>
        											
        											<tr>';
        				                            $sub_total=0;
                                            
                                                foreach ($arr2 as $item) {
                                                    echo '<tr><td>'.$item['p_name'].' X '.$item['quantity'].' </td><td><span>'.$item['p_price']*$item['quantity'].'</span></td>';
                                                    if($item['status']==2){
                                                    	echo ' <td>Completed</td></td>';
                                                    }else
                                                    	echo ' <td>Pending</td></td>';
                                                    $sub_total=$sub_total+$item['p_price']*$item['quantity'];
                                                }
                                                if($sub_total > 500){
                                                    $shipping_fee = 0;
                                                }else
                                                    $shipping_fee = 0;
        									  echo '</tr>
											
											</table>
											
											<p>Sub Total <span>'.$sub_total.'</span></p>
											<p>'; if($shipping_fee) echo 'Shipping Cost <span>'.$shipping_fee.'</span>'; else echo 'Free Shipping!!';  echo'</p>
											<p>Discount Coupan <span>'.$odr_data['coupan_value'].'</span></p>
											<h4>Grand Total <span>'.($sub_total+$shipping_fee - $odr_data['coupan_value']).'</span></h4>
											
										</div></div>';
											}
											
										}
										?>
										
										
										
								</div>
						



									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="download" role="tabpanel">
									<div class="myaccount-content">
										<h3>Downloads</h3>

										<div class="myaccount-table table-responsive text-center">
											<table class="table table-bordered">
												<thead class="thead-light">
												<tr>
													<th>Product</th>
													<th>Date</th>
													<th>Expire</th>
													<th>Download</th>
												</tr>
												</thead>

												<tbody>
												<tr>
													<td>Mostarizing Oil</td>
													<td>Aug 22, 2018</td>
													<td>Yes</td>
													<td><a href="#" class="btn">Download File</a></td>
												</tr>
												<tr>
													<td>Katopeno Altuni</td>
													<td>Sep 12, 2018</td>
													<td>Never</td>
													<td><a href="#" class="btn">Download File</a></td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="payment-method" role="tabpanel">
									<div class="myaccount-content">
										<h3>Payment Method</h3>

										<p class="saved-message">You Can't Saved Your Payment Method yet.</p>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="address-edit" role="tabpanel">
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
                								echo '<div class="myaccount-content"><address>
                									<p><strong>'.$row['name'].'</strong>';
                									echo '
                									<p>'.$row['address'].'<br>
                										'.$cty['name'].' , '.$prv['name'].'</p>
                									<p>Mobile: '.$row['phone'].'</p>
                								</address>';
                								echo '
                								<a href="address.php?aid='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>edit</a>';
                								if($user['D_address'] != $row['a_id'])
                								echo'
                								<a href="my-account.php?defaultAddressId='.$row['a_id'].'" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>set as default</a>';
                								echo '</div>';
                
                							}
                							
                						}
										?>
										   <div class="myaccount-content"><a href="address.php" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>Add Address</a></div>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="account-info" role="tabpanel">
									<div class="myaccount-content">
										<h3>Account Details<?php ?></h3>

										<div class="account-details-form">
											<form action="" method="post">
												<div class="row">
												    <div class="col-md-12 col-12 mb-20">
                    									<label>Full Name</label>
                    									<input class="mb-0" name="first" type="text" placeholder="First Name" pattern ="[A-Za-z].{3,}" title="Only alphabates are allowed. and Name must be between 3 and 30 characters" size="30" value="<?php echo $user[1]; ?>" required>
                    								</div>

													<div class="col-md-12 mb-20">
                    									<label>Email Address*</label>
                    									<input class="mb-0" name="email" type="email" placeholder="Email Address" size="30" value="<?php echo $user['email']; ?>" required>
                    								</div>
                    								<div class="col-md-6 mb-20">
                    									<label>Phone</label>
                    									<input class="mb-0" name="phone" type="tel" placeholder="03XX-XXXXXXX" size="12" title="please enter number in given pattern '03XXXXXXXXX'" value="<?php echo $user['phone']; ?>" required>
                    								</div>

													<div class="col-12 mb-30"><h4>Password change</h4></div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="new-pwd" name="pass" placeholder="New Password" type="password" minlength="4" maxlength="20" title="Password must be between 4 to 20 charachers">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="confirm-pwd" name="Vpass" placeholder="Confirm Password" type="password" minlength="4" maxlength="20" title="Password must be between 4 to 20 characters">
													</div>

													<div class="col-12">
														<button type="submit" name="update" class="save-change-btn">Save Changes</button>
													</div>

												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->
							</div>
						</div>
						<!-- My Account Tab Content End -->
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of My account page section  ======-->
	

	<!--=============================================
	=            Footer         =
	=============================================-->
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
	<script src="assets/js/vendor/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js"></script>

	<!-- Main JS -->
	<script src="assets/js/main.js"></script>

</body>


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>

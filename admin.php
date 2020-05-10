<?php
session_start();
include_once('classes/categoryClass.php');
//include_once('classes/sub_categoryClass.php');
include_once('classes/adminClass.php');
$user;
$user1= new admin();

	if(isset($_SESSION["aemail"]) && isset($_SESSION["apass"])){

		$email=$_SESSION['aemail'];
		if ($result=$user1->fetch_data($email))
		  {
		  	foreach ($result as $row) {
		  		$user=$row;
		  	}

		}else{
			echo "didnt fetched";
		}
	}
	else
	    echo 'nai hua login';
		//header('location:admin_login_register.php');
$first= $user[1];


$cat= new category();
if(isset($_POST['add'])) {
	$cat->insert($_POST['name']);
}


//$sub_cat= new sub_category();
if(isset($_POST['add_sub'])){
	$sub_cat->insert($_POST['sub_name'],$_POST['category']);
}

?>

<head class="no-js" lang="zxx"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Admin Panel-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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

								<a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

								<a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> category</a>

								<a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
									Method</a>

								<a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>

								<a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

								<a href="admin_login_register.php"><i class="fa fa-sign-out"></i> Logout</a>
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

										<div class="myaccount-table table-responsive text-center">
											<table class="table table-bordered">
												<thead class="thead-light">
												<tr>
													<th>No</th>
													<th>Buyer Name</th>
													<th>Status</th>
													<th>Total</th>
												</tr>
												</thead>

												<tbody>
													<?php
													$result = $user1->get_orders();
													foreach ($result as $row) {
														echo '<tr>
																<td>'.$row[0].'</td>
																<td>'.$row[1].' '.$row[2].'</td>';
															if($row[3]==1){
																echo '<td>pending</td>';
															}else
																echo '<td>shipped</td>';
														echo 	'<td>'.$user1->get_order_total($row[0]).'</td>
															</tr>';
													}
													
													?>
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="download" role="tabpanel">
									<div class="myaccount-content">

										<h3>Category</h3>

										<div class="account-details-form">
											<form action="" method="post">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input id="name"name="name" placeholder="Name" type="text">
													</div>
													<div class="col-md-12">
														<button type="submit" name="add" class="register-button mt-0">add</button>
													</div>
												</div>
											</form>
										</div>

										<?php
										$row =$cat->fetch_all();
										
										?>


										<h3>Sub Category</h3>

										<div class="account-details-form">
											<form action="" method="post">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input id="sub_name"name="sub_name" placeholder="Name" type="text">
													</div>

													<h3>Category:  </h3>
														<select name="category" id="category" class="nice-select">
															<?php
																foreach($row as $value){
																	echo '<option value='.$value[0].'>'.$value[1].'</option>';
																}
															?>
														</select>
													<div class="col-md-12">
														<button type="submit" name="add_sub" class="register-button mt-0">add</button>
													</div>
												</div>
											</form>
										</div>
									
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
										<h3>Billing Address</h3>

										<address>
											<p><strong>Alex Tuntuni</strong></p>
											<p>1355 Market St, Suite 900 <br>
												San Francisco, CA 94103</p>
											<p>Mobile: (123) 456-7890</p>
										</address>

										<a href="#" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>Edit Address</a>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="account-info" role="tabpanel">
									<div class="myaccount-content">
										<h3>Account Details<?php ?></h3>

										<div class="account-details-form">
											<form action="#">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input id="first-name" placeholder="First Name" type="text" value=<?php echo $user[1];?>>
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="last-name" placeholder="Last Name" type="text" value=<?php echo $user[2];?>>
													</div>

													<div class="col-12 mb-30">
														<input id="email" placeholder="Email Address" type="email" value=<?php echo $user[3	];?>>
													</div>

													<div class="col-12 mb-30"><h4>Password change</h4></div>

													<div class="col-12 mb-30">
														<input id="current-pwd" placeholder="Current Password" type="password">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="new-pwd" placeholder="New Password" type="password">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="confirm-pwd" placeholder="Confirm Password" type="password">
													</div>

													<div class="col-md-12">
															<button type="submit" name="login" class="register-button mt-0">Login</button>
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
						<!-- My Account Tab Menu End -->
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
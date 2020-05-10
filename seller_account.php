<?php
session_start();
include_once('classes/productClass.php');
include_once ('classes/sellerClass.php');
include_once ('classes/categoryClass.php');
$user;
$user1= new seller();

	if(isset($_SESSION["semail"]) && isset($_SESSION["spass"])){

		$email=$_SESSION['semail'];
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
	//	header('location:seller_login_register.php');
    echo "<script>window.location.href='seller_login_register.php';</script>";
	    				exit;
	    
	}
$first= $user[1];
$last= $user[2];

if(isset($_POST['update'])){
	if(isset($_POST['pass']) and isset($_POST['Vpass'])){
		if( $_POST['pass']==$_POST['Vpass']){
			$user1->update($user[0],$_POST['email'],$_POST['first'],$_POST['last'],$_POST['pass']);
			$_SESSION['semail']= $_POST['email'];
			$_SESSION['spass']= $_POST['pass'];
			echo'changed';
			unset($_POST['update']);
			header('location: seller_account.php');
		}else{
			echo "passwords do not matches";
		}

	}else{
		$user1->update($user[0],$_POST['email'],$_POST['first'],$_POST['last'],$user[4]);
		$_SESSION['email']= $_POST['email'];
		echo'changed';
		unset($_POST['update']);
		header('location: my-account.php');
	}
}

if(isset($_GET['update_Pid'])){
    echo 'update ho gaya';
}

if(isset($_GET['delete_Pid'])){
    $pro= new product();
    $pro->update_Product_set_qty($_GET['delete_Pid'],0);
    echo 'delete ho gaya';
}

if(isset($_GET['o_no'])){
   // echo 'hali wayo';
    $result = $user1->get_pending_order($_GET['o_no'],$user[0]);
	foreach ($result as $row) {
		$user1->update_order_status($row['order_id']);
	//	<td><a href="seller_account.php?status='.$row[0].'" class="btn">ship</a></td></tr>

	}
}





//$sub_ca= new sub_category();
if(isset($_POST["add"])){
	$target_path="assets/images/products/";
	$target_file= $target_path.basename($_FILES['img']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//check if file is img or not
	$check = getimagesize($_FILES["img"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
// check if not already exist
   	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
		}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}	


	if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
		$pro= new product();
		$target_file= $target_path.$_POST['name'].$user[0].".".$imageFileType;
	    if ($pro->insert_product($_POST['name'],$user[0],$_POST['category'],$_POST['price'],$_POST['discription'],$target_file,$_POST['quantity'],
	    $_POST['disc_price'],$_POST['disc_start_date'],$_POST['disc_end_date'],$_POST['brand'],$_POST['mini_desc'],$_POST['prod_weight'])) {
	    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
	       		 echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}

if(isset($_GET['status'])){
	$user1->update_order_status($_GET['status']);
}


	
// show hierarchy of category
function showCategory($parent = NULL){
    $cat = new category();
    if ($result=$cat->fetch_by_parent($parent)){
        foreach($result as $category){
            if($cat->fetch_by_parent($category[0])){
                echo '<li class="menu-item-has-children"><li>.$category[1]';
                echo '<ul class="sub-menu">';
                showCategory($category[0]);
                echo '</ul>';
            }else{
                 echo '<li><option value='.$category[0].'>'.$category[1].'</option></li>';
            }
        }
        return 1;
    }else
    return 0;
    /*
    $result = $sub_ca->fetch_all();
	foreach($result as $value){
		echo '<option value='.$value[0].'>'.$value[2].'</option>';
	}*/

}
	
?>

<head class="no-js" lang="zxx"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Seller Account-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
							<a href="seller_account.php">
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

								<a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> add product</a>

								<a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> My Products</a>

								<a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>

								<a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

								<a href="seller_login_register.php"><i class="fa fa-sign-out"></i> Logout</a>
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
											<p>Hello, <strong><?php echo "$first $last"; ?></strong></p>
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
										<?php
							
										$result = $user1->get_order_no($user[0]);
										foreach ($result as $row){
										    echo '<div class="myaccount-content"><div style="float: left"><h2>Order no :'.$row['order_no'].' </h2></div>
										    <div class="cart-buttons mb-20" style="float: right">
                                                <div class="add-to-cart-btn" style="float: right">
                                                    <a href="invoice.php?o_no='.$row['order_no'].'&s_id='.$user[0].'" target="_blank" ><i class="fa fa-file"></i>print invoice</a>
                                                </div>
                                                <div class="add-to-cart-btn" style="float: left">
                                                    <a href="seller_account.php?o_no='.$row['order_no'].'" ><i class="fa fa-file"></i>ready to ship</a>
                                                </div>
                                            </div>';
										    echo'
										    <div class="myaccount-table table-responsive text-center">
											    <table class="table table-bordered">
    												<thead class="thead-light">
    												<tr>
    													<th>No</th>
    													<th>Name</th>
    													<th>Price</th>
    													<th>quantity</th>
    													<th>Total</th>
    													
    												</tr>
    												</thead>
    												
    												<tbody>';
    												$result = $user1->get_pending_order($row['order_no'],$user[0]);
    												foreach ($result as $row) {
    													echo '<tr><td>'.$row[0].'</td>
    													<td>'.$row[1].'</td>
    													<td>'.$row[2].'</td>
    													<td>'.$row[3].'</td>
    													<td>'.$row[2]*$row[3].'</td>';
    												//	<td><a href="seller_account.php?status='.$row[0].'" class="btn">ship</a></td></tr>
    
    												}echo '	
    												</tbody>
    											</table>
    										</div></div>';
										}
										?>
									</div>
									
									<!--shipped orders -->
									<div class="myaccount-content">
								        
										<h3>Shipped Orders</h3>
										<?php
							
										$result = $user1->get_shipped_order_no($user[0]);
										foreach ($result as $row){
										    echo '<div class="myaccount-content"><div style="float: left"><h2>Order no :'.$row['order_no'].' </h2></div>
										    <div class="cart-buttons mb-20" style="float: right">
                                                <div class="add-to-cart-btn" style="float: right">
                                                    <a href="invoice.php?o_no='.$row['order_no'].'&s_id='.$user[0].'" target="_blank" ><i class="fa fa-file"></i>print invoice</a>
                                                </div>
                                                
                                            </div>';
                                            
                                        /*    <div class="add-to-cart-btn" style="float: left">
                                                    <a href="seller_account.php?o_no='.$row['order_no'].'" ><i class="fa fa-file"></i>ready to ship</a>
                                                </div> */
										    echo'
										    <div class="myaccount-table table-responsive text-center">
											    <table class="table table-bordered">
    												<thead class="thead-light">
    												<tr>
    													<th>No</th>
    													<th>Name</th>
    													<th>Price</th>
    													<th>quantity</th>
    													<th>Total</th>
    													
    												</tr>
    												</thead>
    												
    												<tbody>';
    												$result = $user1->get_shipped_order($row['order_no'],$user[0]);
    												foreach ($result as $row) {
    													echo '<tr><td>'.$row[0].'</td>
    													<td>'.$row[1].'</td>
    													<td>'.$row[2].'</td>
    													<td>'.$row[3].'</td>
    													<td>'.$row[2]*$row[3].'</td>';
    												//	<td><a href="seller_account.php?status='.$row[0].'" class="btn">ship</a></td></tr>
    
    												}echo '	
    												</tbody>
    											</table>
    										</div></div>';
										}
										?>
									</div>
								</div>
								<!-- Single Tab Content End -->

																<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="download" role="tabpanel">
									<div class="myaccount-content">
										<h3>Product Details</h3>

										<div class="account-details-form">
											<form action="seller_account.php" method="post" enctype="multipart/form-data">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input id="name" name="name" placeholder="Product Name" type="text" maxlength="65">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="brand" name="brand" placeholder="Product Brand" type="text">
													</div>
                                                    <div class="col-lg-6 col-12 mb-30">
														<input id="prod_weight" name="prod_weight" placeholder="Enter Product Weight (Grams)" type="number">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="price" name="price" placeholder="price" type="number">
													</div>
												    <div class="col-lg-6 col-12 mb-30">
														<input id="disc_price" name="disc_price" placeholder="Discounted Price" type="number">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="disc_start_date" name="disc_start_date" value="2020-01-08 00:00:0" placeholder="Enter Discounted Price Start Date" type="date">
													</div>
											    	<div class="col-lg-6 col-12 mb-30">
														<input id="disc_end_date" name="disc_end_date" value="2020-01-08 00:00:0" placeholder="Enter Discounted Price End Date" type="date">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input name="img"  type="file">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input name="quantity" id="quantity"  value=100 placeholder="quantity" type="number">
													</div>
													<h3>Category:  </h3>
														<select name="category" id="category" class="nice-select" >
														    <ul class="sub-menu">
															<?php
															
																
																showCategory();

															//	style=" border: 1px solid lightgrey;border-radius: 25px;eight: fit-content;padding-left: 10px;margin-left: 10px; height: 50px;"
															
															?>
															</ul>
														</select>
													<!--	<div class="col-lg-6 col-12 mb-30">
														<input id="option1" name="option1" placeholder="Enter Option 1 (like product color ,size)" type="text">
													</div>
													
														<div class="col-lg-6 col-12 mb-30">
														<input id="option2" name="option2" placeholder="Enter Option 2 (like product color ,size)" type="text">
													</div>
													
														<div class="col-lg-6 col-12 mb-30">
														<input id="option3" name="option3" placeholder="Enter Option 3 (like product color ,size)" type="text">
													</div>
													
														<div class="col-lg-6 col-12 mb-30">
														<input id="option4" name="option4" placeholder="Enter Option 4 (like product color ,size)" type="text">
													</div>
													
														<div class="col-lg-6 col-12 mb-30">
														<input id="option5" name="option5" placeholder="Enter Option 5 (like product color ,size)" type="text">
													</div>
													
														<div class="col-lg-6 col-12 mb-30">
														<input id="option6" name="option6" placeholder="Enter Option 6 (like product color ,size)" type="text">
													</div>
                                                
													-->
													<div class="col-12 mb-30">
                                                        <label for="discription"></label>:</label>
                                                        <textarea rows="10" cols="90" name="discription" id="di-name"
                                                        placeholder="Product Description" maxlength="1000" >100% Original Refundable</textarea>
                                                    </div>
                                                    <br>
													<div class="col-12 mb-30">
                                                        <label for="mini_desc"></label>:</label>
                                                        <textarea rows="7" cols="90" name="mini_desc" id="display-name"
                                                        placeholder="Product Mini Description" maxlength="125">100% Original Refundable</textarea>
                                                    </div>

													<div class="col-12">
														<button type="submit" name="add" class="save-change-btn">Add product</button>
													</div>

												</div>
											</form>
										</div>
										<br>



										<h3>Products</h3>
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
										<h3>my products</h3>
										<div class="myaccount-table table-responsive text-center">
											<table class="table table-bordered">
												<thead class="thead-light">
												<tr>
												    <th>id</th>
													<th>Product</th>
													<th>category</th>
													<th>price</th>
													<th>quantity</th>
													<th>update</th>
													<th>delete</th>
												</tr>
												</thead>
												
											<?php
											$pro= new product();
											$result = $pro->fetch_product_by_sid($user[0]);
											foreach($result as $row){
											    echo '
												<tbody>
												<tr>
													<td>'.$row['pid'].'</td>
													<td>'.$row['product_name'].'</td>
													<td>'.$row['pid'].'</td>
													<td>'.$row['price'].'</td>
													<td>'.$row['quantity'].'</td>
													
													<td><div class="cart-buttons mb-20" style="float: right">
                                                            <div class="add-to-cart-btn" style="float: right">
                                                                <a href="update_product.php?update_Pid='.$row['pid'].'" ><i class="fa fa-file"></i>update</a>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    <td><div class="cart-buttons mb-20" style="float: right">
                                                            <div class="add-to-cart-btn" style="float: right">
                                                                <a href="seller_account.php?delete_Pid='.$row['pid'].'" ><i class="fa fa-file"></i>delete</a>
                                                            </div>
                                                        </div>
                                                        </td>
												</tr>
												
												</tbody>
												';
											}
											?>  
												
												
												
											</table>
										</div>
										<p class="saved-message">You Can't Saved Your Payment Method yet.</p>
									</div>
									
									<div class="myaccount-content">
										<h3>my products</h3>
										<div class="myaccount-table table-responsive text-center">
											<table class="table table-bordered">
												<thead class="thead-light">
												<tr>
												    <th>id</th>
													<th>Product</th>
													<th>category</th>
													<th>price</th>
													<th>quantity</th>
													<th>update</th>
													<th>delete</th>
												</tr>
												</thead>
												
											<?php
											$pro= new product();
											$result = $pro->fetch_disabled_product_by_sid($user[0]);
											foreach($result as $row){
											    echo '
												<tbody>
												<tr>
													<td>'.$row['pid'].'</td>
													<td>'.$row['product_name'].'</td>
													<td>'.$row['pid'].'</td>
													<td>'.$row['price'].'</td>
													<td>'.$row['quantity'].'</td>
													
													<td><div class="cart-buttons mb-20" style="float: right">
                                                            <div class="add-to-cart-btn" style="float: right">
                                                                <a href="update_product.php?update_Pid='.$row['pid'].'" ><i class="fa fa-file"></i>update</a>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    <td><div class="cart-buttons mb-20" style="float: right">
                                                            <div class="add-to-cart-btn" style="float: right">
                                                                <a href="seller_account.php?delete_Pid='.$row['pid'].'" ><i class="fa fa-file"></i>delete</a>
                                                            </div>
                                                        </div>
                                                        </td>
												</tr>
												
												</tbody>
												';
											}
											?>  
												
												
												
											</table>
										</div>
										<p class="saved-message">You Can't Saved Your Payment Method yet.</p>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="address-edit" role="tabpanel">
									<div class="myaccount-content">
										<h3>Billing Address</h3>
										<?php
													
											echo '<address>
												<p><strong>'.$user[1].' '.$user[2].'</strong></p>';echo '
												<p>'.$user[6].'<br>
													</p>
												<p>Mobile: '.$user[5].'</p>
											</address>';

										?>
										<a href="#" class="btn d-inline-block edit-address-btn"><i class="fa fa-edit"></i>Edit Address</a>
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
													<div class="col-lg-6 col-12 mb-30">
														<input id="first-name" name="first" placeholder="First Name" type="text" value=<?php echo $user[1];?>>
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="last-name" name="last" placeholder="Last Name" type="text" value=<?php echo $user[2];?>>
													</div>

													<div class="col-12 mb-30">
														<input id="email" name="email" placeholder="Email Address" type="email" value=<?php echo $user[3];?>>
													</div>

													<div class="col-12 mb-30"><h4>Password change</h4></div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="new-pwd" name="pass" placeholder="New Password" type="password">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="confirm-pwd" name="Vpass" placeholder="Confirm Password" type="password">
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
						<!-- My Account Tab Menu End -->
						<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."footer.php");
	?>

	
	<!--=====  End of Footer  ======-->
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
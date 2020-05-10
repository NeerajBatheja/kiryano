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
		//header('location:seller_login_register.php');
    echo "<script>window.location.href='seller_login_register.php';</script>";
exit;
	    
	}
$first= $user[1];
$last= $user[2];

if(isset($_GET['update_Pid'])){
    $pid = $_GET['update_Pid'];
    $pro = new product();
    $result = $pro-> fetch_product($pid);
    foreach ($result as $product);
}




if(isset($_POST['update'])){
    
    $pro = new product();
    if($pro->update_product($_POST['p_id'],$_POST['name'],$_POST['category'],$_POST['price'],$_POST['discription'],$_POST['quantity'],
	    $_POST['disc_price'],$_POST['disc_start_date'],$_POST['disc_end_date'],$_POST['brand'],$_POST['mini_desc'],$_POST['prod_weight'])){
	        header('location:seller_account.php?update_Pid=1');
	    }
    /*
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
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg "
	&& $imageFileType != "gif"  && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
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
	}*/

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
	<title>Product Update-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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

		<!--=======  header bottom  =======-->

	<div class="my-account-section section position-relative mb-50 fix">
		<div class="container">
				<div class="myaccount-content">
										<h3>Product Details</h3>

										<div class="account-details-form">
											<form action="update_product.php" method="post" enctype="multipart/form-data">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input id="name" name="name" placeholder="Product Name" type="text" value="<?php echo $product['product_name']; ?>">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="brand" name="brand" placeholder="Product Brand" type="text" value="<?php echo $product['brand']; ?>">
													</div>
                                                    <div class="col-lg-6 col-12 mb-30">
														<input id="prod_weight" name="prod_weight" placeholder="Enter Product Weight (Grams)" type="number" value="<?php echo $product['prod_weight']; ?>">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="price" name="price" placeholder="price" type="number" value=<?php echo $product['price']; ?>>
													</div>
												    <div class="col-lg-6 col-12 mb-30">
														<input id="disc_price" name="disc_price" placeholder="Discounted Price" type="number" value="<?php echo $product['disc_price']; ?>">
													</div>
													<div class="col-lg-6 col-12 mb-30">
														<input id="disc_start_date" name="disc_start_date" placeholder="Enter Discounted Price Start Date" type="date" value=<?php echo $product['disc_start_date']; ?> >
													</div>
											    	<div class="col-lg-6 col-12 mb-30">
														<input id="disc_end_date" name="disc_end_date" placeholder="Enter Discounted Price End Date" type="date" value=<?php echo $product['disc_end_date']; ?>>
													</div>

													

													<div class="col-lg-6 col-12 mb-30">
														<input name="quantity" id="quantity" placeholder="quantity" type="number" value=<?php echo $product['quantity']; ?>>
													</div>
													<h3>Category:  </h3>
														<select name="category" id="category" class="nice-select"  value=<?php echo $product['category']; ?>>
														    <ul class="sub-menu">
															<?php
																showCategory();
															?>
															</ul>
														</select>
													<div class="col-12 mb-30">
                                                        <label for="discription"></label>
                                                        <textarea rows="10" cols="90" name="discription" id="di-name" placeholder="Product Description" maxlength="1000"><?php echo $product['discription']; ?></textarea>
                                                    </div>
                                                    <br>
													<div class="col-12 mb-30">
                                                        <label for="mini_desc"></label>
                                                        <textarea rows="7" cols="90" name="mini_desc" id="display-name" placeholder="Product Mini Description" maxlength="125" ><?php echo $product['mini_desc']; ?></textarea>
                                                    </div>
                                                   <input type="hidden" id="p_id" name="p_id" value=<?php echo $product['pid']; ?>>
													<div class="col-12">
														<button type="submit" name="update" class="save-change-btn">Update</button>
													</div>

												</div>
											</form>
										</div>
										<br>
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
	
	
	
	
	
	
	
	
	
	
	
	
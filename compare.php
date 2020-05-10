<?php
session_start();
include_once 'classes/userClass.php';
include_once 'classes/compareClass.php';
$user;
$user1= new user();
$comp= new compare();

if(isset($_GET["product"])){

    $_SESSION["product"] = $_GET['product'];
    unset($_GET["product"]);
}

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
	//	header('location:login-registrer.php?loc=3');
       echo "<script>window.location.href='login-registrer.php?loc=3';</script>";
exit;}    
$first= $user[1];
$last= $user[2];	

if(isset($_SESSION["product"])){
        
        if($comp->insert_to_compare($user[0],$_SESSION["product"]))
            echo "inserted";
        unset($_SESSION["product"]);
    }

if(isset($_GET['rid'])){
        if($comp->delete_product($user[0],$_GET['rid'])){
            echo "deleted";
        }
    }


// show all parent categories
function showCategoryParent($id = NULL){
    
	if(is_null($id)){
		return;
	}else{
		$cat = new category();
		$result =$cat->fetch_by_id($id);
		echo '<a href="home.php?pid='.$result['id'].'">'.$result['name'].'</a> , ';
		return showCategoryParent($result['parent']);
	}
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/compare.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:15 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Compare-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
	=            compare page content         =
	=============================================-->
	
	<div class="page-section section mb-50">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="#">		
								
						<!-- Compare Table -->
						<div class="compare-table table-responsive">
							<table class="table mb-0">
								<tbody>
									<tr>
										<td class="first-column">Product</td>
										
										<?php
											$result= $comp->get_products($user[0]);
											foreach ($result as $row) {
											echo '<td class="product-image-title">
											<a href="single-product.php?id='.$row['pid'].'" class="image"><img src="'.$row[6].'"" class="img-fluid" alt="Compare Product"></a>';
											showCategoryParent($row['cat_id']);
											echo '<a href="single-product.php?id='.$row['pid'].'" class="title">'.$row[1].'</a>
											</td>';
											}
										?>
									</tr>
									<tr>
										<td class="first-column">Description</td>
										<?php
											foreach ($result as $row) {
												echo '<td class="pro-desc"><p>'.$row[5].'</p></td>';
											}
										?>
									</tr>
									<tr>
										<td class="first-column">Price</td>
										<?php
											foreach ($result as $row) {
												echo '<td class="pro-price">'.$row[4].'</td>';
											}
											
										?>
									</tr>
									<tr>
										<td class="first-column">Stock</td>
										<?php
											foreach ($result as $row) {
												if($row['quantity'])
													echo '<td class="pro-stock">In Stock</td>';
												else
													echo '<td class="pro-stock">out of Stock</td>';
											}
										?>
									</tr>
									<tr>
										<td class="first-column">Add to cart</td>
										<?php
										foreach ($result as $row) {
										    if($row['quantity'])
												echo '<td class="pro-addtocart"><a href="cart.php?product='.$row[0].'" class="add-to-cart" tabindex="0"><i class="fa fa-shopping-cart"></i><span>ADD TO CART</span></a></td>';
											}
											
										?>
									</tr>
									<tr>
										<td class="first-column">Delete</td>
										<?php
										foreach ($result as $row) {
												echo '<td class="pro-remove"><a href="compare.php?rid='.$row[0].'"><i class="fa fa-trash-o"></i></a></td>';
											}
											
										?>
									</tr>
								</tbody>
							</table>
						</div>
						
					</form>	
					
				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of compare page content  ======-->

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


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/compare.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:15 GMT -->
</html>
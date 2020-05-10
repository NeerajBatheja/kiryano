<?php
session_start();
include_once 'classes/userClass.php';


$user;
$user1= new user();

// will save url product id before login and then will use it after login;
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
    else
    {
        // header('location:login-registrer.php?loc=1');
        echo "<script>window.location.href='login-registrer.php?loc=1';</script>";
exit;
    }
       


// this will add clicked product  to wishlist     
if(isset($_SESSION["product"])){
        if($user1->add_to_wishlist($_SESSION["product"],$user[0]))
            echo "inserted";
        unset($_SESSION["product"]);
    }

// this wil remove the product with ($rid) from wishlist
if(isset($_GET['rid'])){
        if($user1->delete_wishlist_product($_GET['rid'])){
            echo "deleted";
        }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Wishlist-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
    =            Wishlist page content         =
    =============================================-->
    

    <div class="page-section section mb-50">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<form action="#">				
							<!--=======  cart table  =======-->
							
							<div class="cart-table table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="pro-thumbnail">Image</th>
											<th class="pro-title">Product</th>
											<th class="pro-price">Price</th>
											<th class="pro-quantity">Buy Now</th>
											<th class="pro-remove">Remove</th>
										</tr>
									</thead>
									<tbody>
									    <?php 
									    if($result = $user1->get_wishlist($user[0])){
									        foreach($result as $item){
                							  echo '<tr>
                										<td class="pro-thumbnail"><a href="single-product.php?id='.$item['pid'].'"><img src="'.$item['img_path'].'" class="img-fluid" alt="Product"></a></td>
                                                        <td class="pro-title"><a href="single-product.php?id='.$item['pid'].'">'.$item['product_name'].'</a></td>
                                                        <td class="pro-price"><span>'.$item['price'].'</span></td>';
                                                        if($item['quantity'])
                                                        echo '
                                                        <td><div class="cart-buttons mb-20">
                                                            <div class="add-to-cart-btn">
                                                                <a href="cart.php?product='.$item['pid'].'"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                                                            </div>
                                                        </div> </td>';
                                                        else
                                                            echo '<td>Out of Stock</td>';
                                                        echo'
                										<td class="pro-remove"><a href="wishlist.php?rid='.$item['id'].'"><i class="fa fa-trash-o"></i></a></td>
                									</tr>';
									        }
									    }
									    
									  
									    
									    ?>
									    
									    
										
									</tbody>
								</table>
							</div>
							
							<!--=======  End of cart table  =======-->
							
						</form>	
					</div>
				</div>
			</div>
		</div>
		
		<!--=====  End of Cart page content  ======-->
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


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>
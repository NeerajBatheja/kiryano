<?php
include_once 'classes/userClass.php';

session_start();
if(isset($_GET["product"])){

    $_SESSION["product"] = $_GET['product'];
    unset($_GET["product"]);
}

$user;
$user1= new user();

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
        header('location:login-registrer.php?loc=4');

    if(isset($_SESSION["product"])){
        
        if($user1->add_to_cart($_SESSION["product"],$user[0]))
            echo "inserted";
        unset($_SESSION["product"]);
    }

    if(isset($_GET['rid'])){
        if($user1->delete_product($_GET['rid'])){
            echo "deleted";
        }
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Greenfarm - Organic Food eCommerce Bootstrap 4 Template</title>
	<meta name="description" content="">
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
    =            Cart page content         =
    =============================================-->
    

    <div class="page-section section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">				
                        <!--=======  cart table  =======-->
                        
                        <div class="cart-table table-responsive mb-40">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                        <th class="pro-remove">update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sub_total=0;
                                        if($arr = $user1->get_cart($user[0])){
                                            foreach ($arr as $item) {
                                                echo '<tr>
                                                        <td class="pro-thumbnail"><a href="#"><img src="'.$item[1].'" class="img-fluid" alt="Product"></a></td>
                                                        <td class="pro-title"><a href="#">'.$item[2].'</a></td>
                                                        <td class="pro-price"><span>'.$item[3].'</span></td>

                                                        <td class="pro-quantity"><div class="pro-qty"><input type="number" value="'.$item[5].'"></div></td> 
                                                        <td class="pro-subtotal"><span>'.$item[3]*$item[5].'</span></td>
                                                        <td class="pro-remove"><a href="cart.php?rid='.$item[6].'"><i class="fa fa-trash-o"></i></a></td>
                                                        <td class="pro-remove"> <div class="cart-summary"><div class="cart-summary-button"><button class="update-btn">Update</button></div></div></td>
                                                    </tr>';
                                                $sub_total=$sub_total+$item[3]*$item[5];
                                            }
                                        }
                                      
                                    ?>
            
                                </tbody>
                            </table>
                        </div>
                        
                        <!--=======  End of cart table  =======-->
                        
                        
                    </form>	
                        
                    <div class="row">
    
                       
                        <div class="col-lg-6 col-12 d-flex">
                            <!--=======  Cart summery  =======-->
                        
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span><?php echo $sub_total; ?></span></p>
                                    <p>Shipping Cost <span><?php echo $sub_total*0.1; ?></span></p>
                                    <h2>Grand Total <span><?php echo $sub_total+$sub_total*0.1; ?></span></h2>
                                </div>
                                <div class="cart-summary-button">

                                    <?php if($sub_total+$sub_total*0.1)  echo '<button class="checkout-btn"><a href="checkout.php?cid='.$user[0].'">Checkout</a></button>'; ?>
                                </div>
                            </div>
                        
                            <!--=======  End of Cart summery  =======-->
                            
                        </div>
    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!--=====  End of Cart page content  ======-->



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


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>
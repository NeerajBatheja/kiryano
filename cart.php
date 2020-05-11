<?php
session_start();
include_once 'classes/userClass.php';

// will save url product id before login and then will use it after login;

if(isset($_GET["product"])){
    $_SESSION["product"] = $_GET['product'];
    unset($_GET["product"]);
    if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){
    $_SESSION['productAdded'] = 1;    
     }
										     
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
        {
            echo "<script async>window.location.href='login-registrer.php?loc=4';</script>";
            exit;
        }


    if(isset($_SESSION["product"])){
        
        if($user1->add_to_cart($_SESSION["product"],$user[0]))
            
        unset($_SESSION["product"]);
        echo "<script async>window.location.href='home.php';
    </script>";
   exit;
    }

    if(isset($_GET['rid'])){
        if($user1->delete_product($_GET['rid'])){
            echo '<h4><font color="green">Product Has Been Deleted From the Cart</font></h4>';
        }
    }
    if(isset($_GET['increase_id'])){
        if($user1->increase_product($_GET['increase_id'])){
            		   echo '<h5><font color="green">Product Quantity Has Been Increased</font></h5>';
        }
    }
    if(isset($_GET['decrease_id'])){
        if($user1->decrease_product($_GET['decrease_id'])){
           echo '<h4><font color="green">Product Quantity Has Been Decreased</font></h4>';
        }
        
    }
    
    if(isset($_GET['p_qty_up'])){
        if($user1->prod_qty_update($_GET['p_qty_up'])){
            echo '<h4><font color="green">Your Cart Has Been Updated</font></h4>';
        }
    }
    
    
     
     
    
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Cart-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
	<script src="assets/js/vendor/modernizr-2.8.3.min.js" async></script>

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
                                        <th class="pro-quantity">Decrease</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-quantity">Increase</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sub_total=0;
                                        if($arr = $user1->get_cart($user[0])){
                                            foreach ($arr as $item) {
                                                echo '<tr>
                                                        <td class="pro-thumbnail"><a href="single-product.php?id='.$item['pid'].'"><img src="'.$item[1].'" class="img-fluid" alt="Product"></a></td>
                                                        <td class="pro-title"><a href="single-product.php?id='.$item['pid'].'">'.$item[2].'</a></td>
                                                        <td class="pro-price"><span>'.$item['disc_price'].'</span></td>
                                                        <td class="update-btn" id="update-btn"><a href="cart.php?decrease_id='.$item[6].'"><i  class="fa fa-minus-circle" style="font-size: 30px"></i></a></td>
                                                        <td class="pro-quantity">'.$item[5].'</td> 
                                                        <td class="update-btn"><a href="cart.php?increase_id='.$item[6].'"> <i class="fa fa-plus-circle" style="font-size: 30px"></i></a></td>
                                                        <td class="pro-subtotal"><span>'.$item[3]*$item[5].'</span></td>
                                                        <td class="pro-remove"><a href="cart.php?rid='.$item[6].'"><i class="fa fa-trash-o"></i></a></td>
                                                    </tr>';
                                                $sub_total=$sub_total+$item[3]*$item[5];
                                            }
                                        }
                                      if($sub_total > 500){
                                          $shipping_fee = 0;
                                      }else
                                        //$shipping_fee = 30;
                                        $shipping_fee = 30;

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
                                    <p>SubTotal <span><?php echo $sub_total; ?></span></p>
                                    <p><?php if($shipping_fee) echo 'Shipping Cost <span>'.$shipping_fee.'</span>'; else echo '<h4>Free Shipping!!</h4>';  ?></p>
                                    <h2>Grand Total <span><?php echo $sub_total+$shipping_fee-$coupan_value; ?></span></h2>
                                    <br>
                                    </font><p><font color = "blue">You can apply discount coupan on checkout page.For coupans <a href="kiryanocoupans.php">Click Here</a></font></p>
                                    
                                </div>
                                <div class="cart-summary-button">

                                    <?php if($sub_total+$sub_total*0.1){
                                        $_SESSION['customer'] =$user[0] ;
                                    echo '<a href="checkout.php?cid=1"><button class="checkout-btn">Checkout</button></a>';
                                    }?>
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
	<script src="assets/js/vendor/jquery.min.js" async></script>

	<!-- Popper JS -->
	<script src="assets/js/popper.min.js" async></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js" async></script>

	<!-- Plugins JS -->
	<script src="assets/js/plugins.js" async></script>

	<!-- Main JS -->
	<script src="assets/js/main.js" async></script>
<!--Retain scroll position --> 
<script async>
$(document).ready(function(){
var saveScroll = 0;
$(window).scroll(function(){
var saveScroll = $(window).scrollTop();
//setting cookie for saving javascript variable as we can get it after refreshing the page
document.cookie = "saveScroll = " + saveScroll

    
});

});
</script>
<script async>
    //getting cookie back to javascript variable using php cookie function
    getcookie = '<?php echo $_COOKIE['saveScroll']; ;?>';
    $(window).scrollTop(getcookie);
    
</script>    



</body>


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
</html>
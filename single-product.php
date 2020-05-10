<?php
session_start();
include_once('classes/productClass.php');
include_once('classes/categoryClass.php');
$pid=$_GET["id"];

// including header.php
$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
include($IPATH."header.php");
$var=1;
//geting submitted review;
if(isset($_POST['Rsubmit']) and isset($_POST['review'])){
    $user1->submit_review($pid,$user[0],$_POST['review'],$_POST['stars']);
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


// show all parent categories but shift to single product view
function showCategoryParentForProduct($id = NULL){
	if(is_null($id)){
		return;
	}else{
		$cat = new category();
		$result =$cat->fetch_by_id($id);
		echo '<a href="single-product.php?id='.$result['id'].'">'.$result['name'].'</a> , ';
		return showCategoryParent($result['parent']);
	}
}

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:48 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Kiryano Product-Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
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
    =            single product content         =
    =============================================-->
    
    <div class="single-product-content ">
        <div class="container">
            <!--=======  single product content container  =======-->
            <div class="single-product-content-container mb-35">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12"> 

                        <?php
                            $products = new product();
                            $cat;
                                if ($result=$products->fetch_product($pid)){
                                // Fetch one and one row
                                  foreach ($result as $row){
                                    $cat= $row['cat_id'];
                                   echo '
                                                <div class="product-image-slider d-flex flex-custom-xs-wrap flex-sm-nowrap align-items-center mb-sm-35">
                                                    <div class="tab-content product-large-image-list">
                                                        <div class="tab-pane fade show active" id="single-slide1" role="tabpanel" aria-labelledby="single-slide-tab-1">
                                                            <!--Single Product Image Start-->
                                                            <div class="single-product-img easyzoom img-full">
                                                                <img src="'.$row['img_path'].'" class="img-fluid" alt="">
                                                                <a href="'.$row['img_path'].'" class="big-image-popup"><i class="fa fa-search-plus"></i></a>
                                                            </div>
                                                            <!--Single Product Image End-->
                                                        </div>
                                                        
                                                    </div>
                                                    <!--Modal Content End-->

                                                </div>
                                                <!-- end of product image gallery -->
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-xs-12">
                                                
                                                <div class="product-feature-details">
                                                    <h2 class="product-title mb-15">'.$row['product_name'].'</h2>
<!-- product quick view description 
                                                    <p class="product-rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>

                                                        <a href="#">(1 customer review)</a>
                                                    </p>
                                                    -->
                                                    <h2 class="product-price mb-15"> 
                                                   <!--     <span class="main-price">Rs.12.90</span> -->
                                                   ';
                                                        if($row['price']==$row['disc_price'])
									                	{
										                 echo'<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>';
									                	}
									                	else
									                   	{
									            	    echo'<span class="main-price">Rs.'.$row['price'].'</span>
									    	<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>';
										}
                                                    echo'</h2>
                                                    
                                                    <p class="product-description mb-20">'.$row['mini_desc'].'</p>';
                                                    
                                                    if($row['quantity'])
                                                   echo ' 
                                                   
                                                    <div class="cart-buttons mb-20">
                                                        
                                                        <div class="add-to-cart-btn">
                                                            <a href="cart.php?product='.$row['pid'].'"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                                                        </div>
                                                    </div>
                                                    '; 
                                                    echo'

                                                    <div class="single-product-action-btn mb-20">
                                                        <a href="wishlist.php?product='.$row['pid'].'" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> Add to wishlist</a>
                                                        <a href="compare.php?product='.$row['pid'].'" data-tooltip="Add to compare"> <span class="arrow_left-right_alt"></span> Add to compare</a>
                                                    </div>


                                                    <div class="single-product-category mb-20">
                                                        <h3>Categories: <span>'; showCategoryParent($row['cat_id']); echo'</span></h3>
                                                    
                                                     <div class="single-product-category mb-20">
                                                    <h3>Brand:<span class="single-product-category mb-20"> '.$row['brand'].'</span></h3> </div>
                                                  
                                                        
                                                    
                                                </div>
                                                <!-- end of product quick view description -->
                                            </div>
                                        </div>
                                    </div>';  
                                  }
                                }
                            
                        ?>
                        <!--=======  End of single product content container  =======-->
                        
                    </div>
                    
                </div>
                
                <!--=====  End of single product content  ======-->

    <!--=============================================
    =            single product tab         =
    =============================================-->
    
    <div class="single-product-tab-section mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-slider-wrapper">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                                aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                aria-selected="false">Reviews</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <?php
                            echo '<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p class="product-desc">'.$row['discription'].'</p>
                            </div>';

                            ?>
                            
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">


                                <div class="product-ratting-wrap">

                                    <div class="pro-avg-ratting">
                                    <div class="ratting-list">
                                        <div class="sin-list float-left">
                                            <?php
                                    $total_reviews = 0;
                                    $total_rating = 0;
                                    $result =$user1->fetch_reviews($pid);
                                    if($result){
                                    foreach ($result as $row) {
                                    $total_reviews = $total_reviews +1;
                                    $total_rating = $total_rating + $row['stars'];    
                                    }
                                    $avg_rating = $total_rating/$total_reviews;
                                    $temp_avg = $avg_rating; 
                                    while($temp_avg>0)
                                    {
                                        echo '<i class="fa fa-star " Style="color:#ffcc00" ></i>';
                                        $temp_avg = $temp_avg - 1;
                                    }
                                    
                                    $unactive_stars=5-round($avg_rating);
                                    while($unactive_stars>0)
                                    {
                                        echo '<i class="fa fa-star " ></i>';
                                       $unactive_stars= $unactive_stars - 1;
                                    }
                                    echo'<span>(Based on '.$total_reviews.' Customers)</span>
                                    </div>
                                        <h4>'.round($avg_rating,1).' <span>(Overall Rating)</span></h4>';
                                    }
                                    ?>
                                            
                                        
                                    
                                    </div>
                                    
                                       
                                        
                                        
                                        
                                    </div> 
                                    
                                    
                                    <div class="rattings-wrapper">

                                    <?php
// fetching all the reviews of that product
                                    $result =$user1->fetch_reviews($pid);
                                    if($result){
                                    foreach ($result as $row) {
                                                                 
                                        echo '<div class="sin-rattings">
                                            <div class="ratting-author">
                                                <h3>'.$row['f_name'].'</h3>
                                                <div class="ratting-star">';
                                                $star_num=$row['stars'];
                                                while($star_num!=0)
                                                {
                                                
                                                 echo'   <i class="fa fa-star" Style="color:#ffcc00"></i>';
                                                $star_num=$star_num-1;    
                                                        
                                                }
                                    $unactive_stars2=5-$row['stars'];
                                    while($unactive_stars2>0)
                                    {
                                        echo '<i class="fa fa-star " ></i>';
                                       $unactive_stars2= $unactive_stars2 - 1;
                                    }
                                                
                                            echo'  <span>('.$row['stars'].')</span>
                                                </div>
                                            </div>
                                            <p>'.$row['review'].'</p>
                                            
                                            
                                        </div>';
                                        
                                    }
                                    } else echo "Be First To Review ";
// showing reveiw form to the customer who has bought product;
                                    if($user1->check_if_bought($pid, $user[0])){

                                        echo '
                                        <div class="ratting-form-wrapper fix">
                                        <h3>Add your Comments</h3>
                                        <form action="" method="post">
                                            <div class="ratting-form row">
                                              
                                                
                                                <div class="col-12 mb-15">
                                               <div class="size mb-20">
                                        How Many Stars? <br>
                                <select name="stars" id="stars">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Stars</option>
                                </select>
                            </div>
                                              
                                                    <label for="your-review">Your Review:</label>
                                                    <textarea name="review" id="your-review"
                                                    placeholder="Write a review"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <input name="Rsubmit" value="add review" type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>';
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
    
    <!--=====  End of single product tab  ======-->
    <!--=============================================
	=            category slider         =
	=============================================-->
	
	<div class="slider category-slider mb-35">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!--=======  category slider section title  =======-->
					
					<div class="section-title">
						<h3>top categories</h3>
					</div>
					
					<!--=======  End of category slider section title  =======-->
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<!--=======  category container  =======-->
					
					<div class="category-slider-container">

						<!--=======  single category  =======-->
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Vegetables">
									<img src="assets/images/categories/category1.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Vegetables</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->

						<!--=======  single category  =======-->
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Fast Food">
									<img src="assets/images/categories/category2.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Fast Food</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->
					
						<!--=======  single category  =======-->

						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Fish & Meats">
									<img src="assets/images/categories/category3.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Fish & Meats</a>
								</h3>
							</div>
						</div>						
						
						<!--=======  End of single category  =======-->
					
						<!--=======  single category  =======-->
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Fruits">
									<img src="assets/images/categories/category4.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Fruits</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->
					
						<!--=======  single category  =======-->
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Salads">
									<img src="assets/images/categories/category5.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Salads</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->
					
						<!--=======  single category  =======-->
						
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Bread">
									<img src="assets/images/categories/category6.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Bread</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->
					
						<!--=======  single category  =======-->
						
						<div class="single-category">
							<div class="category-image">
								<a href="shop-left-sidebar.html" title="Beans">
									<img src="assets/images/categories/category7.png" class="img-fluid" alt="">
								</a>
							</div>
							<div class="category-title">
								<h3>
									<a href="shop-left-sidebar.html"> Beans</a>
								</h3>
							</div>
						</div>
						
						<!--=======  End of single category  =======-->
						
					</div>
					
					<!--=======  End of category container  =======-->

				</div>
			</div>
		</div>
	</div>
	
    <!--=====  End of category slider  ======-->
    
    
   
	<!--=============================================
	=            Related Product slider         =
	=============================================-->
	
	<div class="slider related-product-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  multisale  slider section title  =======-->
                    
                    <div class="section-title">
                        <h3>Related Product</h3>
                    </div>
                    
                    <!--=======  End of multisale slider section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  related product slider wrapper  =======-->
                    
                    <div class="related-product-slider-wrapper">
                        <!--=======  single related slider product  =======-->
                        <?php
                        
                        if ($result=$products->fetch_product_by_category($cat)){
                                    // Fetch one and one row
                                  foreach ($result as $row){
                        echo' <div class="gf-product related-slider-product">
                            <div class="image">
                                <a href="single-product.php?id='.$row[0].'">
                                    <span class="onsale">Sale!</span>
                                    <img src="'.$row['img_path'].'" class="img-fluid" alt="">
                                </a>
                                <div class="product-hover-icons">
                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-categories">
                                    '; showCategoryParent($cat);echo'</a>
                                    
                                </div>
                                <h3 class="product-title"><a href="single-product.html">'.$row['product_name'].'</a></h3>
                                <div class="price-box">
                                    <span class="main-price"> Rs.'.$row['price'].'</span>
                                 <span class="discounted-price">Rs.'.$row['disc_price'].'</span>
                                </div>
                            </div>
                            
                        </div>'; } } ?>
                        
                        <!--=======  End of single related slider product  =======-->
                        <!--=======  single related slider product  =======-->
                         <!--=======  End of single related slider product  =======-->
                        
                    </div>
                    
                    <!--=======  End of related product slider wrapper  =======-->
                </div>
            </div>
        </div>
    </div>
    
    <!--=====  End of Related product slider  ======-->	
	
    
    
    <!--=====  End of Related product slider  ======-->	
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

 
<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:42:52 GMT -->
</html>
<?php
session_start();
    include_once("classes/userClass.php");
	include_once('classes/categoryClass.php');
	include_once('classes/productClass.php');
	$cat = new category();
	$pro = new product();
	$user1 = new user();
	
	if(!isset($_SESSION['email'])){
		    
		    if(isset($_COOKIE['email'])){
		        if(isset($_COOKIE['pass']))
		        {
		            $email = $_COOKIE['email'];
		            $pass = $_COOKIE['pass'];
		            	if($user1->validate($email,$pass) ==1){
			//echo "login successfull";
			
			$_SESSION['email']=$email;
			$_SESSION['pass']=$pass;
		            	}
		            
		            
		        }
		    }
		    
		}
	


// get value of parent id of category;
if(isset($_GET['pid']))
	$pid = $_GET['pid'];
else
	$pid = 0;
//for top brands section	
if(isset($_GET['brand']))
	$brand = $_GET['brand'];
else
	$brand = 0;

// get value of searchbar text
if(isset($_POST['keywords'])){
	   $_SESSION['keywords_s'] = $_POST['keywords'];
	   $keywords = $_SESSION['keywords_s'];
	   $keyword_meta_input = metaphone($keywords);
	}
	else
	   if($_GET['keyword_not_set']){
	       $keywords=0;
	       $_SESSION['keywords_s'] = 0;
	   }
	   else
	   {
	   $keywords = $_SESSION['keywords_s'];
	   $keyword_meta_input = metaphone($keywords);    
	   }
	   
		

if(isset($_GET['pageno'])){
	   $page = $_GET['pageno'];
	   $result = $_SESSION['result'];
	}
	else
		$page = 0;
		
// show sidebass of category
function showSidebar($pid){
	$cat = new category();

	if($result = $cat->fetch_all_parent_category()){
		foreach ($result as $row){
	  		if($pid==$row[0]){
	  			echo '<li><a class="active" href="home.php?pid='.$row['id'].'">'.$row['name'].'</a></li>';
	  		}else{
	  			echo '<li><a  href="home.php?pid='.$row['id'].'">'.$row['name'].'</a></li>';
	  		}
	    }
	}
	return $pid;
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

function showProductByPage($page,$result){
    $product_per_page = 28;
    $total_page = ceil(sizeof($result)/$product_per_page);
    $j=0;
    for($i=$product_per_page *($page-1);$i<sizeof($result) && $j<28;$i++){
        $array[] =$result[$i];
        $j++;
    }
    return $array;
}

?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/greenfarm-preview/greenfarm/shop-list-left-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Oct 2019 09:43:15 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Favicon -->
	<link rel="icon" href="assets/images/favicon.ico">

	<meta http-equiv="X-UA-Compatible" content="Kiryano is Pakistan based online shopping store . Kiryano Serves  Gorcery, latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<title>Kiryano-Online Shopping in Pakistan:Grocery,Electronics,Fashion</title>
	<meta name="description" content="Kiryano is Pakistan based online shopping store . Kiryano Serve  Gorcery,latest Mobiles, Appliances, Fashion Accessories, & more retail products available at Reasonable Price,Kiryano is Startup Of FAST-NUCES Students For Larkana People.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Modernizer JS -->
	<script src="assets/js/vendor/modernizr-2.8.3.min.js" async></script>
    </head>


<body>
<?php    
if($_SESSION['NewCustomerMessage']!=1){
echo'    <script src="assets\js\sweetalert.min.js"></script>;
<script>swal("How To Place Order At Kiryano?", "Create Account -> Add Products To Cart -> Checkout", "success");</script>;';}
 
$_SESSION['NewCustomerMessage'] = 1;
if($_SESSION['productAdded']){
echo '<script src="assets\js\sweetalert.min.js"></script>';
echo '<script>swal("Added to Cart!", "You can view your all products from cart!", "success");</script>';
$_SESSION['productAdded']=0;
    
}
?>
	<!--=============================================
	=            Header         =
	=============================================-->

	<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."header.php");
	
	
	?>
	<!--=====  End of Header  ======-->
	                       <p style="color:red"> Product Na milne ki surat mein ap humhe 03488311613 is number pe msg (WhatsApp) kr skte ha take wo hum product upload kr skein. </p>
    
	

  
	<!--=============================================
	=            Shop page container         =
	=============================================-->
	
	
	<div class="shop-page-container mb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<!--=======  sidebar area  =======-->
					
					<div class="sidebar-area">
						<!--=======  single sidebar  =======-->
						
						<div class="sidebar mb-35">
							<h3 class="sidebar-title">PRODUCT CATEGORIES</h3>
							<ul class="product-categories">
								<?php
									$pid =showSidebar($pid);
								?>
							</ul>
						</div>
						
					
						

						<!--=======  single sidebar  =======-->
						
						<div class="sidebar mb-35">
							<h3 class="sidebar-title">Popular products</h3>
							
							<!--=======  top rated product container  =======-->
							
							<div class="top-rated-product-container">
								<!--=======  single top rated product  =======-->
							<?php 
								
								$result2 = $pro->fetch_all_products();
								for ($i =0; $i < 5; $i++) {
								    $row = $result2[$i];
								    echo'<div class="single-top-rated-product d-flex align-content-center">
            								<div class="image">
            									<a href="single-product.php?id='.$row['pid'].'">
                                                     <img src="'.$row['img_path'].'" class="img-fluid" alt="">
            									</a>
            								</div>
            								<div class="content">
            									<p><a href="single-product.php?id='.$row['pid'].'">'.$row['product_name'].'</a></p>';
            									
            									$total_reviews = 0;
                                                $total_rating = 0;
                                                $rvw =$user1->fetch_reviews($row['pid']);
            									if($rvw){
            									    
                                                    foreach ($rvw as $row1) {
                                                        $total_reviews = $total_reviews +1;
                                                        $total_rating = $total_rating + $row1['stars'];
                                                    }
                                                    
                                                    $avg_rating = $total_rating/$total_reviews;
                                                    $temp_avg = $avg_rating;
                                                    
                                                    echo'<p class="product-rating">';
                                                    
                                                    for($j =0 ;$j<5;$j++){
                                                        if($avg_rating > $j){
                                                             echo '<i class="fa fa-star" Style="color:#ffcc00"></i>';
                                                        }else{
                                                             echo '<i class="fa fa-star " ></i>';
                                                        }
                                                    }
                									echo'('.$total_reviews.')
                									</p>';
            									} else echo "Be First To Review";
            									
        						           echo'<p class="product-price"> 
        											<span class="main-price">Rs.'.$row['price'].'</span>
        									    	<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>
        									    </p>
        										
        									</div>
        								</div>'; 
                                }
								?>
								<!--=======  End of single top rated product  =======-->
								<!--=======  single top rated product  =======-->
								
								
								
								<!--=======  End of single top rated product  =======-->
								<!--=======  single top rated product  =======-->
								
								
								
								<!--=======  End of single top rated product  =======-->
								
							</div>
							
							<!--=======  End of top rated product container  =======-->
						</div>
						
						<!--=======  End of single sidebar  =======-->

						<!--=======  single sidebar  =======-->
						
						<div class="sidebar">
							<h3 class="sidebar-title">TOP BRANDS</h3>
							<!--=======  tag container  =======-->
							
							<ul class="tag-container">
								<?php
								
						        if($page){
						            
						        }else{
						            $page = 1;
						           
    						            // result is used to get all the products either by category or by search
        								if($keywords){
        								    $result = $pro->fetch_product_by_keyword_search($keywords);
									
    								    $total_products2=count($result);
    								    if($total_products2==0)
    								    {
    								        
    								    $result = $pro->fetch_product_by_keyword($keyword_meta_input);    
    								    }
        								     
        								}
        								else if($pid)
        									$result = $pro->fetch_product_by_category($pid);
        								else if($brand)
									        $result = $pro->fetch_all_products_sorted_by_popular_brands($brand);
        								else
        									$result = $pro->fetch_all_products();
						        }
								    $loop_count = 0;    
								    
									  foreach ($result as $row) {
									      
									      if($row['brand']!=$exist_brand)
								echo'<li><a href="home.php?brand='.$row['brand'].'">'.$row['brand'].'</a> </li>'; 
								$exist_brand=$row['brand'];
								$loop_count = $loop_count +1;
								if($loop_count==10)
								break;
								
								} ?>
							
							</ul>
							
							<!--=======  End of tag container  =======-->
						</div>
						
						<!--=======  End of single sidebar  =======-->
					</div>
					
					<!--=======  End of sidebar area  =======-->
				</div>
				<div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">

					<!--=======  shop page banner  =======-->
					
					<div class="shop-page-banner mb-15">
						<a href="home.php">
							<img src="assets/images/banners/shop-banner.jpg" class="img-fluid" alt="">
						</a>
					</div>
					
					<!--=======  End of shop page banner  =======-->
<!--=============================================
	=            Policy area         =
	=============================================-->
	
	<div class="policy-section mb-15">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="policy-titles d-flex align-items-center flex-wrap">
						<!--=======  single policy  =======-->
						
						<div class="single-policy">
							<span><img src="assets/images/policy-icon1.png" class="img-fluid" alt=""></span>
							<p> FREE SHIPPING OVER R.500</p>
						</div>
						
						<!--=======  End of single policy  =======-->


						<!--=======  single policy  =======-->
						
						<div class="single-policy">
							<span><img src="assets/images/policy-icon2.png" class="img-fluid" alt=""></span>
							<p>3 - DAY RETURN</p>
						</div>
						
						<!--=======  End of single policy  =======-->
						
						<!--=============================================
						=            single policy         =
						=============================================-->
						
						<div class="single-policy">
							<span><img src="assets/images/policy-icon3.png" class="img-fluid" alt=""></span>
							<p> 24/7 SUPPORT</p>
						</div>
						
						<!--=====  End of single policy  ======-->

					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of Policy area  ======-->
        

	<!--=======  Shop header  =======-->
	
	<div class="shop-header mb-15">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
			<!--=======  view mode  =======-->
				
				<div class="view-mode-icons mb-xs-10">
					<a  class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
					<a   href="#" data-target="list"><i class="fa fa-list"></i></a>
				</div>
				
				<!--=======  End of view mode  =======-->
				
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
				<!--=======  Sort by dropdown  =======-->
				
				<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
					<p class="mr-10">Sort By: </p>
					<select name="sort-by" id="sort-by" class="">
						<option value="0">Popularity (Default)</option>
					</select>
				</div>
				
				<!--=======  End of Sort by dropdown  =======-->

				<p class="result-show-message">Showing <?php if($keywords) {
				    
					 echo sizeof($result).' of ';}   ?>  <?php $pro->show_total_no_products();  ?>  Results</p>
			</div>
		</div>
	</div>
	
	<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->
					
						<div class="shop-product-wrap grid row no-gutters mb-35">
						
						    <!--=======  Grid view product  =======-->
						    <?php
						    /*
							// result is used to get all the products either by category or by search
								if($keywords){
									$result = $pro->fetch_product_by_keyword_search($keywords);
									
								    $total_products2=count($result);
								    if($total_products2==0)
								    {
								        
								    $result = $pro->fetch_product_by_keyword($keyword_meta_input);    
								    }
								
								    
								}								
								else if($pid)
									$result = $pro->fetch_product_by_category($pid);
								else if($brand)
									$result = $pro->fetch_all_products_sorted_by_popular_brands($brand);
								else
								{
								    if($pageno==5)
								    {
								        $result = $pro->fetch_all_products_for_home($this_page_first_result,1000);
								    }
								    else
								    $result = $pro->fetch_all_products_for_home($this_page_first_result,$results_per_page);
								}*/
								
								$product = showProductByPage($page,$result);
								
								//if product not found section	
								$total_products=count($result);
								    if(isset($_POST['keywords'])){
								    if($total_products==0)
								    {   $_SESSION["prodsearch"] =  $keywords;
								         echo '<h4>Are You Looking For <font color="green">'.$keywords.'?</font></h4><br>';
								        echo'	<form action="home.php" method="post" enctype="multipart/form-data">
								        <textarea rows="5" cols="90" name="prodinfo" id="prodinfo"
                                                        placeholder="Product you are looking for is not available,Provide additional information about the product so we can avail it for you in future." maxlength="100" ></textarea>
								    	        
								    	        <div class="col-12">
														<button type="submit" name="submit" class="save-change-btn">submit</button>
													</div></form>';
								        
								    
								    $pro->req_new_product($_SESSION["prodsearch"],$_POST['prodinfo'],"NULL");    
								    }
								    else
								    {
								        $_SESSION["prodsearch"] =  $keywords;
								        $pro->req_new_product("NULL",$_POST['prodinfo'],$_SESSION["prodsearch"]);
								    }
								    if(isset($_POST['submit']))
								    {
								        
								        $pro->req_new_product($_SESSION["prodsearch"],$_POST['prodinfo']);
								        
								    } }
								//if products found
								 foreach ($product as $row) {
						  echo' <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6"> 
						  <div class="gf-product shop-grid-view-product">
									<div class="image">
									<a href="single-product.php?id='.$row['pid'].'">';
									
									
									if($row['price']>$row['disc_price'])
									{
									    $disc_percentage =round((($row['price']-$row['disc_price'])*100)/$row['price'],1);
									echo '<span class="onsale">'.$disc_percentage.'% Off</span>';     
									}
									
									
									
	
									if(!$row['quantity'])
									echo'<span class="onsale">Out of stock</span>';
									echo '<img src="'.$row['img_path'].'" class="img-fluid" alt="">
										
										</a>
										<div class="product-hover-icons">';
										if($row['quantity']){
										    echo'<a href="cart.php?product='.$row['pid'].'" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>';
										}
										else
										    echo '<span class="onsale">Out of stock</span>';
											echo'
													<a href="wishlist.php?product='.$row['pid'].'" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
													<a href="compare.php?product='.$row['pid'].'" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
											<a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
										</div>
									</div>
									<div class="product-content">
										<div class="product-categories">';
										
										showCategoryParent($row['cat_id']);
											
										echo'</div>
										<h3 class="product-title"><a href="single-product.php?id='.$row['pid'].'">'.$row['product_name'].'</a></h3>
										<div class="price-box">';
										if($row['price']==$row['disc_price'])
										{
										    echo'<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>';
										}
										else
										{
										    echo'<span class="main-price">Rs.'.$row['price'].'</span>
									    	<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>';
										}
										$total_reviews = 0;
                                                $total_rating = 0;
                                                $rvw =$user1->fetch_reviews($row['pid']);
            									if($rvw){
            									    
                                                    foreach ($rvw as $row1) {
                                                        $total_reviews = $total_reviews +1;
                                                        $total_rating = $total_rating + $row1['stars'];
                                                    }
                                                    
                                                    $avg_rating = $total_rating/$total_reviews;
                                                    $temp_avg = $avg_rating;
                                                    
                                                    echo'<p class="product-rating">';
                                                    
                                                    for($j =0 ;$j<5;$j++){
                                                        if($avg_rating > $j){
                                                             echo '<i class="fa fa-star" Style="color:#ffcc00"></i>';
                                                        }else{
                                                             echo '<i class="fa fa-star " ></i>';
                                                        }
                                                    }
                									echo'('.$total_reviews.')
                									</p>';
            									} else echo "Be First To Review";
								echo'	</div>
								</div>
									
									
									
								</div> 
								     <div class="gf-product shop-list-view-product">
											<div class="image">
												<a href="single-product.php?id='.$row['pid'].'">
													<img src="'.$row['img_path'].'" class="img-fluid" alt="">
												</a>';
													if($row['price']>$row['disc_price']){
                									    $disc_percentage =round((($row['price']-$row['disc_price'])*100)/$row['price'],1);
                									    echo '<span class="onsale">'.$disc_percentage.'% Off</span>';     
                									}
												
											echo'</div>
											<div class="product-content">
												<div class="product-categories">';
												showCategoryParent($row['cat_id']);
												echo '</div>
												<h3 class="product-title"><a href="single-product.php?id='.$row['pid'].'">'.$row['product_name'].'</a></h3>
												<div class="price-box mb-20">';
												
												if($row['price']==$row['disc_price'])
										{
										    echo'<span class="main-price">Rs.'.$row['disc_price'].'</span>';
										}
										else
										{
										    echo'<span class="main-price">Rs.'.$row['price'].'</span>
									    	<span class="discounted-price">Rs.'.$row['disc_price'].'</span><br>';
										}
												echo'</div>';
												
                                    $total_reviews = 0;
                                    $total_rating = 0;
                                    $result3 =$user1->fetch_reviews($row['pid']);
                                    if($result3){
                                        
                                    
                                    foreach ($result3 as $row1) {
                                    $total_reviews = $total_reviews +1;
                                    $total_rating = $total_rating + $row1['stars'];    
                                    }
                                    $avg_rating = $total_rating/$total_reviews;
                                    $temp_avg = $avg_rating; 
                                    echo'<p class="product-rating">';
                                    while($temp_avg>0)
                                    {
                                        echo '<i class="fa fa-star" Style="color:#ffcc00"></i>';
                                        $temp_avg = $temp_avg - 1;
                                    }
                                    $unactive_stars2=5-round($avg_rating);
                                    while($unactive_stars2>0)
                                    {
                                        echo '<i class="fa fa-star " ></i>';
                                       $unactive_stars2= $unactive_stars2 - 1;
                                    }
									echo'('.$total_reviews.')
                            </p>';	}		
												
												
												
                                
                                
												echo'<p class="product-description">'.$row['mini_desc'].'</p>
												<div class="list-product-icons">';
												if($row['quantity'])
												echo '
													<a href="cart.php?product='.$row['pid'].'" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>';
													echo '
													<a href="wishlist.php?product='.$row['pid'].'" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
													<a href="compare.php?product='.$row['pid'].'" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
												</div>
											</div>
										 </div></div>';
										 
										 
										 
								    }

							?>

							<!--=======  End of Shop list view product  =======-->
							
						
					</div>
					
					<!--=======  End of Grid list view  =======-->

					<!--=======  Pagination container  =======-->
					
					<div class="pagination-container">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<!--=======  pagination-content  =======-->
									
									
										
											
											<?php 
											
											$product_per_page = 28;
                                            $total_page = ceil(sizeof($result)/$product_per_page);
                                            echo'<div class="pagination-content text-center"> 
                                                    <ul>';
                                                    
                                                    
											for($i= 1; $i<=$total_page; $i++ ){
											    $_SESSION['result'] =$result;
											    if($page==$i)
    											echo'<li><a class="active" href="home?pageno='.$i.'">'.$i.'</a></li>';
    											else
    											echo'<li><a  href="home?pageno='.$i.'">'.$i.'</a></li>';
    											echo' ';
											}
            											echo'</ul>
            									</div>';
											?>
											
											
											
											
										
									
									<!--=======  End of pagination-content  =======-->
								</div>
							</div>
						</div>
					</div>
					
					<!--=======  End of Pagination container  =======-->

				</div>
			</div>
		</div>
	</div>
	
	<!--=====  End of Shop page container  ======-->
<!--=============================================
	=            Brand logo slider         =
	=============================================-->

	<!--=============================================
	=            Footer         =
	=============================================-->
	<?php
	$IPATH = $_SERVER["DOCUMENT_ROOT"]."/";
	include($IPATH."footer.php");
	?>

	
	<!--=====  End of Footer  ======-->

	<!--=============================================
	=            Quick view modal         =
	=============================================-->

	<?php
						/*		if($cid){
									$result= $pro->fetch_product_by_category($cid);
								}
								else if($keywords)
									$result = $pro->fetch_product_by_keyword($keyword_meta_input);
								else if($sid)
									$result = $pro->fetch_product_by_sub_category($sid);
								else
									$result = $pro->fetch_all_products();
								
								
								  
								  foreach ($result as $row) {
								  	//print_r($row);
								  	$sub = new sub_category();
								  	$result_2= $sub->fetch_by_sub_id($row[3]);
								    
								    foreach ($result_2 as $row2) {
								    	# code...
								    }
								    	
	

	
	echo '	<div class="modal fade quick-view-modal-container" id="quick-view-modal-container" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-xs-12">
							<!-- product quickview image gallery -->
							<div class="product-image-slider">
								<!--Modal Tab Content Start-->
								<div class="tab-content product-large-image-list" id="myTabContent">
									<div class="tab-pane fade show active" id="single-slide1" role="tabpanel" aria-labelledby="single-slide-tab-1">
										<!--Single Product Image Start-->
										<div class="single-product-img img-full">
								
											<img src="'.$row[6].'" class="img-fluid" alt="">
										</div>
										<!--Single Product Image End-->
									</div>
									<div class="tab-pane fade" id="single-slide2" role="tabpanel" aria-labelledby="single-slide-tab-2">
										<!--Single Product Image Start-->
										<div class="single-product-img img-full">
											<img src="assets/images/products/product02.jpg" class="img-fluid" alt="">
										</div>
										<!--Single Product Image End-->
									</div>
									<div class="tab-pane fade" id="single-slide3" role="tabpanel" aria-labelledby="single-slide-tab-3">
										<!--Single Product Image Start-->
										<div class="single-product-img img-full">
											<img src="assets/images/products/product03.jpg" class="img-fluid" alt="">
										</div>
										<!--Single Product Image End-->
									</div>
									<div class="tab-pane fade" id="single-slide4" role="tabpanel" aria-labelledby="single-slide-tab-4">
										<!--Single Product Image Start-->
										<div class="single-product-img img-full">
											<img src="assets/images/products/product04.jpg" class="img-fluid" alt="">
										</div>
										<!--Single Product Image End-->
									</div>
								</div>
								<!--Modal Content End-->
								<!--Modal Tab Menu Start-->
								<div class="product-small-image-list"> 
									<div class="nav small-image-slider" role="tablist">
										<div class="single-small-image img-full">
											<a data-toggle="tab" id="single-slide-tab-1" href="#single-slide1"><img src="assets/images/products/product01.jpg"
												class="img-fluid" alt=""></a>
										</div>
										<div class="single-small-image img-full">
											<a data-toggle="tab" id="single-slide-tab-2" href="#single-slide2"><img src="assets/images/products/product02.jpg"
												class="img-fluid" alt=""></a>
										</div>
										<div class="single-small-image img-full">
											<a data-toggle="tab" id="single-slide-tab-3" href="#single-slide3"><img src="assets/images/products/product03.jpg"
												class="img-fluid" alt=""></a>
										</div>
										<div class="single-small-image img-full">
											<a data-toggle="tab" id="single-slide-tab-4" href="#single-slide4"><img src="assets/images/products/product04.jpg"
												alt=""></a>
										</div>
									</div>
								</div>
								<!--Modal Tab Menu End-->
							</div>
							<!-- end of product quickview image gallery -->
						</div>
						<div class="col-lg-7 col-md-6 col-xs-12">
							<!-- product quick view description -->
							<div class="product-feature-details">
								
                                <h3 class="product-title"><a href="single-product.php?id='; echo $row[0]; echo'">'.$row[1].'</a></h3>
								<h2 class="product-price mb-15"> 
									
								<span class="main-price"> Rs.'.$row[4].'</span>
										<span class="discounted-price">Rs.'.$row[10].'</span>
								 </h2>
                                <p class="product-description">'.$row[14].'</p>
							<div class="cart-buttons mb-20">
									<div class="pro-qty mr-10">
										<input type="text" value="1">
									</div>
									<div class="add-to-cart-btn">
									
									    <a href="cart.php?product=';echo $row[0];  echo'" data-tooltip="Add to cart">Add to cart <span class="icon_cart_alt"></span></a>
									</div>
								</div>

						
								<div class="social-share-buttons">
									<h3>share this product</h3>
									<ul>
										<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
									</ul>
								</div>
							</div>
							<!-- end of product quick view description -->
						</div>
					</div>
				</div>
			</div>
	</div>
	</div>
	'; } */
	?>
	
	<!--=====  End of Quick view modal  ======-->

	<!-- scroll to top  -->
	<a href="#" class="scroll-top"></a>
	<!-- end of scroll to top -->
	
	<!-- JS
	============================================ -->

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
getcookie = '<?php echo $_COOKIE['saveScroll']; ;?>';
</script async>
<?php 
if(isset($_GET['pageno'])){
echo'<script async>$(window).scrollTop(500);</script>';
}
else
{
echo'<script async>
$(window).scrollTop(getcookie);
document.cookie = "saveScroll=; max-age=0";
</script> ';
}


?>
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
 

</body>

</html>
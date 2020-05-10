<?php
include_once('dbClass.php');
include_once('categoryClass.php');

 
// show all parent categories
function showCategoryParenthidden($id = NULL){
    
	if(is_null($id)){
		return;
	}else{
		$cat = new category();
		$result =$cat->fetch_by_id($id);
		return $result['name'].' '.showCategoryParenthidden($result['parent']);
	}
}
    
/**
 * 
 */
class product
{
    
	function __construct()
	{
		 $this->conn= db::connect();
	}


// return number of results fetched
// used within the class;
	function if_product_exist($name,$s_id){
	    // select the product from the product table database
	    $stmt = $this->conn->prepare("SELECT * from product where product_name = ? and s_id = ?");
		$stmt->bind_param('si',$name,$s_id);
		$stmt->execute();
		
		$result = $stmt->get_result();
		// return the number of rows feteched
		return $num = mysqli_num_rows($result);
	}
	
	
//insert product into database
// used in seller_account.php
	function insert_product($product_name,$s_id,$sub_id,$price,$discription,$img_path,$qty,$disc_price,$disc_start_date,$disc_end_date,$brand,$mini_desc,$prod_weight){
	    // if product already exist then return 0 else insert product;
		if($this->if_product_exist($product_name,$s_id)){
				return 0;
			}else{
			    // create a metaphone for searching the product;
				$indexing =metaphone($product_name.' '.showCategoryParenthidden($sub_id));
				$activated =1;
				// insert product into datbase table;
                $stmt = $this->conn->prepare("INSERT into product(product_name,s_id,cat_id,price,discription,img_path,quantity,activated,indexing,disc_price,disc_start_date,disc_end_date,brand,mini_desc,prod_weight) 
							VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            	$stmt->bind_param('siiissiisissssi',$product_name,$s_id,$sub_id,$price,$discription,$img_path,$qty,$activated,$indexing,$disc_price,$disc_start_date,$disc_end_date,$brand,$mini_desc,$prod_weight);
            	
            	//if query execute succesfully then retrun 1 else return 0;
				if($stmt->execute())
					return 1;
					else return 0;
			}
	}
	

// update product with id ($p_id);
// used in seller_account.php
	function update_product($p_id,$product_name,$cat_id,$price,$discription,$qty,$disc_price,$disc_start_date,$disc_end_date,$brand,$mini_desc,$prod_weight){
	    //create mataphone for search product;
	    $indexing =metaphone($product_name.' '.showCategoryParenthidden($sub_id));
	    
	    // preparesing update query;
	    $stmt = $this->conn->prepare("UPDATE product 
                                    SET product_name = ?,
                                        cat_id = ?,
                                        price = ?,
                                        discription = ?,
                                        quantity = ?,
                                        disc_price = ?,
                                        disc_start_date =?,
                                        disc_end_date = ?,
                                        brand = ?,
                                        mini_desc= ?,
                                        prod_weight =?,
                                        indexing =?
                                    WHERE pid = ?");
		$stmt->bind_param('siisiissssisi', $product_name,$cat_id,$price,$discription,$qty,$disc_price,$disc_start_date,$disc_end_date,$brand,$mini_desc,$prod_weight,$indexing,$p_id);
		//if successfully updated return 1 else return 0;
	    if($stmt->execute())
			return 1;
		else
	    	return 0;
	
	}


// fetch the product with pid
//used in single_product.php page and update_product page;
	function fetch_product($pid){
	    // prepare query to get product from datbase;
	    $stmt = $this->conn->prepare("SELECT * from product where pid = ?");
		$stmt->bind_param('i',$pid);
		$stmt->execute();
		
		$array= array();
		// if product give result success fully fetch result else return 0;
		if ($result = $stmt->get_result()){
		    if($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		        return $array;
		    }else return 0;
		}else return 0;

	}
	
	
//fetch all products
// used in home page;
	function fetch_all_products(){
	    // prepare select product statement;
	    $stmt = $this->conn->prepare("SELECT * FROM product ORDER BY soldquantity DESC");
		$stmt->execute();
		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    
		    $array= array();
		    
		    // fetch the result into the row and save them into the array untill all the results are fetched;
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
		
	}
	
	
// fetch all the products sorted by brands;
// used in home page;
	function fetch_all_products_sorted_by_popular_brands($brand)
	{
	   // prepare select product statement;
	    $stmt = $this->conn->prepare("SELECT * FROM product where brand = ?");
	    $stmt->bind_param('s',$brand);
		$stmt->execute();
		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    
		  // fetch the result into the row and save them into the array untill all the results are fetched;
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
		
	}
	
	
	
	
	
// fetch product from product table using category
// used in home page;
	function fetch_product_by_category($id){
	    
		// fetch all the child categories with category_id
		$cat = new category();
		$result = $cat->fetch_all_childs_nodes_with_no_child($id);
		foreach ($result as $row) {
			$categories[] = $row[0];
		}
		$stmt = $this->conn->prepare("SELECT * from product where cat_id = ?  ORDER BY soldquantity DESC");
	    $stmt->bind_param('i',$cate);
		// prepare select product statement by category;
		foreach($categories as $cate){
		    $stmt->execute();
		    // if there is any product then fetch l
		    if ($result = $stmt->get_result()){
    		    
    		    // fetch the result into the row and save them into the array untill all the results are fetched;
    		    while ($row = mysqli_fetch_array($result)){
    		        $array[]=$row;
    		    }
    		}
		}
	    // return the result;
		return $array;
	}


//fetch product by keyword;
// used in header page in seach function;
	function fetch_product_by_keyword($keyword_meta_input){

        // prepare select product statement by category;
        $keyword_meta_input ='%'.$keyword_meta_input.'%';
	    $stmt = $this->conn->prepare("SELECT * FROM product where indexing like ? ORDER BY soldquantity DESC");
	    $stmt->bind_param('s',$keyword_meta_input);
		$stmt->execute();
		
		$array= array();
		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    // fetch the result into the row and save them into the array untill all the results are fetched;
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
	
	function fetch_product_by_keyword_search($keyword){

        // prepare select product statement by category;
        $keyword_search ='%'.$keyword.'%';
	    $stmt = $this->conn->prepare("SELECT * FROM product where product_name like ? ORDER BY soldquantity DESC");
	    $stmt->bind_param('s',$keyword_search);
		$stmt->execute();
		
		$array= array();
		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    // fetch the result into the row and save them into the array untill all the results are fetched;
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
// return the total number of products in database
// used in home page to show total products;
	function show_total_no_products(){
	    
	    // prepare select product statement;
	    $stmt = $this->conn->prepare("SELECT * FROM product");
		$stmt->execute();
		
		// if get any result then return number of rows fetched else return 0;
		if ($result = $stmt->get_result()){
		    echo mysqli_num_rows($result);
		    return;
		}else return 0;
	}
	

	
	function fetch_product_by_keyword_for_showing_results($keyword_meta_input){
	
		// prepare select product statement by category;
        $keyword_meta_input ='%'.$keyword_meta_input.'%';
	    $stmt = $this->conn->prepare("SELECT * FROM product where indexing like ? ORDER BY soldquantity DESC");
	    $stmt->bind_param('s',$keyword_meta_input);
		$stmt->execute();

		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    // fetch the result into the row and save them into the array untill all the results are fetched;
		    echo $result->num_rows;
		    return;
		}else return 0;
	}


// fetech all the product of seller with $sid;
// used in seller page;
	function fetch_product_by_sid($sid){
	    // prepare statement to select product from the database which are enable;
	    $stmt = $this->conn->prepare("SELECT * FROM product where s_id = ? and quantity !=0");
	    $stmt->bind_param('i',$sid);
		$stmt->execute();
		
		
		$array= array();
		// if get any result then fetch all else return 0;
		if ($result = $stmt->get_result()){
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
	
	
// fetech all the product of seller with $sid;
// used in seller page;
	function fetch_disabled_product_by_sid($sid){

	// prepare statement to select product from the database which are disable;
	    $stmt = $this->conn->prepare("SELECT * FROM product where s_id = ? and quantity =0");
	    $stmt->bind_param('i',$sid);
		$stmt->execute();
		
		
		$array= array();
		// if get any result then fetch all else return 0;
		if ($result = $stmt->get_result()){
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
	
	
// update the product quntity ;	
// used in order details;
	function update_Product_qty($p_id,$quantity){
	    $stmt = $this->conn->prepare("UPDATE product SET quantity=quantity- ?,soldquantity = soldquantity+? WHERE pid = ?");
	    $stmt->bind_param('iii',$quantity,$quantity,$p_id);
	    
		if($stmt->execute())
			return 1;
		else return 0;
	}
	
	
//set the quantity of the product;	
// used in seller page to delete product;
	function update_Product_set_qty($p_id,$quantity){
	    // prepare query to upate product 
	    $stmt = $this->conn->prepare("UPDATE product SET quantity=? WHERE pid = ?");
	    $stmt->bind_param('ii',$quantity,$p_id);
	    //if execute successfully retutn 1 else return 0;
		if($stmt->execute())
			return 1;
		else return 0;
	}
	
	
	
//fetch product form home;
    function fetch_all_products_for_home($this_page_first_result,$results_per_page){
        
        // prepare statement to select product from the database which are disable;
	    $stmt = $this->conn->prepare("SELECT * FROM product  ORDER BY soldquantity DESC LIMIT ?,?");
	    $stmt->bind_param('ii',$this_page_first_result,$results_per_page);
		$stmt->execute();
		
		
		$array= array();
		// if get any result then fetch all else return 0;
		if ($result = $stmt->get_result()){
		    while ($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
	
	
	
	function req_new_product($prod,$prodinfo,$prodSearch){
	    
	    $stmt = $this->conn->prepare("INSERT INTO requestedproducts(product,prodinfo,ProductSearch) VALUES(?,?,?) ");
	    $stmt->bind_param('sss',$prod,$prodinfo,$prodSearch);
		
		// if get any result then return number of rows fetched else return 0;
		if ($stmt->execute()){
		    return 1;
		}else return 0;
    }
    
}

/*	function insert_product_size($op1=NULL,$op2=NULL,$op3=NULL,$op4=NULL,$op5=NULL,$op6=NULL)
	{
	    $reg = "INSERT into productSize(p_opt1,p_opt2,p_opt3,p_opt4,p_opt5,p_opt6) VALUES ('$op1','$op2','$op3','$op4','$op5','$op6')";
	    $result = mysqli_query($this->conn,$reg);
	} */

?>
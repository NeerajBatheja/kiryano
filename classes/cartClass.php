<?php
include_once('dbClass.php');
include_once('productClass.php');

/**
 * 
 */
class cart
{
	// database connection in constructor
	function __construct()
	{
		 $this->conn= db::connect();
	}
	
	
	// this function will return the order_id if the product already exist in cart
	// used within class;
	function if_already_exist($pid,$ono){
		//prepare query to select product from database with pid and orderno;
        $stmt = $this->conn->prepare("SELECT * from cart where p_id = ? and order_no = ?");
		$stmt->bind_param('ii',$pid, $ono);
		$stmt->execute();
		
		$result = $stmt->get_result();
		// returns the orderId if there exist the product;
		$row=mysqli_fetch_array($result);
		return $row['order_id'];

	}
	
	
	// add product($pid) to the cart in order_no($ono)
	// used in cart page;
	function add_to_cart($pid ,$ono,$qty){
	    // if product already exist it print and returns else insert product in to database;
		if($oid = $this->if_already_exist($pid,$ono)){
		   //echo '<h4><font color="green">Product you are trying to add is already in the cart</font></h4>';
			unset($_SESSION["product"]);
			return;// $this->increase_product($oid);
		}else{
			$date = date("d/m/y");
			//prepare insert query to insert product into cart;
			$stmt = $this->conn->prepare("INSERT into cart(p_id,order_no,quantity,add_date) 
							VALUES (?,?,?,?)");
    		$stmt->bind_param('iiis',$pid, $ono ,$qty ,$date);
    		
			// if inserted successfull return 1 else return 0;	
			if($stmt->execute()){
			    //echo '<h4><font color="green">Your product has been added</font></h4>';
			    return 1;
			}else return 0;
		}
	}
	
	
	// get all the product that which are in order_no ($o_no);
	// used in cart;
	function get_products($o_no){
	    //prepare query to select product from database with pid and orderno;
        $stmt = $this->conn->prepare("SELECT 
                            			product.pid,
                            			product.img_path,
                            			product.product_name,
                            			product.disc_price,
                            			product.quantity,
                            			cart.quantity,
                            			cart.order_id,
                            			cart.order_no,
                            			cart.status
                            		 from cart 
                            		 inner join product 
                            		 on cart.p_id =product.pid and order_no = ? order by cart.status ,cart.order_no");
		$stmt->bind_param('i', $o_no);
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
	
	
	// get all items of order from orderno;
	// used in myaccount page;
	function get_order_in_given_order_no($o_no){
	    
	    //prepare query to select item from database with order_no and orderno;
        $stmt = $this->conn->prepare("SELECT * from cart WHERE order_no = ? order by status");
		$stmt->bind_param('i', $o_no);
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
	
	
	// increment product already present in the cart
	//used in cart page;
	function increase_product($oid){
	    $stmt = $this->conn->prepare("UPDATE cart 
	                                    SET quantity = quantity+1
	                                    WHERE (order_id = ? 
	                                       AND quantity < 5 
	                                       AND quantity <(SELECT quantity 
	                                                        FROM product 
	                                                        WHERE product.pid = (SELECT cart.p_id
	                                                                                FROM (SELECT * FROM cart) AS cart1
	                                                                                WHERE order_id = ?)))");
		$stmt->bind_param('ii',$oid, $oid);
		// if incremented return 1 else return 0;
		if($stmt->execute()){
		    if($stmt->affected_rows)
			return 1;
			else return 0;
		}else return 0;
	}
	

    // delete product from cart with order_id;
	function delete_product($oid){
	    //prepare query for delete from cart;
	    $stmt = $this->conn->prepare("DELETE from cart where order_id = ?");
		$stmt->bind_param('i',$oid);
		
		// if execute succesfully return 1 else return 0
		if($stmt->execute())
			return 1;
		else return 0;
	}
	
	
	// decrease the product quantity from the cart;
	// used in cart page
	function decrease_product($oid){
	    // prepare update query to decrease the quantity of given product;
	    $stmt = $this->conn->prepare("UPDATE cart SET quantity = quantity-1 WHERE (order_id = ?)");
		$stmt->bind_param('i', $oid);
		//if successfully updated then delete prodcut if quantity becomes 0 else return 0;
	    if($stmt->execute()){
	        if($stmt->affected_rows){
	            // prepare query to select item from cart;
    	        $stmt2 = $this->conn->prepare("SELECT * FROM cart where order_id = ?");
    		    $stmt2->bind_param('i', $oid);
    		    $stmt2->execute();
    		
        		// if get any result then fetch it else return 1;
        		if ($result = $stmt2->get_result()){
        		    // if fetched then check if queuty is 0;
        		    if($row = mysqli_fetch_array($result)){
    					if($row['quantity'] ==0){
    						self::delete_product($oid);
    					}
    			    }
        		}
        		return 1;
	        } else return 0;
	    } else return 0;
	}
	
	
	// update cart status;
	// used in userclass ;
	function update_cart_status($o_no, $pid ,$status){
	    $prd = new product();
	    $result =$prd->fetch_product($pid);
	    foreach($result as $row );

	    // preparesing update query;
	    $stmt = $this->conn->prepare("UPDATE cart SET status = ? , p_name = ?, p_price = ? WHERE order_no = ? and p_id = ?");
	    $p_name = $row['product_name'];
	    $p_price = $row['disc_price'];
		$stmt->bind_param('isiii',$status,$p_name,$p_price,$o_no,$pid);
		
		$stmt->execute();
		//if successfully updated return 1 else return 0;
	    if($stmt->affected_rows)
			return 1;
		else{
			return 0;   
		}
	    
	}


//check if item is competed or shipped;
// used in order_detailclass
	function check_if_completed($oid){
	    
	    // prepare query to get product from datbase;
	    $stmt = $this->conn->prepare("SELECT status from cart where order_id =?");
		$stmt->bind_param('i',$oid);
		$stmt->execute();
		
		// if product give result success fully fetch result else return 0;
		if ($result = $stmt->get_result()){
		    // if result fetched then return status else return 0;
		    if($row=mysqli_fetch_array($result)){
		        return $row[0];
		    }else return 0;
		}else return 0;
	}
	
	
// update the cart with order_no;
// used inside the class; 
	function update_cart($o_no){
		// prepare query to get product from datbase;
	    $stmt = $this->conn->prepare("SELECT * FROM cart WHERE order_no = ?");
		$stmt->bind_param('i',$o_no);
		$stmt->execute();
		
		if ($result = $stmt->get_result()){
			$pro= new product();
		  while ($row=mysqli_fetch_array($result)){
		  	$pro->update_Product_qty($row['p_id'],$row['quantity']);
		    $this->update_cart_status($o_no,$row['p_id'],1);
		    }
		}else return 0;
	}
	
	
	function check_out($o_no){
		$this->update_cart($o_no);
		return 1;
	}
	
	
// check if product with ($pid) is bought by customer with ($cid)
//used in single prodcut page for review review;
	function check_if_bought($pid ,$cid){
	    
	    // prepare query to get product from datbase;
	    $stmt = $this->conn->prepare("SELECT * FROM cart where cart.p_id = ? AND cart.order_no IN (SELECT order_detail.order_no FROM order_detail WHERE c_id = ? and order_detail.status=2)");
		$stmt->bind_param('ii',$pid ,$cid);
		$stmt->execute();
		
		if($result = $stmt->get_result()){
		    	return mysqli_num_rows($result);
		}else return 0;
	}




	/////////sellers fuctions//////////


//get pending order of the seller;
// used in seller_account page;
    public function get_pending_order($o_no,$sid){
	    //prepare query to select product from database with sid and orderno;
        $stmt = $this->conn->prepare("SELECT 
                            			cart.order_id,
                            			cart.p_name,
                            			cart.p_price,
                            			cart.quantity,
                            			cart.status
                            		 FROM cart,product
                            		 where product.s_id = ? and
                            		    order_no = ? and
                            		 	 product.pid = cart.p_id and
                            		 	 cart.status =1
                            		 order BY cart.order_no desc");
		$stmt->bind_param('ii', $sid,$o_no);
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
	
	function check_if_all_products_are_in_stock($o_no){
	   return 1;
	}
	
//get shiped order of the seller;
// used in seller_account page; 
	public function get_shipped_order($o_no,$sid){
	    //prepare query to select product from database with sid and orderno;
        $stmt = $this->conn->prepare("SELECT 
                            			cart.order_id,
                            			cart.p_name,
                            			cart.p_price,
                            			cart.quantity,
                            			cart.status
                            		 FROM cart,product
                            		 where product.s_id = ? and
                            		    order_no = ? and
                            		 	 product.pid = cart.p_id and
                            		 	 cart.status =2
                            		 order BY cart.order_no desc");
		$stmt->bind_param('ii', $sid,$o_no);
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
    
    //update the status of particular status;
    //currently not used any where;
	public function update_order_status_id($oid,$status){
	    // preparesing update query;
	    $stmt = $this->conn->prepare("UPDATE cart SET status = ? WHERE order_id= ?");
		$stmt->bind_param('ii',$status,$oid);
		//if successfully updated return 1 else return 0;
	    if($stmt->execute())
			return 1;
		else
	    	return 0;
	}
}


/*

    // error in this code quantity is not passed;
    // update the quantity of the product in the cart
	// not used;
	function prod_qty_update($oid){
	    // preparesing update query;
	    $stmt = $this->conn->prepare("UPDATE  cart SET qty=$qty WHERE order_id = ?");
		$stmt->bind_param('i',$oid);
		//if successfully updated return 1 else return 0;
	    if($stmt->execute())
			return 1;
		else
	    	return 0;
	}
	
	
	
	
	
	public function get_pending_order($sid){
		$sql = 'SELECT 
			cart.order_id,
			product.product_name,
			product.price,
			cart.quantity,
			cart.status
		 FROM cart,product
		 where product.s_id = '.$sid.' and
		 	 product.pid = cart.p_id and
		 	 cart.status =1
		 order BY cart.order_no desc;';

		$array= array();
		if ($result=mysqli_query($this->conn,$sql)){
		  while ($row=mysqli_fetch_array($result)){
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	}
*/




	/*
	public function update_item($pid,$oid,$qty){
		$sql = "UPDATE cart SET quantity=$qty WHERE p_id=$pid and order_no = $oid";
		if (mysqli_query($this->conn, $sql)) {
		    return 1;
		} else {
		    return 0;
		}

	}
	function get_qty($pid,$oid){
		$sql= "SELECT quantity from cart where p_id = $pid and order_no = $oid";
		echo $sql;
		$result = mysqli_query($this->conn,$sql);

		if($row=mysqli_fetch_array($result)){
			return $row[0];
		}
	}
	
	*/
?>
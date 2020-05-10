<?php
include_once('dbClass.php');
include_once('productClass.php');

/**
 * 
 */
class wishlist
{
	
	function __construct()
	{
		 $this->conn= db::connect();
	}
// this function will return the 1 if the product already exist in wishlist
// used in wishlist.php class
	function if_already_exist($cid,$pid){
	    $stmt = $this->conn->prepare("SELECT * from wishlist where p_id = ? and c_id = ?");
		$stmt->bind_param('ii',$pid,$cid);
		$stmt->execute();
		
		$result = $stmt->get_result();
		// return the number of items in wishlist
		return $num = mysqli_num_rows($result);
	}
	
	
// remove product from wishlist with  id
// used in wishlish.php on delete button;
	function remove_from_wishlist($id){
	    //prepare query for delete from wishlist;
	    $stmt = $this->conn->prepare("DELETE from wishlist where id = ?");
		$stmt->bind_param('i',$id);
		
		// if execute succesfully return 1 else return 0
		if($stmt->execute())
			return 1;
		else
		return 0;
	}
	
	
// get all the product details of customer with id  $cid  that will be shown in wishlist
// used in wishlish to show all the wishlist product;
	function get_wishlist_products($cid){
	    
	    $stmt = $this->conn->prepare("SELECT 
                                		product.pid,
                                		product.img_path,
                                		product.product_name,
                                		product.price,
                                		product.quantity,
                                		wishlist.id
                                	 FROM wishlist 
                                	 INNER JOIN product 
                                	 ON wishlist.p_id = product.pid
                                	 AND wishlist.c_id = ?");
		$stmt->bind_param('i',$cid);
		$stmt->execute();
		$result = $stmt->get_result();
    // create an array to store data arrays
		$array =array();
	// save fetched rows to column untill all the rows are saved;
		while($row=mysqli_fetch_array($result)){
			$array[] = $row;
		}
		return $array;
	}
	
	
// will add product($pid) to wishlist of custmer($cid)
// used in wishlish.php page
	function add_to_wishlist($pid ,$cid){
	// if the product already exist then return 0 else insert and return 1;
		if(!$this->if_already_exist($cid,$pid)){
		    // prepare query for 
		    $stmt = $this->conn->prepare("INSERT into wishlist(c_id,p_id) VALUES (?,?)");
        	$stmt->bind_param('ii',$cid,$pid);
        	// the insert query runs return true else return 0
			if($stmt->execute())
				return 1;
			else return 0;
		}else return 0;
		
	}
	
/*
	function get_qty($pid,$oid){
		$sql= "SELECT quantity from cart where p_id = $pid and order_no = $oid";
		$result = mysqli_query($this->conn,$sql);

		if($row=mysqli_fetch_array($result)){
			return $row[0];
		}
	}
	
	
	
	public function update_item($pid,$oid,$qty){
		$sql = "UPDATE cart SET quantity=$qty WHERE p_id=$pid and order_no = $oid";
		if (mysqli_query($this->conn, $sql)) {
		    return 1;
		} else {
		    return 0;
		}

	}
*/
}


?>
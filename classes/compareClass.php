<?php
include_once('dbClass.php');
include_once('productClass.php');

/**
 * 
 */
class compare
{
	function __construct()
	{
		 $this->conn= db::connect();
	}
// if product already exist in comare rturn 1;
// used within class;
	public function if_already_exist($cid,$pid){
	    
	    //prepare query to select product from database with pid and orderno;
        $stmt = $this->conn->prepare("SELECT * from compare where p_id = ? and c_id = ?");
		$stmt->bind_param('ii',$pid, $cid);
		$stmt->execute();
		
		$result = $stmt->get_result();
		// returns the number of rows exist;
		return mysqli_num_rows($result);
	}


// if product limit exceeds 3 return 1;
//used within class;
	public function if_limit_exceed($cid){
	    $stmt = $this->conn->prepare("SELECT * from compare where c_id = ?");
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		
		if($result = $stmt->get_result()){
			$num = mysqli_num_rows($result);
			if($num ==3)
				return 1;
			else return 0;
		}else return 0;
			


	}

// insert into comare table in database
// used in compare page;
	public function insert_to_compare($cid,$pid){
		if($this->if_already_exist($cid,$pid)){
			return 0;
		}else{
			if($this->if_limit_exceed($cid)){
				echo "compare box is full remove any one item and try again";
				return 0;
			}else{
		    	$stmt = $this->conn->prepare("INSERT into compare (c_id,p_id) values (?,?)");
        		$stmt->bind_param('ii',$cid,$pid);
        		
    			// if inserted successfull return 1 else return 0;	
    			if($stmt->execute()){
    			    echo '<h4><font color="green">Your product has been added to wishlist</font></h4>';
    			    return 1;
    			}else return 0;
			}

		}

	}

// delete product from the compare;
// used in wishlish page;
	public function delete_product($cid,$pid){
	     //prepare query for delete from cart;
	    $stmt = $this->conn->prepare("DELETE from compare where c_id = ? and p_id = ?");
		$stmt->bind_param('ii',$cid,$pid);
		// if execute succesfully return 1 else return 0
		if($stmt->execute())
			return 1;
		else return 0;
	}


// get all products for compare with cid;
// used in wishlist page;
	public function get_products($cid){
	    //prepare query to select product from database with with cid;
        $stmt = $this->conn->prepare("SELECT * from product where pid IN (select p_id from compare where c_id = ? )");
		$stmt->bind_param('i', $cid);
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
}
?>
<?php
/**
 * user class
 */
include_once('dbClass.php');
include_once('order_detailsClass.php');
include_once('addressClass.php');
include_once('cartClass.php');
include_once('wishlistClass.php');
include_once('reviewClass.php');
include_once('provinceClass.php');
include_once('cityClass.php');
include_once('coupanClass.php');
class user
{
	function __construct()
	{	
		 $this->conn= db::connect();
	}
// fucntion to register new user into database.
// it is used in login-register page
	public function insert($first,$email,$pass,$phone){
		// check if email already exist query to fetch email from database;
		$stmt = $this->conn->prepare("SELECT * from customer where email = ?");
		$stmt->bind_param('s',$email);
		$stmt->execute();
		
		$select_result = $stmt->get_result();
		// if email exist return 1 else insert the email
		if(mysqli_num_rows($select_result) == 1){
			return 0;
		}else{
		    // hash the password; before inserting into databse;
		    $pass = password_hash($pass,PASSWORD_DEFAULT);
		    
		    // insert user into database;
		    $stmt2 = $this->conn->prepare("INSERT into customer (f_name,email,pass,phone) values (?,?,?,?)");
		    $stmt2->bind_param("ssss",$first,$email,$pass,$phone);
		    
		    // if user inserted then create the order of that user;
			if($stmt2->execute())
			{
			    //
				$stmt3 = $this->conn->prepare("SELECT c_id from customer WHERE email =?");
				$stmt3->bind_param("s",$email);
				$stmt3->execute();
				
				if($result = $stmt3->get_result()){
				    
					$row=mysqli_fetch_array($result);
					$odr =new order_details();
					$odr-> create_new_order($row[0]);
					return 1;
					
				}
				
				
			}
		}
		
		
	}
	
// function to submit data in to job class
// used in jobs page
	function jobs_update($email,$resume){
	    $stmt = $this->conn->prepare("INSERT INTO kiryanojobs(email,resume) VALUES(?,?)");
	    $stmt->bind_param("ss",$email,$resume);
	    if($stmt->execute())
	        return 1;
	}
	
// function to submit data in to scholarship class
// used in schholarships page
	function scholarships_update($email,$addnote){
	    $stmt = $this->conn->prepare("INSERT INTO kiryanoscholarships(email,add_note) VALUES(?,?)");
	    $stmt->bind_param("ss",$email,$addnote);
	    if($stmt->execute())
	        return 1;
	}
	
	
//update default address of the customer
// used in the account details in my-account page on update details;
	function update_default_address($cid,$aid){
	    $stmt = $this->conn->prepare("UPDATE customer SET D_address = ? WHERE c_id = ?;");
	    $stmt->bind_param("ii",$aid,$cid);
	    if($stmt->execute())
	        return 1;
	    else
		    return 0;
	}
	
	
//validate the user 
//used in every page where login is required
	public function validate($email,$pass){
	    
	// select the customer with email address 
	    $stmt = $this->conn->prepare("SELECT pass from customer where email = ?");
		$stmt->bind_param('s',$email);
		$stmt->execute();
		$result = $stmt->get_result();
       
    //if the result is fetched then will match the password else return 0;
    	if($row=mysqli_fetch_array($result)){
    	    
    	    //if password matches with the password entered then it will return 1 else 0;
    	    if(password_verify($pass,$row['pass']))
    	        return 1;
    	    else 
    	        return 0;
        }else
        	return 0;
	}


//update the data of user into the database;
// used in my-account.php page in 
	public function update($cid,$email,$first,$phone,$pass){
	    
	//hashing newly send password
	    $pass = password_hash($pass, PASSWORD_DEFAULT);
	    
	// update the data of customer
	    
	    $stmt = $this->conn->prepare("UPDATE customer SET f_name=?, email=?, phone=?, pass=? WHERE c_id=?");
	    $stmt->bind_param("ssssi",$first,$email,$phone,$pass,$cid);
	    
	 // check if query execute
	    if($stmt->execute())
	        return 1;
	    else
		    return 0;
	}


// fetch all the data of the user with given email
// used in header and orther palces;
	public function fetch_data($email){
	    
	    // select data using email from database;
	    $stmt = $this->conn->prepare("SELECT * from customer where email = ?");
		$stmt->bind_param('s',$email);
		$stmt->execute();
		
		// if get result correctly
		if ($result = $stmt->get_result()){
		    
		    // if data is fetched it is saved in to an arry
		    if($row=mysqli_fetch_array($result)){
		        $array[]=$row;
		    }
		}else{
		    return 0;
		}
		return $array;
	}
	
	
	
	
	
	
    // add product($pid) to cart of customer($cid) with quantity($qid)
	public function add_to_cart($pid,$cid,$qty=1){
		$odr = new order_details();
		$o_no = $odr->get_letest_orderNo($cid);
		$crt = new cart();
		if($crt->add_to_cart($pid,$o_no,$qty))
			return 1;
	}
	// select all product details of cart of customer($cid)
	public function get_cart($cid){
		$odr = new order_details();
		$o_no = $odr->get_letest_orderNo($cid);
		$crt = new cart();
		if($array =$crt->get_products($o_no))
			return $array;
	}
	public function get_orders($cid){
		$odr = new order_details();
		$orders = $odr->get_orderNo($cid);
		$crt = new cart();
		$array = array();
		foreach ($orders as $o_no) {
			$array[] =$crt->get_order_in_given_order_no($o_no[0]);
		}
		return $array;
	}

	//cart functions 
	public function delete_product($oid){
		$crt = new cart();
		if($crt->delete_product($oid))
			return 1;
	}

	public function increase_product($oid){
		$crt = new cart();
		if($crt->increase_product($oid))
			return 1;
	}

	public function decrease_product($oid){
		$crt = new cart();
		if($crt->decrease_product($oid))
			return 1;
	}
	// Coupan Validation
    public function coupan_validate($coupan_code){
		$cpn = new Coupan_Codes();
		if($cpn->fetch_validate_coupan($coupan_code))
		{
		   $coupan_code=$cpn->fetch_validate_coupan($coupan_code);
		   return $coupan_code;
		}
		else
		return 0;
	}
	//checking if coupan is already used or not
	public function validate_coupan_user_email($coupan_code,$user_cid)
	{
	    $cpn = new Coupan_Codes();
	    if($usageCount = $cpn->validate_coupan_usage($coupan_code,$user_cid))
	    {
            return $usageCount;
	    }
	    
	    
	}
	//insert coupan data
	public function insert_coupan_used($coupan_code,$cid)
	{
	    
	 $cpn = new Coupan_Codes();
	 $cpn->insert_coupan_data($coupan_code,$cid);

	}



	public function check_out($aid,$coupan_code){
	    // get address and make a single string;
		$add = new address();
		$user1 = $add->select_address_by_id($aid);
		
		$ctyObj = new city();
        $prvObj = new province();
        
		$cty = $ctyObj->get_city($user1['city_id']);
	    $prv = $prvObj->get_province($cty['prov_id']);
		
		$adrs  = $user1['address'].' , '.$cty['name'].' , '.$prv['name'];
		
		
		
	    
	    $odr = new order_details();
		$o_no = $odr->get_letest_orderNo($user1['c_id']);
        
        if($coupan_code){
            
	        $cpn = new Coupan_Codes();
	        $row = $cpn->fetch_validate_coupan($coupan_code);
	        $odr->update_order_details($row['coupanValue'],0,$o_no);
	        
	    }
        
        $crt = new cart();
        if($crt->check_if_all_products_are_in_stock($o_no)){
            $odr->update_status($o_no,$user1['name'],$adrs,$user1['phone'],1);
        	if($crt->check_out($o_no)){
        		$odr-> create_new_order($user1['c_id']);
        		return $o_no;
        	}else return 0;
        }
        else return 0;
		return 0;
		
	}
	 public function check_order_status($o_no){
		$odr = new order_details();
		//echo $o_no;
		return $odr->get_order_status($o_no);
	}

// review funtion embeded in user
	public function check_if_bought($pid,$cid){
		$rev = new cart();
		return $rev->check_if_bought($pid,$cid);

	}

	public function submit_review($pid,$cid,$rev,$stars){
		$rvu= new review();
		$rvu->submit_review($pid,$cid,$rev,$stars);

	}
	public function fetch_reviews($pid)
	{
		$rev = new review();
		return $rev->fetch_reviews($pid);

	}
	
	
	// wishlist funtions
	
	
	// add product($pid) to wishlist of customer($cid)c
	public function add_to_wishlist($pid,$cid){
		$wList = new wishlist();
		if($wList->add_to_wishlist($pid,$cid))
			return 1;

	}
	
	//get all the products of customer($cid)
	public function get_wishlist($cid){
		$wList = new wishlist();
		if($array =$wList->get_wishlist_products($cid))
			return $array;
	}
	
	// delete product of wishlist of id($id) from wishlist
	public function delete_wishlist_product($id){
		$wList = new wishlist();
		if($wList->remove_from_wishlist($id))
			return 1;
	}
	
	
	// header data 
	//show total items present in the shopping cart
	function show_total_items_and_total($cid){
        
        $sub_total=0;
        $count =0;
        if($result = $this->get_cart($cid)){
            foreach($result as $row){
                $count= $count+1;
                $sub_total=$sub_total+$row['quantity']*$row['disc_price'];
            }    
        }
        
	    if($subtotal= 0 or $sub_total > 500 or $sub_total ==0){
	       $shipping_fee = 0;
        }else
            //$shipping_fee = 30;
            $shipping_fee = 0;
        
        $array['items']= $count;
        $array['total']= $sub_total+$shipping_fee;
        return $array;
        
	}
}


	/*
	public function insert($first,$email,$pass){
			
			$sql = "SELECT * from customer where email ='$email'";
			$select_result = mysqli_query($this->conn,$sql);
			$num = mysqli_num_rows($select_result);

			if($num ==1){
				return 0;
			}else{
				$reg = "INSERT into customer (f_name,email,pass,D_address) values ('$first','$email','$pass',1)";
				if(mysqli_query($this->conn,$reg))
				{
					$sql2 = "SELECT c_id from customer WHERE email ='$email'";
					if($result =mysqli_query($this->conn,$sql2)){
						$addr = new Address();
						$row=mysqli_fetch_array($result);
						$addr->insert_address($row[0],$address,$town,$phone);
						$d_address = $addr->get_aid($row[0]);
						$sql2 = "UPDATE customer SET D_address=$d_address WHERE email ='$email'";
						if(mysqli_query($this->conn,$sql2)){
							$odr =new order_details();
							$odr-> create_new_order($row[0]);
							return 1;
						}
						

					}
					
					
				}
			}
	}
*/
?>
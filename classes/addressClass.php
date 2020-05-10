<?php
include_once('dbClass.php');

/**
 * 
 */
class Address
{
	function __construct()
	{
		 $this->conn= db::connect();
	}
	
// select address of customer ($cid)
// used in checkout, my-account, address pages
	function select_address($cid){
	    
	    // select address from database with cid
        $stmt = $this->conn->prepare("SELECT * from address where c_id = ?");
		$stmt->bind_param('i' , $cid);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		// save the $row array to an array untill all the addresses of customer are not fetched;
		while($row = mysqli_fetch_array($result)){
			$array[] = $row;
		}
		return $array;
	}
	
	
	
// insert address into database of customer($cid);
// used in address.php page;
	function insert_address($name,$cid,$address,$cityId,$phone){
	    
	// select the address from the database to check if address already exist;
	    $stmt = $this->conn->prepare("SELECT * from address where name = ? and address = ? and c_id = ? and city_id = ? and phone =?");
		$stmt->bind_param('ssiis' ,$name, $address, $cid, $cityId, $phone);
		$stmt->execute();
		$result = $stmt->get_result();
		
		
	// address already exit return 0; else insert the address;
		if(mysqli_num_rows($result) ==1){
			return 0;
		}else{
		    
		 // insert the address to the database 
		    $stmt2 = $this->conn->prepare("INSERT into address (name,c_id,address,city_id,phone) values (?,?,?,?,?)");
    		$stmt2->bind_param('sisis' ,$name, $cid, $address, $cityId, $phone);
    		
			if($stmt2->execute())
				return 1;
			else return 0;
		}
	}
	
	
//update the address aid 
// used in my-account.php page
	function update_address( $aid, $name, $address, $cityId, $phone){
	    // update the address into the database;
	    $stmt = $this->conn->prepare("UPDATE address SET name = ?, address = ?, city_id = ? , phone = ? WHERE a_id = ?");
		$stmt->bind_param('ssisi' ,$name, $address, $cityId, $phone, $aid);
		// if statement execute retuns 1 else return 0;
		if($stmt->execute()){
		    return 1;
		}else
		    return 0;
	}
// returns the row at address id($aid)
// used in checkout;
	function select_address_by_id($aid){
	    
	    //select address from database;
	    $stmt = $this->conn->prepare("SELECT * from address where a_id = ?");
		$stmt->bind_param('i' , $aid);
		$stmt->execute();
		$result = $stmt->get_result();
		
		// if address is fetched return the address else return 0;
		if($row=mysqli_fetch_array($result))
			return $row;
		else return 0;
	}

	function get_aid($cid){
	    $stmt = $this->conn->prepare("SELECT a_id from address where c_id = ?");
		$stmt->bind_param('i' , $cid);
		$stmt->execute();
		$result = $stmt->get_result();
		if($row=mysqli_fetch_array($result))
			return $row[0];
		else return 0;
	}
}

?>
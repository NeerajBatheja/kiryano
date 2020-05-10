<?php
include_once('dbClass.php');

class province{
    function __construct()
	{	
		 $this->conn= db::connect();
	}
	
// fetch the all provinces;
// used in address.php page.
	function fetch_province(){
	    // select all the provinces from database
	    $stmt = $this->conn->prepare("SELECT * from province ");
		$stmt->execute();
		
		
	    $array= array();
	   // if it reutrns result then fetch all;
		if ($result = $stmt->get_result()){
		    // fetch all the rows untill all the rows are fetched;
		    while ($row=mysqli_fetch_array($result)){
		         $array[]=$row;
		    }
		}else return 0;
		
		return $array;
	}
	

// return the province with province_id 
// used in address.php and my account.php
	function get_province($provId){
	    // select one province with id 
	    $stmt = $this->conn->prepare("SELECT * from province where prov_id= ?");
		$stmt->bind_param('i',  $provId);
		$stmt->execute();
		
		
		$array= array();
		// if query runs successful fetch the row from the result else return 0;
		if ($result = $stmt->get_result()){
		    // if row is fetched then return the row else return 0;
		  if($row=mysqli_fetch_array($result))
		     return $row;
		     else return 0;
		}else return 0;	
	}
}
?>
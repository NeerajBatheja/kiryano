<?php
include_once('dbClass.php');

class city{
    function __construct()
	{	
		 $this->conn= db::connect();
	}
	
	
	function fetch_city(){
	    // select all the cities from database
	    $stmt = $this->conn->prepare("SELECT * from city ");
		$stmt->execute();
		
		
	    $array= array();
	   // if it reutrns result then fetch all;
		if ($result = $stmt->get_result()){
		    // fetch all the rows untill all the rows are fetched;
		    while ($row=mysqli_fetch_array($result)){
		         $array[]=$row;
		    }
		    return $array;
		}else return 0;
	}
	
	function get_city($cityId){
	     // prepare statement to select the city with id from database
	    $stmt = $this->conn->prepare("SELECT * from city where city_id= ?");
	    $stmt->bind_param('i', $cityId);
		$stmt->execute();
		
		if ($result = $stmt->get_result()){
		    if($row=mysqli_fetch_array($result)){
		        return $row;
		    }
		}else return 0;
	    
	}

}
?>
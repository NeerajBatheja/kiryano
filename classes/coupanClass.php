<?php
include_once('dbClass.php');

class Coupan_Codes{
    function __construct()
	{	
		 $this->conn= db::connect();
	}
	//checking wether coupan is valid or not
	function fetch_validate_coupan($coupan_code){
	    $stmt = $this->conn->prepare("SELECT coupanValue,amount_condition From coupanCode where coupan = ?");
		$stmt->bind_param('s',$coupan_code);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result -> fetch_assoc();
	    return $row;
	
	    
	}
	function validate_coupan_usage($coupan_code,$user_cid)
	{       
	    
	        $stmt = $this->conn->prepare("SELECT * from coupanCode_Used WHERE user_cid = ? AND coupan = ? ");
	    	$stmt->bind_param('is',$user_cid,$coupan_code);
		    $stmt->execute();
		    $result = $stmt->get_result();
            $row = mysqli_num_rows($result);
	        return $row;
	}
	function insert_coupan_data($coupan_code,$cid)
	{
	        $stmt = $this->conn->prepare("INSERT INTO coupanCode_Used(coupan,user_cid) VALUES(?,?)");
	    	$stmt->bind_param('si',$coupan_code,$cid);
		    if($stmt->execute())
		        return 1;
		    else
		        return 0;
	    
	}
	
	

}
?>
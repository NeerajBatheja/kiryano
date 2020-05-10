<?php
include_once('dbClass.php');
include_once('addressClass.php');
include_once('cartClass.php');
/**
 * 
 */
class order_details
{
	
	function __construct()
	{
		 $this->conn= db::connect();
	}

//fetch letest order_no of customer;
//used in
	function get_letest_orderNo($cid){
		$sql= "SELECT order_no from order_detail where c_id = $cid and order_no = (select max(order_no) from order_detail where c_id = $cid)";
		$result = mysqli_query($this->conn,$sql);
		if($row=mysqli_fetch_array($result)){
			return $row[0];
		}
		
	}
	function fetch_data($ono){
		$sql= "SELECT * from order_detail where order_no = $ono";
		$result = mysqli_query($this->conn,$sql);
		if($row=mysqli_fetch_array($result)){
			return $row;
	    }
	}
	function update_order_details($coupan_value,$shipping=0,$order_no){
	    $sql = "UPDATE order_detail SET coupan_value =$coupan_value ,shippingFee= $shipping WHERE order_no = $order_no ";
		if($result = mysqli_query($this->conn,$sql)){
			return 1;
		}
	}
		
	function get_orderNo($cid){
		$sql= "SELECT order_no from order_detail where c_id = $cid and status!= 0 and order_no != (select max(order_no) from order_detail where c_id = $cid) order by order_no desc";
		$result = mysqli_query($this->conn,$sql);
		$array=array();
		if ($result=mysqli_query($this->conn,$sql)){
		  while ($row=mysqli_fetch_array($result)){
		      $this->get_order_status($row['order_no']);
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
		
	}
	
	
// update the status of order in order_details
//used in user page;
	function update_status($o_no,$name,$address = null,$phone = null ,$status = null){
	    if(is_null($address)){
	        $stmt = $this->conn->prepare("UPDATE order_detail SET status= ? WHERE order_no=?");
	        $stmt->bind_param('ii',$name,$o_no);
	    }else{
	        $stmt = $this->conn->prepare("UPDATE order_detail SET status=? ,name = ?, address = ?, phone = ?  WHERE order_no= ?");
    	    $stmt->bind_param('isssi',$status,$name,$address,$phone,$o_no);
	    }
		if($stmt->execute())
			return 1;
		else return 0;
	}
	
	
	function check_if_completed($o_no){
		$sql= "SELECT order_id from cart where order_no =$o_no";
		//echo $sql;
			$result = mysqli_query($this->conn,$sql);
			$crt = new cart();
			$checker = 2;
			while($row=mysqli_fetch_array($result) and $checker == 2){
				$checker = $crt->check_if_completed($row[0]);
			}
			if($checker==2){
				$this->update_status($o_no,2);
			}
			return $checker;
	}

	function get_order_status($o_no){
		$sql= "SELECT status from order_detail where order_no =$o_no";
		//echo $sql;
		$result = mysqli_query($this->conn,$sql);
		$row=mysqli_fetch_array($result);
		if($row[0] == 2){
			return $row[0];
		}else if ($this->check_if_completed($o_no)==2){
			return 2;
		}else return 0;

	}

	function create_new_order($cid){
		$sql = "INSERT into order_detail (c_id,o_date) values ($cid,CURRENT_TIMESTAMP) ";
		if($result = mysqli_query($this->conn,$sql)){
			return 1;
		}
	}
}

?>
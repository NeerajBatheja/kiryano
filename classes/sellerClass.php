<?php
/**
 * user class
 */
include_once('dbClass.php');
include_once('cartClass.php');
class seller
{
	function __construct()
	{	
		 $this->conn= db::connect();
	}

	public function insert($first,$last,$email,$pass){
			
			$sql = "SELECT * from seller where email ='$email'";
			$select_result = mysqli_query($this->conn,$sql);
			$num = mysqli_num_rows($select_result);

			if($num ==1){
				return 0;
			}else{
				$reg = "INSERT into seller (f_name,l_name,email,password) values ('$first','$last','$email','$pass')";
				if(mysqli_query($this->conn,$reg))
					return 1;
			}
	}

	public function validate($email,$pass){

		$sql = "SELECT * from seller where email ='$email' and password = '$pass'";
		$result = mysqli_query($this->conn,$sql);
		return $num = mysqli_num_rows($result);


	}
	
	public function update($id,$email,$first, $last,$pass){
		$sql = "UPDATE seller SET f_name='$first', l_name ='$last', email='$email', password= $pass WHERE s_id=$id";
		if (mysqli_query($this->conn, $sql)) {
		    return 1;
		} else {
		    return 0;
		}

	}

	public function fetch_data($email){
		$sql="SELECT * FROM seller WHERE email = '$email'";
		$array= array();
		if ($result=mysqli_query($this->conn,$sql))
		  {
		  while ($row=mysqli_fetch_array($result))
		    {
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	}
	public function get_order_no($sid){
	    $sql="SELECT order_no FROM cart WHERE status = 1 AND p_id IN (SELECT p_id FROM product WHERE s_id = '.$sid.' )  GROUP BY order_no ORDER BY order_no DESC";
		$array= array();
		if ($result=mysqli_query($this->conn,$sql))
		  {
		  while ($row=mysqli_fetch_array($result))
		    {
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	    
	}
	
	public function get_shipped_order_no($sid){
	    $sql="SELECT order_no FROM cart WHERE status = 2 AND p_id IN (SELECT p_id FROM product WHERE s_id = '.$sid.' )  GROUP BY order_no ORDER BY order_no DESC";
		$array= array();
		if ($result=mysqli_query($this->conn,$sql))
		  {
		  while ($row=mysqli_fetch_array($result))
		    {
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	    
	}

	public function get_pending_order($o_no,$sid){
		$crt = new cart();
		return $crt->get_pending_order($o_no,$sid);
	}
	
	public function get_shipped_order($o_no,$sid){
		$crt = new cart();
		return $crt->get_shipped_order($o_no,$sid);
	}
	
	public function update_order_status($o_id){
		$odr = new cart();
		$odr->update_order_status_id($o_id,2);
	}

	public function get_total_selling($sid){
		$sql= 'SELECT SUM(cart.quantity*product.price) FROM cart,product WHERE product.pid = cart.p_id and cart.status !=0 and product.s_id ='.$sid.' GROUP by s_id';
		if ($result=mysqli_query($this->conn,$sql)){
		  if ($row=mysqli_fetch_array($result)){
		     return $row[0];
		    }
		}else
			echo "didnt fetched";
	}
}

$obj = new seller();
$obj->get_total_selling(1);
?>
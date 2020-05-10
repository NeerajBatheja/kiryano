<?php
/**
 * user class
 */
include_once('dbClass.php');
include_once('cartClass.php');
class admin
{
	function __construct()
	{	
		 $this->conn= db::connect();
	}

	public function insert($name,$email,$pass){
			
			$sql = "SELECT * from admin where email ='$email'";
			$select_result = mysqli_query($this->conn,$sql);
			$num = mysqli_num_rows($select_result);

			if($num ==1){
				return 0;;
			}else{
				$reg = "INSERT into admin (name,email,password) values ('$name','$email','$pass')";
				if(mysqli_query($this->conn,$reg))
					return 1;
			}
	}

	public function validate($email,$pass){

		$sql = "SELECT * from admin where email ='$email' and password = '$pass'";
		$result = mysqli_query($this->conn,$sql);
		return $num = mysqli_num_rows($result);


	}
	/*
	
	public function update($id,$email,$first, $last,$pass){
		$sql = "UPDATE admin SET f_name='$first', l_name ='$last', email='$email', password= $pass WHERE s_id=$id";
		if (mysqli_query($this->conn, $sql)) {
		    return 1;
		} else {
		    return 0;
		}

	}*/

	public function fetch_data($email){
		$sql="SELECT * FROM admin WHERE email = '$email'";
		$array= array();
		if ($result=mysqli_query($this->conn,$sql))
		  {
		  while ($row=mysqli_fetch_row($result))
		    {
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	}

	public function get_orders(){
		$sql='SELECT 
				order_detail.order_no,
				customer.f_name,
				customer.l_name, 
				order_detail.status 
			FROM 
				order_detail,
				customer 
			WHERE order_detail.c_id = customer.c_id 
				AND order_detail.status !=0 
			ORDER BY status';
		$array= array();
		if ($result=mysqli_query($this->conn,$sql))
		  {
		  while ($row=mysqli_fetch_row($result))
		    {
		     $array[]=$row;
		    }
		}else{
			echo "didnt fetched";
		}
		return $array;
	}

	public function get_order_total($ono){
		$sql = 'SELECT SUM(product.price * cart.quantity) FROM cart,product WHERE cart.p_id = product.pid AND order_no ='.$ono;
		if ($result=mysqli_query($this->conn,$sql)){
		  if ($row=mysqli_fetch_row($result)){
		     return $row[0];
		    }
		}else
			echo "didnt fetched";
	}
/*
	public function update_order_status($o_id){
		$odr = new cart();
		$odr->update_order_status_id($o_id,2);
	}

	public function get_total_selling($sid){
		$sql= 'SELECT SUM(cart.quantity*product.price) FROM cart,product WHERE product.pid = cart.p_id and cart.status !=0 and product.s_id ='.$sid.' GROUP by s_id';
		if ($result=mysqli_query($this->conn,$sql)){
		  if ($row=mysqli_fetch_row($result)){
		     return $row[0];
		    }
		}else
			echo "didnt fetched";
	}*/
}

//$obj = new admin();
//print_r($obj->fetch_data('ajaychawla804@gmail.com'));


?>
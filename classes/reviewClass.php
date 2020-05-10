<?php
include_once('dbClass.php');
/**
 * 
 */
class review
{
	
	function __construct()
	{
		$this->conn = db::connect();
	}
// submit the reveiw $rev of product $pid entered by client with $cid
// used in single product page.
	public function submit_review($pid,$cid,$rev,$star){
	    //select the review of $pid by customer $cid;
	    $stmt = $this->conn->prepare("SELECT * from review where p_id =? and c_id = ?");
		$stmt->bind_param('ii', $pid, $cid);
		$stmt->execute();
		
		$result = $stmt->get_result();
		// if review already entered return 0 else return insert review into database;
		if(mysqli_num_rows($select_result)){
			return 0;
		}else{ 
		    // insert the review into the database;
		    $stmt = $this->conn->prepare("INSERT into review (p_id,c_id,review,stars) values (?,?,?,?)");
    		$stmt->bind_param('iisi', $pid, $cid, $rev, $star);
			// return 1 if inserted into datbase else return 0;
			if($stmt->execute())
			    return 1;
			    else return 0;
		}
	}

// fetch all reviews of product $pid;
// used in review.php page to show all the review class
	public function fetch_reviews($pid){
	    // select data from reveiw tablel from customer;
	    $stmt = $this->conn->prepare("SELECT customer.f_name,review.review, review.stars FROM customer,review WHERE customer.c_id= review.c_id AND review.p_id = ?");
		$stmt->bind_param('i', $pid);
		$stmt->execute();
		// save result of query in to result variable;
		$result = $stmt->get_result();

		$array =array();
		// save the results in to the array until all the row are fetched;
		while($row=mysqli_fetch_array($result)){
			$array[] = $row;
		}
		return $array;
	}
	
}


?>
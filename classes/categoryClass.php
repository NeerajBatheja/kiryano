<?php
include_once('dbClass.php');

/**
 * 
 */
class category
{
	
	function __construct()
	{
		 $this->conn= db::connect();
	}

// Insert categoty in to the database;
// used in the admin panel;
	function insert($name,$parentId){
	    // select the category from the database to check if address already exist;
	    $stmt = $this->conn->prepare("SELECT * from category where name = ?");
		$stmt->bind_param('s' ,$name);
		$stmt->execute();
		$result = $stmt->get_result();
		
		
	// if category already exit return 0; else insert the category;
		if(mysqli_num_rows($result) == 1){
			return 0;
		}else{
		    
		 // insert the category to the database 
		    $stmt2 = $this->conn->prepare("INSERT into category (name,parent) values (?,?)");
    		$stmt2->bind_param('si' ,$name, $parentId);
    		
			if($stmt2->execute())
				return 1;
			else return 0;
		}
		
	}
	

// fetch all the categories from the databse;
// used in home;
	function fetch_all(){
	     //prepare query to select all the categories from the ;
        $stmt = $this->conn->prepare("SELECT * from category");
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
	
	
	// fetch all the child of parent;
	// used in show funtion in home;
	function fetch_by_parent($parentId = NULL){
	    
	    // if parent id is given then prepare statement with parent id else prepare without it;
	    if($parentId != NULL){
	        //prepare query to select category from database with parentID ;
            $stmt = $this->conn->prepare("SELECT * from category where parent = ?");
    		$stmt->bind_param('i', $parentId);
		}else{
		    //prepare query to select category from database with null parent id;
            $stmt = $this->conn->prepare("SELECT * from category Where parent is null");
		}
		
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
	
	
	//get the category with id ;
	// used in ....;
	function fetch_by_id($id){
	    
	    //prepare query to select item from database with order_no and orderno;
        $stmt = $this->conn->prepare("SELECT * from category where id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		// if get any result then fetch it else return 0;
		if ($result = $stmt->get_result()){
		    // fetch the result into the row and save them into the array untill all the results are fetched;
		    if($row=mysqli_fetch_array($result)){
		        return $row;
		    }
		    
		}else return 0;
		
	}
	
	
	// return all child nodes which don't have any child;
	// used in seller class;
	function fetch_all_childs_nodes_with_no_child($pid = NULL){
		if($result = self::fetch_by_parent($pid)){
			$array =array();
			foreach ($result as $row) {
				$array2 =array();
				$array2 = self::fetch_all_childs_nodes_with_no_child($row[0]);
				foreach ($array2 as $arr) {
					$array[] =$arr;
				}
			}
			return $array;
		}else{
			$array[] =self::fetch_by_id($pid);
			return $array;
		}
	}

	function fetch_all_child_nodes($pid =NULL){
		$array =array();
		$array[] =self::fetch_by_id($pid);
		if($result = self::fetch_by_parent($pid)){
			foreach ($result as $row) {
				$array2 =array();
				$array2 = self::fetch_all_child_nodes($row[0]);
				foreach ($array2 as $arr) {
					$array[] =$arr;
				}
			}
		}
		return $array;
	}
	
	// fetch all base parent
	// used in home;
	function fetch_all_parent_category(){
	    // prepare select statement;
	    $stmt = $this->conn->prepare("SELECT * from category Where parent is NULL");
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
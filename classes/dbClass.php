<?php

/**
 * 
 */
class db 
{
	public static $conn;
	private function __construct()
	{
		

	}
	public static function connect(){
		if(!isset($conn)){
			self::$conn= mysqli_connect("localhost","neerajba_neerajbatheja","neerajBatheja5506","neerajba_myprj");
			if (mysqli_connect_errno())
			{
			 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
		
		return self::$conn;
	}
}
?>
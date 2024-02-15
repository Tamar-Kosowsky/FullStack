<?php
class Connect {
	// connect to database
	public static function connectToDB() {
		
		//$con = mysqli_connect("host","user name","password");
		$con = mysqli_connect("localhost","root",""); // on local it isnt must to have password
		
		// check connection 		
		if (!$con)  die('Could not connect: ');
		
		// if connection seccess -> select database upwords		
		$success = mysqli_select_db($con,"upwords");
		
		// encode db data to utf8
		 mysqli_query($con,"SET NAMES utf8;"); 

		 // check database (upwords)connection success
		if (!$success) die('Could not select DB:');
		
		// return conection
		return $con;
	}		
	
}
?>
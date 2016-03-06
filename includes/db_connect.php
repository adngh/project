<?php 

	// this is one way to define CONSTANTS
	define("DB_SERVER", "localhost");
	define("DB_USER", "adnan");
	define("DB_PASS", "12312");
	define("DB_NAME", "senior_project");
	
	
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	
	
	// mysqli_connect_errno() return the error number or (zero if no error)
	// return the error name or (empty string if no error)
	
	if(mysqli_connect_errno()){
		// die meant stop, kill everything and quit
		die("DB connection failed: " . 
			mysqli_connect_error() .
			"(" . mysqli_connect_errno() .")"
			);
	} 
	
	?>

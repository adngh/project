<?php 
require_once("../includes/session.php");
require_once("../includes/functions.php"); 
require_once("../includes/db_connect.php"); 
require_once("../includes/validation_function.php"); 
?>


<?php 		

			if($_GET["id"]){
			
			$member = $_SESSION["count"][$_GET["id"]];
			
			$query = "delete from members";
			$query .= " where id = " . $member["id"];
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1){
				$_SESSION["message"] = "Deletion Succeed";
				redirect_to("manage_content.php?members=1");
			} else {
				$_SESSION["errors"] = "Deletion Failed";
				redirect_to("manage_content.php?members=2");
			}
			
	} // if($_GET["id"] && $_GET["id"] == $member["id"])
	  else {
		  redirect_to("manage_content.php");
	  }
  ?>
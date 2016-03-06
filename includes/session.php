<?php 

	session_start();

	function message(){
		if(isset($_SESSION["message"])){
			$output = "<div class=\"message\">";
			// $_SESSION["message"] will be message returned to user, this value maybe coming from DB or ..
			// so htmlentities() or htmlspecialchars() wii make sure everything is ok
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			// clear message after use.
			$_SESSION["message"] = null;
			return $output ;
		}
	}
	
	function errors(){
		if(isset($_SESSION["errors"])){
			$errors = $_SESSION["errors"];
			// clear errors after use
			$_SESSION["errors"] = null;
			return $errors ;
		}
	}
	?>
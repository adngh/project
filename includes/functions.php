<?php 
	
	function mysql_prepare($string){
		global $connection;
		return mysqli_real_escape_string($connection, $string);
	}
	
	function redirect_to($new_location){
		header("Location: " . $new_location);
		exit;
	}
	
	function confirm_query($result_set){
		if(!$result_set){
		die("DB query failed ...");
		}
	}
	
	function find_all_subjects(){
	
	global $connection;	
	$query = "select * ";
	$query .= "from subjects ";
	$query .= "where visible = 1 ";
	$query .= "order by position asc";
	$subject_set = mysqli_query($connection, $query);
	confirm_query($subject_set);
	return $subject_set;
	}
	
	
	function find_pages_for_subject($subject_id){
	global $connection;
	
	// we are getting the $subject id from user using ($_GET), not safe value
	// so we need to escape
	$safe_subject_id = 	mysqli_real_escape_string($connection,
	$subject_id);
	
	$query = "select * ";
	$query .= "from pages ";
	$query .= "where visible = 1 ";
	$query .= "and subject_id = {$safe_subject_id} ";
	$query .= "order by position asc";
	$page_set = mysqli_query($connection, $query);
	confirm_query($page_set);
	return $page_set;
	}

	
	function find_subject_by_id($subject_id){
	global $connection;	
	
	// we are getting the $subject id from user using ($_GET), not safe value
	// cuz maybe we end up with sql injection, so we need to escape
	$safe_subject_id = 	mysqli_real_escape_string($connection,
	$subject_id);
		
	$query = "select * ";
	$query .= "from subjects ";
	$query .= "where id = {$safe_subject_id} ";
	$query .= "limit 1";
	$subject_set = mysqli_query($connection, $query);
	confirm_query($subject_set);
	if($subject = mysqli_fetch_assoc($subject_set)){
		return $subject;
	} else {
		return null; // or return false
	}
	
	
	}
	
	function find_page_by_id($page_id){
	global $connection;	
	
	
	$safe_page_id = mysqli_real_escape_string($connection,
	$page_id);
		
	$query = "select * ";
	$query .= "from pages ";
	$query .= "where id = {$safe_page_id} ";
	$query .= "limit 1";
	$page_set = mysqli_query($connection, $query);
	confirm_query($page_set);
	if($page = mysqli_fetch_assoc($page_set)){
		return $page;
	} else {
		return null; // or return false
	}
	
	
	}
	
	function find_selected_page(){
		// we need to either return $current_page and $current_subject (return array)
		// or we create them in the global scope.
		
		// even they didn't exist until they got to this method, we are reffering to them in the global scope
		// so when we use them anywere below, they are inside the global scope
		global $current_page;
		global $current_subject;
		
	if(isset($_GET["subject"])) {
	$current_subject = find_subject_by_id($_GET["subject"]);
	$current_page = null;
	}elseif(isset($_GET["page"])){
		$current_page = find_page_by_id($_GET["page"]);
		$current_subject = null;
	}else{
		$current_page = null;
		$current_subject = null;
	}
	}
	
	// refactoring the navigation (104- Moving the navigation to a function)
	function navigation($subject_array, $page_array){
		// navigation takes two arguments
		// * the current subject array or null
		// * the current page array or null 
		
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		// we want to print menu_name 
		while($subject = mysqli_fetch_assoc($subject_set)){
			// after that go to html, print in a nice way
		$output .= "<li ";  
		 if($subject_array && $subject["id"] == $subject_array["id"]){
		 $output .= "class=\"selected\"";
		 }
		 $output .= ">";		 
	$output .= "<a href=\"manage_content.php?subject=";
	$output .= urlencode($subject["id"]); 
	$output .="\">";
	$output .= $subject["menu_name"]; 
	$output .= "</a>"; 
	
	$page_set = find_pages_for_subject($subject["id"]);
	$output .= "<ul class=\"pages\">";
	while($page = mysqli_fetch_assoc($page_set)){	
		 $output .= "<li ";  
		 if($page_array && $page["id"] == $page_array["id"]){
		 $output .= "class=\"selected\"";
		 }
		$output .= ">"; 
		$output .= "<a href=\"manage_content.php?page=";
		$output .= urlencode($page["id"]); 
		$output .= "\">";
		$output .= $page["menu_name"]; 
		$output .="</a></li>";
			}
	mysqli_free_result($page_set);		
	$output .="</ul></li>";
	}
	mysqli_free_result($subject_set);
	$output .= "</ul>";
	return $output;
	}
	
	
	
	function form_errors($errors=array()){
		$output = "";
		if(!empty($errors)){
			$output .= "<div class=\"error\">";
			$output .= "please fix the folowing errors:";
			$output .= "<ul>";
			foreach($errors as $key => $error){
				$output .= "<li>{$error}</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}
	
	?>
	
	
	<?php
	
	
	function find_all_members(){
		global $connection;
		$query = "select * from members";
		$members_set = mysqli_query($connection, $query);
		confirm_query($members_set);
		return $members_set;	
	}
	
	function find_all_admin(){
		global $connection;
		$query = "select * from admin";
		$members_set = mysqli_query($connection, $query);
		confirm_query($members_set);
		return $members_set;	
	}
	
	
	
	
	?>
	
	<?PHP
	
	
	function getUserData($id){
		global $connection;
		$array=array();
		$q = mysql_query("SELECT * FROM members WHERE id='[id]'");
		while($row = mysql_fetch_assoc($q))
		{
			$array['id']= $row['id'];
			$array['first_name']= $row['first_name'];
			$array['last_name']= $row['last_name'];
			$array['aboutme']= $row['aboutme'];
			$array['email']= $row['email'];
			$array['city']= $row['city'];
			$array['intrest']= $row['intrest'];
		}
		return $array;
	}
	
	
	function find_member_by_id($member_id){
		global $connection;
		
		$query = "select * from members where id = {$member_id} limit 1";
		$members_set = mysqli_query($connection, $query);
		confirm_query($members_set);
		if($member = mysqli_fetch_assoc($members_set)){
			return $member;
		}else{
			return null;
		}
	}	
		
		
	
	
	?>
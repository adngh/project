<?php

	// this will make sure that $errors always has values, we don't need to remined ourselves
	// to give it a value, once we include this file, we work with it
	$errors = array();
	
	function fieldname_as_text($fieldname){
		$fieldname = str_replace("_", " ", $fieldname);
		$fieldname = ucfirst($fieldname);
		return $fieldname;
	}
	function has_presence($value){
		return isset($value) && $value !== "";
	}

	function validate_presences($required_field){
		global $errors;
		foreach($required_field as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value)){
				$errors[$field] = fieldname_as_text($field) . " can't be blank";
			}
		}
		
	}	

	function has_max_length($value, $max){
		return strlen($value) <= $max;
			}
			
	function validate_max_length($array){
		global $errors;
		foreach($array as $field => $max){
			$value = trim($_POST[$field]);
			if(!has_max_length($value, $max)){
				$errors[$field] = fieldname_as_text($field) . " can't exceed {$max}";
					}
				}
			}

	
	//* included in a set
	function has_inclusion_in($value, $set){
		return in_array($value, $set);
			}
			
	function members_validate_login($id, $password){
		
			$members = find_all_members();
			if($members && mysqli_num_rows($members) > 0){
				while($member = mysqli_fetch_assoc($members)){
					if($member["id"] === $id && $member["password"] === $password){
						$_SESSION["member_login"] = $member;
						return 1;
					}
				}
			} else {
				return 0;
				}
				
	}		
	
	function admin_validate_login($id, $password){
		
		$members = find_all_admin();
			if($members && mysqli_num_rows($members) > 0){
				while($member = mysqli_fetch_assoc($members)){
					if($member["id"] === $id && $member["password"] === $password){
						$_SESSION["admin_login"] = $member;
						return 1;
					}
				}
			} else {
				return 0;
				}
				
	}		
	

	
	
?>
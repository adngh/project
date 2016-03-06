	
<?php
 require_once("../includes/session.php");
 require_once("../includes/functions.php"); 
 require_once("../includes/db_connect.php");
 require_once("../includes/validation_function.php"); 
 include("../includes/layout/header.php"); 
 ?>
 
	
	<!-- take $_GET value to determine member, I can't send id on $_GET cuz not safe for my system -->  
	<?php $count = $_GET["id"]; ?>
	<?php $member = $_SESSION["count"][$count]; ?>
	<?php 
	
	if(isset($_POST["submit"])){
			
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$id = $_POST["id"];
			$password =  $_POST["password"];
			$discription = "Write something here";
			echo $first_name . "<br />";
			echo $last_name . "<br />";
			echo $id . "<br />";
			echo $password . "<br />";
			echo $discription . "<br />";
			
			
			
			// validate
			$required_fields = array("first_name", "last_name", "id", "password");
			validate_presences($required_fields);
			
			$array = array("first_name" => 20, "last_name" => 20, "id" => 11, "password" => 30,);
			validate_max_length($array);
			if(!empty($errors)){
				$_SESSION["errors"] = $errors;
				redirect_to("add_member.php");
			}
			
			$query = "update members set";
			$query .= " first_name = '{$first_name}', last_name = '{$last_name}',";
			$query .= " id = {$id}, password = '{$password}'";
			$query .= " where id = " . $member["id"];
			
			$result = mysqli_query($connection, $query);
			confirm_query($result);
			if($result && mysqli_affected_rows($connection) == 1){
				$_SESSION["message"] = "update Succeed";
				redirect_to("manage_content.php?members=1");
			} else {
				$_SESSION["message"] = "update Failed";
				redirect_to("manage_content.php?members=1");
				}
		} /*else {
		// get request
		$_SESSION["message"] = "select a member first to edit";
		redirect_to("manage_content.php?members=1");
		
	} */
	
?>

		<div id="main">
		<div id="navigation">
		
		</div>
		<div id="page">

			<?php if(!empty($message)){ echo "<div class=\"message\">" . $message . "</div>"; }	?>
			<?php echo message(); ?>
			<?php echo form_errors($errors); ?>
			<?php form_errors($errors); ?>
			
		<h2>Edit member: <?php echo $member["first_name"] . " " . $member["last_name"]; ?></h2>
		 <form action="edit_member.php?id=<?php echo $count?>" method="post">
		  <p>First name:
			<input type="text" name="first_name" value="<?php echo $member["first_name"]; ?>"/>
		  </p>
		  
		  <p>Last name:
			<input type="text" name="last_name" value="<?php echo $member["last_name"]; ?>"/>
		  </p>
		  
		  <p>ID:
			<input type="text" name="id" value="<?php echo $member["id"]; ?>"/>
		  </p>
		  
		  
		  <p>Password:
			<input type="password" name="password" value=""/>
		  </p>
		  
		  <p>Discription
			<textarea name="discription" rows="10" cols="50">Write something here</textarea>
			
		  </p>
			<input type="submit" name="submit" value="Edit member" />
		 </form>
		 <br />
		 <a href="manage_content.php">Cancle</a>
		 &nbsp
		 &nbsp
		 
		 <a href="delete_member.php?id=<?php echo
		  $member["id"]; ?>" onclick="return confirm('Are you sure ?');">Delete member</a>
		</div>
		</div>


		<?php include("../includes/layout/footer.php"); ?>
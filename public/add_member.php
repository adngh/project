<?php
 require_once("../includes/session.php");
 require_once("../includes/validation_function.php");
 require_once("../includes/functions.php"); 
 require_once("../includes/db_connect.php"); 
 include("../includes/layout/header.php"); 
 ?> 
 
 
		
	<?php
		if(isset($_POST["submit"])){
			
			$first_name = mysql_prepare($_POST["first_name"]);
			$last_name = mysql_prepare($_POST["last_name"]);
			$id = (int) $_POST["id"];
			$password =  mysql_prepare($_POST["password"]);
			$discription = mysql_prepare($_POST["discription"]);
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
			
			$query = "insert into members (id, first_name, last_name, password)";
			$query .= " values";
			$query .= " ({$id}, '{$first_name}', '{$last_name}', '{$password}')";
			
			$result = mysqli_query($connection, $query);
			
			if($result){
				$_SESSION["message"] = "Insertion Succeed";
				redirect_to("manage_content.php?members=1");
			} else {
				$_SESSION["message"] = "Insertion Failed";
				redirect_to("manage_content.php?members=1");
				}
		}		
	?>
	
	
	
<div id="main">
<div id="navigation">
 <!-- we could embedd the code here, but we choose to make navigation function (find it in ) better to have a look on it -->
 
	
</div>
		<div id="page">
			<?php 	echo message();	?>
			<?php $errors = errors();?>
			<?php echo form_errors($errors); ?>
			<?php form_errors($errors); ?>
			<?php if(isset($_POST["submit"])){echo "<h2>Page Created</h2>";exit;} ?>
			
			
		<h2>Add Member</h2>
		 <form action="add_member.php" method="post">
		  <p>First name:
			<input type="text" name="first_name" value=""/>
		  </p>
		  
		  <p>Last name:
			<input type="text" name="last_name" value=""/>
		  </p>
		  
		  <p>ID:
			<input type="text" name="id" value=""/>
		  </p>
		  
		  <p>Password:
			<input type="password" name="password" value=""/>
		  </p>
		  
		  <p>Discription
			<textarea name="discription" rows="10" cols="50">Write something here</textarea>
			
		  </p>
			<input type="submit" name="submit" value="Add member" />
		 </form>
		 <br />
		 <a href="manage_content.php">Cancle</a>
		</div>
</div>


<?php include("../includes/layout/footer.php"); ?>
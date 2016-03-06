	
<?php
 
 require_once("../includes/functions.php"); 
 require_once("../includes/session.php"); 
 require_once("../includes/validation_function.php"); 
 require_once("../includes/db_connect.php"); 
 include("../includes/layout/header.php"); 
 ?> 

<html>

<head>
  <link rel="stylesheet" href="style/mythem.css">

</head>

<body>
 <div id="header">
 <ul>
        <li><a href="members_page.php">Home</a></li>
        <li><a href="aboutme.php">About Me</a></li>
        <li><a class="active" href="accountmanagement.php">Account management</a></li>
		<li><a href="main_page.php?logout=1">Logout</a></li>
      </ul>
	
</div>	




</body>







</html> 
	 
	 
		
<div id="main">


<?php
if (isset($_GET['logout']))
{
	$_SESSION = array();
	if ($_COOKIE[session_name()])
	{
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	header('Location: main_page.php');
}
?>
 

 
<!DOCTYPE html>
<html>
        <head>
       
        </head>
        <body>
                <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <input type="submit" name="submit">
                </form>
               
               
                 <?php	
						
                        // $members = mysqli_query($connection,"SELECT * FROM members WHERE id = " . $_SESSION["member_id"]);
                        // $member = find_member_by_id(1);
						$member = $_SESSION["member_login"];
                               
						if(!has_presence($member["images"])){
								echo "<img width='100' height='100' src='images/default.jpg' alt='Default Profile Pic'>";
						} else {
								echo "<img width='100' height='100' src='images/".$member['images']."' alt='Profile Pic'>";
						}
						echo "<br>";
						
						
                ?>
				
				<?php
						
				if(isset($_POST["save"])){
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					$email = mysqli_real_escape_string($connection, $_POST['email']);
					$city = $_POST["city"];
					$intrest = $_POST["intrest"];
					// var_dump($member);
					// var_dump($_POST);
					$query = "update members set first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', city = '{$city}', intrest = '{$intrest}' where id = " . $member["id"];
					var_dump($query);
					$result = mysqli_query($connection, $query);
					confirm_query($result);
					if($result && mysqli_affected_rows($connection) == 1){
						$_SESSION["message"] = "Information Updated";
						redirect_to("members_page.php");
					}else{
						$_SESSION["message"] = "Failed to Update";
						$redirect_to("accountmanagement.php");
					}
					
				}
				
				?>	
				
				
				<h3><center>Change account information</center></h3>
			 <form action="accountmanagement.php" method="post">
				 <div class="control-group">
          <label for="input-name">First name:  </label>
          <input id="input-name" type="text" name="first_name" value="<?php echo $member["first_name"]?>"/>
		  
          <div class="clear"></div>
        </div>
		
		
		<div class="control-group">
          <label for="input-name">Last name: 	</label>
          <input id="input-name" type="text" name="last_name" value="<?php echo $member["last_name"]?>"/>
		 
          <div class="clear"></div>
		</div>
				<div class="control-group">
          <label for="input-email">Email</label>
          <input id="input-email" type="email" name="email" placeholder="youremail@website.com" value="<?php echo $member["email"]?>"/>
          <div class="clear"></div>
        </div>
				
        <div class="control-group">
          <label for="input-city">City:</label>
          <input id="input-city" type="text" name="city" placeholder="where are you now ?" value="<?php echo $member["city"]?>"/>
          <div class="clear"></div>
        </div>
		
        <div class="control-group">
          <label for="input-intrest">interst in:</label>
          <input id="input-intrest" type="text" name="intrest" placeholder="SE , HCI , Networking .." value="<?php echo $member["intrest"]?>"/>
          <div class="clear"></div>
        </div>
			<div class="submit-group">
          <input type="submit" name="save" value="save" />
        </div>
      </form>
	 


				











	   </body>
</html>


</div>



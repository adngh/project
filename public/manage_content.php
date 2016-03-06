		
	<?php
	 require_once("../includes/session.php");
	 require_once("../includes/functions.php"); 
	 require_once("../includes/db_connect.php"); 
	 include("../includes/layout/header.php"); 
	 ?> 

		
	<div id="main">
	<div id="navigation">
	 <!-- we could embedd the code here, but we choose to make navigation function (find it in ) better to have a look on it -->
		<a href="manage_content.php">- Home</a>
		<br />
		<a href="manage_content.php?members=1">- Members</a>
	</div>
	<div id="page">

	<?php 	echo message();	?>

	 <?php 	if(isset($_GET["members"])){
				 echo "<h2>Members of FCIT</h2>"; 
				 ?>
		 
		 
		 <?php
				$members = find_all_members();
				if($members && mysqli_num_rows($members) > 0){
					$count = 0;
					echo "<ul>";
					while($member = mysqli_fetch_assoc($members)){
						$_SESSION["count"][++$count] = $member;
						echo "Member name: " . mysql_prepare($member["first_name"]) 
						. " " . mysql_prepare($member["last_name"]) . " "
						. "<a href=\"edit_member.php?id={$count}\">Edit member</a>" . "<br />" ;
						
							}
					echo "</ul>";
				}else{
					echo "Error: No Records in members' table.";
				}
				echo "<p><a href=\"add_member.php?members=1\"> + Add member</a></p>";
		 ?>
				
		 
		 
		 
			
	 <?php	 
	 } else {
		 echo "<h2>Welcome</h2>";
		 echo "<h6> FCIT ERM</h6>";
	 }
	 ?>
	 
	</div>
	</div>


	<?php include("../includes/layout/footer.php"); ?>
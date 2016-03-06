	
<?php
 require_once("../includes/session.php");
 require_once("../includes/functions.php"); 
 require_once("../includes/validation_function.php"); 
 require_once("../includes/db_connect.php"); 
 include("../includes/layout/header.php"); 
 ?> 

 
 <?php
			if(isset($_POST["submit"])){ 
			$member_login = members_validate_login($_POST["id"], $_POST["password"]); 
				if($member_login == 1) { redirect_to("members_page.php"); }
				else{
					echo "user or pass is invalid";
					}
			}	
			
			
	 ?>
	 
	 
	 
		
<div id="main">
<div id="navigation">
 <h4>Add Member</h4>
		 <form action="main_page.php" method="post">
		  <p>ID:
			<input type="text" name="id" value=""/>
		  </p>
		  
		  <p>Password:
			<input type="password" name="password" value=""/>
		  </p>
		  <input type="submit" name="submit" value="Log in" />
		  
		   <li><a href="visitor.php">for visitor click here </a></li>
	
</div>
<div id="page">

<?php 	echo message();	?>
 
</div>
</div>


<?php include("../includes/layout/footer.php"); ?>
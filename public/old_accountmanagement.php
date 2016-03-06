	
<?php
 
 require_once("../includes/functions.php"); 
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
       
      </ul>
	
</div>	




</body>







</html> 
	 
	 
		
<div id="main">


 <?php session_start();
        $_SESSION['id'] = "id";
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
                        $con = mysqli_connect("localhost","root","","senior_project");
						
                        $members = mysqli_query($con,"SELECT * FROM members WHERE id='[id]'");
                        while($row = mysqli_fetch_assoc($members)){
                               
                                if($row['images'] == ""){
                                        echo "<img width='100' height='100' src='images/default.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100' src='images/".$row['images']."' alt='Profile Pic'>";
                                }
                                echo "<br>";
							}
						
                ?>
				
				
				
				<h3><center>Change account information</center></h3>
			 <form action="accountmanagement.php">
				 <div class="control-group">
          <label for="input-name">First name:  </label>
          <input id="input-name" type="text" name="first_name"/>
		  
          <div class="clear"></div>
        </div>
		
		
		<div class="control-group">
          <label for="input-name">Last name: 	</label>
          <input id="input-name" type="text" name="last_name"/>
		 
          <div class="clear"></div>
		</div>
				<div class="control-group">
          <label for="input-email">Email</label>
          <input id="input-email" type="email" name="email" placeholder="youremail@website.com" />
          <div class="clear"></div>
        </div>
				
        <div class="control-group">
          <label for="input-city">City:</label>
          <input id="input-city" type="text" name="city" placeholder="where are you now ?" />
          <div class="clear"></div>
        </div>
		
        <div class="control-group">
          <label for="input-intrest">interst in:</label>
          <input id="input-intrest" type="text" name="intrest" placeholder="SE , HCI , Networking .." />
          <div class="clear"></div>
        </div>
			<div class="submit-group">
          <input type="submit" name="submit" value="save" />
        </div>
      </form>
	 














	   </body>
</html>


</div>



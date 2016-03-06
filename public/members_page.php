	
<?php
 
 require_once("../includes/functions.php"); 
 require_once("../includes/validation_function.php"); 
 require_once("../includes/session.php"); 
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
        <li><a class="active" href="members_page.php">Home</a></li>
        <li><a href="aboutme.php">About Me</a></li>
        <li><a href="accountmanagement.php">Account management</a></li>
		<li><a href="main_page.php?logout=1">Logout</a></li>
      </ul>
	
</div>	


	<? $member = $_SESSION["member_login"]; ?>

</body>







</html> 
	 
	 
		
<div id="main">





 
 
<?php
        if(isset($_POST['submit'])){
                move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
                $con = mysqli_connect("localhost","root","","senior_project");
                $members = mysqli_query($con,"UPDATE members SET images = '".$_FILES['file']['name']."' WHERE id = '".$member["id"]."'");
				
        }
?>

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
                        <input type="file" name="file" value="choose file">
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
				
				
				
				 
							
				
				
        </body>
</html>

<html>
<head>
<title>Title of your search engine</title>
</head>
<body>
<form action='search.php' method='GET'>
<center>
<h1>search publications</h1>
<input type='text' size='90' name='search'></br></br>
<input type='submit' name='submit' value='Search source code' ></br></br></br>
</center>
</form>
</body>
</html>


</div>



<?php include("../includes/layout/footer.php"); ?>
	
<?php
 
 require_once("../includes/functions.php"); 
 require_once("../includes/session.php"); 
 require_once("../includes/validation_function.php"); 
 require_once("../includes/db_connect.php"); 
 include("../includes/layout/header.php");


	$member = $_SESSION["member_login"];
 
 ?> 
 
 

<html>

<head>
  <link rel="stylesheet" href="style/mythem.css">
<style>
table {
    border-collapse: collapse;
    width: 100%;
	 margin-left:auto; 
    margin-right:auto;
}

th, td {
    text-align: left;
    padding: 15px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #8D0D19;
    color: white;
}
</style>
</head>

<body>
 <div id="header">
 <ul>
        <li><a href="members_page.php">Home</a></li>
        <li><a class="active" href="aboutme.php">About Me</a></li>
        <li><a href="accountmanagement.php">Account management</a></li>
		<li><a href="main_page.php?logout=1">Logout</a></li>
       
      </ul>
	
</div>	




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
				
			<?php	
				 $con = mysqli_connect("localhost","root","","senior_project");
                        $members = mysqli_query($con,"SELECT * FROM members WHERE id=" . $member["id"]);
						
                        while($row = mysqli_fetch_assoc($members)){
							
					?>		
				 
				<table style="width:70%">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>		
    <th>ID</th>
	<th>E-mail</th>
	<th>city</th>
	<th>intrest</th>
  </tr>
  <tr>
    <td><?php echo $row['first_name'];?></td>
    <td><?php echo $row['last_name'];?></td>		
    <td><?php echo $row['id'];?></td>
	<td><?php echo $row['email'];?></td>
	<td><?php echo $row['city'];?></td>
	<td><?php echo $row['intrest'];?></td>
	
  </tr>
  
</table>
	  <?php
		}				
	  ?>
	  	
		
				
		
		
        </body>
</html>


</div>


<?php include("../includes/layout/footer.php"); ?>
<?php
 require_once("../includes/session.php");
 require_once("../includes/functions.php"); 
 require_once("../includes/validation_function.php"); 
 require_once("../includes/db_connect.php"); 
 include("../includes/layout/header.php"); 
 ?> 

<html>


<head>
<title> FCIT ERM </title>
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
        <li><a href="home_visitor.php">Publications</a></li>
        <li><a class="active" href="visitor.php">Doctors</a></li>
        
       
      </ul>
	
</div>

<div id="main">
<?php	
				 $con = mysqli_connect("localhost","root","","senior_project");
                        $members = mysqli_query($con,"SELECT * FROM members ");
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
	  	

























</div>
</body>



</html>
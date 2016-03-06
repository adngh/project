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
<html>
<head>
<title>Title of your search engine</title>
</head>
<body>
<form action='search.php' method='GET'>
<center>
<h1>Search publications or authors</h1>
<input type='text' size='90' name='search'></br></br>
<input type='submit' name='submit' value='search' ></br></br></br>
</center>
</form>
</body>
</html>
	  	

























</div>
</body>



</html>
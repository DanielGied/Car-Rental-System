<!-- 
Name of screen: db.inc.php
Purpose of screen: Connection to database 
Student ID: C00260331
Date: March, 2022
-->

<?php
$hostname = "localhost:3306 (MariaDB)"; 
$username = "CarRental";
$password = "carrental";

$dbname = "CarRental";

$con = mysqli_connect($hostname,$username,$password, $dbname);

if (!$con)
	{
	die ("Failed to connect to MySQL: " . mysqli_connect_error());
	}
?>
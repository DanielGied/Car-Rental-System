<!-- 
Name of screen: CarReport.php
Purpose of screen: Show a table with the details for ModelName,Manufacturer,Registration,Status,DateAddedToFleet and CumulativeRecords
Student ID: C00260331
Date: March, 2022
-->

<! DOCTYPE html>
<html>
<head>

<!-- Title of the page -->
<title>
Car Rental System
</title>

<link rel="stylesheet" href="Report.css">
</head>

<!-- Page Menu at the top of the page, user can go between different pages -->
<body>
	<section>
		<nav class="page__menu page__custom-settings menu">			
			<ul class="menu__list r-list">
			<li class="menu__group"><a href="menu.html" class="menu__link r-link text-underlined">Main Menu</a></li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Car</a></li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Company</a></li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Blacklist</a> 
			<li class="menu__group">
			<a href="#0" class="menu__link r-link text-underlined">Category</a>
			<ul>
					<li><a href="AddRental.html">Add Renal Category</a></li>
					<br>
					<li><a href="DeleteRental.html.php">Delete Rental Category</a></li>
					<br>
					<li><a href="AmendViewRental.html.php">Amend/view Category</a></li>
				</ul>
			</li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Returns</a></li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Rentals</a></li>
			<li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Rental Report</a></li>
			<li class="menu__group"><a href="CarReport.php" class="menu__link r-link text-underlined">Car Report</a></li>
			</ul>
		</nav>
	</section>	
<br/>

<!-- Color div is used for the background image -->	
<div class="color">
<h3 align="center">
<br/><br/><br/><br/><br/>
</h3>

<?php 
include 'db.inc.php'; // Database connection
date_default_timezone_set('UTC'); // Sets the default timezone used by all date/time functions in the script
?>

<form action = "CarReport.php" method = "post" name = "reportForm">
<input type = "hidden" name = "choice">

<center>
<legend><h2>Car Report</h2></legend>
<br><br>
<h3>(Click a button to see the Car Report in the desired order)</h3>
<br><br>

<!-- 3 different types of buttons you can use for the car report -->	
<input type = 'button' id = "modelButton" value = 'Model Name Order'
onclick = 'modelOrder()' title = 'Click here to see Cars in alphabetical order of Model'>

<input type = 'button' id = "popularCarsButton" value = 'Popular Cars Order'
onclick = 'popularOrder()' title = 'Click here to see Cars in descending order of cumulative rentals'>

<input type = 'button' id = "dateButton" value = 'Date Added to Fleet Order'
onclick = 'dateOrder()' title = 'Click here to see Cars in reverse date order'>
</center>
<br>
<br>
<center>

<script>
function modelOrder() // modelOrder() function 
{
	document.reportForm.choice.value = "ModelName";
	document.reportForm.submit();
}
function popularOrder() // popularOrder() function
{
	document.reportForm.choice.value = "CumulativeRecords";
	document.reportForm.submit();
}
function dateOrder() // dateOrder() function
{
	document.reportForm.choice.value = "DateAddedToFleet";
	document.reportForm.submit();
}
</script>

<?php

$choice = "ModelName"; 
if (ISSET($_POST['choice'])) // Model name is in alphabetical order by default
{
$choice = $_POST['choice'];
}
if ($choice == "DateAddedToFleet") // If Date Added to Fleet Order button is clicked is shows dates in ascending order
{
?>
	<script>
	document.getElementById("dateButton").disabled = true;
	document.getElementById("modelButton").disabled = false;
	document.getElementById("popularCarsButton").disabled = false;
	</script>
	
<?php
	
	$sql = "SELECT * FROM CarReport WHERE DeletedFlag = false ORDER BY DateAddedToFleet ASC";
	produceReport($con,$sql);
}
else if ($choice == "ModelName") // If Model Name Order button is clicked is shows model names in order
{
?>
	<script>
	document.getElementById("modelButton").disabled = true;
	document.getElementById("dateButton").disabled = false;
	document.getElementById("popularCarsButton").disabled = false;
	</script>
<?php
	$sql = "SELECT * FROM CarReport where DeletedFlag = false ORDER BY ModelName";
	produceReport($con,$sql);
}
else // If Popular Cars Order button is clicked is shows Cars in descending order of cumulative rentals
{
?>
	<script>
	document.getElementById("popularCarsButton").disabled = true;
	document.getElementById("modelButton").disabled = false;
	document.getElementById("dateButton").disabled = false;
	</script>
<?php
	$sql = "SELECT * FROM CarReport where DeletedFlag = false ORDER BY CumulativeRecords DESC";
	produceReport($con,$sql);
};

// The produceReport() function prints out the table with the details for ModelName,Manufacturer,Registration,Status,DateAddedToFleet and CumulativeRecords
function produceReport($con,$sql)
{
	$result = mysqli_query($con,$sql); // The mysqli_query() function performs a query against the database
	
	echo "<table>
			<tr><th>Model Name</th><th>Manufacturer</th><th>Registration Number</th><th>Status</th><th>Date Added To Fleet</th><th>Cumulative Records</th></tr>";
			
	while ($row=mysqli_fetch_array($result))
		
		{
			$date = date_create($row['DateAddedToFleet']); // The date_create() function returns a new DateTime object.
			$FDate = date_format($date,"d/m/Y"); // The date_format() function returns a date formatted according to the specified format
			
			echo	"<td align=center>".$row['ModelName']."</td>
					<td align=center>".$row['Manufacturer']."</td>
					<td align=center>".$row['RegistrationNumber']."</td>
					<td align=center>".$row['Status']."</td>
					<td align=center>".$FDate."</td>
					<td align=center>".$row['CumulativeRecords']."</td>
					</tr>";
		}
		echo "</table>";
}

	mysqli_close($con); //Specifies the MySQL connection to close
?>
</center>
</form>
</body>
</html>
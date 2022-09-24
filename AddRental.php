<!-- 
Name of screen: AddRental.php
Purpose of screen: Add rental categorys to the database with details for each rental category
Student ID: C00260331
Date: March, 2022
-->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<!-- Title of the page -->
<title>
Car Rental System
</title>

<link rel="stylesheet" href="Form.css"> <!-- Link to css page -->
</head>

<!-- Nav bar Menu at the top of the page, user can go between different screens -->
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
<br/><br/>
</h3>

<center>
<form action = "AddRental.html" method = "POST">
<br>
<?php
include 'db.inc.php'; // Database connection

// Insert the details the user entered for rentalcategory, standardcost, fiveday and tenday into RentalCategory table
$sql = "Insert into RentalCategory (rentalcategory,standardcost,fiveday,tenday)
VALUES ('$_POST[rentalcategory]','$_POST[standardcost]','$_POST[fiveday]','$_POST[tenday]')";

if (!mysqli_query($con,$sql)) //If rental category is already in database echo message below
{
	echo "<br><br><br><br><br><br>"; //Line Break
	echo ("<br>Rental category ". $_POST['rentalcategory'] . " is already in the database!<br>"); //Print rental category is already in database
	echo "<br>Return to the insert page to pick a different Rental Category"; //Print message
}
else // Else echo message below that a new rental category has been added to the database
{
	echo "The details sent into the database are: <br><br>"; //Heading of form

	echo "Rental category is :" . $_POST['rentalcategory'] . "<br><br>"; //Shows Rental Category the user entered
	echo "Standard cost is :" . $_POST['standardcost'] . " Euro" . "<br><br>"; //Shows Standard cost the user entered
	echo "Five day dicount is :" . $_POST['fiveday'] . "%" . "<br><br>"; //Shows Five day discount the user entered
	echo "Ten day dicount is :" . $_POST['tenday'] . "%" . "<br>"; //Shows Ten day discount the user entered
	
	echo "<br>A record has been added for rental category: " . $_POST['rentalcategory'] . ".";
}
echo "<br>"; //Line Break
echo "<br>"; //Line Break

mysqli_close($con); //Specifies the MySQL connection to close
?>

<!-- Button to go back to the AddRental.html screen -->
<input type="submit" value = "Return to Add Rental Category Page"/>
</center>

</form>
</body>
</html>
<!-- 
Name of screen: ListBoxRental.php
Purpose of screen: Display List box of rental categorys
Student ID: C00260331
Date: March, 2022
-->

<?php
include "db.inc.php";//database connection

// Select all of the Rental Categorys that have a DeletedFlag of 0, to display in the listbox
$sql = "SELECT rentalcategory, standardcost, fiveday, tenday FROM RentalCategory where DeletedFlag = 0";

if (!$result = mysqli_query($con, $sql)) // The mysqli_query() function performs a query against the database
{
die( 'Error in querying the database' . mysqli_error($con)); //  Print message and exit from the current php script
}

echo "<br><select name = 'listboxrental' id = 'listboxrental' onclick = 'populate()'>";

while ($row = mysqli_fetch_array($result))	// Show all of the details for the selected rental category
{
	$category = $row['rentalcategory'];
	$scost = $row['standardcost'];
	$fday = $row['fiveday'];
	$tday = $row['tenday'];
	$allText = "$category,$scost,$fday,$tday";
	echo "<option value = '$allText'>$category</option>";
}
echo "</select>";
mysqli_close($con); //Specifies the MySQL connection to close

?>
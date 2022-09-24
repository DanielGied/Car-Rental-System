<!-- 
Name of screen: AmendViewRental.php
Purpose of screen: Amend details of rental categorys to the database
Student ID: C00260331
Date: March, 2022
-->

<?php	session_start(); // A session is started with the session_start() function
?><br><br>
<?php
include 'db.inc.php'; // Database connection

// Update Rental Category details if user decides to amend details for the RentalCategory table
$sql = "UPDATE RentalCategory SET standardcost = '$_POST[amendstandardcost]', 
		fiveday = '$_POST[amendfiveday]',
		tenday = '$_POST[amendtenday]' WHERE rentalcategory = '$_POST[amendrentalcategory]' ";

if (! mysqli_query($con,$sql )) // The mysqli_query() function performs a query against the database
{
	echo "Error ".mysqli_error($con); //Print error message
}

$_SESSION["rentalcategory"] = $_POST['amendrentalcategory']; // Set session variable

mysqli_close($con); //Specifies the MySQL connection to close
?>

<script>
window.location = "AmendViewRental.html.php" // window.location object can is used to get the current page address URL and to redirect the browser to a new page
</script>

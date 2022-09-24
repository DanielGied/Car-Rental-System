<!-- 
Name of screen: DeleteRental.php
Purpose of screen: Delete rental categorys from the database / listbox
Student ID: C00260331
Date: March, 2022
-->

<?php	session_start(); // A session is started with the session_start() function
?><br><br>
<?php
include 'db.inc.php'; //Database connection

// Set 1 to the DeletedFlag if the user decides to delete a rental category, which will remove the rental category from the listbox to.
$sql = "UPDATE RentalCategory SET DeletedFlag = true WHERE rentalcategory = '$_POST[delrentalcategory]'";

if (! mysqli_query($con,$sql )) // The mysqli_query() function performs a query against the database
{
	echo "Error ".mysqli_error($con); //Print error message
}

// Set session variables
$_SESSION["rentalcategory"] = $_POST['delrentalcategory'];
$_SESSION["standardcost"] = $_POST['delstandardcost'];
$_SESSION["fiveday"] = $_POST['delfiveday'];
$_SESSION["tenday"] = $_POST['deltenday'];

mysqli_close($con); //Specifies the MySQL connection to close

?>
<script>
window.location = "DeleteRental.html.php" // window.location object can is used to get the current page address URL and to redirect the browser to a new page
</script>
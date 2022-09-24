<!-- 
Name of screen: AmendViewRental.html.php
Purpose of screen: Amend details of rental categorys to the database
Student ID: C00260331
Date: March, 2022
-->

<?php session_start(); // A session is started with the session_start() function
?>
<!DOCTYPE html>
<html>
<head>

<!-- Title of the page -->
<title>
Car Rental System
</title>

<link rel="stylesheet" href="Form.css"> <!-- Link to css page -->
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
	
<!-- Color div is used for the background image -->	
<div class="color">
<h3 align="center">
<br/><br/>
</h3>
<br><br><br><br>

<form name="myForm" action="AmendViewRental.php" onsubmit="return confirmCheck()" method="post">
<fieldset id="1">

<legend><h3 style="text-align:center;">Amend/View a Rental Category</h3></legend>
<br>
<h4 style="text-align:center;">Please select a rental category and then click the amend button if you wish to update.</h4>

<center>
<?php include 'ListBoxRental.php';?> <!-- List box with all of the rental category options -->	
<br><br>

<script>
// The populate() function populates details of each rental category when clicked onto
function populate()
{
var sel = document.getElementById("listboxrental"); // Create a variable called sel and return element listboxrental
var result; // Create a variable called result
result = sel.options[sel.selectedIndex].value;
var rentalDetails = result.split(',');
document.getElementById("display").innerHTML;
document.getElementById("amendrentalcategory").value = rentalDetails[0]; 
document.getElementById("amendstandardcost").value = rentalDetails[1];
document.getElementById("amendfiveday").value = rentalDetails[2];
document.getElementById("amendtenday").value = rentalDetails[3];
}

// The toggleLock() function is used to lock the details if the user is on the 'view details' button and if the user clicks the
// 'amend details' button it will unlock all of the details and let the user change what ever they want appar from the rental category which is always locked
function toggleLock()
{
if (document.getElementById("amendViewbutton").value == "Amend Details")
{
document.getElementById("amendstandardcost").disabled = false;
document.getElementById("amendfiveday").disabled = false;
document.getElementById("amendtenday").disabled = false;
document.getElementById("amendViewbutton").value = "View Details";
}
else
{
document.getElementById("amendstandardcost").disabled = true;
document.getElementById("amendfiveday").disabled = true;
document.getElementById("amendtenday").disabled = true;
document.getElementById("amendViewbutton").value = "Amend Details";
}
}

// The confirmCheck() function gives the user a pop up if they are sure they want to save the changes.
function confirmCheck()
{
var response; // Create a variable called response
response = confirm('Are you sure you want to save these changes?');
if (response)
{	document.getElementById("amendrentalcategory").disabled = false;
	document.getElementById("amendstandardcost").disabled = false;
	document.getElementById("amendfiveday").disabled = false;
	document.getElementById("amendtenday").disabled = false;	
	return true;
}
else
{
	populate();
	toggleLock();
	return false;
}
}
</script>

<p id = "display"> </p>
<input type = "button" value = "Amend Details" id = "amendViewbutton" onclick = "toggleLock()">

<br><br>
<label for "amendrentalcategory">Rental Category Identification:</label>
<input type = "text" name = "amendrentalcategory" id = "amendrentalcategory" pattern="[A-Za-z]{1}" disabled>
<br><br>
<label for "amendstandardcost">Standard Cost:</label>
<input type = "number" name = "amendstandardcost" id = "amendstandardcost" step="0.01" min="0" disabled>
<br><br>
<label for "amendfiveday">Five Day discount:</label>
<input type = "number" name = "amendfiveday" id = "amendfiveday" step="0.01" min="0" max="100" disabled>
<br><br>
<label for "amendtenday">Ten Day discount:</label>
<input type = "number" name = "amendtenday" id = "amendtenday" step="0.01" min="0" max="100" disabled>
<br><br>
<input type = "submit" value = "Save Changes">
</form>
</center>
<center>
<br>
<?php
	
	if (ISSET($_SESSION["rentalcategory"])) //The isset() function checks if the "rentalcategory" variable has already been set. If "rentalcategory" has been set, print message.
	{ 
		echo "<h2 class='myMessage'>Rental Category ".
		$_SESSION["rentalcategory"] . " Updated" . "</h2>";
	}
	session_destroy(); //Destroys all data registered to a session
	
?>
</center>
</body>
</html>
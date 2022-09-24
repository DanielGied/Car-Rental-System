<!-- 
Name of screen: DeleteRental.html.php
Purpose of screen: Delete rental categorys from the database / listbox
Student ID: C00260331
Date: March, 2022
-->

<?php session_start(); // A session is started with the session_start() function
?>
<html>
<head>

<!-- Title of the page -->
<title>
Car Rental System
</title>

<link rel="stylesheet" href="Form.css"> <!-- Link to css page -->
</head>

<body>
<!-- Page Menu at the top of the page, user can go between different pages -->
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

<form name="deleteForm" action="DeleteRental.php" onsubmit="return confirmCheck()" method="post">
<fieldset id="1">

<legend><h3 style="text-align:center;">Delete a Rental Category</h3></legend>
<br>
<h4 style="text-align:center;">Please select a rental category and then click the delete button.</h4>

<center><?php include 'ListBoxRental.php'; ?></center> <!-- List box with all of the rental category options -->	
<br>

<script>

// The populate() function populates details of each rental category when clicked onto
function populate()
{
var sel = document.getElementById("listboxrental"); // Create a variable called sel and return element listboxrental
var result; // Create a variable called result
result = sel.options[sel.selectedIndex].value;
var rentalDetails = result.split(',');
document.getElementById("display").innerHTML;
document.getElementById("delrentalcategory").value = rentalDetails[0];
document.getElementById("delstandardcost").value = rentalDetails[1];
document.getElementById("delfiveday").value = rentalDetails[2];
document.getElementById("deltenday").value = rentalDetails[3];
}

// The confirmCheck() function gives the user a pop up if they are sure they want to save the changes.
function confirmCheck()
{
var response; // Create a variable called response
response = confirm('Are you sure you want to delete this rental category?');
if (response)
{	document.getElementById("delrentalcategory").disabled = false;
	document.getElementById("delstandardcost").disabled = false;
	document.getElementById("delfiveday").disabled = false;
	document.getElementById("deltenday").disabled = false;	
	return true;
}
else
{
	populate();
	return false;
}
}	
</script>

<p id = "display"> </p>
<center>
<label for "delrentalcategory">Rental Category Identification:</label>
<input type = "text" name = "delrentalcategory" id = "delrentalcategory" disabled>
<br><br>
<label for "delstandardcost">Standard Cost:</label>
<input type = "number" name = "delstandardcost" id = "delstandardcost" disabled>
<br><br>
<label for "delfiveday">Five Day discount:</label>
<input type = "number" name = "delfiveday" id = "delfiveday" disabled>
<br><br>
<label for "deltenday">Ten Day discount:</label>
<input type = "number" name = "deltenday" id = "deltenday" disabled>
<br><br>
<input type = "submit" value = "Delete Rental Category">
</center>
</form>
<center>
<br>
<?php
	
	if (ISSET($_SESSION["rentalcategory"])) //The isset() function checks if the "rentalcategory" variable has already been set. If "rentalcategory" has been set, print message.
	{ 
		echo "<h2 class='myMessage'>Record deleted for ".
		$_SESSION["rentalcategory"] . "</h2>" ;
	}
	session_destroy(); //Destroys all data registered to a session
	
?>
</center>
</body>
</html>
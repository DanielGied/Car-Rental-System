<center>
<style>
body {
  background-color: #37a0d9;
}
</style>
<?php include 'db.inc.php';
session_start();
echo '<link rel="stylesheet" href="pass.css" type="text/css">';
echo "<br><br><br><br><br><br><br><br><br><br>";
if (isset($_POST['loginName']) && isset($_POST['passWord']))
{
	$attempts = $_SESSION['attempts'];
	
	$sql = "SELECT * FROM password WHERE loginName = '$_POST[loginName]' AND password = '$_POST[passWord]'";
	
	if (!mysqli_query($con, $sql))
		echo "Error in query " . mysqli_error($con);
	else
	{
		if (mysqli_affected_rows($con) == 0)
		{
			$attempts++;
			
			if ($attempts <=3)
			{	$_SESSION['attempts'] = $attempts;
				buildPage($attempts);
				
				echo "<div class='errorstyle'>No record found with this login name and password combination - Please try again.</div>";
			}
			else
			{
				echo "<div class='errorstyle'>Sorry - You have used all 3 attempts<br>
					 shutting down ...</div>";	
			}
		}
		else
		{
			//Sucessful login
			$_SESSION['user'] =$_POST['loginName']; //Session Variable to keep track of the login name
													// for use with Change password screen
			echo " <h2> Login Successful!</h2>
				   <h2>Welcome to our Car Rental Website</h2>
				   <h3> Do you want to change password or go directly to the Main Menu?</h3>
				   
				   <input type ='button' value = 'Change Password' onclick = 'window.location = \"changePass.php\"'>
				   
				   <input type = 'button' value = 'Main Menu' onclick = 'window.location = \"menu.html\"'>";
		}
	}
}
else
{
	// building page for initial display
	$attempts = 1; // Screen will be displayed for first attempts
	$_SESSION['attempts'] = $attempts; // Set seesion variables so that the number of attempts can be counted
	buildPage($attempts); // parameter passed so that a heading can display the number of attempts
};

function buildPage($att)
{
	echo " <body>
	
			<form action = 'loginScreen.php' method = 'post'>
			<h1>Car Rental Website</h1>
			<h2>Attempt Number: $att </h2>
			<label for 'loginName'>Login Name</label>
			<input type = 'text' name = 'loginName' id = 'loginName' autocomplete = 'off'/><br><br>
			<label for 'password'>Password</label>
			<input type = 'password' name = 'passWord' id = 'passWord' ><br><br>
			<input type = 'submit' value = 'Submit'>
			</form>";
}

mysqli_close($con);
?>
</center>		
				
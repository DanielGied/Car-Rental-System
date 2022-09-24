<center>
<style>
body {
  background-color: #37a0d9;
}
</style>
<?php include 'db.inc.php';
session_start();
echo '<link rel="stylesheet" href = "pass.css" type="text/css">';
echo "<br><br><br><br><br><br><br><br><br><br>";
if (isset($_SESSION['user'])) // checks whether a user has logged in
{
	if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['confirmPass']))
	{
		$old = $_POST['oldPass'];
		$new = $_POST['newPass'];
		$confirm = $_POST['confirmPass'];
		
		$user = $_SESSION['user'];
		
		$sql = "SELECT * FROM password WHERE loginName = '$user' AND passWord = '$_POST[oldPass]'";
		if (! mysqli_query($con, $sql))
			echo "Error in Select query ".mysqli_error($con);
		else
		{
			if (mysqli_affected_rows($con) == 0)
			{
				buildPage($old, $new, $confirm);
				echo "<div class='errorstyle'>Old password incorrect!</div>";
			}
			else
			{
				if($_POST['newPass'] != $_POST['confirmPass'])
				{
					buildPage($old, $new, $confirm);
					echo "<div class='errorstyle'>New passwords do not match - Please try again.</div>";
				}
				else
				{
					$sql = "UPDATE password SET passWord = '$_POST[newPass]' WHERE loginName = '$user' ";
					if (! mysqli_query($con, $sql))
						echo "Error in Update query ".mysqli_error($con);
					else
					{
						if (mysqli_affected_rows($con) == 0)
						{
							buildPage($old, $new, $confirm);
							echo "<div class='errorstyle'>No changes made!</div>";
						}
						else
						{
							echo "<div class='errorstyle'>Congratulations, your password has been updated!</div>
								 <h3><input type = 'button' value = 'Proceed to Main Menu' onclick = 'window.location = \"menu.html\"'></h3> ";
							session_destroy();
						}
					}
				}
			}
		}
	}
	else
	{
		buildPage("", "", "");
	}
}
else
{
	echo '<div class="nologin">You must be logged in to view this page</div>';
}

function buildPage($o,$n,$c)
{
	echo " <body>
	
		   <form action = 'changePass.php' method = 'post'>
		   <h1>My System</h1>
		   <h3>Change Password</h3>
		   <label for 'oldPass'>Old Password</label>
		   <input type = 'password' name = 'oldPass' id = 'oldPass' autocomplete = 'off' value = $o ><br><br>
		   <label for 'newPass'>New Password </label><input type = 'password' name = 'newPass' id = 'newPass' value $n><br><br>
		   <label for 'confirmPass'>Confirm New Password </label><input type = 'password' name = 'confirmPass' id = 'confirmPass' value = $c><br><br>
		   <input type= 'submit' value = 'submit'>
		   </form>";
}

mysqli_close($con);
?>
</center>
<?php
	//configuration
	require("includes/config.php");

	//if the user reached via GET (as by clicking a link or direct)
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//prompt to login
		render("login.php", ["title" => "Login"]);
	}
	//else if user reached via POST (submitting a form)
	else if($_SERVER["REQUEST_METHOD"] == "POST") {
		//validate submission
		if(empty($_POST["username"]))
		{
			reporterror("Username blank!");
			//echo "Username blank";
		}
		else if(empty($_POST["password"]))
		{
			reporterror("Password blank!");
			//echo "Password blank!";
		}
		
		//select database for user
		$users = "SELECT * FROM `users` WHERE `username` = '".$_POST["username"]."'";
		
		if ($result = mysqli_query($conn,$users))
		{
		  // Fetch one and one row
		  while ($row = mysqli_fetch_array($result))
		    {
			    //username and password with database
			    if (password_verify($_POST["password"], $row["hash"]))
	            {
	                // remember that user's now logged in by storing user's ID in session
	                $_SESSION["id"] = $row["id"];

	                // redirect to portfolio
	                redirect("whiteboard.php");
	            }
		    }
		  // Free result set
		  mysqli_free_result($result);
		}

		//else display error
		reporterror("Invalid Username or Password!");
	}
 ?>
<?php
	//configuration
	require("includes/config.php");

	if(empty($_SESSION["id"]))
	{
		//if not logged in redirect to login page
		redirect("login.php");
	}
	else
	{
		//get user details
		$userid = $_SESSION["id"];
		$users = "SELECT * FROM `users` WHERE id = '".$userid."'";

		//fetch data from mysql table
		if ($result = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in " . $users))
		{
		  // Fetch one and one row
		  while ($row = mysqli_fetch_array($result))
		    {
		    	$username = $row["username"];
		    	$firstname = $row["firstname"];
		    	$lastname = $row["lastname"];
		    	$email = $row["email"];
		    	$profile_pic = $row["profile_pic"];
		    }
		  // Free result set
		  mysqli_free_result($result);
		}

		//render template	
		render("account.php", ["title" => "My Account", "username" => $username, "firstname" => $firstname, "lastname" => $lastname, "email" => $email, "profile_pic" => $profile_pic]);
	}

?>
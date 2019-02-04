<?php
	//**
	//this is help page
	//all usage and FAQ details will come here

	//configuration
	include("includes/config.php");

	//***
	//get current user id
	// $userid = $_SESSION["id"];
	// //query mysql table for user details
	// $users = "SELECT * FROM `users` WHERE id = '".$userid."'";
	// //fetch user data from current user row
	// if($result = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in" . $users))
	// {
	// 	while($row = mysqli_fetch_array($result))
	// 	{
	// 		//get user firstname to display on header
	// 		$firstname = $row["firstname"];
	// 	}
	// }

	//render help template
	render("help.php", ["title" => "All about posti"]);

?>
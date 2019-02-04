<?php
	//configuration
	include("includes/config.php");

	//check if user is logged in
	if(empty($_SESSION["id"]))
	{
		//redirect user to login page
		redirect("login.php");
	}
	else
	{
		//display purpose
		//***
		//get admin user id
		$userid = $_SESSION["id"];
		//query mysql table for user details
		$users = "SELECT * FROM `users` WHERE id = '".$userid."'";
		//fetch user data from current user row
		if($result = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in" . $users))
		{
			while($row = mysqli_fetch_array($result))
			{
				//get user firstname to display on header
				$firstname = $row["firstname"];
				$lastname = $row["lastname"];
				$profile_pic = $row["profile_pic"];
			}
		}

		/**
		* if it's reached through GET render form
		**/
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			render("invite_friend.php", ["title" => "Invite a friend to join Posti", "firstname" => $firstname, "profile_pic" => $profile_pic]);
		}

		//***
		//if user reached via form submission
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//***
			//check if request has a user-id
			if(empty($_POST["friends_email"]))
			{
				reporterror("Please enter a valid email id!");
			}
			else
			{
				/**
				* collect user data and send email
				**/
				//get values for email
	        	$firstname = $firstname;
	        	$lastname = $lastname;
	        	$friends_email = $_POST["friends_email"];
	        	//send email variables
	        	$from = "no_reply@postisquare.com";
	        	$from_name = "Posti";
	        	$subject = "Posti - {$firstname} invited you to join Posti!";
	        	$message = "<p>Welcome to Posti!<p><p>Complete your registration by clicking the following link: </p><p><a href='http://localhost/cs50/posti/register.php'>Join Now</a></p><p>Thanks,</p><p>Posti Team</p>";
	        	//send email notification (confirm registration)
	        	//send_email($to, $to_name, $from, $from_name, $subject, $message)
	        	send_email($friends_email, $firstname, $from, $from_name, $subject, $message);
	        	//var_dump($email, $firstname, $from, $from_name, $subject, $message);

				//redirect to confirmation page
				render("friend_invite_success.php", ["title" => "Friend invitation successfully sent", "firstname" => $firstname, "profile_pic" => $profile_pic]);

				}
			}
			//var_dump($users_data);

	}

	//render add friend form template
	render("add_friend.php", ["title" => "Add a friend", "firstname" => $firstname, "users_data" => $users_data, "total_users" => $total_users]);

?>
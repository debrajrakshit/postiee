<?php
	//configuration
	include("includes/config.php");

	//check for session
	if(empty($_SESSION["id"]))
	{
		//if session empty redirect to login page
		redirect("login.php");
	}
	else
	{
		//***
		//get current user id
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
				$profile_pic = $row["profile_pic"];
			}
		}

		//***
		//get friends list
		//query in friends sql table with user-id and collect all friend's user ids
		$friends_list_id = array();
		$friends_list = "SELECT * FROM `friends` WHERE `admin_user_id` = '".$userid."'";
		if($friends_data = mysqli_query($conn, $friends_list) or trigger_error(mysql_error() . "in " . $friends_list))
		{
			foreach($friends_data as $friends)
			{
				$friends_list_id[] = [
					"id" => $friends["friend_user_id"]
				];
			}
		}
		//var_dump($friends_list_id);

		//after geting the IDs, query into users table to get the user details and save into an array
		//pass that array into template parameters
		//total friends
		$total_friends = count($friends_list_id);

		//***
		//query in the user table with the ids and save user detials in an array
		$all_friends_data = array();
		foreach($friends_list_id as $friend_list_id)
		{
			//query in users table with each friends-id
			$friend_data_query = "SELECT * FROM `users` WHERE `id` = '".$friend_list_id["id"]."'";
			if($friend_data_rows = mysqli_query($conn, $friend_data_query) or trigger_error(mysql_error() . "in " . $friend_data_query))
			{
				while($friend_data = mysqli_fetch_array($friend_data_rows))
				{
					$all_friends_data[] = [
						"user_id" => $friend_data["id"],
						"firstname" => $friend_data["firstname"],
						"lastname" => $friend_data["lastname"],
						"user_profile_pic" => $friend_data["profile_pic"]
					];
				}
			}
		}
		//var_dump($all_friends_data);
		//render friends template
		render("friends.php", ["title" => "{$firstname}'s Friends", "firstname" => $firstname, "profile_pic" => $profile_pic, "friend_list" => $all_friends_data, "total_friends" => $total_friends]);

	}

?>
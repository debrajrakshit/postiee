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
				$profile_pic = $row["profile_pic"];
			}
		}

		//***
		//check if user has friends in friends table
		$friend_id_list = array();
		$firend_query = "SELECT `friend_user_id` FROM `friends` WHERE `admin_user_id` ='".$userid."' ";
		if($friend_rows = mysqli_query($conn, $firend_query) or trigger_error(mysql_error() . "in " . $firend_query))
		{
			while($friend_ids = mysqli_fetch_array($friend_rows))
			{
				$friend_id_list[] = $friend_ids["friend_user_id"];
			}
		}
		//var_dump($friend_id_list);

		//***
		//get all user ids and their data
		$users_data = array();
		$users_list_query = "SELECT * FROM `users`";
		if($user_list_rows = mysqli_query($conn, $users_list_query) or trigger_error(mysql_error() . "in " . $users_list_query))
		{
			foreach($user_list_rows as $user_row)
			{
				//check if user id is current user or it's friends
				//check if user is activated
				//if found don't add into array
				//var_dump($user_row["id"]);
				if(($user_row["id"] != $userid) && (!in_array($user_row["id"], $friend_id_list)) && $user_row["user_status"] == 0)
				{
					//users can be added as friends
					$users_data[] = [
						"id" => $user_row["id"],
						"firstname" => $user_row["firstname"],
						"lastname" => $user_row["lastname"],
						"user_profile_pic" => $user_row["profile_pic"]
					];
				}
			}
		}

		/**
		* check if request already been sent
		**/
		$request_status = array();
		$pending_requests = "SELECT * FROM `friend_request` WHERE `user_id` = $userid";
		if($rows = mysqli_query($conn, $pending_requests) or trigger_error(mysql_error() . "in " . $pending_requests))
		{
			while($row = mysqli_fetch_array($rows))
			{
				$request_status[] = [
					"friend_user_id" => $row["friend_user_id"]
				];
			}
		}
		//var_dump($request_status);

		//total user count
		$total_users = count($users_data);

		//***
		//when add friend button request sent
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//***
			//check if request has a user-id
			if(empty($_POST["friend_id"]))
			{
				reporterror("No user found!");
			}
			else
			{
				//get all the user_ids in $users_data as an array
				$friends_available = array();
				foreach($users_data as $user_id)
				{
					$friends_available[] = $user_id["id"];
				}
				//var_dump($friends_available);
				////var_dump($_POST["request_type"]);
				//check if friend-id is non-friend list and exists in database
				if(in_array($_POST["friend_id"], $friends_available))
				{
					
					/**
					* NEED IMPROVEMENT
					* check if there are requests
					* check if alreay request sent
					* then do not send again
					**/
					if(!empty($request_status))
					{
						foreach($request_status as $request_sent)
						{
							if($request_sent["friend_user_id"] == $_POST['friend_id'])
							{
								//do nothing
							}
							else
							{
								/**
								* create record on freind_request table
								**/
								$friend_request = "INSERT INTO `friend_request`(`user_id`, `friend_user_id`) VALUES ({$userid}, ".$_POST['friend_id'].")";
								mysqli_query($conn, $friend_request) or trigger_error(mysql_error() . "in " . $friend_request);
								//var_dump("Send method " + $_POST["friend_id"], $_POST["request_type"]);
							}
						}
					}
					else
					{
						/**
						* create record on freind_request table
						**/
						$friend_request = "INSERT INTO `friend_request`(`user_id`, `friend_user_id`) VALUES ({$userid}, ".$_POST['friend_id'].")";
						mysqli_query($conn, $friend_request) or trigger_error(mysql_error() . "in " . $friend_request);
						//var_dump("Send method " + $_POST["friend_id"], $_POST["request_type"]);
					}
					


					//get the new friend's name
					// $new_friend = array();
					// foreach($users_data as $user)
					// {
					// 	if($user["id"] == $_POST['friend_id'])
					// 	{
					// 		$new_friend = [
					// 			"firstname"	=> $user["firstname"],
					// 			"lastname" => $user["lastname"]
					// 		];
					// 	}
					// }
					//var_dump($new_friend);

					/**
					* add track record
					* get admin id of current object
					**/
					//$friend_id = intval($_POST["friend_id"]);
					//var_dump($admin_user_id);

					//query for update record in mod-history
					//$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('friend', {$friend_id}, {$userid}, {$userid}, 'add')";
					//$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
					//var_dump($record_history);


					//redirect to confirmation page
					//render("friend_add_success.php", ["title" => "Friend add successful", "firstname" => $firstname, "new_friend" => $new_friend]);
				}
			}
			//var_dump($users_data);
			
			
		}

	}

	//render add friend form template
	render("add_friend.php", ["title" => "Add a friend", "firstname" => $firstname, "profile_pic" => $profile_pic, "users_data" => $users_data, "total_users" => $total_users, "request_status" => $request_status]);

?>
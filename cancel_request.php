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
						"lastname" => $user_row["lastname"]
					];
				}
			}
		}


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
				$friend_request = "DELETE FROM `friend_request` WHERE `friend_user_id` = ".$_POST['friend_id']."";
				mysqli_query($conn, $friend_request) or trigger_error(mysql_error() . "in " . $friend_request);
				//var_dump("Send method " + $_POST["friend_id"], $_POST["request_type"]);

			}
			//var_dump($users_data);
			
			
		}

	}

	//render add friend form template
	//render("add_friend.php", ["title" => "Add a friend", "firstname" => $firstname, "users_data" => $users_data, "total_users" => $total_users, "request_status" => $request_status]);

?>
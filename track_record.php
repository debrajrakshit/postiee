<?php 
	//configuration
	require("includes/config.php");

	//check user request method
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//check for user login session
		if(empty($_SESSION["id"]))
		{
			//redirect to login
			redirect("login.php");
		}
		else
		{
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

			//collect data from mod_history table
			$track_record_data = array();
			//select rows where both admin and user id are identical
			$mod_history = "SELECT A.* FROM `mod_history` A INNER JOIN (SELECT `user_id`, `admin_id` FROM `mod_history` WHERE `admin_id`={$userid} OR `user_id`={$userid} GROUP BY `user_id`, `admin_id` HAVING COUNT(*) > 1) B ON A.`user_id` = B.`user_id` AND A.`admin_id` = B.`admin_id`" ;
			if($rows = mysqli_query($conn, $mod_history) or trigger_error(mysql_error() . "in ". $mod_history))
			{
				while($row = mysqli_fetch_array($rows))
				{
					//get user first name from user_id(params.php)
					$user_firstname = user_fname($conn, intval($row["user_id"]));

					//save data into array
					$track_record_data[] = [
						"obj_type" => $row["obj_type"],
						"obj_id" => $row["obj_id"],
						"firstname" => $user_firstname,
						"mod_type" => $row["mod_type"],
						"mod_time" => $row["mod_time"]
					];
				}
			}
			//var_dump($track_record_data);

			//render track record template
			render("track_record.php", ["title" => "Track Record", "firstname" => $firstname, "profile_pic" => $profile_pic, "track_records" => $track_record_data]);


		}
	}

	//if user reached by any other method/ without log in/ redirect to whiteboard
	//redirect("whiteboard.php");

?>
<?php
	//configuration
	include("includes/config.php");

	//***
	//check if user is logged in
	if(empty($_SESSION["id"]))
	{
		//redirect to login page
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
		//get projects of current user
		$project_data_list = array();
		$project_query = "SELECT * FROM `project_assigned` WHERE `user_id` = '".$userid."'";
		if($project_data = mysqli_query($conn, $project_query) or trigger_error(mysql_error() . "in " . $project_query))
		{
			foreach($project_data as $project_assigned)
			{
				$project_data_list[] = [
					"id" => $project_assigned["id"],
					"user_id" => $project_assigned["user_id"],
					"project_id" => $project_assigned["project_id"],
					"admin" => $project_assigned["admin"]
				];
			}
		}
		//var_dump($project_data_list);

		//***
		//get project ids from 
		$project_name_list = array();
		//iterate over each project_assigned for current use
		foreach($project_data_list as $project_data)
		{
			//get the project id and query for it's name
			$project_name_query = "SELECT * FROM `projects` WHERE `id` = '".$project_data['project_id']."'";
			if($rows = mysqli_query($conn, $project_name_query) or trigger_error(mysql_error() . "in " . $project_name_query))
			{
				foreach($rows as $row)
				{
					$project_name_list[] = [
						"project_id" => $row["id"],
						"project_name" => $row["project_name"],
						"archived" => $row["archived"],
						"total_notes" => $row["total_notes"]
					];
				}
			}
		}
		//var_dump($project_name_list);
		

		//***
		//get friends of current user
		$user_friend_list = array();
		$friend_query = "SELECT * FROM `friends` WHERE `admin_user_id` = '".$userid."'";
		if($friend_data = mysqli_query($conn, $friend_query) or trigger_error(mysql_error() . "in " . $friend_query))
		{
			foreach($friend_data as $friend)
			{
				$user_friend_list[] = $friend["friend_user_id"];
			}
		}
		//var_dump($user_friend_list);


		//***
		//get friend details
		$total_friends = count($user_friend_list);
		//var_dump($total_friends);
		$friend_data_set = array();
		foreach($user_friend_list as $friend_id)
		{
			//query for user data
			$friend_data_query = "SELECT * FROM `users` WHERE `id` = '".$friend_id."'";
			if($friend_data_list = mysqli_query($conn, $friend_data_query) or trigger_error(mysql_error() . "in " . $friend_data_query))
			{
				foreach($friend_data_list as $friend)
				{
					$friend_data_set[] = [
						"user_id" => $friend["id"],
						"firstname" => $friend["firstname"],
						"lastname" => $friend["lastname"]
					];
				}
			}
		}
		//var_dump($friend_data_set);

		//***
		//check if user reaches by direct link(GET)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//render assign project template with form
			render("assign_project.php", ["title" => "Assign a project", "firstname" => $firstname, "profile_pic" => $profile_pic, "projects" => $project_data_list, "project_name_list" => $project_name_list, "friends" => $friend_data_set]);
		}
		//if user reaches via assign project form submission(POST)
		elseif($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check for validation
			if(empty($_POST["project"]))
			{
				reporterror("Select a project.", $firstname);
			}
			elseif(empty($_POST["friend"]))
			{
				reporterror("Select a friend.", $firstname);
			}
			else
			{
				//***
				//query in project_assigned table
				$project_assigned_query = "INSERT INTO `project_assigned`(`user_id`, `project_id`, `admin`) VALUES ('".$_POST['friend']."','".$_POST['project']."', 0)";
				mysqli_query($conn, $project_assigned_query) or trigger_error(mysql_error() . "in " . $project_assigned_query);
				//var_dump($project_assigned_query);

				//***
				//get friend full name
				//query mysql table for user details
				$friend_assigned_query = "SELECT * FROM `users` WHERE id = '".$_POST['friend']."'";
				//fetch user data from current user row
				if($result = mysqli_query($conn,$friend_assigned_query) or trigger_error(mysql_error() . "in" . $friend_assigned_query))
				{
					while($row = mysqli_fetch_array($result))
					{
						//get user firstname to display on header
						$friend_firstname = $row["firstname"];
						$friend_lastname = $row["lastname"];
					}
				}
				//***
				//query for project name
				$friend_assigned_project = "SELECT * FROM `projects` WHERE `id` = '".$_POST["project"]."' ";
				if($result = mysqli_query($conn, $friend_assigned_project) or trigger_error(mysql_error() . "in " . $friend_assigned_project))
				{
					while($row = mysqli_fetch_array($result))
					{
						//get project name
						$project_name_assigned = $row["project_name"];
					}
				}

				/**
				* add track record
				* get admin id of current object
				**/
				$project_id = intval($_POST['project']);
				$admin_user_id = get_admin($conn, $project_id);
				//var_dump($admin_user_id);

				//query for update record in mod-history
				$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('project', {$project_id}, {$userid}, {$admin_user_id}, 'assign')";
				$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
				//var_dump($record_history);

				//render assign project template
				render("project_assign_confirmation.php", ["title" => "Project assign successful", "firstname" => $firstname, "project_name" => $project_name_assigned, "friend_firstname" => $friend_firstname, "friend_lastname" => $friend_lastname]);

			}
		}





	}



	//render assign project form
	//render("assign_project.php", ["title" => "Assign a project", "firstname" => $firstname]);

?>
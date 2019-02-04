<?php
	//configuration
	require("includes/config.php");

	//check if user logged in
	if(empty($_SESSION["id"]))
	{
		redirect("login.php");
	}
	else
	{
		//***
		//first get user details
		//get user id
		$userid = $_SESSION["id"];
		//query into sql database for user details
		$users = "SELECT * FROM `users` WHERE id = '".$userid."'";
		//fetch user data from row
		if($result = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in " . $users))
		{
			while($row = mysqli_fetch_array($result))
			{
				//get user details
				$firstname = $row["firstname"];
				$profile_pic = $row["profile_pic"];
			}
		}

		//***
		//get list of project-ids from 'project_assigned' table
		$project_id_list = "SELECT * FROM `project_assigned` WHERE `user_id` = '".$userid."'";
		$project_id_array = array();
		if($project_id_query = mysqli_query($conn, $project_id_list) or trigger_error(mysql_error() . "in " . $project_id_list))
		{
			while($project_id = mysqli_fetch_array($project_id_query))
			{
				$project_id_array[] = $project_id["project_id"];
			}
		}
		//var_dump($project_id_array);


		//***
		//query for projects in $project_id_array(list of project IDs)
		$projects_data = array();
		foreach($project_id_array as $project_id)
		{
			//get details of each project_id
			$user_projects = "SELECT * FROM `projects` WHERE `id` = '".$project_id."'";
			//fetch project data
			if($rows = mysqli_query($conn,$user_projects) or trigger_error(mysql_error() . "in " . $user_projects))
			{
				//iterate through each rows with same id
				foreach($rows as $row)
				{
					//save key value pais as an array
					$projects_data[] = [
						"project_id" => $row["id"],
						"project_name" => $row["project_name"],
						"archived" => $row["archived"],
						"total_notes" => $row["total_notes"]
					];
				}
			}
		}
		//var_dump($projects_data);

		//***
		//get assigned userids of projects of current user
		//required output [project_id => id, firstname => firstname]
		$project_id_user_list = array();
		foreach($project_id_array as $project_id)
		{
			//get user_id from project assigned table
			$user_id_list = "SELECT * FROM `project_assigned` WHERE `project_id` = '".$project_id."'";
			if($rows = mysqli_query($conn,$user_id_list) or trigger_error(mysql_error() . "in ". $user_id_list))
			{
				while($row = mysqli_fetch_array($rows))
				{
					//get firstname for each user_id
					$user_firstname = "SELECT `firstname` FROM `users` WHERE `id` = '".$row["user_id"]."'";
					if($user_rows = mysqli_query($conn, $user_firstname) or trigger_error(mysql_error() . "in ". $user_firstname))
					{
						while($user_row = mysqli_fetch_array($user_rows))
						{
							$project_id_user_list[] = [
								"project_id" => $project_id,
								"user_firstname" => $user_row["firstname"]
							];
						}
					}
					
				}
				
			}
		}
		//var_dump($project_id_user_list);

		

		//render projects view template
		render("projects.php", ["title" => "My Projects", "firstname" => $firstname, "profile_pic" => $profile_pic, "projects" => $projects_data, "user_assigned" => $project_id_user_list]);
	}

?>
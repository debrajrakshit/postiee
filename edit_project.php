<?php
	//configuration
	require("includes/config.php");

	//check if user is logged in or redirect to login page
	if(empty($_SESSION["id"]))
	{
		redirect("login.php");
	}
	else
	{
		//***
		//get the URL
		$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//extract the query in url
		$query = parse_url($url,PHP_URL_QUERY);

		//***
		//get user personal details
		//get user id
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
		//if page reached by direct link(GET)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//if url has proper query(with '='' sign and a 'number') then process edit
			//else redirect to projects page
			if(isset($query) && (strpos($query, "=") == true))
			{
				//get project id from URL
				//extract project id from query(numaric value after =)
				//and convert into an int
				$projectid = intval(trim($query, "projectid="));
				//var_dump($projectid);
				//if project id available on URL proceed with editing
				if($projectid)
				{
					//get selected project details
					$projects_data = "SELECT * FROM `projects` WHERE `id` = '".$projectid."'";
					//query for project details
					if($query_data = mysqli_query($conn, $projects_data) or trigger_error(mysql_error() . "in " . $projects_data))
					{
						while($rows = mysqli_fetch_array($query_data))
						{
							$project_name = $rows["project_name"];
							//var_dump($project_name);
						}
					}
					render("edit_project.php", ["title" => "Edit Project", "firstname" => $firstname, "project_name" => $project_name, "projectid" => $projectid]);
				}
				//else reditect to projects page
				else
				{
					redirect("projects.php");
				}
			}
			else
			{
				redirect("projects.php");
			}
		}
		//for edit form submission
		//if user submits the edit project forms
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check if input is empty
			if(empty($_POST["projectname"]))
			{
				reporterror("Project name can't be blank!", $firstname);
			}
			else
			{
				//get project id
				$projectid = intval($_POST["projectid"]);
				$project_name = htmlspecialchars($_POST['projectname']);
				var_dump($projectid);
				//update mysql row with new details
				$project_update = "UPDATE `projects` SET `project_name`='".$project_name."' WHERE `id` = '".$projectid."'";
				mysqli_query($conn,$project_update) or trigger_error(mysql_error() . "in " . $project_update);

				//commented because we don't have project_name in new data structure
				//update relation table for project name(as project name has changed)
				// $project_name_update = "UPDATE `relation` SET `project_name`='".$_POST['projectname']."' WHERE `project_id` = '".$projectid."'";
				// mysqli_query($conn,$project_name_update) or trigger_error(mysql_error() . "in " . $project_name_update);
				//var_dump($test1, $test2);

				/**
				* add track record
				* get admin id of current object
				**/
				$project_id = intval($projectid);
				$admin_user_id = get_admin($conn, $project_id);
				//var_dump($admin_user_id);

				//query for update record in mod-history
				$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('project', {$project_id}, {$userid}, {$admin_user_id}, 'update')";
				$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
				//var_dump($record_history);
				
				redirect("projects.php");
			}
		}

		

	}

?>
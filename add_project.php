<?php
	//configuration
	include("includes/config.php");

	//if user is not loggedin redirec to login form
	if(empty($_SESSION["id"]))
	{
		//else redirect to login page
		redirect("login.php");
	}
	//else get user details
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
		//check if user get to this page via direct url (GET method)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//render add project form
			render("add_project.php", ["title" => "Add a project", "firstname" => $firstname, "profile_pic" => $profile_pic]);
		}
		//if user get thorugh submission of form (POST method)
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check for project name
			if(empty($_POST["projectname"]))
			{
				//added second argument into helper.php for extra field
				reporterror("Enter a valid project name.", $firstname);
			}
			else
			{
				//***
				//get project name
				$projectname = $_POST["projectname"];
				//query for new project into mysql database
				$project_query = "INSERT IGNORE INTO `projects` (`project_name`) VALUES ('".$projectname."')";
				//insert new project into database
				$test = mysqli_query($conn,$project_query) or trigger_error(mysql_error() . "in " . $project_query);
				//var_dump($test);

				//get the last insert id(for just created project)
				$project_id_created = mysqli_insert_id($conn);
				//var_dump($project_id_created);

				//***
				//create an entry to project_assigned table
				$project_assigned_query = "INSERT INTO `project_assigned`(`user_id`, `project_id`, `admin`) VALUES ('".$userid."', '".$project_id_created."', 1)";
				$test2 = mysqli_query($conn, $project_assigned_query) or trigger_error(mysql_error() . "in " . $project_assigned_query);
				//var_dump($test2);

				/**
				* add track record
				* get admin id of current object
				**/
				$project_id = intval($project_id_created);
				$admin_user_id = get_admin($conn, $project_id);
				//var_dump($admin_user_id);

				//query for update record in mod-history
				$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('project', {$project_id}, {$userid}, {$admin_user_id}, 'add')";
				$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
				//var_dump($record_history);

				//redirect to projects page
				redirect("projects.php");
			}

			
		}

		
	}

?>
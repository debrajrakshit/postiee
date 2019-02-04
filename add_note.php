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
		//get the project id list from 'project_assigned' table
		$project_id_list = array();
		$project_query = "SELECT * FROM `project_assigned` WHERE `user_id` = '".$userid."'";
		if($project_list = mysqli_query($conn, $project_query) or trigger_error(mysql_error() . "in " . $project_query))
		{
			//fetch the project data and save into an array
			foreach($project_list as $project)
			{
				$project_id_list[] = $project["project_id"];
			}
		}
		//var_dump($project_id_list);

		//***
		//get each project-id data as an array
		$projects = array();
		//query for each projects
		foreach($project_id_list as $project_id)
		{
			//query with each id
			$user_projects = "SELECT * FROM `projects` WHERE `id` = '".$project_id."'";
			//fetch user project data
			if($rows = mysqli_query($conn,$user_projects) or trigger_error(mysql_error() . "in " . $user_projects))
			{
				//iterate through each rows with same id
				foreach($rows as $row)
				{
					//save key value pais as an array
					$projects[] = [
						"project_id" => $row["id"],
						"project_name" => $row["project_name"],
						"archived" => $row["archived"],
						"total_notes" => $row["total_notes"]
					];
				}
			}
		}
		//var_dump($projects);
		
		//***
		//check if user get to this page via direct url (GET method)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//render add project form
			render("add_note.php", ["title" => "Add a note", "firstname" => $firstname, "profile_pic" => $profile_pic, "projects" => $projects]);
		}
		//if user get thorugh submission of form (POST method)
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check for project id
			if(empty($_POST["project"]))
			{
				//if empty return error
				reporterror("Select a project.", $firstname);
			}
			else if(empty($_POST["data1"]))
			{
				//if empty return error
				reporterror("Can't create blank note.", $firstname);
			}
			else
			{
				//***
				//get required note data
				//required for relation table
				//$note_user_id = $userid;
				//$note_project_id = $_POST["project"];

				//required for note table
				$note_data1 = htmlspecialchars($_POST["data1"]);
				$note_data2 = htmlspecialchars($_POST["data2"]);
				$note_data3 = htmlspecialchars($_POST["data3"]);
				$note_data4 = htmlspecialchars($_POST["data4"]);
				$note_data5 = htmlspecialchars($_POST["data5"]);
				$note_bg_color = htmlspecialchars($_POST["bgcolor"]);

				var_dump($note_data1, $note_data2, $note_data3, $note_data4, $note_data5, $note_bg_color);

				//***
				//query for new note into mysql database
				$note_query = "INSERT IGNORE INTO `notes`(`data1`, `data2`, `data3`, `data4`, `data5`, `bg_color`) VALUES ('{$note_data1}', '{$note_data2}', '{$note_data3}', '{$note_data4}', '{$note_data5}', '{$note_bg_color}')";
				//insert new project into database
				mysqli_query($conn,$note_query) or trigger_error(mysql_error() . "in " . $note_query);
				//var_dump($test);

				//***
				//add note_id and project_id into relation table
				//get the latest note id
				$new_note_id = $conn->insert_id;
				//var_dump($new_note_id);
				//get project id
				$new_note_project_id = $_POST["project"];
				//query for assigning note_id into projects row
				$relation_query = "INSERT IGNORE INTO `relation`(`note_id`, `project_id`) VALUES ($new_note_id,$new_note_project_id)";
				mysqli_query($conn, $relation_query) or trigger_error(mysql_error() . "in " . $relation_query);
				//var_dump($relation_query);

				//***
				//update project `total_notes` by 1 with each time a note added
				$total_notes_update_query = "UPDATE `projects` SET `total_notes` = (`total_notes` + 1) WHERE `id` = {$new_note_project_id}";
				mysqli_query($conn, $total_notes_update_query) or trigger_error(mysql_error() . "in " . $total_notes_update_query);

				/**
				* add track record
				* get admin id of current note
				**/
				$note_id = intval($new_note_id);
				$admin_user_id = get_admin_by_note($conn, $note_id);
				//var_dump($admin_user_id);

				//query for update record in mod-history
				$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('note', {$note_id}, {$userid}, {$admin_user_id}, 'add')";
				$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
				//var_dump($record_history);

				//redirect to whiteboard
				redirect("whiteboard.php");
			}
		}
	}

?>
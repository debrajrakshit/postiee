<?php
	//configuration
	require("includes/config.php");

	if(empty($_SESSION["id"]))
	{
		//if not logged in redirect to login page
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
		//get all the project ids from project_assigned table
		$project_list_ids = array();
		$project_id_list = "SELECT * FROM `project_assigned` WHERE `user_id` = '".$userid."'";
		if($rows = mysqli_query($conn, $project_id_list) or trigger_error(mysql_error() . "in " . $project_id_list))
		{
			foreach($rows as $row)
			{
				$project_list_ids[] = $row["project_id"];
			}
		}
		//var_dump($project_list_ids);

		//***
		//get all project ids and save into an array
		$project_list = array();
		foreach($project_list_ids as $project_ids)
		{
			//save results as array(projectname => project id)
			$project_list[] = [
				"project_id" => $project_ids
			];
		}
		//var_dump($project_list);

		//***
		//get project data by project_id(projects table)
		$project_data = array();
		foreach($project_list as $project)
		{
			//var_dump($project);
			//query with each project id and get it's data
			$project_data_query = "SELECT * FROM `projects` WHERE `id` = '".$project['project_id']."'";
			if($rows = mysqli_query($conn, $project_data_query) or trigger_error(mysql_error() . "in " . $project_data_query))
			{
				while($row = mysqli_fetch_array($rows))
				{
					$project_data[] = [
						"project_id" => $row["id"],
						"project_name" => $row["project_name"],
						"archived" => $row["archived"],
						"total_notes" => $row["total_notes"]
					];
				}
			}
		}
		//var_dump($project_data);

		//***
		//get list of note-ids by project_id(relation table)
		$note_id_list = array();
		foreach($project_list as $project)
		{
			$note_list_query = "SELECT * FROM `relation` WHERE `project_id` = '".$project['project_id']."'";
			if($rows = mysqli_query($conn, $note_list_query) or trigger_error(mysql_error() . "in " . $note_list_query))
			{
				while($row = mysqli_fetch_array($rows))
				{
					$note_id_list[] = [
						"note_id" => $row["note_id"],
						"project_id" => $project['project_id']
					];
				}
			}
		}
		//var_dump($note_id_list);

		//***
		//get all note ids in an array
		$note_ids = array();
		foreach($note_id_list as $note_id)
		{
			$note_ids[] = $note_id;
		}
		//var_dump($note_ids);

		//***
		//for each note-id get their data
		$note_data = array();
		foreach($note_ids as $note_id)
		{
			//echo $note_id["note_id"];
			//query for note data in notes table
			$note_data_query = "SELECT * FROM `notes` WHERE `id` = '".$note_id['note_id']."'";
			if($rows = mysqli_query($conn, $note_data_query) or trigger_error(mysql_error() . "in " . $note_data_query))
			{
				while($row = mysqli_fetch_array($rows))
				{
					$note_data[] = [
						"note_id" => $row["id"],
						"data1" => $row["data1"],
						"data2" => $row["data2"],
						"data3" => $row["data3"],
						"data4" => $row["data4"],
						"data5" => $row["data5"],
						"bg_color" => $row["bg_color"],
						"archived" => $row["archived"],
						"last_update" => $row["last_update"]
					];
				}
			}
		}
		//var_dump($note_data);

		/**
		* get the project id from url and display
		**/
		//get the url
		$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//extract the query in the url
		$query = parse_url($url, PHP_URL_QUERY);
		var_dump($query);

		//if query is a proper quesry with '='
		if(isset($query) && strpos($query, "=") == true)
		{
			//get the value after type=
			$tpe = strstr($query, "&", true);
			//string after 'type='
			$object_type = substr($tpe, 5);

			//get the id after 'ID='
			$occ = strchr($query, "ID=");
			$object_id_render = intval(trim($occ, "ID="));
			//var_dump($object_type, $object_id_render);

			//TODO
			if(isset($object_type) && $object_type == "project")
			{
				
				//***
				//get project data by project_id(projects table)
				$project_data_sorted = array();
				$project_data_query = "SELECT * FROM `projects` WHERE `id` = '".$object_id_render."'";
				if($rows = mysqli_query($conn, $project_data_query) or trigger_error(mysql_error() . "in " . $project_data_query))
				{
					while($row = mysqli_fetch_array($rows))
					{
						$project_data_sorted[] = [
							"project_id" => $row["id"],
							"project_name" => $row["project_name"],
							"archived" => $row["archived"],
							"total_notes" => $row["total_notes"]
						];
					}
				}
				//var_dump($project_data_sorted);
				//get project title
				$project_title;
				foreach ($project_data_sorted as $project)
				{
					$project_title = $project["project_name"];
				}

				//***
				//get the note id list from relation respect to project id
				$note_id_list_sorted = array();
				$note_list_query = "SELECT * FROM `relation` WHERE `project_id` = '".$object_id_render."'";
				if($rows = mysqli_query($conn, $note_list_query) or trigger_error(mysql_error() . "in " . $note_list_query))
				{
					while($row = mysqli_fetch_array($rows))
					{
						$note_id_list_sorted[] = [
							"note_id" => $row["note_id"],
						];
					}
				}
				//var_dump($note_id_list_sorted);

				//***
				//get all note ids in an array
				$note_ids_sorted = array();
				foreach($note_id_list_sorted as $note_id)
				{
					$note_ids_sorted[] = $note_id;
				}
				//var_dump($note_ids_sorted);
				//***
				//for each note-id get their data
				$note_data_sorted = array();
				foreach($note_ids_sorted as $note_id)
				{
					//echo $note_id["note_id"];
					//query for note data in notes table
					$note_data_query = "SELECT * FROM `notes` WHERE `id` = '".$note_id['note_id']."'";
					if($rows = mysqli_query($conn, $note_data_query) or trigger_error(mysql_error() . "in " . $note_data_query))
					{
						while($row = mysqli_fetch_array($rows))
						{
							$note_data_sorted[] = [
								"note_id" => $row["id"],
								"data1" => $row["data1"],
								"data2" => $row["data2"],
								"data3" => $row["data3"],
								"data4" => $row["data4"],
								"data5" => $row["data5"],
								"bg_color" => $row["bg_color"],
								"archived" => $row["archived"],
								"last_update" => $row["last_update"]
							];
						}
					}
				}
				//var_dump($note_data_sorted);


				//echo "Project will display";
				render("project_whiteboard.php", ["title" => $project_title, "firstname" => $firstname, "profile_pic" => $profile_pic, "project_id" => $object_id_render, "project_data" => $project_data_sorted, "note_id_list" => $note_id_list_sorted, "note_data" => $note_data_sorted]);
				exit();
			}
		}


		//render view
		render("whiteboard.php", ["title" => "Whiteboard", "firstname" => $firstname, "profile_pic" => $profile_pic, "project_list" => $project_list, "project_data" => $project_data, "note_id_list" => $note_id_list, "note_data" => $note_data]);
	}

?>
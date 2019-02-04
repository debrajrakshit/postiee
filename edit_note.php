<?php
	//configuration
	include("includes/config.php");
	//include("includes/params.php");

	//check if user is logged in
	if(empty($_SESSION["id"]))
	{
		redirect("login.php");
	}
	else
	{
		//get the url
		$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//extract the query in the url
		$query = parse_url($url, PHP_URL_QUERY);

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
			}
		}

		//***
		//define variable to save note data
		$note_data_list = array();
		//define variable to save relation data
		$note_relation_data = array();
		//get project name data
		$project_name_data = array();

		//check if user reaches through GET(direct url or link)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//if url has proper query(with '='' sign) then process edit
			//else redirect to projects page
			if(isset($query) && strpos($query, "=") == true)
			{
				//get note id from URL
				//extract note id from query(numaric value after '=')
				//and convert into an int
				$noteid = intval(trim($query, "noteid="));
				
				//if note id available on URL proceed with editing
				if($noteid)
				{
					
					//***
					//query the 'notes' table to get it's data
					$note_data = "SELECT * FROM `notes` WHERE `id` = '".$noteid."'";
					if($query_data = mysqli_query($conn, $note_data) or trigger_error(mysql_error() . "in " . $note_data))
					{
						while($note_row = mysqli_fetch_array($query_data))
						{
							//get all note data into predefined array
							$note_data_list = $note_row;
						}
					}

					//***
					//get project data of above note id
					$project_data = "SELECT * FROM `relation` WHERE `note_id` = '".$noteid."'";
					if($query_project_data = mysqli_query($conn, $project_data) or trigger_error(mysql_error() . "in ". $project_data))
					{
						while($project_row = mysqli_fetch_array($query_project_data))
						{
							$note_relation_data = $project_row;
						}
					}
					//var_dump($note_relation_data);
					//echo "String";
					//var_dump($note_relation_data['project_id']);


					//***
					//get the project name from projects table
					$project_name_query = "SELECT * FROM `projects` WHERE `id` = '".$note_relation_data['project_id']."'";
					if($project_name_rows = mysqli_query($conn, $project_name_query) or trigger_error(mysql_error() . "in " . $project_name_query))
					{
						while($project_name = mysqli_fetch_array($project_name_rows))
						{
							$project_name_data = $project_name;
						}
					}
					//var_dump($project_name_data["project_name"]);

					//render edit note template and send all note data
					render("edit_note.php", ["title" => "Edit note id: {$noteid}", "firstname" => $firstname, "note_data" => $note_data_list, "relation" => $note_relation_data, "project_name" => $project_name_data]);

					//var_dump($note_data_list, $note_relation_data);
					
				}
				//else redirect to whiteboard
				else
				{
					redirect("whiteboard.php");
				}
			}
			//redirect("whiteboard.php");
		}
		//else if reaches through form submission(POST method)
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check if there is any input value
			if(empty($_POST["note_id"]))
			{
				reporterror("Error editing note! Try again.", $firstname);
			}
			else if(empty($_POST["data1"]))
			{
				reporterror("Add atleast one note to update a post.", $firstname);
			}
			else
			{
				//***
				//get details of the note from SQL table
				//save into an array
				$note_data = array();
				$note_data = "SELECT * FROM `notes` WHERE `id` = '".$_POST['note_id']."'";
				if($note_rows = mysqli_query($conn, $note_data) or trigger_error(mysql_error() . "in " . $note_data))
				{
					//fetch note data
					$note_row = mysqli_fetch_array($note_rows);
					//var_dump($note_row);
				}

				//collect all data need to submit int sql row
				$note_update_data1 = htmlspecialchars($_POST["data1"]);
				$note_update_data2 = htmlspecialchars($_POST["data2"]);
				$note_update_data3 = htmlspecialchars($_POST["data3"]);
				$note_update_data4 = htmlspecialchars($_POST["data4"]);
				$note_update_data5 = htmlspecialchars($_POST["data5"]);
				$note_update_bgcolor = $_POST["bgcolor"];;
				//save input data into SQL table
				//query for update data
				$note_update = "UPDATE `notes` SET `data1`='{$note_update_data1}', `data2`='{$note_update_data2}', `data3`='{$note_update_data3}', `data4`='{$note_update_data4}', `data5`='{$note_update_data5}', `bg_color`='{$note_update_bgcolor}' WHERE `id` = '".$_POST['note_id']."'";
				$test = mysqli_query($conn, $note_update) or trigger_error(mysql_error() . "in " . $note_update);

				//var_dump($note_row);
				//var_dump($note_update_data1, $note_update_data2, $note_update_data3, $note_update_data4, $note_update_data5, $note_update_bgcolor);

				//get admin id of current note
				$note_id = intval($_POST['note_id']);
				$admin_user_id = get_admin_by_note($conn, $note_id);
				//var_dump($admin_user_id);

				//query for update record in mod-history
				$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('note', ".$_POST['note_id'].", {$userid}, {$admin_user_id}, 'update')";
				$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
				//var_dump($record_history);

				//render edit note success page
				render("edit_note-success.php", ["title" => "Note id: {$_POST['note_id']} updated successfully!", "note_data" => $note_row]);
			}
		}
	}

?>
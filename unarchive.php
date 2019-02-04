<?php
	//configuration
	require("includes/config.php");

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

	//check if user is logged in
	if(empty($_SESSION["id"]))
	{
		redirect("login.php");
	}
	else
	{
		//check if user reached page via GET(direct link or url)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			reditect("whiteboard.php");
		}
		//if page reached via form submit
		else if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//check if input value
			//define object type
			$valid_object_type = ["note", "project"];
			if(empty($_POST["obj_id"]) && empty($_POST["obj_type"]) && !in_array($_POST["object_type"], $valid_object_type))
			{
				reporterror("Error archiving object! Try again.", $firstname);
			}
			else
			{	
				//save object type and id
				$object_type = $_POST["obj_type"];
				$object_id = $_POST["obj_id"];

				//if object type is a note
				if($object_type == 'note')
				{
					//check for the note_id in notes table
					$unarchive_note = "UPDATE `notes` SET `archived` = 0 WHERE `id` = {$object_id}";
					mysqli_query($conn, $unarchive_note) or trigger_error(mysql_error() . "in ". $unarchive_note);

					//update `note_count` in projects table
					//get the project_id
					$project_id = get_project($conn, intval($object_id));
					//var_dump($project_id);
					//update project `total_notes` by 1 with each time a note un-archived
					$total_notes_update_query = "UPDATE `projects` SET `total_notes` = (`total_notes` + 1) WHERE `id` = {$project_id}";
					mysqli_query($conn, $total_notes_update_query) or trigger_error(mysql_error() . "in " . $total_notes_update_query);


					/**
					* add track record
					* get admin id of current object
					**/
					$note_id = intval($object_id);
					$admin_user_id = get_admin_by_note($conn, $note_id);
					//var_dump($admin_user_id);

					//query for update record in mod-history
					$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('note', {$note_id}, {$userid}, {$admin_user_id}, 'restore')";
					$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
					//var_dump($record_history);

				}
				//if object type is a project
				else if($object_type == 'project')
				{
					//TODO
				}
				else
				{
					//redirect to whiteboard
					redirect("whiteboard.php");
				}


				//**
				//when note is archived, remove record from relation
				//$update_note_relation = "DELETE FROM `relation` WHERE `note_id` = '".$_POST["note_id"]."'";
				//mysqli_query($conn,$update_note_relation) or trigger_error(mysql_error() . "in " . $update_note_relation);

				//render confirmation template
				render("unarchive_success.php", ["title" => "Object id: {$_POST['obj_id']} unarchived", "firstname" => $firstname, "obj_id" => $_POST['obj_id'], "obj_type" => $_POST["obj_type"]]);

			}
		}
	}

	

?>
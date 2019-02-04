<?php 
	
	//configuration
	require_once("config.php");

	//test function
	function multiply($value_a, $value_b)
	{
		return $value_a * $value_b;
	}

	/**
	* check duplicate username
	**/
	function validate_username($mysql_connect, $username)
	{
		//check for valid parameters
		if(isset($username) && !empty($username))
		{
			$select_users = "SELECT `username` FROM `users`";
			if($rows = mysqli_query($mysql_connect, $select_users) or trigger_error(mysql_error() . "in " . $select_users))
			{
				while($row = mysqli_fetch_array($rows))
				{
					if($row["username"] == $username)
					{
						return TRUE;
						exit();
					}
				}
				return FALSE;
				exit();
			}
		}
		else
		{
			trigger_error("Invalid parameter: {$username}", E_USER_ERROR);
		}
	}


	/**
	* retreival of data functions from database
	**/

	//**
	//function to find admin id from a project id(Project)
	function get_admin($mysql_connect, $project_id)
	{
		//check if parameter is valid and not empty
		if(isset($project_id) && !empty($project_id) && is_int($project_id) == TRUE)
		{
			//find the admin id from project_assigned table
			$select_project = "SELECT * FROM `project_assigned` WHERE `project_id` = {$project_id}";
			if($rows = mysqli_query($mysql_connect, $select_project) or trigger_error(mysql_error() . "in " . $select_project))
			{
				while($row = mysqli_fetch_array($rows))
				{
					//if the admin is 1
					if(intval($row["admin"]) == 1)
					{
						//var_dump("Is admin?: ". intval($row["admin"]));
						//var_dump("User id: " . intval($row["user_id"]));
						//return the user_id
						return intval($row["user_id"]);
					}
				}
			}
		}
		else
		{
			//display error
			trigger_error("Invalid parameter: {$project_id}", E_USER_ERROR);
		}
	}

	//**
	//function to find project id from note id
	function get_project($mysqli_connect, $note_id)
	{
		//check if parameter is valid and not empty
		if(isset($note_id) && !empty($note_id) && is_int($note_id) == TRUE)
		{
			//find the project id from relation table
			$find_project = "SELECT * FROM `relation` WHERE `note_id` = {$note_id}";
			if($rows = mysqli_query($mysqli_connect, $find_project) or trigger_error(mysql_error() . "in " . $find_project))
			{
				while($row = mysqli_fetch_array($rows))
				{
					return intval($row["project_id"]);
				}
			}
		}
		else
		{
			//display error
			trigger_error("Invalid parameter: {$note_id}", E_USER_ERROR);
		}
	}

	//**
	//find admin id from note id
	function get_admin_by_note($mysqli_connect, $note_id)
	{
		//check for valid parameter
		if(isset($note_id) && !empty($note_id) && is_int($note_id) == TRUE)
		{
			//find the project id
			if(get_project($mysqli_connect, $note_id))
			{
				//save project id into varible
				$project = get_project($mysqli_connect, $note_id);
				//get the admin id
				return get_admin($mysqli_connect, $project);
			}
		}
		else
		{
			//display error
			trigger_error("Invalid parameter: {$note_id}", E_USER_ERROR);
		}
	}

	//**
	//get user first name from user id
	function user_fname($mysqli_connect, $userid)
	{
		//check for valid parameter
		if(isset($userid) && !empty($userid) && is_int($userid) == TRUE)
		{
			//find the user first name from users table
			$find_user = "SELECT * FROM `users` WHERE `id` = {$userid}";
			if($rows = mysqli_query($mysqli_connect, $find_user) or trigger_error(mysql_error() . "in " . $find_user))
			{
				while($row = mysqli_fetch_array($rows))
				{
					return $row["firstname"];
				}
			}
		}
	}

	//**
	//find the archive status of an note
	function is_archived_note($mysqli_connect, $noteid)
	{
		//check for validation
		if(isset($noteid) && !empty($noteid) && is_int($noteid) == TRUE)
		{
			$archive_state = "SELECT `archived` FROM `notes` WHERE `id` = {$noteid}";
			$rows = mysqli_query($mysqli_connect, $archive_state) or trigger_error(mysql_error() . "in " . $archive_state);
			while($row = mysqli_fetch_array($rows))
			{
				return intval($row["archived"]);
			}
		}
	}

	//**
	//find the archive status of an project
	function is_archived_project($mysqli_connect, $projectid)
	{
		//check for validation
		if(isset($projectid) && !empty($projectid) && is_int($projectid) == TRUE)
		{
			$archive_state = "SELECT `archived` FROM `projects` WHERE `id` = {$projectid}";
			$rows = mysqli_query($mysqli_connect, $archive_state) or trigger_error(mysql_error() . "in " . $archive_state);
			while($row = mysqli_fetch_array($rows))
			{
				return intval($row["archived"]);
			}
		}
	}

?>
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
			$lastname = $row["lastname"];
			$email = $row["email"];
			$profile_pic = $row["profile_pic"];
		}
	}

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//render template
		render("edit_account.php", ["title" => "Edit Account", "firstname" => $firstname, "profile_pic" => $profile_pic, "lastname" => $lastname, "email" => $email]);
	}
	else  if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["firstname"]))
		{
			reporterror("First Name can't be left blank!");
		}
		else if(empty($_POST["lastname"]))
		{
			reporterror("Last Name can't be left blank!");
		}
		else if(empty($_POST["email"]))
		{
			reporterror("Enter a valid email!");
		}
		else if(empty($_POST["password"]))
		{
			reporterror("Password can't be left blank!");
		}
		else if($_POST["password"] != $_POST["confirm-password"])
		{
			reporterror("Password did not match!");
		}
		else
		{
			//if a file selected
			if(isset($_POST["avatar"]) && !empty($_POST["avatar"]))
			{
				//check if image file has been selected
				$file = $_FILES["avatar"];
				$file_name = $_FILES["avatar"]["name"];
				$file_type = $_FILES["avatar"]["type"];
				$file_tmp = $_FILES["avatar"]["tmp_name"];
				$file_size = $_FILES["avatar"]["size"];
				$extn = explode('.', $file_name);
				$file_ext = strtolower(end($extn));
				$uploads_dir = "uploads/user";
				
				var_dump($file, $file_name, $file_type, $file_tmp, $file_size, $file_ext);

				//extensions allowed
				$image_types = array("jpg", "jpeg", "gif", "png");

				//check for valid file type
				if(in_array($file_ext, $image_types) === FALSE)
				{
					reporterror("Invalid file type!");
				}
				//check for valid file size
				else if($file_size > 2000000)
				{
					reporterror("File too large! Maximum 2mb allowed.");
				}
				else
				{
					move_uploaded_file($file_tmp, $uploads_dir."/".$file_name);
					echo "Success";
				}

				//file path to save in db
				$profile_pic = htmlspecialchars($uploads_dir."/".$file_name);
				var_dump($profile_pic);
			}
		

			//get user details
			//$id = $_SESSION["id"];
			//$users = "SELECT * FROM `users`";
			if ($result = mysqli_query($conn,$users))
			{
			  // Fetch one and one row
			  while ($row = mysqli_fetch_array($result))
			    {
				    //verify password with database
				    if (password_verify($_POST["password"], $row["hash"]))
		            {
		                //if new password matches old password
		                reporterror("Your new password should not match old password. Try again.", ["profile_pic" => $profile_pic]);
		            }
		            else
		            {
		            	//get date and time for timestamp
		            	$date = new DateTime();
		            	$timestamp = date('Y-m-d H:i:s',$date->getTimestamp());
		            	$firstname = $_POST["firstname"];
		            	$lastname = $_POST["lastname"];
		            	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		            	$email = $_POST["email"];
		            	//update user row in mysql database
		            	$query = "UPDATE `users` SET `hash`='".$password."',`firstname`='".$firstname."',`lastname`='".$lastname."',`email`='".$email."',`reg_date`='".$timestamp."',`profile_pic`='".$profile_pic."' WHERE id = '".$userid."'";
		            	mysqli_query($conn,$query) or trigger_error(mysql_error() ." in ".$query);

		            	/**
						* add track record
						**/
						//query for update record in mod-history
						$record_history = "INSERT INTO `mod_history`(`obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`) VALUES ('account', {$userid}, {$userid}, {$userid}, 'update')";
						$add_history = mysqli_query($conn, $record_history) or trigger_error(mysql_error() . "in " . $record_history);
						//var_dump($record_history);

		            	//render success page
		            	render("account_update_success.php", ["Title" => "Update Account", "firstname" => $firstname, "profile_pic" => $profile_pic, "timestamp" => $timestamp]);
		            }
			    }
			  // Free result set
			  mysqli_free_result($result);
			}
		}
		
		//
	}
	

?>
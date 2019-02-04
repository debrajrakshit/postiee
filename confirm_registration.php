<?php
	//configuration
	include("includes/config.php");
	//include("includes/params.php");

	//check if user is logged in
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//get the url
		$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//extract the query in the url
		$query = parse_url($url, PHP_URL_QUERY);


		//check if user reaches through GET(direct url or link)
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			//if url has proper query(with '='' sign) then process edit
			//else redirect to login
			if(isset($query) && strpos($query, "=") == true)
			{
				//get activation id from URL
				//extract activation id from query(numaric value after '=')
				//and convert into an int
				$activation_id = intval(trim($query, "ID="));
				
				//if activation id available on URL proceed with activation
				if($activation_id)
				{
					
					/**
					* read json file and check for username associated with activation id
					**/
					$json_data_file = "bin/activation/{$activation_id}.json";
					//if file is readable extract it's data
					// if(file_exists($json_data_file))
					// {
					// 	//extract file into array
					// 	//echo "File eixists \r\n";
					// 	$json_data[] = file_get_contents($json_data_file);
					// 	//$json_data_extract = json_decode($json_data, true);
					// 	//var_dump($json_data_extract);

					// 	foreach ($json_data as $string) {
					// 	    echo 'Decoding: ' . $string;
					// 	    json_decode($string);

					// 	    switch (json_last_error()) {
					// 	        case JSON_ERROR_NONE:
					// 	            echo ' - No errors';
					// 	        break;
					// 	        case JSON_ERROR_DEPTH:
					// 	            echo ' - Maximum stack depth exceeded';
					// 	        break;
					// 	        case JSON_ERROR_STATE_MISMATCH:
					// 	            echo ' - Underflow or the modes mismatch';
					// 	        break;
					// 	        case JSON_ERROR_CTRL_CHAR:
					// 	            echo ' - Unexpected control character found';
					// 	        break;
					// 	        case JSON_ERROR_SYNTAX:
					// 	            echo ' - Syntax error, malformed JSON';
					// 	        break;
					// 	        case JSON_ERROR_UTF8:
					// 	            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
					// 	        break;
					// 	        default:
					// 	            echo ' - Unknown error';
					// 	        break;
					// 	    }

					// 	    echo PHP_EOL;
					// 	}
					// }

					//read file and extract data as array
					if(file_exists($json_data_file))
					{
						$json_data = file_get_contents($json_data_file);
						$activation_data = json_decode($json_data, false, 512, JSON_BIGINT_AS_STRING);
						//var_dump($activation_data);
						//covert object into associative array
						$extract = (array) $activation_data;
						//var_dump($extract);

						//validate id and activate user
						if($extract["activation_id"] == $activation_id)
						{
							//get usernem
							$username = $extract["username"];
							$user_connect = "UPDATE `users` SET `user_status`= 0 WHERE `username` = '{$username}'";
							$save = mysqli_query($conn, $user_connect) or trigger_error(mysql_error() . "in " . $user_connect);
							//var_dump($save);
						}
					}

					//login user after success
					//get user details
					$user_data = "SELECT `id` FROM `users` WHERE `username` = '{$username}'";
					$user_id;
					if($user_row = mysqli_query($conn, $user_data) or trigger_error(mysql_error() . "in " . $user_data))
					{
						while($user = mysqli_fetch_array($user_row))
						{
							$user_id = intval($user["id"]);
							//var_dump($user_id);
						}
					}
					//save session for user
					$_SESSION["id"] = $user_id;

					//get current user firstname
					$firstname;
					$email;
					//query mysql table for user details
					$users = "SELECT * FROM `users` WHERE id = $user_id";
					//fetch user data from current user row
					if($result = mysqli_query($conn, $users) or trigger_error(mysql_error() . "in" . $users))
					{
						while($row = mysqli_fetch_array($result))
						{
							//get user firstname to display on header
							$firstname = $row["firstname"];
							$email = $row["email"];
						}
					}

					//send confirmation email
					$from = "no_reply@postisquare.com";
		        	$from_name = "Posti";
		        	$subject = "Posti - Registration confirmation";
		        	$message = "<p>Congratulations!<p><p>You have successfully activated your account. <a href='http://localhost/cs50/posti/'>Get started by adding a project</a></p><p>Thanks,</p><p>Posti Team</p>";
		        	send_email($email, $firstname, $from, $from_name, $subject, $message);

					//render activation success page
					render("activation_success.php", ["title" => "Account activated", "firstname" => $firstname]);
					
				}
				//else redirect to login page
				else
				{
					redirect("login.php");
				}
			}
		}
		//if reached through any other process redirect to login page
		else
		{
			redirect("login.php");
		}
	}
	//for any other request method redirect to login page
	else
	{
		redirect("login.php");
	}

?>
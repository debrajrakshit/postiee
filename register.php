<?php 
	
	//configuration
	require("includes/config.php");
	
	//if the user reached via GET (as by clicking a link or direct)
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//prompt to login
		if(!empty($_SESSION["id"]))
		{
			redirect("whiteboard.php", ["title" => "My Whiteboard"]);
		}
		else
		{
			render("register.php", ["title" => "Registration"]);
		}
		
	}
	//else if user reached via POST (submitting a form)
	else if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//validate submission
		if(empty($_POST["username"]) && !preg_match("/^[a-zA-Z]*$/", $_POST["username"]))
		{
			reporterror("Username blank!");
			//echo "Username blank";
		}
		else if(empty($_POST["firstname"]) && !preg_match("/^[a-zA-Z ]*$/",$_POST["firstname"]))
		{
			reporterror("Provide your first name.");
		}
		else if(empty($_PPOST["lastname"]) && !preg_match("/^[a-zA-Z]*$/", $_POST["lastname"]))
		{
			reporterror("Enter your last name.");
		}
		else if(empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			reporterror("Provide a valid email id.");
		}
		else if(empty($_POST["password"]))
		{
			reporterror("Password blank!");
			//echo "Password blank!";
		}
		else if($_POST["password"] != $_POST["confirm-password"])
		{
			reporterror("Password did not match!");
		}

		
		//validate user
		$valid_username = validate_username($conn, $_POST["username"]);
		//var_dump($valid_username, $_POST["username"]);

		if($valid_username == TRUE)
		{
			reporterror("Username already exists!");
		}
		else
		{
			//get values from inputs
        	$date = new DateTime();
        	$timestamp = date("Y-m-d H:i:s", $date->getTimestamp());
        	$username = strtolower($_POST["username"]);
        	$firstname = $_POST["firstname"];
        	$lastname = $_POST["lastname"];
        	$email = $_POST["email"];
        	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        	//create new user in SQL database
        	//get last insert id
        	$latest_user_id;
        	$query = "INSERT IGNORE INTO `users`(`username`, `hash`, `firstname`, `lastname`, `email`, `reg_date`, `user_status`) VALUES ('".$username."','".$password."','".$firstname."','".$lastname."','".$email."','".$timestamp."', 1)";
        	if(mysqli_query($conn, $query) or trigger_error(mysql_error() ."in ". $query))
        	{
        		$latest_user_id = mysqli_insert_id($conn);
        		//var_dump($last_insert_id);
        	}

        	//send email variables
        	$from = "no_reply@postisquare.com";
        	$from_name = "Posti";
        	$subject = "Posti - Thank you for registering";

        	//link to generate = /confirm_registration.php?ID=123456789
        	$activation_code = random_int(mt_rand(100000000,500000000), mt_rand(500000000,999999999));
        	//var_dump($activation_code);      	

        	$message = "<p>Welcome to Posti!<p><p>Confirm your registration by clicking the following link: </p><p><a href='http://localhost/cs50/posti/confirm_registration.php?ID={$activation_code}'>Confirm Registration</a></p><p>Thanks,</p><p>Posti Team</p>";

        	//create json file with code respect to user id
        	//define array for json file
        	$user_registered = ["activation_id" => $activation_code, "username" => $username, "email" => $email];
        	//var_dump($user_registered);
        	//write entry into json file
        	//load file
        	//$activate_json = "bin/activation/activate.json";
        	//check if file exists

        	//create a file
        	$new_json = fopen("bin/activation/{$activation_code}.json", 'w');
        	fwrite($new_json, json_encode($user_registered));
        	fclose($new_json);

        	//send email notification (confirm registration)
        	//send_email($to, $to_name, $from, $from_name, $subject, $message)
        	send_email($email, $firstname, $from, $from_name, $subject, $message);
        	//var_dump($email, $firstname, $from, $from_name, $subject, $message);

        	//redirect to confirmation
            render("registration_success.php", ["firstname" => $firstname]);
        

       //  	if(file_exists($activate_json))
       //  	{
       //  		//extract the contents of the file
    			// //$content = file($activate_json)
    			// //var_dump($content);
    			// //save json into an array
    			// //$temp_data = json_decode($activate_json, true);
    			// //var_dump("temp array: $temp_data");
    			// //add new array to existing array
    			// // array_push($temp_data, $user_registered);
    			// // var_dump($temp_data);
    			// // //convert into json data
    			// // $json_data = json_encode($user_registered, JSON_FORCE_OBJECT);
    			// // //save into json file
    			// // file_put_contents($activate_json, $json_data, FILE_APPEND | LOCK_EX);
    			// // var_dump(file_put_contents($json_data));
       //  	}
       //  	else
       //  	{
       //  		trigger_error("Can't read file/ file does not found.\r\n");
       //  	}

        	

        	//**user auto-login
        	//get the new user id
        	// remember that user's now logged in by storing user's ID in session
            //**$_SESSION["id"] = $latest_user_id;
            //var_dump($_SESSION["id"]);

            // redirect to confirmation
            //render("registration_success.php", ["firstname" => $firstname]); //TODO
		}

		//select database for user
		// $users = "SELECT `username` FROM `users`";
		
		// if ($result = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in " . $users))
		// {
		//   // Fetch one and one row
		//   while ($row = mysqli_fetch_array($result))
		//   {
		// 	    //verify username with any existing username
		// 	    if ($_POST["username"] == $row["username"])
	 //            {
	 //               reporterror("Username already exists!");
	 //            }
	 //            else
	 //            {
	            	
	 //            }
		//     }
		//   // Free result set
		//   //mysqli_free_result($result);
		// }

		//else display error
		//reporterror("Invalid Username or Password!", $_POST["firstname"]);
	}
?>
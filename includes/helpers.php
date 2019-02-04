<?php
	
	require_once("config.php");
	
	/**
	* Error page
	* Added extra parameter for any additional variable render
	**/
	function reporterror($message,$message2='')
	{
		//echo $message;
		render("error_report.php", ["message" => $message, "message2" => $message2]);
	}

	/**
	* Logout
	**/
	function logout()
	{
		//unset any session variables
		$_SESSION = [];

		//expire cookie
		if(!empty($_COOKIE[session_name()]))
		{
			setcookie(session_name(), "", time() - 42000);
		}

		//destroy session
		session_destroy();
	}

	/**
	* Redirects user to location, which can be URL or
	* a relative path on the localhost
	* http://stackoverflow.com/a/25643550/5156190
	* Because this function outputs an HTTP header, it
    * must be called before caller outputs any HTML.
	**/
	function redirect($location)
	{
		if(headers_sent($file, $line))
		{
			trigger_error("HTTP header already sent at {$file}:{$line}", E_USER_ERROR);
		}
		header("Location: {$location}", false);
		exit();
	}

	/**
	* render views
	**/
	function render($view, $values = [])
	{
		//if view exists render it
		if(file_exists("views/{$view}"))
		{
			//extract variables into equal scope
			extract($values);
			//render view bitween header and footer
			require("views/header.php");
			require("views/{$view}");
			require("views/footer.php");
			//echo "$message";
			exit();
		}
		//else error
		else
		{
			trigger_error("Invalid view: {$view}", E_USER_ERROR);
		}
	}


	/**
	* email notifications
	* send email
	**/
	function send_email($to, $to_name, $from, $from_name, $subject, $message)
	{
		//validate parameters
		if(!empty($to) && !empty($to_name) && !empty($from) && !empty($from_name) && !empty($subject) && !empty($message))
		{
			//HTML header info
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/html; charset=iso-8859-1";
			//additional headers
			$headers[] = "To: {$to_name} <{$to}>";
			$headers[] = "From: {$from_name} <{$from}>";

			//send email
			mail($to, $subject, $message, implode("\r\n", $headers));
		}
		else
		{
			trigger_error("Invalid parameters! Check for valid entries in {$to}, {$to_name}, {$from}, {$from_name}, {$subject}, {$message}", E_USER_ERROR);
		}
		
	}

	/**
	* check if friend request sent to a user
	**/
	function sent_request($user_id, $user_list = [])
	{
		//check for valid entry
		if(empty($user_id) && isset($user_id))
		{
			return $user_id;
			exit();
		}
		else if(empty($user_list) && isset($user_list))
		{
			return $user_list;
			exit();
		}

		//loop to check
		foreach($user_list as $user)
		{
			if($user["friend_user_id"] == $user_id)
			{
				return true;
				exit();
			}
			else
			{
				return false;
				exit();
			}
		}
	}

	/**
	* random function (inbuild in PHP7)
	**/
	if (!function_exists('random_int')) {
	    function random_int($min, $max) {
	        if (!function_exists('mcrypt_create_iv')) {
	            trigger_error(
	                'mcrypt must be loaded for random_int to work', 
	                E_USER_WARNING
	            );
	            return null;
	        }
	        
	        if (!is_int($min) || !is_int($max)) {
	            trigger_error('$min and $max must be integer values', E_USER_NOTICE);
	            $min = (int)$min;
	            $max = (int)$max;
	        }
	        
	        if ($min > $max) {
	            trigger_error('$max can\'t be lesser than $min', E_USER_WARNING);
	            return null;
	        }
	        
	        $range = $counter = $max - $min;
	        $bits = 1;
	        
	        while ($counter >>= 1) {
	            ++$bits;
	        }
	        
	        $bytes = (int)max(ceil($bits/8), 1);
	        $bitmask = pow(2, $bits) - 1;

	        if ($bitmask >= PHP_INT_MAX) {
	            $bitmask = PHP_INT_MAX;
	        }

	        do {
	            $result = hexdec(
	                bin2hex(
	                    mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM)
	                )
	            ) & $bitmask;
	        } while ($result > $range);

	        return $result + $min;
	    }
	}

?>
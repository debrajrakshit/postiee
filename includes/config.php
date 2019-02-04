<?php
	
	/**
	* posti configuration file	
	**/
	//display errors
	ini_set("display_errors", true);
	error_reporting(E_ALL);

	//require
	require_once("helpers.php");
	require_once("params.php");

	//database details
	$host = "localhost";
	$user = "orzuywi_KI7J56";
	$password = ")*0a-]wr*sK";
	$database = "orzuywi_ptdemo1";

	//database details
	// $host = "localhost";
	// $user = "root";
	// $password = "dbadmin";
	// $database = "postiee";

	//create connection
	// $conn = new PDO('mysql:dbname=posti;host=localhost;charset=utf8', 'root', 'dbadmin');
	// $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$conn = new mysqli($host, $user, $password, $database);
	//check connection
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	//$conn->close();

	//enable sessions
	session_start();


	// $users = $conn->query("SELECT * FROM `users` WHERE `username` = ?", $_POST["username"]);
	// $user = $users->fetch_array(MYSQL_BOTH);

	// $_SESSION["username"] = $user["username"];

	// echo $_SESSION["username"];

	//pages don't required authentications
	// if(!in_array($_SERVER["PHP_SELF"], ["/index.php", "/login.php", "/logout.php", "/register.php"]))
	// {
	// 	if(empty($_SESSION["id"]))
	// 	{
	// 		redirect("login.php");
	// 	}
	// }



?>
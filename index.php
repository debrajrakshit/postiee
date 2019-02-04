<?php 

  //configuration
  require("includes/config.php");

  if(empty($_SESSION["id"]))
  {
    //render homepage view
    render("homepage.php", ["title" => "Welcome to Postiee"]);
  }
  else
  {
    //get user details
    $userid = $_SESSION["id"];
    $users = "SELECT * FROM `users` WHERE `id` = '".$userid."'";

    //query for user details from row
    if($user = mysqli_query($conn,$users) or trigger_error(mysql_error() . "in ". $users))
    {
      while($row = mysqli_fetch_array($user))
      {
        //save user details in variables
        $firstname = $row["firstname"];
      }
    }

    //render homepage view
    render("homepage.php", ["title" => "Welcome to Postiee", "firstname" => $firstname]);
  }
  
?>
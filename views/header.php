<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Postiee - Your digital solution for Post-it Notes">
    <link rel="shortcut icon" href="favicon.ico">

    <?php if(isset($title)): ?>
    <title><?php echo "Postiee - " . htmlspecialchars($title); ?></title>
    <?php else: ?>
    <title>Posti - Virtual Post-it notes</title>
    <?php endif ?>

    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      //form validations
      function validate(form){
        //check if values are empty
        if(valid)
        {
          alert("This note will be archived!");
        }
      }
    </script>
  </head>
  <body>
  <header id="header">
    <!-- navigation starts -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Postiee" class="img-fluid"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="whiteboard.php">Whiteboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="help.php">Help</a>
          </li>
        </ul>
        <ul class="my-2 my-lg-0 navbar-nav navbar-right">
          <?php
          if(empty($_SESSION["id"]))
          {
            echo '<li class="nav-item"><a href="account.php" class="nav-link">Welcome! Guest<span class="sr-only">(current)</span></a></li>';
            echo '<li class="nav-item"><a href="login.php" class="nav-link">Log in <span class="sr-only">(current)</span></a></li>';
            echo '<li class="nav-item"><a href="register.php" class="nav-link">Sign up <span class="r-only">(current)</span></a></li>';
          }
          else
          {
            //if additional variable is available
            if(isset($message2))
            {
              echo '<li class="nav-item"><a href="account.php" class="nav-link"><div class="profile-pic"><img src="img/user.png"></div> '. htmlspecialchars($message2) .'<span class="sr-only">(current)</span></a></li>';
            }
            else if(isset($firstname))
            {
              echo '<li class="nav-item"><a href="account.php" class="nav-link"><div class="profile-pic">';
              if(isset($profile_pic) && $profile_pic != "")
              {
                echo '<img src="'. htmlspecialchars($profile_pic) .'" alt="'. htmlspecialchars($firstname) .'">';
              }
              else
              {
                echo htmlspecialchars($profile_pic);
                echo '<img src="img/user.png">';
              }
              echo '</div></span>'. htmlspecialchars($firstname) .'<span class="sr-only">(current)</span></a></li>';
            }
            else
            {
              echo '<li class="nav-item"><a href="account.php" class="nav-link"><div class="profile-pic"><img src="img/user.png"></div>Welcome! guest<span class="sr-only">(current)</span></a></li>';
            }
            echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout <span class="sr-only">(current)</span></a></li>';
            echo '<li class="nav-item"><a href="account.php" class="nav-link">My Account <span class="sr-only">(current)</span></a></li>';
          }

           ?>
          <li><a href="/"> </a></li>
        </ul>
      </div>
    </nav>
    <!-- navigation ends -->

  </header>
  <div class="clearfix"></div>
    <!-- Main content starts -->
    <div id="main-wrapper" class="main-wrapper">
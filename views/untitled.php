<!-- navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Postiee"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="whiteboard.php">Whiteboard</a></li>
              <li><a href="help.php">Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                if(empty($_SESSION["id"]))
                {
                  echo "<li><a href='account.php'>Welcome! Guest<span class='sr-only'>(current)</span></a></li>";
                  echo "<li><a href='login.php'>Log in <span class='sr-only'>(current)</span></a></li>";
                  echo "<li><a href='register.php'>Sign up <span class='sr-only'>(current)</span></a></li>";
                }
                else
                {
                  //if additional variable avaibale from helpers.php
                  if(isset($message2))
                  {
                    //render secondary data from helpers.php erropage
                    echo "<li><a href='account.php'><div class='profile-pic'><img src='img/user.png'></div></span>" . htmlspecialchars($message2) . "<span class='sr-only'>(current)</span></a></li>";
                  }
                  else if(isset($firstname))
                  {
                    echo "<li><a href='account.php'><div class='profile-pic'>";
                    if(isset($profile_pic) && $profile_pic != "")
                    {
                      echo "<img src='".htmlspecialchars($profile_pic)."' alt='".htmlspecialchars($firstname)."'>";
                    }
                    else
                    {
                      echo "<img src='img/user.png'>";
                    }
                    echo "</div></span>" . htmlspecialchars($firstname) . "<span class='sr-only'>(current)</span></a></li>";
                  }
                  else
                  {
                    echo "<li><a href='account.php'><div class='profile-pic'><img src='img/user.png'></div>Welcome! Guest<span class='sr-only'>(current)</span></a></li>";
                  }
                  //echo "<li><a href='account.php'>" . htmlspecialchars($firstname) . "<span class='sr-only'>(current)</span></a></li>";
                  echo "<li><a href='logout.php'>Log out <span class='sr-only'>(current)</span></a></li>";
                  echo "<li><a href='account.php'>My Account <span class='sr-only'>(current)</span></a></li>";
                }
              ?>
              
              <li><a href="./" class=""> </a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    <!-- Nav Ends -->
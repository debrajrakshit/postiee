<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
    <div class="postit-section-title">
      <h3><?php echo "You have currently <strong>" . $total_friends . "</strong> friends, " . $firstname ?></h3>
    </div>
    <div class="postit-section-posts">
      <div class="row justify-content-center">
        <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="page-content">
            <p>Here is a list of all your friends:</p>
            <a href="add_friend.php" class="btn btn-lg btn-add"><span class="flaticon-cross8"></span> Find Friends</a>
            <ul class="list-group">
              <li class='list-group-item list-group-header'>
                <span class='badge header-badge'><!--Edit/Update--></span><!-- <span class='project-id'>#id</span> --><span class='project-title'>Name</span>
              </li>
              <?php
                //check if there is any friends in array
                // if(empty($friend_list))
                // {
                //   echo "Currently no friend to display. Why not add one!";
                // }
                //iterate through each values per row
                foreach ($friend_list as $friend)
                {
                  echo "<li class='list-group-item'>";
                  //echo "<a href='edit_project.php?projectid=".$friend["user_id"]."' class='badge edit-account-link'>Edit Project Title</a>";
                  //echo "<span class='project-id'>" . "#". $friend["user_id"]. "</span> ";
                  echo "<div class='profile-pic'>";
                    if(isset($friend["user_profile_pic"]) && !empty($friend["user_profile_pic"]) && $friend["user_profile_pic"] != "")
                    {
                      echo "<img src='".htmlspecialchars($friend["user_profile_pic"])."'>";
                    }
                    else
                    {
                      echo "<img src='img/user.png'>";
                    }
                  echo "</div>";
                  echo "<span class='project-title'>".htmlspecialchars($friend["firstname"])." ".htmlspecialchars($friend["lastname"])."</span>";
                  echo "</li>";
                }
              ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- whiteboard content ends -->
<!-- load whiteboard footer -->
<?php include("whiteboard_footer.php"); ?>
<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
    <div class="postit-section-title">
      <h3><?php echo "Total users found <strong>" . $total_users . "</strong>" ?></h3>
    </div>
    <div class="postit-section-posts">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="page-content">
            <!-- <a href="add_friend.php" class="btn btn-lg btn-add"><span class="flaticon-cross8"></span> Add Friend</a> -->
            <div class="search-friends">
              <form class="form-inline" action="#" method="GET">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="Name or Phone number">
                    <div class="input-group-addon input-search-icon"><span class="flaticon-search7"></span></div>
                  </div>
                </div>
                <button type="submit" class="btn btn-lg btn-add">Search</button>
              </form>
              <a class="btn btn-lg btn-add" href="invite_friend.php">Invite a friend</a>
            </div>
            <div id="result"></div>
            <ul class="list-group">
              <li class='list-group-item list-group-header'>
                <span class='badge header-badge'><!--Edit/Update--></span><span class='project-title'>Name</span>
              </li>
              <?php
                //iterate through each values per row
                foreach ($users_data as $user)
                {
                  echo "<li class='list-group-item'>";
                  //check if request alreay sent and pending
                  //only render cancel request form then
                  $status = sent_request($user["id"], $request_status);
                  if($status == TRUE)
                  {
                    echo "Sent";
                  }
                  else
                  {
                    echo "Not sent";
                  }

                  //add friend form
                    echo "<form id='add-friend' class='add-friend-form-id-".$user['id']."' action='add_friend.php' method='post'>";
                    echo "<input type='hidden' name='friend_id' value='".$user['id']."' class='friend-id'>";
                    echo "<button name='submit' type='submit' value='add_friend' class='badge add-friend-link fid-".$user['id']."'>Add Friend</button>";
                    echo "</form>";
                    //cancel form
                    echo "<form id='cancel-friend' class='cancel-friend-form-id-".$user['id']."' action='cancel_request.php' method='post'>";
                    echo "<input type='hidden' name='friend_id' value='".$user['id']."' class='friend-id'>";
                    echo "<button name='submit' type='submit' value='cancel_friend' class='badge cancel-friend-link cancel-id-".$user['id']."'>Cancel Request</button>";
                    echo "</form>";

                  //echo "<a href='add_friend.php?userid=".$user["id"]."' class='badge edit-account-link'>Add Friend</a>";
                  echo "<div class='profile-pic'>";
                    //var_dump($user["user_profile_pic"]);
                    if(isset($user["user_profile_pic"]) && !empty($user["user_profile_pic"]) && $user["user_profile_pic"] != "")
                    {
                      echo "<img src='".htmlspecialchars($user["user_profile_pic"])."'>";
                    }
                    else
                    {
                      echo "<img src='img/user.png'>";
                    }
                  echo "</div>";
                  echo "<span class='project-title'>" . htmlspecialchars($user["firstname"]) . " ". htmlspecialchars($user["lastname"]) . "</span>";
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
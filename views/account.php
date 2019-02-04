<!-- page content starts here -->
<section id="page" class="page-wrapper">
  <div class="content">
    <div class="container master-container" role="main">
      <div class="row justify-content-center">
        <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="icon-block icon-register">
            <?php
              if($profile_pic != "")
              {
                echo "<img src='".htmlspecialchars($profile_pic)."' alt='".htmlspecialchars($firstname)."' class='profile-display-pic'>";
              }
              else
              {
                echo "<span class='flaticon-profile'></span>";
              }
            ?>
          </div>
          <div class="page-title">
          <h1>My Account</h1>
          </div>
          <div class="page-content">
            <p>Edit your personal details</p>
            <div class="row profile-display">
              <a href="edit_account.php" class="">Add/Update profile picture</a>
            </div>
            <ul class="list-group list-profile">
              <li class="list-group-item">
                Username (cannot be changed): <span class="label label-primary"><?php echo htmlspecialchars($username); ?></span>
              </li>
              <li class="list-group-item">
                <a href="edit_account.php" class="badge edit-account-link">Add/Edit First Name</a>
                First Name: <span class="label label-primary"><?php echo htmlspecialchars($firstname); ?></span>
              </li>
              <li class="list-group-item">
                <a href="edit_account.php" class="badge edit-account-link">Add/Edit Last Name</a>
                Last Name: <span class="label label-primary"><?php echo htmlspecialchars($lastname); ?></span>
              </li>
              <li class="list-group-item">
                <a href="edit_account.php" class="badge edit-account-link">Change Email</a>
                Email: <span class="label label-primary"><?php echo htmlspecialchars($email); ?></span>
              </li>
              <li class="list-group-item">
                <a href="edit_account.php" class="badge edit-account-link">Change Password</a>
                Password
              </li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>
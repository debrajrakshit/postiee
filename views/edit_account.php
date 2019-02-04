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
            <p>Edit your account info</p>
            <form action="edit_account.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="firstname">First Name</label>
              <?php echo "<input type='text' name='firstname' placeholder='First Name' value='".$firstname."' class='form-control'>" ?>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <?php echo "<input type='text' name='lastname' placeholder='Last Name' value='".$lastname."' class='form-control'>" ?>
            </div>
            <div class="form-group">
              <label for="username">Email</label>
              <?php echo "<input type='email' name='email' placeholder='Email' value='".$email."' class='form-control'>" ?>
            </div>
            <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Confirm New Password</label>
              <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="firstname">Profile Picture <small>(support jpg/gif/png upto 2mb)</small></label>
              <?php echo "<input type='file' name='avatar' class=''>" ?>
            </div>
            <div class="form-group">
              <button name="submit" value="editaccount" class="btn btn-lg btn-login"><span class="flaticon-circle10"></span> Save</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>
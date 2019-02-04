<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3><?php echo "Congrats! You and <strong>" . $new_friend["firstname"]. " " . $new_friend["lastname"] . "</strong> are now friends." ?></h3>
      </div>
      <div class="postit-section-posts">
        <div class="row">
          <!-- add postit block -->
          <div class="col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
            <div class="postit-add">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <a href="assign_project.php" class="btn btn-lg btn-login"><span class="flaticon-social7"></span> Assign a project</a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <a href="friends.php" class="btn btn-lg btn-view"><span class="flaticon-group2"></span> View friends</a>
                </div>
              </div>
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
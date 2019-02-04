<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Invite a friend</h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form class="form-horizontal" action="invite_friend.php" method="post">
                <div class="form-group">
                  <label for="friends_email" class="col-sm-2 control-label">Friends' Email: <span class="require">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="friends_email" class="form-control" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <button type="submit" name="submit" value="Add" class="btn btn-lg btn-login"><span class="flaticon-double4"></span> Invite</button>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <a href="add_friend.php" class="btn btn-lg btn-cancel"><span class="flaticon-prohibited1"></span> Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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
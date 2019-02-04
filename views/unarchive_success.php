<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Unarchived <?php echo htmlspecialchars($obj_type); ?> id#: <?php echo htmlspecialchars($obj_id); ?></h3>
      </div>
      <div class="postit-section-posts">
        <div class="row">
          <!-- add postit block -->
          <div class="col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
            <div class="postit-add">
              <p><?php echo htmlspecialchars($obj_type); ?> id: <span class="require"><?php echo $obj_id; ?></span> unarchived successfully.</p>
              <p><a href="whiteboard.php" class="btn btn-lg btn-login"><span class="flaticon-3x3"></span> View Whiteboard</a></p>
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
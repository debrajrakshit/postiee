<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Edit note id#: <?php echo htmlspecialchars($note_data["id"]); ?></h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="postit-add success-message-wrapper">
              <p>Note id: <span class="require"><?php echo $note_data["id"]; ?></span> updated successfully.</p>
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
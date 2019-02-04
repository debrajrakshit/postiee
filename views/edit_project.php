<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Edit project: <?php echo "<strong>" .htmlspecialchars_decode($project_name) . "</strong>"; ?></h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form class="form-horizontal" action="edit_project.php" method="post">
                <input type="hidden" name="projectid" value=<?php echo $projectid; ?>>
                <div class="form-group row">
                  <label for="projectname" class="col-sm-4 control-label">Project Name: <span class="require">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="projectname" class="form-control" placeholder="Project Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button type="submit" name="submit" value="Add" class="btn btn-lg btn-login"><span class="flaticon-double4"></span> Update Project</button>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <a href="projects.php" class="btn btn-lg btn-cancel"><span class="flaticon-prohibited1"></span> Cancel</a>
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
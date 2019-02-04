<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Create a project</h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form class="form-horizontal" action="add_project.php" method="post">
                <div class="form-group row">
                    <label for="projectname" class="col-sm-4 col-form-label">Project Name: <span class="require">*</span></label>
                    <div class="col-sm-8">
                      <input type="text" name="projectname" class="form-control" placeholder="Project Name" required>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <button type="submit" name="submit" value="Add" class="btn btn-lg btn-login"><span class="flaticon-cross8"></span> Create Project</button>
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
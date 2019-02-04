<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Group with friends in a project</h3>
      </div>
      <div class="postit-section-posts">
        <div class="row">
          <!-- add postit block -->
          <div class="col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form action="assign_project.php" method="post" class="form-horizontal">
                <div class="form-group">
                  <label for="projects" class="col-sm-2 control-label">Project: <span class="require">*</span></label>
                  <div class="col-sm-10">
                    <select id="projects" name="project" class="form-control" required>
                      <option value="">-- Select Project --</option>
                      <?php
                        foreach ($projects as $project)
                        {
                          foreach($project_name_list as $project_name)
                          {
                            //check if project_id of project_assigned matches with project id
                            if($project["project_id"] == $project_name["project_id"])
                            {
                              echo "<option value=". $project["project_id"] .">" . $project_name["project_name"] . "</option>";
                            }
                          }
                          
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="data1" class="col-sm-2 control-label">Friend: <span class="require">*</span></label>
                  <div class="col-sm-10">
                    <select id="friend" name="friend" class="form-control" required>
                      <option value="">-- Select Friend --</option>
                      <?php
                        foreach ($friends as $friend)
                        {
                          echo "<option value=". $friend["user_id"] .">" . $friend["firstname"] . " " . $friend["lastname"] ."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-4 col-md-4 col-lg-4">
                        <button name="submit" value="addnote" class="btn btn-lg btn-login"><span class="flaticon-cross8"></span> Add</button>
                      </div>
                      <div class="col-sm-4 col-md-4 col-lg-4">
                        <a href="whiteboard.php" class="btn btn-lg btn-cancel"><span class="flaticon-prohibited1"></span> Cancel</a>
                      </div>
                      <div class="col-sm-4 col-md-4 col-lg-4">
                        <a href="add_friend.php" class="btn btn-lg btn-view"><span class="flaticon-group2"></span> Add a friend</a>
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
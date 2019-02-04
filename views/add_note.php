<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Add a note</h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form action="add_note.php" method="post" class="form-horizontal">
                <div class="form-group row">
                  <label for="projects" class="col-sm-4 control-label">Project: <span class="require">*</span></label>
                  <div class="col-sm-8">
                    <select id="projects" name="project" class="form-control" required>
                      <option value="">-- Select Project --</option>
                      <?php
                        foreach ($projects as $project)
                        {
                          echo "<option value=". $project["project_id"] .">" . htmlspecialchars($project["project_name"]) . "</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data1" class="col-sm-4 control-label">Note 1: <span class="require">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="data1" class="form-control" placeholder="Note 1" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data2" class="col-sm-4 control-label">Note 2:</label>
                  <div class="col-sm-8">
                    <input type="text" name="data2" class="form-control" placeholder="Note 2">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data3" class="col-sm-4 control-label">Note 3:</label>
                  <div class="col-sm-8">
                    <input type="text" name="data3" class="form-control" placeholder="Note 3">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data4" class="col-sm-4 control-label">Note 4:</label>
                  <div class="col-sm-8">
                    <input type="text" name="data4" class="form-control" placeholder="Note 4">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data5" class="col-sm-4 control-label">Note 5:</label>
                  <div class="col-sm-8">
                    <input type="text" name="data5" class="form-control" placeholder="Note 5">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bgcolor" class="col-sm-4 control-label">Post-it color:</label>
                  <div class="col-sm-8">
                    <?php echo "<input type='color' name='bgcolor' value='".htmlspecialchars('#f77e9d')."'>" ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button name="submit" value="addnote" class="btn btn-lg btn-login"><span class="flaticon-cross8"></span> Add</button>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <a href="whiteboard.php" class="btn btn-lg btn-cancel"><span class="flaticon-prohibited1"></span> Cancel</a>
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
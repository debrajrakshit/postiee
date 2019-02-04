<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
      <div class="postit-section-title">
        <h3>Edit note id# <?php echo "<strong>" .htmlspecialchars($note_data["id"]) . "</strong>"; ?></h3>
      </div>
      <div class="postit-section-posts">
        <div class="row justify-content-center">
          <!-- add postit block -->
          <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="postit-add">
              <p><span class="require">*</span> Marked fields are mandatory.</p>
              <form action="edit_note.php" method="post" class="form-horizontal">
                <?php echo "<input type='hidden' name='note_id' value='".$note_data["id"]."'>" ?>
                  <div class="form-group row">
                      <label for="projects" class="col-sm-4 control-label">Project: </label>
                    <div class="col-sm-8">
                      <fieldset disabled="">
                        <select id="projects" name="project" class="form-control">
                          <?php echo "<option id='disabledSelect' value='".$project_name['id']."'>" . htmlspecialchars($project_name['project_name']). "</option>"; ?>
                        </select>
                      </fieldset>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data1" class="col-sm-4 control-label">Note 1: <span class="require">*</span></label>
                    <div class="col-sm-8">
                      <?php echo "<input type='text' name='data1' class='form-control' placeholder='Note 1' value='".$note_data['data1']."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data2" class="col-sm-4 control-label">Note 2:</label>
                    <div class="col-sm-8">
                      <?php echo "<input type='text' name='data2' class='form-control' placeholder='Note 2' value='".$note_data['data2']."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data3" class="col-sm-4 control-label">Note 3:</label>
                    <div class="col-sm-8">
                      <?php echo "<input type='text' name='data3' class='form-control' placeholder='Note 3' value='".$note_data['data3']."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data4" class="col-sm-4 control-label">Note 4:</label>
                    <div class="col-sm-8">
                      <?php echo "<input type='text' name='data4' class='form-control' placeholder='Note 4' value='".$note_data['data4']."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data5" class="col-sm-4 control-label">Note 5:</label>
                    <div class="col-sm-8">
                      <?php echo "<input type='text' name='data5' class='form-control' placeholder='Note 5' value='".$note_data['data5']."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bgcolor" class="col-sm-4 control-label">Post-it color:</label>
                    <div class="col-sm-8">
                      <?php echo "<input type='color' name='bgcolor' value='".htmlspecialchars($note_data['bg_color'])."'>"; ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                      <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <button name="submit" value="savenote" class="btn btn-lg btn-login"><span class="flaticon-pencil12"></span> Save</button>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <a href="whiteboard.php?type=project&ID=<?php echo htmlspecialchars($project_name['id']); ?>" class="btn btn-lg btn-cancel"><span class="flaticon-prohibited1"></span> Cancel</a>
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
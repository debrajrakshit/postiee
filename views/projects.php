<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
    <div class="postit-section-title">
      <h3>All Projects</h3>
    </div>
    <div class="postit-section-posts">
      <div class="row justify-content-center">
        <div class="mx-auto col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="page-content">
            <p>Here is a list of all your projects:</p>
            <a href="add_project.php" class="btn btn-lg btn-add"><span class="flaticon-cross8"></span> Add New</a>
            <a href="assign_project.php" class="btn btn-lg btn-add"><span class="flaticon-social7"></span> Assign a friend</a>
            <ul class="list-group">
              <li class='list-group-item list-group-header'>
                <div class="row">
                  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"><span class="project-id">#id</span></div>
                  <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4"><span class="project-title">Project Title</span></div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"><span class="project-assigned">Members Assigned</span></div>
                  <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3 col-xl-3"><span class="badge header-badge">Edit/Update</span></div>
                </div>
              </li>
              <?php
                //iterate through each values per row
                foreach ($projects as $project)
                {
                  echo "<li class='list-group-item'>";
                  echo "<div class='row'>";
                  echo "<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'><span class='project-id'>" . "#". $project["project_id"]. "</span></div>";
                  echo "<div class='col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4'><span class='project-title'>" . htmlspecialchars_decode($project["project_name"], ENT_QUOTES) . "</span>";
                  echo "<span class='note-count'>(". $project["total_notes"] .")</span></div>";
                  //fetch the username-s from variable by project id
                  echo "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>";
                  foreach($user_assigned as $user_fetch)
                  {
                    if($user_fetch["project_id"] == $project["project_id"])
                    {
                      echo "<span class='project-assigned'>".$user_fetch["user_firstname"]."</span>";
                    }
                  }
                  echo "</div>";
                  echo "<div class='col-xs-1 col-sm-1 col-md-3 col-lg-3 col-xl-3'><a href='edit_project.php?projectid=".$project["project_id"]."' class='badge edit-account-link'>Edit Project Title</a></div>";
                  echo "</div>";
                  echo "</li>";
                }
              ?>

            </ul>
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
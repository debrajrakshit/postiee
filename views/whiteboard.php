<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">

<!-- project section starts -->
  <?php

    //***
    //check if there is any data avaibale for display
    //if not just display message
    if(empty($note_data))
    {
      echo "<div class='notice-block'>";
      echo "<p>There is no data to display! Create your first virtual post-it.</p>";
      echo "<div class='row'>";
      echo "<div class='col-sm-12 col-md-6 col-lg-6 col-md-offset-3'>";
      echo "<div class='row'>";
      echo "<div class='col-md-6 col-lg-6'>";
      echo "<p><a href='projects.php' class='btn btn-lg btn-login'><span class='flaticon-cross8'></span> Create a project</a></p>";
      echo "</div>";
      echo "<div class='col-md-6 col-lg-6'>";
      echo "<p><a href='add_note.php' class='btn btn-lg btn-view'><span class='flaticon-profile'></span> Create a note</a></p>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }

    echo "<div class='container-fluid'>";
    echo "<div class='row wb-projects'>";
    //*** project loop starts
    //for each project data
    foreach($project_data as $project)
    {
      //check if projects has notes
      if($project["total_notes"] != 0)
      {
        echo "<div class='wb-project-card'>";
        echo "<a href='whiteboard.php?type=project&ID=" . $project["project_id"] . "' class='wb-project-link'></a>";
        echo "<h3>" . $project["project_name"] . "</h3>";
        echo "<span class='note-count-main'>Notes: ". $project["total_notes"] ."</span>";
        echo "</div>";
      }
    }
    //project loop ends
    echo "</div>";
    echo "</div>";
  ?>
<!-- project section ends -->

</div>
<div class="clearfix"></div>
<!-- whiteboard content ends -->
<!-- load whiteboard footer -->
<?php include("whiteboard_footer.php"); ?>
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
      //check if project ID matches requested project and projects has notes
      if($project["total_notes"] != 0)
      {
        echo "<div class='postit-section'>";
        echo "<div class='postit-section-title'>";
        echo "<h3> Project: " . $project["project_name"] . "<span class='note-count'>Total notes: ". $project["total_notes"] ."</span></h3>";
        echo "</div>";
        echo "<div class='postit-section-posts'>";
        //echo "<div class='row'>";
        echo "<ul id='notes-sortable' class='notes-sortable'>";

        //*** note loop starts here
        //iterate through each note data array
            foreach($note_data as $note)
            {
              //check if note_id matches with project category note_ids
              //and note is not archived
              if($note["archived"] != 1)
              {
                echo "<li>";
                echo "<div id='notes-block' class='note-wrapper'>";
                $bg_color = htmlspecialchars($note['bg_color']);
                echo "<div class='postit postit-id-". $note['note_id'] . " ' style='background-color:".$note['bg_color']."'>";
                echo "<div class='postit-header'>";

                //time-stamp
                echo "<span class='last-update'>Last update: ". date_format(date_create($note["last_update"]), 'jS F Y \a\t H:i:s') ."</span>";

                //acrchive note
                echo "<form action='archive_note.php' method='post' onsubmit='return validate(this);'>";
                echo "<input type='hidden' name='project_id' value='".$project['project_id']."'>";
                echo "<input type='hidden' name='note_id' value='".$note['note_id']."'>";
                echo "<button name='submit' value='archive' class='postit-close'><span class='' data-toggle='tooltip' data-placement='top' title='Archive'>X</span></button>";
                echo "</form>";
                //edit note
                echo "<a href='edit_note.php?noteid=".$note['note_id']."'><span class='postit-edit' data-toggle='tooltip' data-placement='top' title='Edit'><i class='flaticon-pencil12'></i></span></a>";

                //echo "<a href='#'><span class='postit-close' data-toggle='tooltip' data-placement='top' title='Archive'>X</span></a>";
                //echo "<a href='#'><span class='postit-edit' data-toggle='tooltip' data-placement='top' title='Edit'><i class='flaticon-pencil12'></i></span></a>";
                echo "</div>";
                echo "<div class='postit-content'>";
                echo "<ol class='note-lists'>";
                      //render field if data available
                      if($note["data1"])
                      {
                        echo "<li>" . htmlspecialchars_decode($note["data1"]) . "</li>";
                      }
                      if($note["data2"])
                      {
                        echo "<li>" . htmlspecialchars_decode($note["data2"]) . "</li>";
                      }
                      if($note["data3"])
                      {
                        echo "<li>" . htmlspecialchars_decode($note["data3"]) . "</li>";
                      }
                      if($note["data4"])
                      {
                        echo "<li>" . htmlspecialchars_decode($note["data4"]) . "</li>";
                      }
                      if($note["data5"])
                      {
                        echo "<li>" . htmlspecialchars_decode($note["data5"]) . "</li>";
                      }
                echo "</ol>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</li>";
              }
            }
        //note loop ends here
        echo "</ul>";
        //echo "</div>";
        echo "</div>";
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
<!-- load whiteboard header -->
<?php include("whiteboard_header.php"); ?>
<!-- whiteboard content starts -->
<div class="page-content">
  <div class="postit-section">
    <div class="postit-section-title">
      <h3><?php echo "Archive" ?></h3>
    </div>
    <div class="postit-section-posts">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
          <div class="page-content">
            <form class="form-inline" action="#" method="get">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" id="exampleInputAmount" placeholder="Your Query">
                  <div class="input-group-addon input-search-icon"><span class="flaticon-search7"></span></div>
                </div>
              </div>
              <button type="submit" class="btn btn-lg btn-add">Search</button>
            </form>
            <ul class="list-group">
              <li class='list-group-item list-group-header'>
                <span class='tab-title'>Object</span><span class='tab-title'>User</span><span class='tab-title'>Type</span><span class='tab-title'>Restore</span>
              </li>
              <?php
                //check if there is any friends in array
                // if(empty($friend_list))
                // {
                //   echo "Currently no friend to display. Why not add one!";
                // }
                //iterate through each values per row
                foreach ($track_records as $track_record)
                {
                  //check if the object is archived only render
                  //check if there is no duplicate render
                  if($track_record["archived"] != 0)
                  {
                      echo "<li class='list-group-item'>";
                      echo "<span class='tab-data'>" . $track_record["obj_type"]. "</span> ";
                      echo "<span class='tab-data'>" . htmlspecialchars($track_record["firstname"]) . " </span>";
                      echo "<span class='tab-data'>" . htmlspecialchars($track_record["mod_type"]) . " </span>";
                      echo "<form action='unarchive.php' name='unarchive' class='inline-form' method='post'>";
                      echo "<input type='hidden' name='obj_id' value='". $track_record["obj_id"] ."'>";
                      echo "<input type='hidden' name='obj_type' value='". htmlspecialchars($track_record["obj_type"]) ."'>";
                      echo "<button type='submit' class='btn_restore' value='unarchive'><span class='' data-toggle='tooltip' data-placement='top' title='Restore'>Restore</span></button>";
                      echo "</form>";
                      echo "</li>";
                  }
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
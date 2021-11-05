<?php
ob_start();
session_start(); 
$active_page = "applications";
// Include database class
include_once '../inc/db.php';
if(!isset($_SESSION['userSession'])){
  header("Location: ../index");
  exit;
}elseif (isset($_SESSION['userSession'])){
  $user_id = $_SESSION['userSession'];
  $app_id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('inc/header.php');?>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include('inc/_navbar.php'); ?>
    <!-- partial -->
    <div class="../container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include('inc/_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Exeat Application</h4>
                  <div id="get_result"></div>
                  <?php 
                      $record = Database::getInstance()->select_from_where2("Applications","applicationID",$app_id);
                      foreach ($record as $data) {
                        $studentID = $data['studentID'];
                        $leavetype = $data['leave_type'];
                        $destination = $data['destination'];
                        $depatureDate = $data['depatureDate'];
                        $matricNumber = Database::getInstance()->get_name_from_id("matricNumber","Students","id",$studentID);
                        $dpt_id = Database::getInstance()->get_name_from_id("department_id","Students","id",$studentID);
                        $department = Database::getInstance()->get_name_from_id("departmentName","Departments","id",$dpt_id);
                        $hall_id = Database::getInstance()->get_name_from_id("hall_id","Students","id",$studentID);
                        $hall = Database::getInstance()->get_name_from_id("hallName","Halls","id",$hall_id);
                        $email = Database::getInstance()->get_name_from_id("email","Students","id",$studentID);
                        $pn = Database::getInstance()->get_name_from_id("phoneNumber","Students","id",$studentID);
                        $rec = Database::getInstance()->select_from_where2("Students","id",$studentID);
                        foreach ($rec as $fn) {
                          $fullname = $fn['lastName']." ".$fn['middleName'].$fn['firstName'];
                        }
                  ?>
                    <div class="row">
                      <label for="fullname" class="col-sm-3 col-form-label">Applicant's Fullname</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $fullname; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="matricNumber" class="col-sm-3 col-form-label">Matric Number</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $matricNumber; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="department" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $department; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="hall" class="col-sm-3 col-form-label">Hall Of Residence</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $hall; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $email; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $pn; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="department" class="col-sm-3 col-form-label">Guardian's 1 Full Name</label>
                      <div class="col-sm-9">
                        <span class="text-default"></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="department" class="col-sm-3 col-form-label">Guardian's 1 Contact</label>
                      <div class="col-sm-4">
                        <span class="text-default">Phone Number</span>
                      </div>
                      <div class="col-sm-4">
                        <span class="text-default">Email</span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="department" class="col-sm-3 col-form-label">Guardian's 2 Full Name</label>
                      <div class="col-sm-9">
                        <span class="text-default"></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="department" class="col-sm-3 col-form-label">Guardian's 2 Contact</label>
                      <div class="col-sm-4">
                        <span class="text-default">Phone Number</span>
                      </div>
                      <div class="col-sm-4">
                        <span class="text-default">Email</span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="destination" class="col-sm-3 col-form-label">Exeat Type</label>
                      <div class="col-sm-9">
                        <span class="text-default">
                          <?php 
                            if ($data['leave_type'] == "short") {?>
                            <div class="badge badge-warning">Short</div>
                            <?php } else {?>
                            <div class="badge badge-success">Long</div>
                            <?php }
                            
                          ?>
                        </span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="destination" class="col-sm-3 col-form-label">Destination</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $data['destination']; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Departure Date</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $data['depatureDate']; ?></span>
                      </div>
                    </div>
                      <?php
                      $ext = Database::getInstance()->select_from_where2('Extensions','applicationID',$app_id);
                      foreach ($ext as $ex) {
                        if ($ex == NULL) { ?>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Return Date</label>
                            <div class="col-sm-9">
                              <span class="text-default"><?php echo $data['returnDate']; ?></span>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Period</label>
                            <div class="col-sm-9">
                              <span class="text-default"><b><?php $diff = date_diff(date_create($data['depatureDate']),date_create($data['returnDate'])); echo $diff->format("%a days"); ?></b></span>
                            </div>
                          </div>
                          <div class="row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reason For Leave</label>
                            <div class="col-sm-9">
                              <span class="text-default"><?php echo $data['reason']; ?></span>
                            </div>
                          </div>
                       <?php }else{ ?>
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Return Date</label>
                          <div class="col-sm-9">
                            <span class="text-default"><?php echo $ex['returnDate']; ?></span>
                          </div>
                        </div>
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Period</label>
                          <div class="col-sm-9">
                            <span class="text-default"><b><?php $diff = date_diff(date_create($data['depatureDate']),date_create($ex['returnDate'])); echo $diff->format("%a days"); ?></b></span>
                          </div>
                        </div>
                        <div class="row">
                          <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reason For Leave</label>
                          <div class="col-sm-9">
                            <span class="text-default"><?php echo $ex['reason']; ?></span>
                          </div>
                        </div>
                        <?php if ($data['dayLeft'] == NULL && $data['dateReturned'] == NULL){ ?>
                            <h4 class="h4 title mt-5 mb-3">Sign</h4>
                            <div class="row p-5">
                              <div class="col">
                                  <button type="button" class="btn btn-info" onclick="change(<?php echo $app_id; ?>,1);">Student Left Today</button>
                              </div>
                              <div class="col">
                                  <a href="Applications" class="btn btn-light">Go Back</a>
                              </div>
                            </div>
                          <?php }else if ($data['dayLeft'] != NULL && $data['dateReturned'] == NULL){ ?>
                            <h4 class="h4 title mt-5 mb-3">Grant Exeat Approval</h4>
                            <div class="row p-5">
                              <div class="col">
                                  <button type="button" class="btn btn-info"  onclick="change(<?php echo $app_id; ?>,2);">Student Returned Today</button>
                              </div>
                              <div class="col">
                                  <a href="Applications" class="btn btn-light">Go Back</a>
                              </div>
                            </div>
                          <?php } ?>
                       <?php }
                      }
                    } ?>

                    <div class="row p-4" style="background-color:#F4F6FF;" id="comments">
                      <div class="col-lg-12">
                        <h4 class="m-2 text-center ">Comments</h4>
                        <form id="newComment">
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Comment</label>
                              <div class="col-sm-8">
                                <textarea  name="comment" class="form-control" placeholder="Comment Goes Here"></textarea>
                              </div>
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary btn-icon-text">
                            <i class="ti-file btn-icon-prepend"></i>Submit</button>
                            </div>
                            </div>
                        </form>
                      </div>
                    </div>
                    <?php 
                      $comments_g = Database::getInstance()->select_from_where_no2('Comments','ApplicationID',$app_id,'Comment_by','all');
                      foreach ($comments_g as $comment_g) { ?>
                        <div class="row m-2">
                          <div class="col-lg-12 p-3">
                            <h5 class="text-primary">General Comment</h5>
                            <p><?php echo $comment_g['Comment']; ?></p>
                            <span class="text-muted" style="font-size: 12px;"><?php echo date_format(date_create($comment_g['DateCreated']),"d M Y H:i:s"); ?></span>
                          </div>
                        </div>
                      <?php }
                    ?>
                    <?php 
                      $comments = Database::getInstance()->select_from_where_no2('Comments','ApplicationID',$app_id,'Comment_by',$user_id);
                      foreach ($comments as $comment) { ?>
                        <div class="row m-2">
                          <div class="col-lg-12 p-3">
                            <p><?php echo $comment['Comment']; ?></p>
                            <span class="text-muted" style="font-size: 12px;"><?php echo date_format(date_create($comment['DateCreated']),"d M Y H:i:s"); ?></span>
                          </div>
                        </div>
                      <?php }
                    ?>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.</span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>  -->
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

 <?php include('inc/footer.php');?>
 <script type="text/javascript">
		var a=jQuery .noConflict();
        var user = <?php echo $user_id; ?>;
        a('#newComment').on('submit', function (e) {
          e.preventDefault();
            a.ajax({
              type: 'POST',
              url: '../func/verify.php',
              data: a('#newComment').serialize() + '&ins=newComment&user='+user+'&val=<?php echo $app_id; ?>',
              success: function(response)
              {
                if (response === 'Done') {
                    window.location = 'viewApplication?id=<?php echo $app_id; ?>';
                } else {
                  document.getElementById('get_result').innerHTML = response;
                }
              }
            });
        });

        function change(app_id,status) {
            a.ajax({
            type: 'POST',
            url: '../func/verify.php',
            data: 'ins=leavingStatus&status='+status+'&app_id='+app_id+'&user='+user,
            success: function(response)
            {
              if (response === 'Done') {
                window.location.href = 'Applications?status=changed';
              } else {
                window.location.href = 'Applications?status=unchanged';
              }
            }
          });
        }
</script>
</body>

</html>


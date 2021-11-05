<?php
ob_start();
session_start(); 
$active_page = "extensions";
// Include database class
include_once '../inc/db.php';
if(!isset($_SESSION['userSession'])){
  header("Location: ../index");
  exit;
}elseif (isset($_SESSION['userSession'])){
  $user_id = $_SESSION['userSession'];
  $ext_id = $_GET['id'];
  $app_id = Database::getInstance()->get_name_from_id('applicationID','Extensions','extensionID',$ext_id);
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
                      <div class="col">
                      <?php 
                            if ($data['status'] == 0 && $data['guardianApproval'] == 0) {?>
                            <span class="badge badge-warning right">Pending</span>
                            <?php }if ($data['status'] == 0 && $data['guardianApproval'] == 1) {?>
                            <span class="badge badge-info right">Processing</span>
                            <?php } else if($data['status'] == 1 && $data['guardianApproval'] == 1){?>
                                <span class="badge badge-success right">Approved</span>
                            <?php }else {?>
                                <span class="badge badge-danger right">Declined</span>
                            <?php } ?>
                      </div>
                    </div>
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
                      <label for="department" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $department; ?></span>
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
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Return Date</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $data['returnDate']; ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reason For Leave</label>
                      <div class="col-sm-9">
                        <span class="text-default"><?php echo $data['reason']; ?></span>
                      </div>
                    </div>
                    <?php 
                    $ext = Database::getInstance()->select_from_where2('Extensions','applicationID',$app_id);
                    foreach ($ext as $extension) { ?>
                      <div class="row mt-2">
                      <div class="col  pt-3 pb-3"  style="border-top:solid #000 1px;border-bottom:solid #000 1px;">
                          <div class="container">
                            <div class="row">
                              <label class="col-sm-3 col-form-label">Reason For Extension</label>
                              <div class="col-sm-9">
                                <span class="text-default  mt-2"><?php echo $extension['reason']; ?></span>
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label">Date Applied</label>
                              <div class="col-sm-9">
                                <span class="text-default mt-2"><?php echo $extension['dateCreated']; ?></span>
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label">New Return Date</label>
                              <div class="col-sm-9">
                                <span class="text-default  mt-2"><?php echo $extension['returnDate']; ?></span>
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label">Guardian Approval Status</label>
                              <div class="col-sm-9">
                                <?php 
                                    if ($extension['guardianApproval'] == 0 ){ ?>
                                      <div class="badge badge-warning mt-2">Pending</div>
                                   <?php }else if ($extension['guardianApproval'] == 1) { ?>
                                      <div class="badge badge-success mt-2">Approved</div>
                                   <?php }else { ?>
                                      <div class="badge badge-danger mt-2">Declined</div>
                                   <?php } ?>
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label">Status</label>
                              <div class="col-sm-9">
                              <?php 
                                    if ($extension['guardianApproval'] == 0 && $extension['status'] == 0) { ?>
                                      <div class="badge badge-warning mt-2">Pending</div>
                                   <?php }else if ($extension['guardianApproval'] == 1 && $extension['status'] == 0) { ?>
                                      <div class="badge badge-info mt-2">Processing</div>
                                   <?php }else if ($extension['guardianApproval'] == 1 && $extension['status'] == 1) { ?>
                                      <div class="badge badge-success mt-2">Approved</div>
                                   <?php }else { ?>
                                      <div class="badge badge-danger mt-2">Declined</div>
                                   <?php } ?>
                              </div>
                            </div>

                            <?php if ($extension['guardianApproval'] == 0) { ?>
                        <h4 class="h4 title mt-5 mb-3">Grant Guardian Approval</h4>
                            <div class="row mb-3">
                              <div class="col">
                                  <button class="btn btn-primary" onclick="guardianApproval(<?php echo $extension['extensionID']; ?>,1,'Extensions')">Parent Gave Approval</button>
                              </div>
                              <div class="col">
                                  <button class="btn btn-danger" onclick="guardianApproval(<?php echo $extension['extensionID']; ?>,2,'Extensions')">Parent Did Not Give Approval</button>
                              </div>
                            </div>
                          <?php } else if ($extension['guardianApproval'] == 1 && $extension['status'] == 0){ ?>
                            <h4 class="h4 title mt-5 mb-3">Grant Exeat Approval</h4>
                            <div class="row mb-3">
                              <div class="col">
                                  <button type="button" class="btn btn-success" onclick="approve(<?php echo $extension['extensionID']; ?>,'Extensions');">Approve</button>
                              </div>
                              <div class="col">
                                  <button type="button" class="btn btn-danger"  onclick="decline(<?php echo $extension['extensionID']; ?>,'Extensions');">Decline</button>
                              </div>
                              <div class="col">
                                  <a href="Extensions" class="btn btn-light">Go Back</a>
                              </div>
                            </div>
                          <?php }else if ($extension['guardianApproval'] == 1 && $extension['status'] == 1){ ?>
                            <h4 class="h4 title mt-5 mb-3">Grant Exeat Approval</h4>
                            <div class="row mb-3">
                              <div class="col">
                                  <button type="button" class="btn btn-danger"  onclick="decline(<?php echo $extension['extensionID']; ?>,'Extensions');">Revoke Approval</button>
                              </div>
                              <div class="col">
                                  <a href="Extensions" class="btn btn-light">Go Back</a>
                              </div>
                            </div>
                          <?php } ?>
                          </div>
                      </div>
                    </div>
                    <?php }
                        if ($data['status'] == 0 && $data['guardianApproval'] == 0) {?>
                            <button type="button" class="btn btn-danger mr-2" >Cancel</button>
                        <?php }?>
                    <a href="Applications" class="btn btn-light">Go Back</a>
                      <?php 
                      } ?>
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
        function approve(app_id,table) {
            a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: 'ins=alterStatus&status=1&app_id='+app_id+'&user='+user+'&table='+table,
					success: function(response)
					{
                        if (response === 'Done') {
                            window.location.href = 'Extensions?status=changed';
                        } else {
                            window.location.href = 'Extensions?status=unchanged';
                        }
					}
				});
        }

        function guardianApproval(app_id,status,table) {
            a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: 'ins=GuardianApproval&status='+status+'&app_id='+app_id+'&user='+user+'&table='+table,
					success: function(response)
					{
                        if (response === 'Done') {
                            window.location.href = 'Extensions?status=changed';
                        } else {
                            window.location.href = 'Extensions?status=unchanged';
                        }
					}
				});
        }

        function decline(app_id,table) {
            a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: 'ins=alterStatus&status=2&app_id='+app_id+'&user='+user+'&table='+table,
					success: function(response)
					{
                        if (response === 'Done') {
                            window.location.href = 'Extensions?status=changed';
                        } else {
                            window.location.href = 'Extensions?status=unchanged';
                        }
					}
				});
        }
</script>
</body>

</html>


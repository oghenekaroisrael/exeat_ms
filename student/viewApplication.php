<?php
ob_start();
session_start(); 
$active_page = "dashboard";
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
    <?php include('../partials/_navbar.html'); ?>
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
                      <div class="col-sm-12">
                        <span class="badge badge-success right">Approved</span>
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
                    <button type="button" class="btn btn-danger mr-2" >Cancel</button>
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
</body>

</html>


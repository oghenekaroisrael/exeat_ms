<?php
ob_start();
session_start(); 
$active_page = "updateProfile";
// Include database class
include_once '../inc/db.php';
if(!isset($_SESSION['userSession'])){
  header("Location: ../index");
  exit;
}elseif (isset($_SESSION['userSession'])){
  $user_id = $_SESSION['userSession'];
  var_dump($user_id);
  $myemail = Database::getInstance()->get_name_from_id('email','Users','id',$user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('inc/header.php');?>
<style>
  #hallCont, #chapelCont, #departmentCont, #securityCont{
    display: none;
  }
</style>
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
                  <h4 class="card-title">My Profile</h4>
                  <div id="get_result"></div>
                  <p class="card-description">
                    Kindly Ensure All Entries Are Completed as required
                  </p>
                  <form class="forms-sample" id="signup">
                    <?php 
                        $users = Database::getInstance()->select_from_where2('ChapelStaffs','email',$myemail);
                        foreach ($users as $data) { 
                          $user = $data['id'];?>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-3">
                              <input type="text" name="l_name" class="form-control" placeholder="Last Name / Surname" value="<?php echo $data['lastName']; ?>">
                            </div>
                            <div class="col-sm-3">
                              <input type="text" name="m_name" class="form-control" placeholder="Middle Name" value="<?php echo $data['middleName']; ?>">
                            </div>
                            <div class="col-sm-3">
                              <input type="text" name="f_name" class="form-control" placeholder="First Name" value="<?php echo $data['firstName']; ?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" name="password" placeholder="Password"/>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" name="c_password" placeholder="Confirm Password"/>
                            </div>
                          </div>
                          <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                              <input type="checkbox" id="chk" class="form-check-input">
                              Check to Confirm all Inputted Values Are Correct
                            </label>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                      <?php } ?>
                    
                  </form>
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
		a('#signup').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/edit.php',
					data: a('#signup').serialize() + '&ins=editStaff&val=<?php echo $user; ?>&table=ChapelStaffs',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Account Updated Successfully!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
</script>
</body>

</html>


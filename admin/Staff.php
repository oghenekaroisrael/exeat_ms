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
                  <h4 class="card-title">New Staff</h4>
                  <div id="get_result"></div>
                  <p class="card-description">
                    Kindly Ensure All Entries Are Completed as required
                  </p>
                  <form class="forms-sample" id="signup">
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Full Name</label>
                      <div class="col-sm-3">
                        <input type="text" name="l_name" class="form-control" placeholder="Last Name / Surname">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" name="m_name" class="form-control" placeholder="Middle Name">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" name="f_name" class="form-control" placeholder="First Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Role</label>
                      <div class="col-sm-9">
                        <select name="role" class="form-control" id="role">
                          <option>Select A Role</option>
                            <option value="hall_admin">Hall Admin</option>
                            <option value="chapel">Chapel Coordinator</option>
                            <option value="security">Security</option>
                            <option value="department">Departmental Staff</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row" id="hallCont">
                      <label class="col-sm-3 col-form-label">Hall Of Residence</label>
                      <div class="col-sm-9">
                        <select name="hall" class="form-control" id="halls">
                        </select>
                      </div>
                    </div>
                    <div class="form-group row" id="chapelCont">
                      <label class="col-sm-3 col-form-label">Chapel</label>
                      <div class="col-sm-9">
                        <select name="chapel" class="form-control" id="chapels">
                        </select>
                      </div>
                    </div>
                    <div class="form-group row" id="departmentCont">
                      <label class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                        <select name="department" class="form-control" id="departments">
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" placeholder="Email Address"/>
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
    a('#role').on('change', function (e) {
    e.preventDefault();
    var role = a('#role :selected').val();
            a.ajax({
            type: 'POST',
            url: 'process.php',
            data: {role : role},
            success: function(response)
            {
                if (role === 'hall_admin') {
                  document.getElementById('departmentCont').style.display = 'none';
                  document.getElementById('chapelCont').style.display = 'none';
                  document.getElementById('hallCont').style.display = 'flex';
                  a('#halls').html(response);
                }else if (role === 'department') {
                  document.getElementById('departmentCont').style.display = 'flex';
                  document.getElementById('chapelCont').style.display = 'none';
                  document.getElementById('hallCont').style.display = 'none';
                  a('#departments').html(response);
                }else if (role === 'chapel') {
                  document.getElementById('departmentCont').style.display = 'none';
                  document.getElementById('chapelCont').style.display = 'flex';
                  document.getElementById('hallCont').style.display = 'none';
                  a('#chapels').html(response);
                }
            }
        });
});
		a('#signup').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: a('#signup').serialize() + '&ins=newStaff',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Account Created Successfully!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
</script>
</body>

</html>


<?php
ob_start();
session_start(); 
$active_page = "departments";
// Include database class
include_once '../inc/db.php';
if(!isset($_SESSION['userSession'])){
  header("Location: ../index");
  exit;
}elseif (isset($_SESSION['userSession'])){
  $user_id = $_SESSION['userSession'];
}
$dpt = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<?php include('inc/header.php');?>
<body>
  <div class="container-scroller">
    <?php include('inc/_navbar.php'); ?>
    <!-- partial -->
    <div class="../container-fluid page-body-wrapper">
      <?php include('inc/_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <div class="col-12 grid-margin stretch-card">
              <?php 
                  if (isset($dpt) && $dpt > 0) { 
                    $dept = Database::getInstance()->select_from_where('Departments','id',$dpt);
                    foreach ($dept as $dep) {?>
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Edit Department</h4>
                          <div id="get_result"></div>
                          <form class="forms-sample" id="editDepartmentForm">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Department Name</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="department" placeholder="Department Name" value="<?php echo $dep['departmentName']; ?>"/>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                          </form>
                        </div>
                      </div>
                   <?php }
                   }else{ ?>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">New Department</h4>
                        <div id="get_result"></div>
                        <form class="forms-sample" id="departmentForm">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Department Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="department" placeholder="Department Name"/>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                 <?php }
              ?>
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
		a('#departmentForm').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: a('#departmentForm').serialize() + '&ins=newDepartment',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Department Created Successfully!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});

    a('#editDepartmentForm').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/edit.php',
					data: a('#editDepartmentForm').serialize() + '&ins=editDepartment&val=<?php echo $dpt;?>',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Department Successfully Updated!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
</script>
</body>

</html>


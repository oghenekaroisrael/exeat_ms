<?php
ob_start();
session_start(); 
$active_page = "chapels";
// Include database class
include_once '../inc/db.php';
if(!isset($_SESSION['userSession'])){
  header("Location: ../index");
  exit;
}elseif (isset($_SESSION['userSession'])){
  $user_id = $_SESSION['userSession'];
  $chapel_id = $_GET['id'];
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
              <?php 
                if (isset($chapel_id) && $chapel_id > 0) { 
                  $chapels = Database::getInstance()->select_from_where('Chapels','id',$chapel_id);
                  foreach ($chapels as $chapel) { ?>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Edit Chapel</h4>
                        <div id="get_result"></div>
                        <form class="forms-sample" id="editChapelForm">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chapel Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="chapel" placeholder="Chapel Name" value="<?php echo $chapel['chapelName']; ?>"/>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                <?php }
               } else { ?>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">New Chapel</h4>
                      <div id="get_result"></div>
                      <form class="forms-sample" id="chapelForm">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Chapel Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="chapel" placeholder="Chapel Name"/>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    </div>
                  </div>
                <?php } ?>
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
		a('#editChapelForm').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/edit.php',
					data: a('#editChapelForm').serialize() + '&ins=editChapel&val=<?php echo $chapel_id; ?>',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Chapel Updated Successfully!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
    a('#chapelForm').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: a('#chapelForm').serialize() + '&ins=newChapel',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Chapel Created Successfully!</div>';
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
</script>
</body>

</html>


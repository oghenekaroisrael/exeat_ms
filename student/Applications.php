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
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">My Applications</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          S/N
                        </th>
                        <th>
                          Application Date
                        </th>
                        <th>
                          Destination
                        </th>
                        <th>
                          Leave Type
                        </th>
                        <th>
                          Departure Date
                        </th>
                        <th>
                          Return Date
                        </th>
                        <th>
                          Reason
                        </th>
                        <th>
                          Progress
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $counter = 0;
                          $list = Database::getInstance()->select_from_where2("Applications","studentID",$user_id);
                          foreach ($list as $app) {?>
                            <tr>
                              <td>
                                <?php echo ++$counter;?>
                              </td>
                              <td>
                              <?php echo $app['dateCreated'];?>
                              </td>
                              <td>
                              <?php echo $app['destination'];?>
                              </td>
                              <td>
                                <div class="badge badge-primary">
                                  <?php echo $app['leave_type'];?>
                                </div>
                              </td>
                              <td>
                              <?php echo $app['depatureDate'];?>
                              </td>
                              <td>
                              <?php echo $app['returnDate'];?>
                              </td>
                              <td>
                              <?php echo $app['reason'];?>
                              </td>
                              <td>
                              <?php 
                                $status = $app['status'];
                                $guardianApproval = $app['guardianApproval'];
                                $progress = ($status < 2) ? (intval($status) + intval($guardianApproval)) : 0;
                              ?>
                                <div class="progress">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo intval($progress)*50;?>%" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="2"></div>
                                </div>
                              </td>
                              <td>
                                <?php 
                                    if ($status == 0 && $guardianApproval == 0) { ?>
                                      <span class="badge badge-warning">Pending</span>
                                    <?php } else if ($status == 0 && $guardianApproval == 1) { ?>
                                      <span class="badge badge-info">Processing</span>
                                    <?php } else if ($status == 1 && $guardianApproval == 1) { ?>
                                      <span class="badge badge-success">Approved</span>
                                    <?php }else { ?>
                                      <span class="badge badge-danger">Declined</span>
                                   <?php }
                                    
                                ?>
                              </td>
                              <td>
                                <a href="viewApplication?id=<?php echo $app['applicationID'];?>" class="btn btn-primary">View</a>
                              </td>
                            </tr>
                          <?}
                      ?>
                    </tbody>
                  </table>
                </div>
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
        a('#searchParam').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: a('#searchParam').serialize() + '&ins=exeatApplication&user='+user,
					success: function(response)
					{
            if (response === 'Done') {
                
            } else {
                console.log(response);
            }
					}
				});
		});
</script>
</body>
</html>


<?php
ob_start();
session_start();
$active_page = "reports";
// Include database class
include_once '../inc/db.php';
// if (!isset($_SESSION['userSession'])) {
//     header("Location: ../index");
//     exit;
// } elseif (isset($_SESSION['userSession'])) {
//     $user_id = $_SESSION['userSession'];

// }
$hall_id = 1;
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
          <h4>Reports</h4>
          <div class="row">
          <div class="col-lg-12">
          <form class="forms-sample" action="Report.php" method="POST">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Beginning Date</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="from" placeholder="dd/mm/yyyy"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ending Date</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="to" placeholder="dd/mm/yyyy"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                  </form>
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


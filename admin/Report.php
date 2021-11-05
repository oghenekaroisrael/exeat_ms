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
        <div class="row">
          <div class="col text-center">
          <img src="../images/bu_logo_main_2.jpg" alt="BU Logo" class="img" style="width: 250px;">
            <h2>Babcock University</h2>
            <h5>PMB 4003, ILISHAN REMO, OGUN STATE, NIGERIA .</h5>
            <h6>Phone: +2347035556536,+2348036428251,+2347066727364</h6>
            <h6>Email: info@babcock.edu.ng, admissions@babcock.edu.ng</h6>
          </div>
        </div>
        <div class="row">
          <div class="col text-center border p-3 m-2">
            Exeat Report From 03-11-2021 To 03-11-2022
          </div>
        </div>
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
                <div class="table-wrap">
                  <table class="table table-borderless">
                    <thead>
                      <tr class="row">
                        <th class="col-md-1">
                          ID
                        </th>
                        <th class="col-md-2">
                          Full Name
                        </th>
                        <th class="col-md-1">
                          Type
                        </th>
                        <th class="col-md-2">
                          Departure
                        </th>
                        <th class="col-md-1">
                          Return
                        </th>
                        <th class="col-md-2">
                          Reason
                        </th>
                        <th class="col-md-1">
                          Destination
                        </th>
                        <th class="col-md-1">
                          Status
                        </th>
                        <th class="col-md-1">
                          Count
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="row">
                        <td class="col-md-1">
                          1
                        </td>
                        <td  class="col-md-2">
                          Lorem, ipsum dolor.
                        </td>
                        <td class="col-md-1">
                          Long
                        </td>
                        <td  class="col-md-2">
                          10-10-2021
                        </td>
                        <td class="col-md-1">
                          21-10-2021
                        </td>
                        <td class="col-md-2">
                          Lorem ipsum.
                        </td>
                        <td class="col-md-1">
                          Lagos
                        </td>
                        <td class="col-md-1">
                          <div class="badge badge-success">Approved</div>
                        </td>
                        <td class="col-md-1">
                          20
                        </td>
                      </tr>
                    </tbody>
                  </table>
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


<?php
ob_start();
session_start();
$active_page = "reports";
// Include database class
include_once '../inc/db.php';
if (!isset($_SESSION['userSession']) && !isset($_POST['from']) && !isset($_POST['to']) && !empty($_POST['from']) && !empty($_POST['to'])) {
  header("Location: ../index");
  exit;
} elseif (isset($_SESSION['userSession'])) {
  $user_id = $_SESSION['userSession'];

}
$hall_id = $_SESSION['HallID'];
$from = $_POST['from'];
$to = $_POST['to'];
?>
<!DOCTYPE html>
<html lang="en">
<?php include('inc/header.php');?>
<style>
  .m-r-1{
    margin-right: 10px;
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
          <div class="col text-center">
          <img src="../images/BU_Logo.png" alt="BU Logo" class="img" style="width: 250px;">
            <h2 class="mt-3">Babcock University</h2>
            <h5>PMB 4003, ILISHAN REMO, OGUN STATE, NIGERIA .</h5>
            <h6>Phone: +2347035556536,+2348036428251,+2347066727364</h6>
            <h6>Email: info@babcock.edu.ng, admissions@babcock.edu.ng</h6>
          </div>
        </div>
        <div class="row">
          <div class="col text-center border p-3 m-2">
            <h3><?php echo ucwords(Database::getInstance()->get_name_from_id('hallName','Halls','id',$hall_id)); ?> Hall</h3>
          </div>
        </div>
        <div class="row">
          <div class="col text-center border p-3 m-2">
            Exeat Report From <b><?php echo date_format(date_create($from),"d M Y"); ?></b> To <b><?php echo date_format(date_create($to),"d M Y");  ?></b>
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
                        <th class="col-md-2 text-center">
                          Full Name
                        </th>
                        <th class="col-md-1 text-center">
                          Type
                        </th>
                        <th class="col-md-1 text-center">
                          Departure
                        </th>
                        <th class="col-md-1 text-center">
                          Return
                        </th>
                        <th class="col-md-2 text-center">
                          Reason
                        </th>
                        <th class="col-md-2 text-center">
                          Destination
                        </th>
                        <th class="col-md-1">
                          Status
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sn = 1;
                        $records =  Database::getInstance()->get_report_from($from,$to,$hall_id);
                        foreach ($records as $record) { ?>
                          <tr class="row">
                            <td class="col-md-1">
                              <?php echo $sn++; ?>
                            </td>
                            <td  class="col-md-2 text-center">
                            <?php echo $record['lastName'].' '.$record['middleName'].' '.$record['firstName']; ?>
                            </td>
                            <td class="col-md-1 text-center">
                              <?php echo $record['leave_type']; ?>
                            </td>
                            <td  class="col-md-1 text-center">
                                <?php echo  date_format(date_create($record['dapatureDate']),"d-m-y"); ?>
                             </td>
                            <td class="col-md- text-center">
                                <?php echo  date_format(date_create($record['returnDate']),"d-m-y"); ?>
                             </td>
                            <td class="col-md-2">
                            <?php echo $record['reason']; ?>
                            </td>
                            <td class="col-md-2">
                            <?php echo $record['destination']; ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                 if ($record['status'] == 0 && $record['guardianApproval'] == 0) { ?>
                                    <span class="badge badge-warning">Pending</span>
                                 <?php }else if ($record['status'] == 0 && $record['guardianApproval'] == 1) { ?>
                                    <span class="badge badge-info">Processing</span>
                                <?php } else if ($record['status'] == 1 && $record['guardianApproval'] == 1) { ?>
                                    <span class="badge badge-success">Approved</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Declined</span>
                                <?php  } ?>
                            </td>
                          </tr>
                       <?php }
                      ?>
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


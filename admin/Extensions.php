<?php
ob_start();
session_start();
$active_page = "extensions";
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
<?php include('inc/header.php'); ?>

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
                                    <h4 class="card-title">Exeat Extensions</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        S/N
                                                    </th>
                                                    <th>
                                                        Extension Date
                                                    </th>
                                                    <th>
                                                        Destination
                                                    </th>
                                                    <th>
                                                        Exeat Type
                                                    </th>
                                                    <th>
                                                        Return Date
                                                    </th>
                                                    <th>
                                                        Reason
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
                                                $sn = 1;
                                                    $records = Database::getInstance()->select_Extensions($hall_id);
                                                    foreach ($records as $record) { ?>
                                                        <tr>
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo date_format(date_create($record['dateCreated']),"d M Y H:i:s"); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['destination']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['leave_type']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date_format(date_create($record['returnDate']),"d M Y H:i:s"); ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $record['reason']; ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            if ($record['status'] == 0 && $record['guardianApproval'] == 0) { ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                        <?php }else if ($record['status'] == 0 && $record['guardianApproval'] == 1) { ?>
                                                        <span class="badge badge-info">Processing</span>
                                                        <?php } else if ($record['status'] == 1 && $record['guardianApproval'] == 1) { ?>
                                                        <span class="badge badge-success">Approved</span>
                                                        <?php } else { ?>
                                                        <span class="badge badge-danger">Declined</span>
                                                        <?php  }
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <a href="viewExtension?id=<?php echo $record['extensionID']; ?>" class="btn btn-primary">View</a>
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
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2021.</span>
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

    <?php include('inc/footer.php'); ?>
</body>

</html>
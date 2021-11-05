<?php
ob_start();
session_start();
$active_page = "Staffs";
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
                    <a href="Staff" class="btn btn-primary m-2">New Staff</a>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Staff</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        S/N
                                                    </th>
                                                    <th>
                                                        Fullname
                                                    </th>
                                                    <th>
                                                        Role
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                $list = Database::getInstance()->select_from_where_no('Users','role','student');
                                                foreach ($list as $record) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $count++; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if ($record['role'] == 'hall_admin') {
                                                            $fn = Database::getInstance()->select_from_where2('Hall_Admins','email',$record['email']); 
                                                        }else if ($record['role'] == 'department') {
                                                            $fn = Database::getInstance()->select_from_where2('DepartmentStaffs','email',$record['email']); 
                                                        }
                                                        foreach ($fn as $fln) {
                                                            echo $fln['lastName']." ".$fln['middleName']." ".$fln['firstName'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['role']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="Staff?id=<?php echo $record['id']; ?>"
                                                            class="btn btn-primary">View</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
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
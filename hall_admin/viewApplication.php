<!DOCTYPE html>
<html lang="en">
<?php include('inc/header.php'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('../partials/_navbar.html'); ?>
        <!-- partial -->
        <div class="../container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include('inc/_sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="badge badge-success right">Approved</span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="fullname" class="col-sm-3 col-form-label">Applicant's Fullname</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="matricNumber" class="col-sm-3 col-form-label">Matric Number</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="hall" class="col-sm-3 col-form-label">Hall Of Residence</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Guardian's 1 Full Name</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Guardian's 1 Contact</label>
                        <div class="col-sm-4">
                            <span class="text-default">Phone Number</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="text-default">Email</span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Guardian's 2 Full Name</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Guardian's 2 Contact</label>
                        <div class="col-sm-4">
                            <span class="text-default">Phone Number</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="text-default">Email</span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="department" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="destination" class="col-sm-3 col-form-label">Exeat Type</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="destination" class="col-sm-3 col-form-label">Destination</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Departure Date</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Return Date</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reason For Leave</label>
                        <div class="col-sm-9">
                            <span class="text-default"></span>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success">Approved</button>
                        <button class="btn btn-danger">Declined</button>
                        <a href="Applications" class="btn btn-light">Back</a>
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
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
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Exeat Application Form</h4>
                  <p class="card-description">
                    Kindly Ensure All Entries Are Completed as required
                  </p>
                  <form class="forms-sample" id="applicationForm">
                  <div class="form-group row">
                      <label for="destination" class="col-sm-3 col-form-label">Exeat Type</label>
                      <div class="col-sm-9">
                        <select name="type" class="form-control">
                            <option value="short">Short</option>
                            <option value="long">Long</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="destination" class="col-sm-3 col-form-label">Destination</label>
                      <div class="col-sm-9">
                        <input type="text" name="destination" class="form-control" id="destination" placeholder="Destination">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Departure Date</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="leaving" placeholder="dd/mm/yyyy"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Return Date</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="returning" placeholder="dd/mm/yyyy"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reason For Leave</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="reason" placeholder="Reason For Leave"></textarea>
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
        var user = <?php echo $user_id; ?>;
        a('#applicationForm').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: '../func/verify.php',
					data: a('#applicationForm').serialize() + '&ins=exeatApplication&user='+user,
					success: function(response)
					{
            if (response === 'Done') {
                window.location.href = 'Applications.php?s=yes';
            } else {
                console.log(response);
            }
					}
				});
		});
</script>
</body>

</html>


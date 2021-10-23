<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Exeat MS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo11.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <div id="get_result"></div>
              <form class="pt-3" id="signup">
              <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="l_name" placeholder="Last Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="m_name" placeholder="Middle Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="f_name" placeholder="First Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="phone_number" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="department">
                    <option selected="selected">Department</option>
                    <option value="1">Computer Science</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Level" name="level">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Matric Number" name="matricNumber">
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="hall">
                    <option selected="selected">Hall Of Residence</option>
                    <option value="1">Welch Hall</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="chapel">
                    <option selected="selected">Chapel</option>
                    <option value="1">Living Spring Chapel</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="role">
                    <option selected="selected">Role</option>
                    <option value="student">Student</option>
                    <option value="hall-admin">Hall Admin</option>
                    <option value="security">Security</option>
                    <option value="super-admin">Super Admin</option>
                    <option value="chapel">Chapel</option>
                    <option value="department">Department</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="c_password" placeholder="Confirm Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="agree">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript">
		var a=jQuery .noConflict();
	a(function () {
		a('#signup').on('submit', function (e) {
			e.preventDefault();
				a.ajax({
					type: 'POST',
					url: 'func/verify.php',
					data: a('#signup').serialize() + '&ins=newUser',
					success: function(response)
					{
            if (response === 'Done') {
                document.getElementById('get_result').innerHTML = '<div class="alert alert-success">Account Created Successfully! You Are Now Being Redirected to Login</div>';
						  setTimeout(() => {
                window.location.href = 'login.php';
              }, 1000);
            } else {
              document.getElementById('get_result').innerHTML = response;
            }
					}
				});
		});
	});
</script>
</body>

</html>

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
                <img src="images/logo11.svg" alt="Logo Goes Here">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <div id="get_result"></div>
              <form class="pt-3" id="login">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
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
		a('#login').on('submit', function (e) {
			e.preventDefault();
			a("#get_result").html("").show();
			var username = a("#username").val();
			var password = a("#password").val();
			if(username === ""){
				a('#get_result').html("<div class='alert alert-danger'>Username must not be empty</div>").show();
			} else if (password === ""){
				
				a('#get_result').html("<div class='alert alert-danger'>Password must not be empty</div>").show();
			} else{
				a.ajax({
					type: 'POST',
					url: 'func/verify.php',
					data: a('#login').serialize() + '&ins=login',
					dataType: 'JSON',
					success: function(response)
					{
						if (response.value === 'emptyUsername') {
							jQuery('#get_result').html("<div class='alert alert-danger'>Username must not be empty</div>").show();
						} else if (response.value === 'emptyPass') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-danger'>Password must not be empty</div>").show();
						} else if (response.value === 'no') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-danger'>Username does not exist</div>").show();
						}else if (response.value === 'Login') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-success'>Redirecting you</div>").show();
							window.location = response.page;
						}else {
							jQuery('#get_result').html(response.value2).show();
							console.log(response);
						}
					}
				});
			}

		});
	});
</script>
</body>

</html>

<?php
require("includes/config.php");

// if (isset($_SESSION['userSession']) != "") {
// 	header("Location:home.php");
// 	exit;
// }
if (isset($_POST['signin'])) {
	$email      =  trim($_POST['user_email']);
	$password   =  trim($_POST['user_pass']);


	$check_email = "SELECT * FROM user_details Where usr_email=:email";
	$stmt = $DB->prepare($check_email);
	$stmt->bindValue(':email', $email);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$count = $stmt->rowCount();
    foreach($result as $row){
		if (password_verify($password, $row['usr_pass']) && $count == 1) {
			$_SESSION['userSession'] = $row['usr_id'];
			header("Location: home.php");
		} else {
			$msg = "<div class='alert alert-danger'>
	   <i class='fad fa-info-circle'></i> &nbsp;<b>Email</b> or <b>Password</b> is invalid !!</div>";
		}
	}
	
	//include 'header.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>ADMIN LOGIN</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    
	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<h3 class="text-primary fw-bold"><b>MY</b> Admin</h3>
						<h4 class="mb-3 f-w-400">Signin</h4>

						<?php
						if (isset($msg)) {
							echo $msg;
						}
						?>
						<form action="" method="post" name="contact_form">
							<input type="hidden" name="mode" value="login">

							<div class="form-group mb-3">
								<label class="floating-label" for="Email">Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" name="user_email" required>
							</div>
							<div class="form-group mb-4">
								<label class="floating-label" for="Password">Password</label>
								<input type="password" id="password" class="form-control" maxlength="10" placeholder="Password" name="user_pass" required>
							</div>

							<button type="submit" name="signin" class="btn btn-block btn-primary mb-4">Sign In</button>

							<p class="mb-2 text-muted">Forgot password? <a href="javascript:void(0);" class="f-w-400">Reset</a></p>
							<p class="mb-0 text-muted">Don’t have an account? <a href="javascript:void(0);" class="f-w-400">Signup</a></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/ripple.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script>
	$(function() {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
</script>



</body>


</html>
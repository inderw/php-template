<?php
require("includes/config.php");
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
	// if logged in send to dashboard page
	redirect("home.php");
}

$title = "Login";
$mode = $_REQUEST["mode"];
if ($mode == "login") {
	$useremail = trim($_POST['user_email']);
	$pass = trim($_POST['user_password']);

	if ($username == "" || $pass == "") {

		$_SESSION["errorType"] = "danger";
		$_SESSION["errorMsg"] = "Enter manadatory fields";
	} else {
		$sql = "SELECT * FROM user_details WHERE usr_email = :uemail AND usr_pass = :upass ";

		try {
			$stmt = $DB->prepare($sql);

			// bind the values
			$stmt->bindValue(":uemail", $useremail);
			$stmt->bindValue(":upass", $pass);

			// execute Query
			$stmt->execute();
			$results = $stmt->fetchAll();

			if (count($results) > 0) {
				$_SESSION["errorType"] = "success";
				$_SESSION["errorMsg"] = "You have successfully logged in.";

				$_SESSION["user_id"] = $results[0]["u_userid"];
				$_SESSION["rolecode"] = $results[0]["u_rolecode"];
				$_SESSION["username"] = $results[0]["u_username"];

				redirect("home.php");
				exit;
			} else {
				$_SESSION["errorType"] = "info";
				$_SESSION["errorMsg"] = "Email or password does not exist.";
			}
		} catch (Exception $ex) {

			$_SESSION["errorType"] = "danger";
			$_SESSION["errorMsg"] = $ex->getMessage();
		}
	}
	redirect("index.php");
}
//include 'header.php';

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
						<?php if ($ERROR_MSG <> "") { ?>
							<div class="col-lg-12">
								<div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
									<button data-dismiss="alert" class="close" type="button">x</button>
									<p><?php echo $ERROR_MSG; ?></p>
								</div>
								<div style="height: 10px;">&nbsp;</div>
							</div>
						<?php } ?>
	
						<form action="" method="post" name="contact_form">
							<input type="hidden" name="mode" value="login">

							<div class="form-group mb-3">
								<label class="floating-label" for="Email">Email</label>
								<input type="email" class="form-control"  placeholder="Enter Email" name="user_email" required>
							</div>
							<div class="form-group mb-4">
								<label class="floating-label" for="Password">Password</label>
								<input type="password" id="password" class="form-control" maxlength="10" placeholder="Password" name="user_password" required>
							</div>

							<button type="submit" class="btn btn-block btn-primary mb-4">Sign In</button>

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
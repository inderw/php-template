<?php
require("includes/config.php");
if (isset($_POST["signup"])) {
	$name  =  trim($_POST['user_name']);
	$email  =  trim($_POST['user_email']);
	$pass   =  trim($_POST['user_pass']);
	$sql = "SELECT COUNT(*) AS count from user_details where usr_email = :email_id";
	
	  $stmt = $DB->prepare($sql);
	  $stmt->bindValue(":email_id", $email);
	  $stmt->execute();
	  $result = $stmt->fetchAll();
  
	  if ($result[0]["count"] > 0) {
		$msg = "<script type='text/javascript'> 
		alert('Email Already Registered');</script>";
		echo $msg;
	   // $msgType = "warning";
	  } else {
		$sql = "INSERT INTO `user_details` (`usr_name`, `usr_email`,`usr_pass` ) VALUES " . "( :name, :email, :pass )";
		$stmt = $DB->prepare($sql);
		$stmt->bindValue(":name", $name);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":pass", password_hash($pass, PASSWORD_DEFAULT));
		$stmt->execute();
		$result = $stmt->rowCount();
		$msg = "<script type='text/javascript'> 
		alert('Register successfull');</script>";
		echo $msg;
		header( "refresh:3;url=index.php" );
	}
  
 
//include 'header.php';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>ADMIN Register</title>
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
						<h4 class="mb-3 f-w-400">Sign UP</h4>
					
						
	
						<form method="post" enctype="multipart/form-data">
                                    <br>
                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="user_name" placeholder="User Name">
                                    </div>

                                    <br>

                                 
                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="user_email" placeholder="Enter Email">
                                    </div>
                     
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-key"></i></span>
                                        <input type="password" class="form-control" name="user_pass" placeholder="Password">
                                    </div>
                                    <br>

									<div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-key"></i></span>
                                        <input type="password" class="form-control" name="user_pass" placeholder="Confirm Password">
                                    </div>
                                    <br>
                                    <div class="input-group text-center">
                                        <button type="submit" name="signup" class="btn btn-primary" >Sign Up</button>
                                         
                                        <a href="javascript:self.history.back();" class="btn btn-danger">Back</a>
                                    </div>

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
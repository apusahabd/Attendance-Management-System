<?php 
	session_start();
	error_reporting(0);
	$su_msg = '';
	if(isset($_POST['login'])){
	require_once('config.php');
	$username = $_POST['user'];
	$password = MD5($_POST['pass']);
	$qry ="SELECT * FROM `admin` WHERE user = '$username' and pass = '$password'";
	$run =  mysqli_query($con,$qry);
	if(mysqli_num_rows($run)){
		$_SESSION['logged_in'] = 1;
		$_SESSION['logged_in_user'] = $username;
		header("Location:subject.php");
        }
		else{
			$su_msg = '<span style="color:#f00;font-style:italic;">Incorrect Username or Password</span>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Student Management System">
    <meta name="author" content="Apu Saha">
	<link rel="icon" href="img/icon.jpg">
    <title>Attendance Management System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" />
	<script src="js/bootstrap.min.js"></script>
  </head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3.5"></div>
				<div class="col-md-5 login_area border border-info rounded mt-4">
					<div class="header">
						<div class="form-title text-center bg-info text-white">
							<h3>Admin Login</h3>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row"> 
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="logo mt-2">
									<img src="img/logo.png" alt="Logo" style="border:1px solid #000; border-radius:50%;" />
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>
					<div class="was-validated">
						<form action="" method="POST">
							<div class="input-group mb-2 mt-3">
								<div class="input-group-prepend">
								  <div class="input-group-text">Username</div>
								</div>
								<input type="text" class="form-control" name="user" required>
							</div>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								  <div class="input-group-text">Password</div>
								</div>
								<input type="password" class="form-control" name="pass" required>
							</div>
							<p style="text-align: center;"><?php echo $su_msg; ?></p>
							<button type="submit" class="btn btn-info mb-3 float-right" name="login">LOGIN</button>
						</form>
					</div>
				</div>
				<div class="col-md-3.5"></div>
			</div>
		</div>
	</body>
</html>
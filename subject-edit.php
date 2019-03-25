<?php 
	session_start();
	if($_SESSION['logged_in']!=1){
		header("Location:index.php");
	}
	error_reporting(0);
	$err_msg['subject'] = $submit_msg =""; $subject ="";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(empty($_POST["subject"])){
		   $err_msg['subject'] = "Subject name is required";
		}else{
			$subject = valitation($_POST["subject"]);
			include_once('config.php');
			$query = mysqli_query($con,"SELECT `Sub_Name` FROM `subject` WHERE `Sub_Name` = '$subject'");
			if(mysqli_num_rows($query)){
				$err_msg['subject'] = "This subject already exists";
			}
		  }
		}
		
		function valitation($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$data = ucwords(strtolower($data));
			return $data;
		}
		
		include_once('config.php');
			$id = $_GET['id'];
			$qry = "SELECT * FROM `subject` WHERE `Subject_Id` = '$id'";
			$run = mysqli_query($con,$qry);
			$subject = mysqli_fetch_assoc($run);
			
			if(isset($_POST['update'])){
				if(!$err_msg['subject']){	
				
				include_once('config.php');
				$uqry = "UPDATE `subject` SET `Sub_Name` = '$_POST[subject]' WHERE `Subject_Id` = '$id'";
				$run = mysqli_query($con, $uqry);
				if($run){
					$submit_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-check"></i> Subject update successful!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
				}
				}
				else{
					$submit_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-times"></i> Subject update fail!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
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
		<link rel="stylesheet" href="css/all.css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/all.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>
	</head>
	<body>
		<div class="container main_area">
			<div class="row  border rounded border-info mt-3 mb-3"> 
				<div class="col-md-12 bg-info"> 
					<div class="form-title text-center text-white pt-2">
						<h3>Add New Subject</h3>
					</div>
					<div class="row">
						<div class="col-md-10">
							<ul class="nav nav-tabs" style="border-bottom:none;">
							  <li class="nav-item">
								<a class="nav-link text-body active" href="subject.php">Add Subject</a>
							  </li>
							  <li class="nav-item ml-1">
								<a class="nav-link text-body" href="insert.php">Add Student</a>
							  </li>
							  <li class="nav-item ml-1">
								<a class="nav-link text-body" href="allstudent.php">All Student</a>
							  </li>
							  <li class="nav-item ml-1">
								<a class="nav-link text-body" href="attendance.php">Take Attendance</a>
							  </li>
							  <li class="nav-item ml-1">
								<a class="nav-link text-body" href="attendance-view.php">View Attendance</a>
							  </li>
							</ul>
						</div>
						<div class="col-md-2">
							<a href="logout.php"><button class="btn btn-outline-white float-right" type="submit">Logout</button></a>
						</div>
					</div>
				</div>
				<div class="col-md-12"> 
					<div class="mt-3 mb-3">
					<div><?php echo $submit_msg; ?></div>
						<div class="row form_content">
						<div class="col-md-6">
							<form class="was-validated" action="subject-edit.php?id=<?php echo $subject['Subject_Id'];?>" method="post">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
									  <div class="input-group-text">Subject Name</div>
									</div>
									<input type="text" class="form-control" name="subject" value="<?php echo $subject['Sub_Name']; ?>" required>
								</div>
								<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['subject']; ?></div>
								<button type="submit" name="update" class="btn btn-info mb-4 float-right">Update</button>
							</form>
						</div>
						<div class="col-md-6">
							<table id="example" class="table table-sm table-sm table-hover table-bordered text-center">
								<thead>
									<tr>
										<th scope="col">Sl No.</th>
										<th scope="col">subject Name</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include_once('config.php');
										$qry = "SELECT * FROM `subject`";
										$run = mysqli_query($con,$qry);
										$count=0;
										while($subject = mysqli_fetch_assoc($run)) :
										$count++;
									?>
									<tr>
										<td class="text-center"><?php echo $count;?></td>
										<td class="text-left"><?php echo $subject['Sub_Name'];?><a href="subject-edit.php?id=<?php echo $subject['Subject_Id'];?>" class="badge badge-warning ml-2">Edit</a></td>
									</tr>
									<?php
										endwhile;
									?>
								</tbody>
							</table>
						</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 bg-info text-center p-2"> 
					<span class="text-white">Copyright &copy; 2019 <a href="http://www.nwu.edu.bd/" target="_blank" style="color:#fff;">North Western University, Khulna.</a> All Rights Reserved.</span>
				</div>
			</div>
		</div>
	</body>
</html>
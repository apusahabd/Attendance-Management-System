<?php
	session_start();
	if($_SESSION['logged_in']!=1){
		header("Location:index.php");
	}
	error_reporting(0);
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
				<div class="col-md-12 bg-info header-area">
					<div class="form-title text-center bg-info text-white pt-2">
						<h3>View Attendance</h3>
					</div>
					<div class="row">
						<div class="col-md-10">
							<ul class="nav nav-tabs" style="border-bottom:none;">
							  <li class="nav-item">
								<a class="nav-link text-body" href="subject.php">Add Subject</a>
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
								<a class="nav-link active text-body" href="attendance-view.php">View Attendance</a>
							  </li>
							</ul>
						</div>
						<div class="col-md-2">
							<a href="logout.php"><button class="btn btn-outline-white float-right" type="submit">Logout</button></a>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="mt-3">
						<table id="example" class="table table-sm table-hover table-bordered text-center">
							<thead>
								<tr>
									<th scope="col">Sl No.</th>
									<th scope="col">Attendance Date</th>
									<th scope="col">Subject Name</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include_once('config.php');
									$qry = "SELECT DISTINCT attendance.Date,subject.Sub_Name,attendance.Subject_Id  FROM `attendance` JOIN subject ON attendance.Subject_Id = subject.Subject_Id";
									$run = mysqli_query($con,$qry);
									$count="";
									while($attendance = mysqli_fetch_assoc($run)) :
									$count++;
								?>
								<tr>
									<td><?php echo $count;?></td>
									<td><?php echo $attendance['Date'];?></td>
									<td class="text-left"><?php echo $attendance['Sub_Name'];?></td>
									<td>
									<a href="view.php?date=<?php echo $attendance['Date'];?>&subject=<?php echo $attendance['Subject_Id'];?>&subjectname=<?php echo $attendance['Sub_Name'];?>" class="badge badge-info">View</a>
									<a href="attendance-edit.php?date=<?php echo $attendance['Date'];?>&subject=<?php echo $attendance['Subject_Id'];?>&subjectname=<?php echo $attendance['Sub_Name'];?>" class="badge badge-warning">Edit</a></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-12 bg-info text-center p-2  mt-3"> 
					<span class="text-white">Copyright &copy; 2019 <a href="http://www.nwu.edu.bd/" target="_blank" style="color:#fff;">North Western University, Khulna.</a> All Rights Reserved.</span>
				</div>
			</div>
		</div>
	</body>
</html>
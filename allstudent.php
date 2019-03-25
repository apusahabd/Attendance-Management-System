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
				<div class="col-md-12 bg-info">
					<div class="form-title text-center bg-info text-white pt-2">
						<h3>All Student</h3>
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
								<a class="nav-link active text-body" href="allstudent.php">All Student</a>
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
				<div class="col-md-12 mb-3">
					<div class="mt-3">
						<table id="example" class="table table-sm table-hover table-bordered text-center">
							<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">Roll</th>
									<th scope="col">Email</th>
									<th scope="col">Phone</th>
									<th scope="col">District</th>
									<th scope="col">Subject</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include_once('config.php');
									$qry = "SELECT * FROM `student` JOIN subject ON student.Subject_Id = subject.Subject_Id";
									$run = mysqli_query($con,$qry);
										while($student = mysqli_fetch_assoc($run)) :
								?>
								<tr>
									<td class="text-left"><?php echo $student['Name'];?></td>
									<td><?php echo $student['Roll'];?></td>
									<td class="text-left"><?php echo $student['Email'];?></td>
									<td><?php echo $student['Phone'];?></td>
									<td class="text-left"><?php echo $student['District'];?></td>
									<td class="text-left"><?php echo $student['Sub_Name'];?></td>
									<td><a href="edit.php?id=<?php echo $student['ID'];?>" class="badge badge-warning">Edit</a> <a href="delete.php?id=<?php echo $student['ID'];?>" class="badge badge-danger "><span name="delete" onclick="return confirm('Do you really want to delete this data ?');">Delete</span></a> <a href="allstudent.php" data-toggle="modal" data-target="#exampleModal<?php echo $student['ID'];?>" class="badge badge-info">View</a></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
						<?php include_once('config.php');
							$qry = "SELECT * FROM `student` JOIN subject ON student.Subject_Id = subject.Subject_Id";
							$run = mysqli_query($con,$qry);
							while($student = mysqli_fetch_assoc($run)) :
						?>
						<div class="modal fade" id="exampleModal<?php echo $student['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-info" id="exampleModalLabel">Student Information</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table class="table table-striped table-sm table-bordered mb-0">
											<tr>
												<th class="text-right">Student Name</th>
												<td><?php echo $student['Name'];?></td>
											</tr>
											<tr>
												<th class="text-right">Father's Name</th>
												<td><?php echo $student['F_Name'];?></td>
											</tr>
											<tr>
												<th class="text-right">Mother's Name</th>
												<td><?php echo $student['M_Name'];?></td>
											</tr>
											<tr>
												<th class="text-right">Roll</th>
												<td><?php echo $student['Roll'];?></td>
											</tr>
											<tr>
												<th class="text-right">Email</th>
												<td><?php echo $student['Email'];?></td>
											</tr>
											<tr>
												<th class="text-right">Date of Birth</th>
												<td><?php echo $student['DOB'];?></td>
											</tr>
											<tr>
												<th class="text-right">Gender</th>
												<td><?php echo $student['Gender'];?></td>
											</tr>
											<tr>
												<th class="text-right">Religion</th>
												<td><?php echo $student['Religion'];?></td>
											</tr>
											<tr>
												<th class="text-right">Phone No</th>
												<td><?php echo $student['Phone'];?></td>
											</tr>
											<tr>
												<th class="text-right">District</th>
												<td><?php echo $student['District'];?></td>
											</tr>
											<tr>
												<th class="text-right">Address</th>
												<td><?php echo $student['Address'];?></td>
											</tr>
											<tr>
												<th class="text-right">Subject</th>
												<td><?php echo $student['Sub_Name'];?></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="col-md-12 bg-info text-center p-2"> 
					<span class="text-white">Copyright &copy; 2019 <a href="http://www.nwu.edu.bd/" target="_blank" style="color:#fff;">North Western University, Khulna.</a> All Rights Reserved.</span>
				</div>
			</div>
		</div>
	</body>
</html>
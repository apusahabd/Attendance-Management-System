<?php
	session_start();
	if($_SESSION['logged_in']!=1){
		header("Location:index.php");
	}
	error_reporting(0);
	$name=$roll=$subject=$attendance=$date=$submit_msg=$search_msg=$err_msg['subject']="";
	error_reporting(0);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(isset($_POST['submit'])){
			if(empty($_POST["attendance"])){
			   $submit_msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-exclamation-triangle"></i> Attendance is required!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
			}
			foreach($_POST['attendance'] as $id=>$attendance) {

                $name = $_POST["name"][$id];
                $roll = $_POST["roll"][$id];
                $subject = $_POST["subject"][$id];
                $attendance = $_POST["attendance"][$id];
                $date = date("d-m-Y");

				if($date==date("d-m-Y") and $roll == $_POST["roll"][$id]){
				
				include_once('config.php');
				$query = mysqli_query($con,"SELECT `Roll` AND `Date` FROM `attendance` WHERE `Roll`='$roll' AND `Date`='$date'");
				if(mysqli_num_rows($query)){
					$submit_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-times"></i> Attendance already taken today!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
				}else{
				
				include_once('config.php');
				$qry = "INSERT INTO `attendance` (`Name`, `Roll`, `Subject_Id`, `Attendance`, `Date`) VALUES ('$name','$roll','$subject','$attendance','$date')";

				$run = mysqli_query($con,$qry);
					if($run){
						$submit_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-check"></i> Attendance take successful!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					}
				}
			}
				else{
					$submit_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><i> <i class="fas fa-times"></i> Attendance take fail!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
				}
			}
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
		<link href="css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/all.css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><link rel="stylesheet" href="css/style.css" />
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
			$(function() {
				$( "#datepicker2" ).datepicker();
			  });
		</script>
	</head>
	<body>
		<div class="container main_area">
			<div class="row  border rounded border-info mt-3 mb-3">
				<div class="col-md-12 bg-info">
					<div class="form-title text-center bg-info text-white pt-2">
						<h3>Attendance Sheet</h3>
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
								<a class="nav-link active text-body" href="attendance.php">Take Attendance</a>
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
				<div><?php echo $err_msg['subject']; ?></div>
				<div><?php echo $search_msg; ?></div>
				<div class="col-md-1"></div>
				<div class="col-md-10 mt-3 mb-2">
					<div class=""> 
						<form class="was-validated" action="attendance.php" method="post">
							<div class="input-group mb-2">
								<input type="text" class="form-control" placeholder="Please search subject name" name="subjectname" required>
								<div class="input-group-prepend">
								  <button type="submit" name="search" class="btn btn-info">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-1"></div>
				<div class="col-md-10">
				<div><?php echo $submit_msg; ?></div>
					<form action="attendance.php" method="post">
						<div class="bg-info text-white p-1 text-center" style="font-size:20px">
						Date: <?php echo date("d-M-Y"); ?>
						</div>
						<table id="" class="table table-sm table-hover table-bordered text-center">
							<thead>
								<tr>
									<th scope="col">Sl No.</th>
									<th scope="col">Name</th>
									<th scope="col">Roll</th>
									<th scope="col">Subject Name</th>
									<th scope="col">Attendance</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_POST['search'])){
									if(empty($_POST["subjectname"])){
									$search_msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong><i><i class="fas fa-exclamation-triangle"></i> Subject name is required!</i></strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
									</div>';
									}
									else{
									include_once('config.php');
									
									$subjectname= $_POST["subjectname"];
									if(!$search_msg){
									$qry = "SELECT * FROM `student` JOIN subject ON student.Subject_Id = subject.Subject_Id WHERE `Sub_Name` LIKE '%$subjectname%'";
									$run = mysqli_query($con,$qry);
									if(mysqli_num_rows($run)<1){
										$search_msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong><i><i class="fas fa-exclamation-triangle"></i> Data not found!</i></strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
										</div>';
									  }
									else{
										$count=0;
										$serial=0;
										while($student = mysqli_fetch_assoc($run)){
										$count++;
								?>
								<tr>
									<td><?php echo $count;?></td>
									<td class="text-left"><?php echo $student['Name'];?>
										<input type="hidden" value="<?php echo $student['Name'];?>" name="name[]" />
									</td>
									<td><?php echo $student['Roll'];?>
										<input type="hidden" value="<?php echo $student['Roll'];?>" name="roll[]" />
									</td>
									<td class="text-left"><?php echo $student['Sub_Name'];?>
										<input type="hidden" value="<?php echo $student['Subject_Id'];?>" name="subject[]" />
									</td>
									<td>
										<div class="attendance">
										  <input type="radio" name="attendance[<?php echo $serial;?>]" value="Present" style="cursor: pointer;"> Present
										  <input type="radio" name="attendance[<?php echo $serial;?>]" value="Absent" class="ml-2"style="cursor: pointer;"> Absent
										</div>
									</td>
								</tr>
								<?php
									$serial++;}
											}
										}
									}
								}
								?>
							</tbody>
						</table>
						<button type="submit" name="submit" class="btn btn-info float-right">Submit</button>
					</form>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-12 bg-info text-center p-2  mt-3"> 
					<span class="text-white">Copyright &copy; 2019 <a href="http://www.nwu.edu.bd/" target="_blank" style="color:#fff;">North Western University, Khulna.</a> All Rights Reserved.</span>
				</div>
			</div>
		</div>
	</body>
</html>
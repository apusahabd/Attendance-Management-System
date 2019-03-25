<?php 
	session_start();
	if($_SESSION['logged_in']!=1){
		header("Location:index.php");
	}
	error_reporting(0);
	$err_msg['name'] = $err_msg['f_name'] = $err_msg['m_name'] = $err_msg['roll'] = $err_msg['email'] = $err_msg['dob'] = $err_msg['gender'] = $err_msg['religion'] = $err_msg['phone'] = $err_msg['district'] = $err_msg['address'] = $err_msg['subject'] = $submit_msg ="";
	$name=$f_name=$m_name=$roll=$email=$dob=$gender=$religion=$phone=$district=$address=$subject="";
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(empty($_POST["name"])){
		   $err_msg['name'] = "Name is required";
		}else{
			$name = valitation($_POST["name"]);
			// check if name only contains letters
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			  $err_msg['name'] = "Only letters allowed"; 
			}
		}
		if(empty($_POST["f_name"])){
		   $err_msg['f_name'] = "Father's Name is required";
		}else{
			$f_name = valitation($_POST["f_name"]);
			// check if name only contains letters
			if (!preg_match("/^[a-zA-Z ]*$/",$f_name)) {
			  $err_msg['f_name'] = "Only letters allowed"; 
			}
		}
		if(empty($_POST["m_name"])){
		   $err_msg['m_name'] = "Mother's Name is required";
		}else{
			$m_name = valitation($_POST["m_name"]);
			// check if name only contains letters
			if (!preg_match("/^[a-zA-Z ]*$/",$m_name)) {
			  $err_msg['m_name'] = "Only letters allowed"; 
			}
		}
		if(empty($_POST["roll"])){
		   $err_msg['roll'] = "Roll is required";
		}
		else{
			$roll = valitation($_POST["roll"]);
			// check if roll only numeric
			if (!is_numeric($roll)) {
			  $err_msg['roll'] = "Only number allowed"; 
			}
			elseif(strlen($roll)!==4){
				$err_msg['roll'] = "Please enter 4 number";
			}
			else{
				include_once('config.php');
				$query = mysqli_query($con,"SELECT `Roll` FROM `student` WHERE Roll='$roll'");
				if(mysqli_num_rows($query)){
					$err_msg['roll'] = "This roll already exists";
				}
			}
		}
		if(empty($_POST["email"])){
		   $err_msg['email'] = "Email is required";
		}
		else{
			$email = valitation($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_msg['email'] = "Invalid email format"; 
			}
			else{
				include_once('config.php');
				$query = mysqli_query($con,"SELECT `Email` FROM `student` WHERE Email='$email'");
				if(mysqli_num_rows($query)){
					$err_msg['email'] = "This email already exists";
				}
			}
		}	
		if(empty($_POST["phone"])){
		   $err_msg['phone'] = "Phone number is required";
		}
		else{
			$phone = valitation($_POST["phone"]);
			// check if phone only numeric
			if (!is_numeric($phone)) {
			  $err_msg['phone'] = "Only number allowed"; 
			}
			else if(strlen($phone)!==11){
				$err_msg['phone'] = "Please enter 11 number";
			}
			else{
				include_once('config.php');
				$query = mysqli_query($con,"SELECT `Phone` FROM `student` WHERE Phone='$phone'");
				if(mysqli_num_rows($query)){
					$err_msg['phone'] = "This number already exists";
				}
			}
		}
		if(empty($_POST["address"])){
		   $err_msg['address'] = "Address is required";
		}
		else{
		   $address = valitation($_POST["address"]);
		}
		if(empty($_POST["dob"])){
		   $err_msg['dob'] = "Date of birth is required";
		}
		else{
		   $dob = valitation($_POST["dob"]);
		}
		if(empty($_POST["district"])){
		   $err_msg['district'] = "District is required";
		}
		else{
		   $district = valitation($_POST["district"]);
		}
		if(empty($_POST["gender"])){
		   $err_msg['gender'] = "Gender is required";
		}
		else {
		   $gender = valitation($_POST["gender"]);
		}
		if(empty($_POST["religion"])){
		   $err_msg['religion'] = "Religion is required";
		}
		else{
		   $religion = valitation($_POST["religion"]);
		}
		if(empty($_POST["subject"])){
		   $err_msg['subject'] = "Seligion is required";
		}
		else{
		   $subject = valitation($_POST["subject"]);
		}
		}
		
		function valitation($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		if(isset($_POST['submit'])){
		include_once('config.php');		
		if(!$err_msg['name'] and !$err_msg['f_name'] and !$err_msg['m_name'] and !$err_msg['roll'] and !$err_msg['email'] and !$err_msg['dob'] and !$err_msg['gender'] and !$err_msg['religion'] and !$err_msg['phone'] and !$err_msg['district'] and !$err_msg['address'] and !$err_msg['subject']){
		
		$qry = "INSERT INTO `student` (`Name`, `F_Name`, `M_Name`, `Roll`, `Email`, `DOB`, `Gender`, `Religion`, `Phone`, `District`, `Address`, `Subject_Id`) VALUES ('$name','$f_name','$m_name','$roll','$email','$dob','$gender','$religion','$phone','$district','$address','$subject')";
		
		$run = mysqli_query($con,$qry);
		if($run){
			$submit_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-check"></i> Data inserted successful!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
		}
		}
		else{
			$submit_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-times"></i> Data inserted fail!</i></strong>
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
		<link href="css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css" />
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
			$(function() {
				$( "#datepicker2" ).datepicker();
			  });
		</script>
	</head>
	<body>
		<div class="container main_area">
			<div class="row border rounded border-info mt-3 mb-3"> 
				<div class="col-md-12 bg-info"> 
					<div class="form-title text-center text-white pt-2">
						<h3>Add New Student</h3>
					</div>
					<div class="row">
						<div class="col-md-10">
							<ul class="nav nav-tabs" style="border-bottom:none;">
							  <li class="nav-item">
								<a class="nav-link text-body" href="subject.php">Add Subject</a>
							  </li>
							  <li class="nav-item ml-1">
								<a class="nav-link text-body active" href="insert.php">Add Student</a>
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
					<div class="mt-3">
						<div><?php echo $submit_msg; ?></div>
						<div class="form_content">
							<form class="was-validated" action="insert.php" method="post" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-6">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Full Name</div>
											</div>
											<input type="text" class="form-control" name="name" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Father's Name</div>
											</div>
											<input type="text" class="form-control" name="f_name" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['f_name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Mother's Name</div>
											</div>
											<input type="text" class="form-control" name="m_name" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['m_name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Roll</div>		  
											</div>
											<input type="text" class="form-control" name="roll" required>
											
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['roll']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Email Address</div>
											</div>
											<input type="text" class="form-control" name="email" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['email']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Date of Birth</div>
											</div>
											<input type="text" class="form-control" placeholder="MM / DD / YYYY" name="dob" id="datepicker2" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['dob']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Gender</div>
											</div>
											<select class="custom-select" name="gender" id="" required>
												<option value="">--- Select One ---</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['gender']; ?></div>
									</div>
									<div class="col-md-6">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Religion</div>
											</div>
											<select class="custom-select" name="religion" id="" required>
												<option value="">--- Select One ---</option>
												<option value="Islam">Islam</option>
												<option value="Hinduism">Hinduism</option>
												<option value="Christianity">Christianity</option>
												<option value="Buddhism">Buddhism</option>
												<option value="Other">Other</option>
											</select>
										</div>									
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Phone No.</div>
											</div>
											<input type="text" class="form-control" name="phone" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['phone']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">District</div>
											</div>
											<select class="custom-select" name="district" id="" required>
												<option value="">--- Select One ---</option>
												<option value="Bagerhat">Bagerhat</option>
												<option value="Bandarban">Bandarban</option>
												<option value="Barguna">Barguna</option>
												<option value="Barishal">Barishal</option>
												<option value="Bhola">Bhola</option>
												<option value="Bogura">Bogura</option>
												<option value="Brahmanbaria">Brahmanbaria</option>
												<option value="Chandpur">Chandpur</option>
												<option value="Chapainawabganj">Chapainawabganj</option>
												<option value="Chattogram">Chattogram</option>
												<option value="Chuadanga">Chuadanga</option>
												<option value="Coxsbazar">Coxsbazar</option>
												<option value="Cumilla">Cumilla</option>
												<option value="Dhaka">Dhaka</option>
												<option value="Dinajpur">Dinajpur</option>
												<option value="Faridpur">Faridpur</option>
												<option value="Feni">Feni</option>
												<option value="Gaibandha">Gaibandha</option>
												<option value="Gazipur">Gazipur</option>
												<option value="Gopalganj">Gopalganj</option>
												<option value="Habiganj">Habiganj</option>
												<option value="Jamalpur">Jamalpur</option>
												<option value="Jashore">Jashore</option>
												<option value="Jhalakathi">Jhalakathi</option>
												<option value="Jhenaidah">Jhenaidah</option>
												<option value="Joypurhat">Joypurhat</option>
												<option value="Khagrachhari">Khagrachhari</option>
												<option value="Khulna">Khulna</option>
												<option value="Kishoreganj">Kishoreganj</option>
												<option value="Kurigram">Kurigram</option>
												<option value="Kushtia">Kushtia</option>
												<option value="Lakshmipur">Lakshmipur</option>
												<option value="Lalmonirhat">Lalmonirhat</option>
												<option value="Madaripur">Madaripur</option>
												<option value="Magura">Magura</option>
												<option value="Manikganj">Manikganj</option>
												<option value="Meherpur">Meherpur</option>
												<option value="Moulvibazar">Moulvibazar</option>
												<option value="Munshiganj">Munshiganj</option>
												<option value="Mymensingh">Mymensingh</option>
												<option value="Naogaon">Naogaon</option>
												<option value="Narail">Narail</option>
												<option value="Narayanganj">Narayanganj</option>
												<option value="Narsingdi">Narsingdi</option>
												<option value="Natore">Natore</option>
												<option value="Netrokona">Netrokona</option>
												<option value="Nilphamari">Nilphamari</option>
												<option value="Noakhali">Noakhali</option>
												<option value="Pabna">Pabna</option>
												<option value="Panchagarh">Panchagarh</option>
												<option value="Patuakhali">Patuakhali</option>
												<option value="Pirojpur">Pirojpur</option>
												<option value="Rajbari">Rajbari</option>
												<option value="Rajshahi">Rajshahi</option>
												<option value="Rangamati">Rangamati</option>
												<option value="Rangpur">Rangpur</option>
												<option value="Satkhira">Satkhira</option>
												<option value="Shariatpur">Shariatpur</option>
												<option value="Sherpur">Sherpur</option>
												<option value="Sirajganj">Sirajganj</option>
												<option value="Sunamganj">Sunamganj</option>
												<option value="Sylhet">Sylhet</option>
												<option value="Tangail">Tangail</option>
												<option value="Thakurgaon">Thakurgaon</option>
											</select>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['district']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Address</div>
											</div>
											<textarea class="form-control" name="address" style="height:86px" required></textarea>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['address']; ?></div>
										<div class="input-group mb-2">
										<div class="input-group-prepend">
										  <div class="input-group-text">Subject Name</div>
										</div>
										<select class="custom-select" name="subject" id="" required>
											<option value="">--- Select One ---</option>
											<?php
												include_once('config.php');
												$qry = "SELECT * FROM `subject`";
												$run = mysqli_query($con,$qry);
												while($subject = mysqli_fetch_assoc($run)) :
											?>
											<option value="<?php echo $subject['Subject_Id'];?>"><?php echo $subject['Sub_Name'];?></option>
											<?php
												endwhile;
											?>
										</select>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['subject']; ?></div>
										<button type="submit" name="submit" class="btn btn-info mb-3 float-right">Save</button>
									</div>
								</div>
							</form>
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
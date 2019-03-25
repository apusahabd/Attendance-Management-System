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
			else if(strlen($roll)!==4){
				$err_msg['roll'] = "Please enter 4 number";
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
		if(empty($_POST["religion"])){
		   $err_msg['religion'] = "Religion is required";
		}
		else{
		   $religion = valitation($_POST["religion"]);
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
		
		include_once('config.php');
			$id = $_GET['id'];
			$qry = "SELECT * FROM `student` JOIN subject ON student.Subject_Id = subject.Subject_Id WHERE `ID` = '$id'";
			$run = mysqli_query($con,$qry);
			$student = mysqli_fetch_assoc($run);
			
			if(isset($_POST['update'])){
			if(!$err_msg['name'] and !$err_msg['f_name'] and !$err_msg['m_name'] and !$err_msg['roll'] and !$err_msg['email'] and !$err_msg['dob'] and !$err_msg['gender'] and !$err_msg['religion'] and !$err_msg['phone'] and !$err_msg['district'] and !$err_msg['address'] and !$err_msg['subject']){
				
			$uqry="UPDATE `student` SET `Name`='$name', `F_Name`='$f_name', `M_Name`='$m_name', `Roll`='$roll', `Email`='$email', `DOB`='$dob', `Gender`='$gender', `Religion`='$religion', `Phone` = '$phone', `District`='$district', `Address`='$address', `Subject_Id` = '$subject' WHERE `ID` = '$id'";
			
			$run = mysqli_query($con,$uqry);
			if($run){
					$submit_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-check"></i> Data update successful!</i></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
				}
				}
				else{
					$submit_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong><i><i class="fas fa-times"></i> Data update fail!</i></strong>
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
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/all.js"></script>
		<script>
			  $(function() {
				$( "#datepicker2" ).datepicker();
			  });
		</script>
	</head>
	<body>
		<div class="container main_area">
			<div class="row  border rounded border-info mt-3"> 
				<div class="col-md-12 bg-info"> 
					<div class="form-title text-center bg-info text-white pt-2">
						<h3>Update Student Info</h3>
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
							<form class="was-validated" action="edit.php?id=<?php echo $student['ID'];?>" method="post" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-6">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Full Name</div>
											</div>
											<input type="text" class="form-control" name="name" value="<?php echo $student['Name'];?>" required />
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Father's Name</div>
											</div>
											<input type="text" class="form-control" name="f_name" value="<?php echo $student['F_Name'];?>" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['f_name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Mother's Name</div>
											</div>
											<input type="text" class="form-control" name="m_name" value="<?php echo $student['M_Name'];?>" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['m_name']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Roll</div>		  
											</div>
											<input type="text" class="form-control" name="roll" value="<?php echo $student['Roll'];?>" required>
											
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['roll']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Email Address</div>
											</div>
											<input type="text" class="form-control" name="email" value="<?php echo $student['Email'];?>" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['email']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Date of Birth</div>
											</div>
											<input type="text" class="form-control" placeholder="MM / DD / YYYY" name="dob" id="datepicker2" value="<?php echo $student['DOB'];?>" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['dob']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Gender</div>
											</div>
											<select class="custom-select" name="gender" id="" required>
												<option value="">--- Select One ---</option>
												<option value="Male" <?php if($student['Gender']=='Male'){echo "selected";}?>>Male</option>
												<option value="Female" <?php if($student['Gender']=='Female'){echo "selected";}?>>Female</option>
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
												<option value="Islam" <?php if($student['Religion']=='Islam'){echo "selected";}?>>Islam</option>
												<option value="Hinduism" <?php if($student['Religion']=='Hinduism'){echo "selected";}?>>Hinduism</option>
												<option value="Christianity" <?php if($student['Religion']=='Christianity'){echo "selected";}?>>Christianity</option>
												<option value="Buddhism" <?php if($student['Religion']=='Buddhism'){echo "selected";}?>>Buddhism</option>
												<option value="Other" <?php if($student['Religion']=='Other'){echo "selected";}?>>Other</option>
											</select>
										</div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Phone No.</div>
											</div>
											<input type="text" class="form-control" name="phone" value="<?php echo $student['Phone'];?>" required>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['phone']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">District</div>
											</div>
											<select class="custom-select" name="district" id="" required>
												<option value="">--- Select One ---</option>
												<option value="Bagerhat" <?php if($student['District']=='Bagerhat'){echo "selected";}?>>Bagerhat</option>
												<option value="Bandarban" <?php if($student['District']=='Bandarban'){echo "selected";}?>>Bandarban</option>
												<option value="Barguna" <?php if($student['District']=='Barguna'){echo "selected";}?>>Barguna</option>
												<option value="Barishal" <?php if($student['District']=='Barishal'){echo "selected";}?>>Barishal</option>
												<option value="Bhola" <?php if($student['District']=='Bhola'){echo "selected";}?>>Bhola</option>
												<option value="Bogura" <?php if($student['District']=='Bogura'){echo "selected";}?>>Bogura</option>
												<option value="Brahmanbaria" <?php if($student['District']=='Brahmanbaria'){echo "selected";}?>>Brahmanbaria</option>
												<option value="Chandpur" <?php if($student['District']=='Chandpur'){echo "selected";}?>>Chandpur</option>
												<option value="Chapainawabganj" <?php if($student['District']=='Chapainawabganj'){echo "selected";}?>>Chapainawabganj</option>
												<option value="Chattogram" <?php if($student['District']=='Chattogram'){echo "selected";}?>>Chattogram</option>
												<option value="Chuadanga" <?php if($student['District']=='Chuadanga'){echo "selected";}?>>Chuadanga</option>
												<option value="Coxsbazar" <?php if($student['District']=='Coxsbazar'){echo "selected";}?>>Coxsbazar</option>
												<option value="Cumilla" <?php if($student['District']=='Cumilla'){echo "selected";}?>>Cumilla</option>
												<option value="Dhaka" <?php if($student['District']=='Dhaka'){echo "selected";}?>>Dhaka</option>
												<option value="Dinajpur" <?php if($student['District']=='Dinajpur'){echo "selected";}?>>Dinajpur</option>
												<option value="Faridpur" <?php if($student['District']=='Faridpur'){echo "selected";}?>>Faridpur</option>
												<option value="Feni" <?php if($student['District']=='Feni'){echo "selected";}?>>Feni</option>
												<option value="Gaibandha" <?php if($student['District']=='Gaibandha'){echo "selected";}?>>Gaibandha</option>
												<option value="Gazipur" <?php if($student['District']=='Gazipur'){echo "selected";}?>>Gazipur</option>
												<option value="Gopalganj" <?php if($student['District']=='Gopalganj'){echo "selected";}?>>Gopalganj</option>
												<option value="Habiganj" <?php if($student['District']=='Habiganj'){echo "selected";}?>>Habiganj</option>
												<option value="Jamalpur" <?php if($student['District']=='Jamalpur'){echo "selected";}?>>Jamalpur</option>
												<option value="Jashore" <?php if($student['District']=='Jashore'){echo "selected";}?>>Jashore</option>
												<option value="Jhalakathi" <?php if($student['District']=='Jhalakathi'){echo "selected";}?>>Jhalakathi</option>
												<option value="Jhenaidah" <?php if($student['District']=='Jhenaidah'){echo "selected";}?>>Jhenaidah</option>
												<option value="Joypurhat" <?php if($student['District']=='Joypurhat'){echo "selected";}?>>Joypurhat</option>
												<option value="Khagrachhari" <?php if($student['District']=='Khagrachhari'){echo "selected";}?>>Khagrachhari</option>
												<option value="Khulna" <?php if($student['District']=='Khulna'){echo "selected";}?>>Khulna</option>
												<option value="Kishoreganj" <?php if($student['District']=='Kishoreganj'){echo "selected";}?>>Kishoreganj</option>
												<option value="Kurigram" <?php if($student['District']=='Kurigram'){echo "selected";}?>>Kurigram</option>
												<option value="Kushtia" <?php if($student['District']=='Kushtia'){echo "selected";}?>>Kushtia</option>
												<option value="Lakshmipur" <?php if($student['District']=='Lakshmipur'){echo "selected";}?>>Lakshmipur</option>
												<option value="Lalmonirhat" <?php if($student['District']=='Lalmonirhat'){echo "selected";}?>>Lalmonirhat</option>
												<option value="Madaripur" <?php if($student['District']=='Madaripur'){echo "selected";}?>>Madaripur</option>
												<option value="Magura" <?php if($student['District']=='Magura'){echo "selected";}?>>Magura</option>
												<option value="Manikganj" <?php if($student['District']=='Manikganj'){echo "selected";}?>>Manikganj</option>
												<option value="Meherpur" <?php if($student['District']=='Meherpur'){echo "selected";}?>>Meherpur</option>
												<option value="Moulvibazar" <?php if($student['District']=='Moulvibazar'){echo "selected";}?>>Moulvibazar</option>
												<option value="Munshiganj" <?php if($student['District']=='Munshiganj'){echo "selected";}?>>Munshiganj</option>
												<option value="Mymensingh" <?php if($student['District']=='Mymensingh'){echo "selected";}?>>Mymensingh</option>
												<option value="Naogaon" <?php if($student['District']=='Naogaon'){echo "selected";}?>>Naogaon</option>
												<option value="Narail" <?php if($student['District']=='Narail'){echo "selected";}?>>Narail</option>
												<option value="Narayanganj" <?php if($student['District']=='Narayanganj'){echo "selected";}?>>Narayanganj</option>
												<option value="Narsingdi" <?php if($student['District']=='Narsingdi'){echo "selected";}?>>Narsingdi</option>
												<option value="Natore" <?php if($student['District']=='Natore'){echo "selected";}?>>Natore</option>
												<option value="Netrokona" <?php if($student['District']=='Netrokona'){echo "selected";}?>>Netrokona</option>
												<option value="Nilphamari" <?php if($student['District']=='Nilphamari'){echo "selected";}?>>Nilphamari</option>
												<option value="Noakhali" <?php if($student['District']=='Noakhali'){echo "selected";}?>>Noakhali</option>
												<option value="Pabna" <?php if($student['District']=='Pabna'){echo "selected";}?>>Pabna</option>
												<option value="Panchagarh" <?php if($student['District']=='Panchagarh'){echo "selected";}?>>Panchagarh</option>
												<option value="Patuakhali" <?php if($student['District']=='Patuakhali'){echo "selected";}?>>Patuakhali</option>
												<option value="Pirojpur" <?php if($student['District']=='Pirojpur'){echo "selected";}?>>Pirojpur</option>
												<option value="Rajbari" <?php if($student['District']=='Rajbari'){echo "selected";}?>>Rajbari</option>
												<option value="Rajshahi" <?php if($student['District']=='Rajshahi'){echo "selected";}?>>Rajshahi</option>
												<option value="Rangamati" <?php if($student['District']=='Rangamati'){echo "selected";}?>>Rangamati</option>
												<option value="Rangpur" <?php if($student['District']=='Rangpur'){echo "selected";}?>>Rangpur</option>
												<option value="Satkhira" <?php if($student['District']=='Satkhira'){echo "selected";}?>>Satkhira</option>
												<option value="Shariatpur" <?php if($student['District']=='Shariatpur'){echo "selected";}?>>Shariatpur</option>
												<option value="Sherpur" <?php if($student['District']=='Sherpur'){echo "selected";}?>>Sherpur</option>
												<option value="Sirajganj" <?php if($student['District']=='Sirajganj'){echo "selected";}?>>Sirajganj</option>
												<option value="Sunamganj" <?php if($student['District']=='Sunamganj'){echo "selected";}?>>Sunamganj</option>
												<option value="Sylhet" <?php if($student['District']=='Sylhet'){echo "selected";}?>>Sylhet</option>
												<option value="Tangail" <?php if($student['District']=='Tangail'){echo "selected";}?>>Tangail</option>
												<option value="Thakurgaon" <?php if($student['District']=='Thakurgaon'){echo "selected";}?>>Thakurgaon</option>
											</select>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['district']; ?></div>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">Address</div>
											</div>
											<textarea class="form-control" name="address" style="height:86px"  required><?php echo $student['Address'];?></textarea>
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
											<option value="<?php echo $subject['Subject_Id'];?>"<?php if($student['Subject_Id'] == $subject['Subject_Id']){echo "selected";}?>><?php echo $subject['Sub_Name'];?></option>
											<?php
												endwhile;
											?>
										</select>
										</div>
										<div  class="text-center text-danger mb-2" style="font-style: italic;"><?php echo $err_msg['subject']; ?></div>
										<button type="submit" name="update" class="btn btn-info mb-3 float-right">Update</button>
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
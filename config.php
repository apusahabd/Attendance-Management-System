<?php 	
	$host = 'localhost';
	$dbusername = 'root';
	$dbpassword = 'apu55555';
	$dbname = 'attendance_management';

	$con = mysqli_connect($host,$dbusername,$dbpassword,$dbname);
	if(!$con){
		echo mysqli_connect_error();
	}
?>
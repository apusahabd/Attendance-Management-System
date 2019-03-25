<?php
	include_once('config.php');
	$id = $_GET['id']; 
	$qry="DELETE FROM `student` WHERE `ID` = '$id'";
	$drun = mysqli_query($con,$qry);
	header("location:allstudent.php");
?>
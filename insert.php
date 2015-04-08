<?php 

	#----CHANGE FOR PRODUCTION----#
	$dbserver = "localhost";
	$dbuser = "kabam";
	$dbpswd = "kabam-307";
	$dbname = "kabam";
	#-----------------------------#
	
	$info_tbl = "info";
	$data_tbl = "data";
	
  $db = mysqli_connect($dbserver, $dbuser, $dbpswd, $dbname);

	//this is an initialization call
	$pi_ID = 'testtest';
  $date = $_POST['date'];
  $wind = $_POST['wind'];
  $temperature = $_POST['temp'];
  $humidity = $_POST['humidity'];
  $light = $_POST['light'];

    //going to add data to the info database
  $query = "INSERT INTO `data` (pi_ID, date, wind_speed, temp, humidity, light) VALUES ('$pi_ID', '$date', '$wind', '$temperature', '$humidity', '$light')";

  $result = $db->query($query);

?>	

<?php 

	#----CHANGE FOR PRODUCTION----#
	$dbserver = "localhost";
	$dbuser = "root";
	$dbpswd = "password1";
	$dbname = "kabam";
	#-----------------------------#
	
	$info_tbl = "info";
	$data_tbl = "data";
	
  $db = mysqli_connect($dbserver, $dbuser, $dbpswd, $dbname);

	//this is an initialization call
	$pi_ID = 'testtest';
  $date = "today";
  $wind = 3;
  $temperature = 78;
  $humidity = 35;
  $light = 2;
	//going to add data to the info database
			
	$query = "INSERT INTO `data` (pi_ID, date, wind_speed, temp, humidity, light) VALUES ('$pi_ID', '$date', '$wind', '$temperature', '$humidity', '$light')";
  echo $query;
			
	$result = $db->query($query);
  var_dump($result);
			
?>	

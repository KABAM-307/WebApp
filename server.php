<?php
class Server
{
	#................SERVER................#
	# handles the interactions between the #
	# database, webapp, and the rasp pi.   #
	#......................................#
	
	#constructer for the server
	function _construct()
	{
		$host = gethostname();
		$ip = gethostbyname($host);
		global $serverIP;
		$serverIP = $ip;
		echo "ServerIP: " . $serverIP . "<br>";
		
		#make ONE instance of the model and controller
		global $model;
		global $controller;
		$model = new Model();
		$controller = new Controller();
	}
	
	#ask for data from pi
	function pollFromPi()
	{
		
	}
	
	#receive data from pi
	
	function handleNewData()
	{
		
	}
	
	#wait for request from web application
	
	function handleWebRequest()
	{
	}
}

class Model
{
	#................MODEL.................#
	# speaks with the database and         #
	# responds to requests from server     #
	#......................................#
	
	function _constructor()
	{
		#.............CHANGE IF NOT TESTING...........#
		$testing = true;
		#.............................................#
		
		#db values that change between prod and test
		global $dbserver;
		global $dbuser;
		global $dbpswd;
		global $dbname;
		
		#constant db values
		global $data_tbl;
		global $info_tbl;
		

		if($testing)
		{
			
			$dbserver = "localhost";
			$dbuser = "root";
			$dbpswd = "";
			$dbname = "kabam_test";
		} else
		{
			$dbserver = "";
			$dbuser = "kabam";
			$dbpswd = "kabam-307";
			$dbname = "kabam";
		}
		
		#constant db values
		$data_tbl = "data";
		$info_tbl = "info";
	}
	
	#runs a query of given type 
	function runQuery($query)
	{
		#make connection to the database
		$dbconnection = new mysqli($dbserver, $dbuser, $dbpswd, $dbname);
		
		#check connection
		if($dbconnection->connect_error)
		{
			die("Connection failed: " . $dbconnection->connect_error);
		}
		
		#make query to database
		$result = $dbconnection->query($query);
		
		#close the connection
		$dbconnection->close();
		
		return $result;
	}
	
	
	#FUNCTIONS THAT WILL ADD DATA TO THE DATABASE
	
	#receives data in JSON file
	
	function addJSONData($json)
	{
	}
	
	#converts JSON file into a SQL statement
	
	function JSONtoSQL($json)
	{
	}
	
	#puts data into database given a SQL statement and table
	function callInsertQuery($query)
	{
		
		#make query to database
		$result = runQuery($query);
		
		if($result == TRUE)
		{
			#new record created successfully
		} else
		{
			echo "Error: " . $sql . "<br>" . $dbconnection->connect_error;
		}
		
	}
	
	
	
	#FUNCTIONS THAT WILL RETURN DATA FROM THE DATABASE
	
	#handles request for data and converts into SQL
	
	function pullData($data)
	{
	}
	
	#returns data from database found from query
	
	function callSelectQuery($query)
	{
		
		$result = runQuery($query);
		
		#return the result
		return $result;
	}
	
	#FUNCTIONS THAT WILL UPDATE DATA FROM THE DATABASE
	
	function changeField($field, $new_val, $pi_id)
	{
		//figure out what table the field is a part of
		$tbl = "";
		
		switch($field)
		{
			case "pi_ID":
			case "date":
			case "wind_speed":
			case "temp":
			case "humidity":
				$tbl = $GLOBALS['data_tbl'];
				break;
			default:
				$tbl = $GLOBALS['info_tbl'];
				break;
		}
		
		$query = "UPDATE " . $tbl . " SET " . $field . "=" . $new_val . " WHERE pi_ID=" . $pi_id;
		$result = runQuery($query);
	}
	
	#FUNCTIONS THAT WILL DELETE A CERTAIN RPI WEATHER STATION
	
	function removePi($pi_id)
	{
		#has to delete from both tables! I think...
		$query = "DELETE FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID=" . $pi_id . ";";
		$query .= "DELETE FROM " . $GLOBALS['info_tbl'] . "WHERE pi_ID=" . $pi_id;
		
		#make query to database
		$result = runQuery($query);
		
	}
}

class Controller
{
	#..............CONTROLLER..............#
	# responds to requests from the web    #
	# application and posts data           #
	#......................................#
	
	#function to get the weather data
	function getWeatherData()
	{
		
	}
	
	#function to get location of user
	function getLocation()
	{
	}
	
	#function to set Alias for pi
	function setAlias()
	{
	}
	
	#function to get filtered data
	function getFilteredData()
	{
	}
}
?>
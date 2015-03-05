<!DOCTYPE html>
<html>
<head>
	<title>Testing PHP</title>
</head>
<body>

<?php

class Server
{
	#................SERVER................#
	# handles the interactions between the #
	# database, webapp, and the rasp pi.   #
	#......................................#

	private $model;
	private $controller;
	private $serverIP;
	
	#constructer for the server
	function __construct()
	{
		$this->model = new Model();
		$this->controller = new Controller();
		$host = gethostname();
		$ip = gethostbyname($host);
		$this->serverIP = $ip;
		return $this;
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
	
	function handleWebRequest($type)
	{
		if($type = "current") 
		{
			#asking for current data from the database
			$this->controller->getCurrentData(NULL);
		}
	}
}

class Model
{
	#................MODEL.................#
	# speaks with the database and         #
	# responds to requests from server     #
	#......................................#
	
	#----CHANGE FOR PRODUCTION----#
	private $dbserver = "localhost";
	private $dbuser = "root";
	private $dbpswd = "";
	private $dbname = "kabam_test";
	#-----------------------------#
	
	private $info_tbl = "info";
	private $data_tbl = "data";
	

	
	#testing function to print out all the records in the database
	
	function printAllData()
	{
		//get results of select all query
		
		$query = "SELECT * FROM " . $this->info_tbl;
		
		$result_info = $this->runQuery($query);
		
		$query = "SELECT * FROM " . $this->data_tbl;
		$result_data = $this->runQuery($query);
		
		echo "INFO TABLE<br><br>";
		
		//print info table
		if ($result_info->num_rows > 0) {
    		echo "<table><tr><th>PI_ID</th><th>Alias</th><th>Owner</th><th>Location</th><th>Share</th></tr>";
    		// output data of each row
    		while($row = $result_info->fetch_assoc()) {
        		echo "<tr><td>".$row["pi_ID"]."</td><td>" . $row["alias"]. "</td><td>" . $row["owner"] . "</td><td>" . $row["location"] . "</td><td>" . $row["share"] . "</td></tr>";
    		}
    		echo "</table>";
		} else {
    		echo "0 results";
		}
		echo "<br><br>DATA TABLE<br><br>";
		
		//print data table
		if ($result_data->num_rows > 0) {
    		echo "<table><tr><th>ID</th><th>PI_ID</th><th>Date</th><th>Wind Speed</th><th>Temperature</th><th>Humidity</th></tr>";
    		// output data of each row
    		while($row = $result_data->fetch_assoc()) {
        		echo "<tr><td>".$row["ID"]."</td><td>" . $row["pi_ID"]. "</td><td>" . $row["date"] . "</td><td>" . $row["wind_speed"] . "</td><td>" . $row["temp"] . "</td><td>" . $row["humidity"] . "</td></tr>";
    		}
    		echo "</table>";
		} else {
    		echo "0 results";
		}
		
	}
	
	#runs a query of given type 
	function runQuery($query)
	{
		#make connection to the database
		$dbconnection = new mysqli($this->dbserver, $this->dbuser, $this->dbpswd, $this->dbname);
		
		#check connection
		if($dbconnection->connect_error)
		{
			die("Connection failed: " . $dbconnection->connect_error);
		}
		
		#make query to database
		$result = $dbconnection->query($query);
		
		if($dbconnection->error)
		{
			echo $dbconnection->error;
		}
		
		#close the connection
		$dbconnection->close();
		
		return $result;
	}
	
	
	#FUNCTIONS THAT WILL ADD DATA TO THE DATABASE
	
	#puts data into database given a SQL statement and table
	function callInsertQuery($query)
	{
		
		#make query to database
		$result = $this->runQuery($query);
		
		if($result == TRUE)
		{
			#new record created successfully
			echo "Successfully added record<br>";
		} else
		{
			echo "Error: " . $query . "<br>";
		}
		
	}
	
	#receives data in JSON file and converts to SQL
	
	function addJSONData($json_file)
	{
		//figure out if this is an init call or a data call
		$json = json_decode($json_file);
		$item = $json->RPiData;
		if($item->type == $this->info_tbl)
		{
			//this is an initialization call
			$pi_ID = $item->pi_ID;
			$alias = $item->alias;
			$owner = $item->owner;
			$location = $item->location;
			$share = $item->share;
			
			//going to add data to the info database
			
			$query = "INSERT INTO " . $this->info_tbl . " (pi_ID, alias, owner, location, share) VALUES ('" . $pi_ID . "', '" . $alias . "', '" . $owner . "', '" . $location . "', " . $share . ")";
			
			$this->callInsertQuery($query);
			
		} elseif($item->type == $this->data_tbl)
		{
			//this is a data input call
			$pi_ID = $item->pi_ID;
			$tmp_date = $item->dateval;
			$temperature = $item->temp;
			$humidity = $item->humidity;
			$wind = $item->wind_speed;
			
			//gotta parse that date!
			//bad code....oops
			$endpt = strpos($tmp_date, "-");
			$month = intval(substr($tmp_date, 0, $endpt));
			$startpt = $endpt + 1;
			$endpt = strpos($tmp_date, "-", $startpt);
			$day = intval(substr($tmp_date,$startpt,$endpt));
			$startpt = $endpt + 1;
			$endpt = strpos($tmp_date, " ", $startpt);
			$year = intval(substr($tmp_date,$startpt,$endpt));
			$startpt = $endpt + 1;
			$endpt = strpos($tmp_date, ":", $startpt);
			$hour = intval(substr($tmp_date,$startpt,$endpt));
			$startpt = $endpt + 1;
			$endpt = strpos($tmp_date, ":", $startpt);
			$minute = intval(substr($tmp_date,$startpt,$endpt));
			$startpt = $endpt + 1;
			$second = intval(substr($tmp_date,$startpt));
			
			$date_new = mktime($hour, $minute, $second, $month, $day, $year);
			$date = date("Y-m-d h:i:sa",$date_new);
			
			//make our query
			$query = "INSERT INTO " . $this->data_tbl . " (pi_ID, date, wind_speed, temp, humidity) VALUES ('" . $pi_ID . "', '" . $date . "', " . $wind . ", " . $temperature . ", " . $humidity . ")";
			
			$this->callInsertQuery($query);
		} else
		{
			//problem with JSON file
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
				$tbl = $this->data_tbl;
				break;
			default:
				$tbl = $this->info_tbl;
				break;
		}
		
		$query = "UPDATE " . $tbl . " SET " . $field . "='" . $new_val . "' WHERE pi_ID='" . $pi_id . "'";
		$result = $this->runQuery($query);
	}
	
	#FUNCTIONS THAT WILL DELETE A CERTAIN RPI WEATHER STATION
	
	function removePi($pi_id)
	{
		#has to delete from both tables, data first
		$query_children = "DELETE FROM " . $this->data_tbl . " WHERE pi_ID='" . $pi_id . "'";
		$query_parent = "DELETE FROM " . $this->info_tbl . " WHERE pi_ID='" . $pi_id . "'";
		
		#make query to database
		$result = $this->runQuery($query_children);
		$result = $this->runQuery($query_parent);
		
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
	
	function getCurrentData($location)
	{
		if($location == NULL)
		{
			$location = "West Lafayette";
		}
		
		$results = array("temp"=>75,"humidity"=>2,"wind"=>6,"location"=>$location);
		
		//fill in the curr_data here
		
		echo "Temperature: " . $results['temp'] . "<br>";
		echo "Wind Speed: " . $results['wind'] . "<br>";
		echo "Humidity: " . $results['humidity'] . "<br>";
		echo "Location: " . $results['location'] . "<br>";
	}
}

$server = new Server();

$q = $_REQUEST["q"];

$server->handleWebRequest($q);

?>

</body>
</html>
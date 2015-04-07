<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 4/6/2015
 * Time: 9:41 PM
 */

#................MODEL.................#
# speaks with the database and         #
# responds to requests from server     #
#......................................#

#----CHANGE FOR PRODUCTION----#
$dbserver = "localhost";
$dbuser = "kabam";
$dbpswd = "kabam-307";
$dbname = "kabam";
#-----------------------------#

$info_tbl = "info";
$data_tbl = "data";



#testing function to print out all the records in the database
function printQueryData($result_info, $result_data) {
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
        echo "<table><tr><th>ID</th><th>PI_ID</th><th>Date</th><th>Wind Speed</th><th>Temperature</th><th>Humidity</th><th>Light</th></tr>";
        // output data of each row
        while($row = $result_data->fetch_assoc()) {
            echo "<tr><td>".$row["ID"]."</td><td>" . $row["pi_ID"]. "</td><td>" . $row["date"] . "</td><td>" . $row["wind_speed"] . "</td><td>" . $row["temp"] . "</td><td>" . $row["humidity"] . "</td><td>" . $row["light"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

function printAllData()
{
    //get results of select all query

    $query = "SELECT * FROM " . $GLOBALS['info_tbl'];

    $result_info = runQuery($query);

    $query = "SELECT * FROM " . $GLOBALS['data_tbl'];
    $result_data = runQuery($query);

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
        echo "<table><tr><th>ID</th><th>PI_ID</th><th>Date</th><th>Wind Speed</th><th>Temperature</th><th>Humidity</th><th>Light</th></tr>";
        // output data of each row
        while($row = $result_data->fetch_assoc()) {
            echo "<tr><td>".$row["ID"]."</td><td>" . $row["pi_ID"]. "</td><td>" . $row["date"] . "</td><td>" . $row["wind_speed"] . "</td><td>" . $row["temp"] . "</td><td>" . $row["humidity"] . "</td><td>" . $row["light"] . "</td></tr>";
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
    $dbconnection = new mysqli($GLOBALS['dbserver'], $GLOBALS['dbuser'], $GLOBALS['dbpswd'], $GLOBALS['dbname']);

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
    $result = runQuery($query);

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
    if($item->type == $GLOBALS['info_tbl'])
    {
        //this is an initialization call
        $pi_ID = $item->pi_ID;
        $alias = $item->alias;
        $owner = $item->owner;
        $location = $item->location;
        $share = $item->share;

        //going to add data to the info database

        $query = "INSERT INTO " . $GLOBALS['info_tbl'] . " (pi_ID, alias, owner, location, share) VALUES ('" . $pi_ID . "', '" . $alias . "', '" . $owner . "', '" . $location . "', " . $share . ")";

        callInsertQuery($query);

    } elseif($item->type == $GLOBALS['data_tbl'])
    {
        //this is a data input call
        $pi_ID = $item->pi_ID;
        $tmp_date = $item->dateval;
        $temperature = $item->temp;
        $humidity = $item->humidity;
        $wind = $item->wind_speed;
        $light = $item->light;

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
        $query = "INSERT INTO " . $GLOBALS['data_tbl'] . " (pi_ID, date, wind_speed, temp, humidity, light) VALUES ('" . $pi_ID . "', '" . $date . "', " . $wind . ", " . $temperature . ", " . $humidity . ", " . $light .")";

        callInsertQuery($query);
    } else
    {
        //problem with JSON file
    }
}

#FUNCTIONS THAT WILL RETURN DATA FROM THE DATABASE

#handles request for current data and converts into SQL

function pullCurrentData($location)
{
    #initialize our results array
    $results = array("temp"=>0,"humidity"=>0,"wind"=>0,"location"=>$location,"light"=>0);

    #write query to find a pi_ID with the given location and then run
    $query = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE location='" . $location . "'";

    $pi_at_location = runQuery($query);

    #get the first pi in location
    #TODO: use coordinates to find closest location?
    $first_pi = mysqli_fetch_assoc($pi_at_location);

    #request the most recent update from the given pi

    $query = "SELECT * FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID='" . $first_pi["pi_ID"] . "'";

    $all_data = runQuery($query);

    #get the last entry added
    for($r = 0; $r < mysqli_num_rows($all_data) - 1; $r++)
    {
        mysqli_fetch_assoc($all_data);
    }
    #now on the last
    $row = mysqli_fetch_assoc($all_data);
    $results['temp'] = $row["temp"];
    $results['humidity'] = $row["humidity"];
    $results['wind'] = $row["wind_speed"];
    $results['light'] = $row["light"];

    return $results;
}

#handles request for filtered data and converts into SQL

function pullFilteredData($filter)
{
    /*
     * $filter = array("alias"=>$_POST["alias"],"city"=>$_POST["city"],"state"=>$_POST["state"],"lowTemp"=>$_POST["lowTemp"],"highTemp"=>$_POST["highTemp"],
        "lowHumid"=>$_POST["lowHumid"],"highHumid"=>$_POST["highHumid"],"lowLight"=>$_POST["lowLight"],"highLight"=>$_POST["highLight"],
        "lowSpeed"=>$_POST["lowSpeed"],"highSpeed"=>$_POST["highSpeed"],"lowDate"=>$_POST["lowDate"],"highDate"=>$_POST["highDate"]);
     */

    //after receiving a filter we need to run a query
    //first grab PI_IDs that match what we need
    $query = "SELECT * FROM " . $GLOBALS['info_tbl'];
    //check if we need
    if ($filter["alias"] != "none") {
        //using alias
        $query = $query . " WHERE alias='" . $filter["alias"] . "'";
    }
    //TODO:add location filtering here
    $pi_results = runQuery($query);
    $pis = mysqli_fetch_assoc($pi_results);
    if ($pi_results->num_rows == 1) {
        //finish second part of query using pi_id
        $finalquery = "SELECT * FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID='" . $pis["pi_ID"] . "'";
    } else if ($pi_results->num_rows != 0) {
        $count = 1;
        $finalquery = "SELECT * FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID IN ('" . $pis["pi_ID"] . "', ";
        for (; $count < $pi_results->num_rows; $count = $count + 1) {
            $pis = mysqli_fetch_assoc($pi_results);
            $finalquery = $finalquery . $pis["pi_ID"] . "'";
            if ($count == $pi_results->num_rows - 1) {
                $finalquery = $finalquery . ")";
            } else {
                $finalquery = $finalquery . ", ";
            }
        }
    } else { return null; }
    //add other filters that they want
    //temperature
    $finalquery = $finalquery . ", temp BETWEEN " . $filter["lowTemp"] . " AND " . $filter["highTemp"];
    //humidity
    $finalquery = $finalquery . ", humidity BETWEEN " . $filter["lowHumid"] . " AND " . $filter["highHumid"];
    //pressure
    $finalquery = $finalquery . ", light BETWEEN " . $filter["lowLight"] . " AND " . $filter["highLight"];
    //wind speed
    $finalquery = $finalquery . ", wind BETWEEN " . $filter["lowSpeed"] . " AND " . $filter["highSpeed"];
    //TODO: Add date stuff
    echo $finalquery;
    $results = runQuery($finalquery);
    return $results;
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
?>
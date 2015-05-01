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
function printQueryData($result_data) {
    //print data table
    if ($result_data->num_rows > 0) {
        echo "<table cellpadding='15px' ><thead><th>PI_ID</th><th>Date</th><th>Wind Speed</th><th>Temperature</th><th>Humidity</th><th>Light</th></thead>";
        // output data of each row
        while($row = $result_data->fetch_assoc()) {
            echo "<tr><td>". $row["pi_ID"]. "</td><td>" . $row["date"] . "</td><td>" . $row["wind_speed"] . "</td><td>" . $row["temp"] . "</td><td>" . $row["humidity"] . "</td><td>" . $row["light"] . "</td></tr>";
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
        echo "Successfully added record";
        return TRUE;
    } else
    {
        echo "Error: " . $query;
        //we might need to update the data
        return FALSE;
    }

}

#convert zipcode to latitude and longitude
function getLnt($zip){
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    $result5[] = $result1[0]['address_components'][1];
    $result6[] = $result1[0]['address_components'][2];
    $location = array("lat"=>$result3[0]['lat'],"lng"=>$result3[0]['lng'], "city"=>$result5[0]['long_name'], "state"=>$result6[0]['short_name']);
    return $location;
}

function getZip($city, $state)
{
    for ($i = 0; $i < strlen($city); $i++) {
        if ($city[$i] == ' ') {
            $city[$i] = '+';
        }
    }
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $city . "+" . $state;
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[] = $result['results'][0];
    $result2[] = $result1[0]['geometry'];
    $result3[] = $result2[0]['location'];
    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $result3[0]['lat'] . "," . $result3[0]['lng'] . "&sensor=true";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result4[] = $result['results'][0];
    $index = 0;
    for ($i = 0; $i < 15; $i++) {
        $result5 = $result4[0]['address_components'][$i];
        if ($result5["types"][0] == "postal_code") {
            $index = $i;
            break;
        }
    }
    $result6[] = $result4[0]['address_components'][$index];
    $zip = $result6[0]['long_name'];
    return $zip;
}

#find distance between two lat/lon points
function getDistance($lat1, $lat2, $lon1, $lon2) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return $miles;
}


#FINDS THE CLOSEST PI_ID to the given latitude and longitude
function findClosestPi($lat, $long)
{
    $pi_info = array("pi_ID"=>0,"zipcode"=>0);
    //first run a query requesting all information in the info table
    $query = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE share=1";
    $all_data = runQuery($query);
    $min_dist = -1;
    $date = date("Y-m-d G:i:s");
    for ($r = 0; $r < mysqli_num_rows($all_data); $r++) {
        $row = mysqli_fetch_assoc($all_data);
        $row_lat = $row["Latitude"];
        $row_lon = $row["Longitude"];
        echo
        $row_dist = getDistance($lat,$row_lat,$long,$row_lon,'M');
        echo "Target: " . $lat . ", " . $long . "<br>";
        echo "Found: " . $row_lat . ", " . $row_lon . "<br>";
        echo $row["alias"] . " distance is " . $row_dist . "<br>";
        if ($min_dist == -1 || $row_dist < $min_dist) {
            //check and see when last update for this pi_ID was
            $datequery = "SELECT * FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID='" . $row["pi_ID"] . "'";
            $dateresults = runQuery($datequery);
            for($s = 0; $s < mysqli_num_rows($dateresults) - 1; $s++)
            {
                mysqli_fetch_assoc($dateresults);
            }
            #now on the last
            $daterow = mysqli_fetch_assoc($dateresults);
            $diff = (strtotime($date) - strtotime($daterow["date"]))/3600;
            echo $row["alias"] . " updated on " . $daterow["date"] . "<br>";
            echo "Difference: " . $diff . "<br>";
            if ($diff <= 1.0) {
                $pi_info["pi_ID"] = $row["pi_ID"];
                $pi_info["zipcode"] = $row["zipcode"];
                $min_dist = $row_dist;
            }
        }
    }

    if ($min_dist > 10 || $min_dist == -1) {
      echo $min_dist;
      return false;
    } else {
      return  $pi_info;
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
        $zip = $item->location;
        $share = $item->share;
        //USE ZIPCODE to find latitude and longitude
        $results = getLnt($zip);
        //check if there is already a pi_ID in there
        $selq = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE pi_ID='" . $pi_ID . "'";
        $res = runQuery($selq);
        $num_res = mysqli_num_rows($res);
        if ($num_res >= 1) {
            echo "Updating Pi";
            //get the record that already has the pi id
            $row = mysqli_fetch_assoc($res);
            if ($alias != $row["alias"]) {
                changeField("alias", $alias, $pi_ID);
            }
            if ($owner != $row["owner"]) {
                changeField("owner", $owner, $pi_ID);
            }
            if ($zip != $row["zipcode"]) {
                changeField("zipcode", $zip, $pi_ID);
                $results = getLnt($zip);
                changeField("City", $results["city"], $pi_ID);
                changeField("State", $results["state"], $pi_ID);
                changeField("Latitude", $results["lat"], $pi_ID);
                changeField("Longitude", $results["lng"], $pi_ID);
            }
            if ($share != $row["share"]) {
                changeField("share", $share, $pi_ID);
            }
        } else {
            //going to add data to the info database
            $query = "INSERT INTO " . $GLOBALS['info_tbl'] . " (pi_ID, alias, owner, zipcode, City, State, share, Latitude, Longitude) VALUES ('"
                . $pi_ID . "', '" . $alias . "', '" . $owner . "', " . $zip . ", '" . $results["city"] . "', '" . $results["state"] . "', " . $share . ", " . $results["lat"] . ", " . $results["lng"] . ")";
            callInsertQuery($query);
        }
    } elseif($item->type == $GLOBALS['data_tbl'])
    {
        //this is a data input call
        $pi_ID = $item->pi_ID;
        $date = date("Y-m-d G:i:s");
        $wind = $item->wind_speed;
        $temperature = $item->temp;
        $humidity = $item->humidity;
        $light = $item->light;
        $pressure = $item->pressure;
        //make our query
        $query = "INSERT INTO " . $GLOBALS['data_tbl'] . " (pi_ID, date, wind_speed, temp, humidity, light, pressure) VALUES ('" . $pi_ID . "', '" . $date . "', '" . $wind . "', '" . $temperature . "', '" . $humidity . "', '" . $light ."', '" . $pressure ."')";
        callInsertQuery($query);
    } else
    {
        //problem with JSON file
    }
}


#generically pulls most recent data from given pi_ID
function pullRecentData($pi_ID) {
    $query = "SELECT * FROM " . $GLOBALS['data_tbl'] . " WHERE pi_ID='" . $pi_ID . "'";

    $all_data = runQuery($query);

    #get the last entry added
    for($r = 0; $r < mysqli_num_rows($all_data) - 2; $r++)
    {
        mysqli_fetch_assoc($all_data);
    }
    #now on the last
    $row = mysqli_fetch_assoc($all_data);
    //get last temp
    $lasttemp = $row["temp"];
    $row = mysqli_fetch_assoc($all_data);
    $difference = 0;
    if ($lasttemp < $row["temp"]) {
        $difference = 1;
    } else if ($lasttemp > $row["temp"]) {
        $difference = -1;
    }
    #get zipcode
    $zipquery = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE pi_ID='" . $pi_ID . "'";
    $zipdata = runQuery($zipquery);
    $ziprow = mysqli_fetch_assoc($zipdata);
    $jsona = array('temp' => $row["temp"], 'humidity' => $row["humidity"],'wind' => $row["wind_speed"],'light' => $row["light"],'zipcode' => $ziprow["zipcode"], 'pressure' => $row["pressure"] ,'difference' => $difference);
    $json = json_encode($jsona);
    return $json;
}

#pulls most recent data for given alias
function pullAliasData($alias) {
    #convert alias to pi_ID
    $query = "SELECT * FROM " . $GLOBALS["info_tbl"] . " WHERE alias='" . $alias . "'";
    $data = runQuery($query);
    $row = mysqli_fetch_assoc($data);
    if ($row["pi_ID"] == NULL) {return NULL;}
    return pullRecentData($row["pi_ID"]);
}


#FUNCTIONS THAT WILL RETURN DATA FROM THE DATABASE

#handles request for current data and converts into SQL
function pullCurrentData($lat, $long) {
    //FIND LOCATION THING THAT IS CLOSEST WITH THE MOST UPDATED TIME
    $closest_Pi = findClosestPi($lat,$long);

    if ($closest_Pi === false) {
        return json_encode(array("error"=>"far"));
    }
    #request the most recent update from the given pi
    return pullRecentData($closest_Pi["pi_ID"]);
}



#handles request for filtered data and converts into SQL

function pullFilteredData($filter, $checks)
{
    /*
     * $filter = array("alias"=>$_POST["alias"],"city"=>$_POST["city"],"state"=>$_POST["state"],"lowTemp"=>$_POST["lowTemp"],"highTemp"=>$_POST["highTemp"],
        "lowHumid"=>$_POST["lowHumid"],"highHumid"=>$_POST["highHumid"],"lowLight"=>$_POST["lowLight"],"highLight"=>$_POST["highLight"],
        "lowSpeed"=>$_POST["lowSpeed"],"highSpeed"=>$_POST["highSpeed"],"lowDate"=>$_POST["lowDate"],"highDate"=>$_POST["highDate"]);

        $checks = array("hasAlias"=>$_POST["aliasCheck"],"hasLoc"=>$_POST["locCheck"], "hasTemp"=>$_POST["tempCheck"], "hasHumid"=>$_POST["humidCheck"],
        "hasLight"=>$_POST["lightCheck"], "hasWind"=>$_POST["windCheck"], "hasDate"=>$_POST["dateCheck"]);
     */

    //after receiving a filter we need to run a query
    //first grab PI_IDs that match what we need
    $query = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE share=1";
    //check if we need
    if ($filter["alias"] != "none" && $checks["hasAlias"]) {
        //using alias
        $query = $query . " AND alias='" . $filter["alias"] . "'";
    }

    if ($filter["city"] != "none" && $filter["state"] != "none" && $checks["hasLoc"]) {
        //using a city as well
        $zip = getZip($filter["city"], $filter["state"]);
        $query = $query . " AND zipcode=" . $zip;
    }

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
            $finalquery = $finalquery . "'" . $pis["pi_ID"] . "'";
            if ($count == $pi_results->num_rows - 1) {
                $finalquery = $finalquery . ")";
            } else {
                $finalquery = $finalquery . ", ";
            }
        }
    } else { return null; }
    //add other filters that they want
    //temperature
    if ($checks["hasTemp"]) {
        $finalquery = $finalquery . " AND (temp BETWEEN " . $filter["lowTemp"] . " AND " . $filter["highTemp"] . ")";
    }
    if ($checks["hasHumid"]) {
        //humidity
        $finalquery = $finalquery . " AND (humidity BETWEEN " . $filter["lowHumid"] . " AND " . $filter["highHumid"] . ")";
    }
    if ($checks["hasLight"]) {
        //light
        $finalquery = $finalquery . " AND (light BETWEEN " . $filter["lowLight"] . " AND " . $filter["highLight"] . ")";
    }
    if ($checks["hasWind"]) {
        //wind speed
        $finalquery = $finalquery . " AND (wind_speed BETWEEN " . $filter["lowSpeed"] . " AND " . $filter["highSpeed"] . ")";
    }
    if ($checks["hasPress"]) {
        //pressure
        $finalquery = $finalquery . " AND (pressure BETWEEN " . $filter["lowPress"] . " AND " . $filter["highPress"] . ")";
    }
    if ($checks["hasDate"]) {
        $year = substr($filter["lowDate"], 0, 4);
        $month = substr($filter["lowDate"], 5, 7);
        $day = substr($filter["lowDate"], 9, 11);
        $startdate = $year . "-" . $month . "-" . $day . "T00:00:00";
        $year = substr($filter["highDate"], 0, 4);
        $month = substr($filter["highDate"], 5, 7);
        $day = substr($filter["highDate"], 9, 11);
        $enddate = $year . "-" . $month . "-" . $day . "T00:00:00";
        $finalquery = $finalquery . " AND (date BETWEEN '" . $startdate . "' AND '" . $enddate . "')";
    }
    $results = runQuery($finalquery);
    for($r = 0; $r < mysqli_num_rows($results); $r++)
    {
        $row = mysqli_fetch_assoc($results);
        $tempquery = "SELECT * FROM " . $GLOBALS['info_tbl'] . " WHERE pi_ID='" . $row["pi_ID"] . "'";
        $tmpresults = runQuery($tempquery);
        $tmprow = mysqli_fetch_assoc($tmpresults);
        if ($checks["hasAlias"]) {
            $jsona[$r]["alias"] = $tmprow["alias"];
        }
        if ($checks["hasLoc"]) {
            $jsona[$r]["city"] = $tmprow["City"];
            $jsona[$r]["state"] = $tmprow["State"];
            $jsona[$r]["lat"] = $tmprow["Latitude"];
            $jsona[$r]["long"] = $tmprow["Longitude"];
        }
        if ($checks["hasDate"]) {
            $jsona[$r]["date"] = $row["date"];
        }
        if ($checks["hasTemp"]) {
            $jsona[$r]["temp"] = $row["temp"];
        }
        if ($checks["hasHumid"]) {
            $jsona[$r]["humidity"] = $row["humidity"];
        }
        if ($checks["hasWind"]) {
            $jsona[$r]["wind"] = $row["wind_speed"];
        }
        if ($checks["hasLight"]) {
            $jsona[$r]["light"] = $row["light"];
        }
        if ($checks["hasPress"]) {
            $jsona[$r]["pressure"] = $row["pressure"];
        }
    }
    $json = json_encode($jsona);
    return $json;
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
            $tbl = $GLOBALS["data_tbl"];
            break;
        default:
            $tbl = $GLOBALS["info_tbl"];
            break;
    }

    $query = "UPDATE " . $tbl . " SET " . $field . "='" . $new_val . "' WHERE pi_ID='" . $pi_id . "'";
    runQuery($query);
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

#posts the current data to the website
function postCurrentData($data)
{
    echo "Currently in zipcode " . $data['zipcode'] . "<br>";
    echo "Temperature: " . $data['temp'] . " *F<br>";
    echo "Wind Speed: " . $data['wind'] . "<br>";
    echo "Humidity: " . $data['humidity'] . "%<br>";
    echo "Light: " . $data['light'] . " lux<br>";
}
?>

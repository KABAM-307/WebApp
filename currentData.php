<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 4/7/2015
 * Time: 3:33 PM
 */
include 'Model.php';
echo "Inside currentData.php";
$lat = $_GET["latitude"];
$long = $_GET["longitude"];
#asking for current data from the database
#send location to our model with a false
#to show only to get the most current data
echo "Found latitude: " . $lat . "\n";
echo "Found longitude: " . $long . "\n";
$data_to_post = pullCurrentData($lat, $long);
#post the data
postCurrentData($data_to_post);
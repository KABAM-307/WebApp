<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 4/7/2015
 * Time: 3:33 PM
 */
include 'Model.php';

$lat = $_POST["latitude"];
$long = $_POST["longitude"];
#asking for current data from the database
#send location to our model with a false
#to show only to get the most current data

$data_to_post = pullCurrentData($lat, $long);
#post the data
postCurrentData($data_to_post);
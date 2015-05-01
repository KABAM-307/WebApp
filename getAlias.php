<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 5/1/2015
 * Time: 4:37 PM
 */

include 'Model.php';
//echo "Inside currentData.php";
$alias = $_GET["alias"];
#asking for current data from a specific alias
$data_to_post = pullAliasData($alias);
#post the data
echo $data_to_post;
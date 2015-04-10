<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 4/7/2015
 * Time: 3:30 PM
 */
    include 'Model.php';
    //$jsonstr = $_POST["json"];
    $jsonstr = "{\n\"RPiData\": {\n\"type\":\"info\",\n\"pi_ID\":\"json1\",\n\"alias\":\"json_tester1\",\n\"owner\":\"bkuehn\",\n\"location\":47906,\n\"share\":0\n}\n}";
    addJSONData($jsonstr);
?>


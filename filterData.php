<?php
    include_once('./header.php');
    include_once('./subnav.php');
?>
<div id="basic" class="content">
<?php
/**
 * Created by PhpStorm.
 * User: Bridgette
 * Date: 4/6/2015
 * Time: 9:14 PM
 */
    include 'Model.php';
    $filter = array("alias"=>$_POST["alias"],"city"=>$_POST["city"],"state"=>$_POST["state"],"lowTemp"=>$_POST["lowTemp"],"highTemp"=>$_POST["highTemp"],
        "lowHumid"=>$_POST["lowHumid"],"highHumid"=>$_POST["highHumid"],"lowLight"=>$_POST["lowLight"],"highLight"=>$_POST["highLight"],
        "lowSpeed"=>$_POST["lowSpeed"],"highSpeed"=>$_POST["highSpeed"],"lowDate"=>$_POST["lowDate"],"highDate"=>$_POST["highDate"]);
    //now that we have filter
    //we have to make an array and call models filter function
    $result = pullFilteredData($filter);
    //we have a query result so we
   echo $result;

?>
</div>
<?php
    include_once('./footer.php');
?>

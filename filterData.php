<?php
    include_once('./header.php');
    include_once('./subnav.php');
?>
<script src="Chart.js"></script>

<?php
  include 'Model.php';
  $filter = array("alias"=>$_POST["alias"],"city"=>$_POST["city"],"state"=>$_POST["state"],"lowTemp"=>$_POST["lowTemp"],"highTemp"=>$_POST["highTemp"],
      "lowHumid"=>$_POST["lowHumid"],"highHumid"=>$_POST["highHumid"],"lowLight"=>$_POST["lowLight"],"highLight"=>$_POST["highLight"],
      "lowSpeed"=>$_POST["lowSpeed"],"highSpeed"=>$_POST["highSpeed"],"lowDate"=>$_POST["lowDate"],"highDate"=>$_POST["highDate"],
      "lowPress"=>$_POST["lowPress"], "highPress"=>$_POST["highPress"]);
  $checks = array("hasAlias"=>$_POST["aliasCheck"],"hasLoc"=>$_POST["locCheck"], "hasTemp"=>$_POST["tempCheck"], "hasHumid"=>$_POST["humidCheck"],
      "hasLight"=>$_POST["lightCheck"], "hasWind"=>$_POST["windCheck"], "hasDate"=>$_POST["dateCheck"], "hasPress"=>$_POST["pressCheck"]);
  //now that we have filter
  //we have to make an array and call models filter function
  $result = pullFilteredData($filter, $checks);
  //we have a query result so we
?>

  <script>
    var json = JSON.parse('<?php echo $result ?>');
  </script>

  <div id="basic" class="content">

  <h1 id="tempVal" style="display: none">Temperature Values</h1>
  <canvas id="tempChart" width="1000px" height="600" style="display: none"></canvas>
  <h1 id="humVal" style="display: none">Humidity Values</h1>
  <canvas id="humidityChart" width="1000px" height="600" style="display: none"></canvas>
  <h1 id="pressVal" style="display: none">Pressure Values</h1>
  <canvas id="pressureChart" width="1000px" height="600" style="display: none"></canvas>
  <h1 id="lightVal" style="display: none">Light Values</h1>
  <canvas id="lightChart" width="1000px" height="600" style="display: none"></canvas>
  <h1 id="windVal" style="display: none">Wind Values</h1>
  <canvas id="windChart" width="1000px" height="600" style="display: none"></canvas>
  </div>


  <script type="application/javascript">
    if (json[0].temp) {
      var temp = [];
      var labels = [];
      for(var i = 0; i < 50; i++) {
        j = json.length-1-(i*3);
        labels[i] = json[j].date;
        temp[i] = parseFloat(json[j].temp);
      }

      var data = {
        labels: labels,
        datasets: [
          {
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: temp
        }
        ]
      };
      var tempChart = $("#tempChart").get(0).getContext("2d");
      $('#tempChart').show();
      $('#tempVal').show();
      var myLineChart = new Chart(tempChart).Line(data);
    } 

    if (json[0].humidity) {
      var humidity = [];
      var labels = [];
      for(var i = 0; i < 50; i++) {
        j = json.length-1-(i*3);
        labels[i] = json[j].date;
        humidity[i] = parseFloat(json[j].humidity);
      }

      var data = {
        labels: labels,
        datasets: [
          {
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(0,187,205,1)",
            pointColor: "rgba(0,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: humidity
        }
        ]
      };
      var humidityChart = $("#humidityChart").get(0).getContext("2d");
      $('#humidityChart').show();
      $('#humVal').show();
      var myLineChart = new Chart(humidityChart).Line(data);
    } 

    if (json[0].pressure) {
      var pressure = [];
      var labels = [];
      for(var i = 0; i < 50; i++) {
        j = json.length-1-(i*3);
        labels[i] = json[j].date;
        pressure[i] = parseFloat(json[j].pressure);
      }

      var data = {
        labels: labels,
        datasets: [
          {
            fillColor: "rgba(187,151,205,0.2)",
            strokeColor: "rgba(187,151,205,1)",
            pointColor: "rgba(187,151,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(187,151,205,1)",
            data: pressure
        }
        ]
      };
      var pressureChart = $("#pressureChart").get(0).getContext("2d");
      $('#pressureChart').show();
      $('#pressVal').show();
      var myLineChart = new Chart(pressureChart).Line(data);
    }

    if (json[0].light) {
      var light = [];
      var labels = [];
      for(var i = 0; i < 50; i++) {
        j = json.length-1-(i*3);
        labels[i] = json[j].date;
        light[i] = parseFloat(json[j].light);
      }

      var data = {
        labels: labels,
        datasets: [
          {
            fillColor: "rgba(205,151,187,0.2)",
            strokeColor: "rgba(205,151,187,1)",
            pointColor: "rgba(205,151,187,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(205,151,187,1)",
            data: light
        }
        ]
      };
      var lightChart = $("#lightChart").get(0).getContext("2d");
      $('#lightChart').show();
      $('#lightVal').show();
      var myLineChart = new Chart(lightChart).Line(data);
    }

    if (json[0].wind) {
      var wind = [];
      var labels = [];
      for(var i = 0; i < 50; i++) {
        j = json.length-1-(i*3);
        labels[i] = json[j].date;
        wind[i] = parseFloat(json[j].wind);
      }

      var data = {
        labels: labels,
        datasets: [
          {
            fillColor: "rgba(151,0,205,0.2)",
            strokeColor: "rgba(151,0,205,1)",
            pointColor: "rgba(151,0,205,1)",
            pointStrokeColor: "#fff",
            pointHighwindFill: "#fff",
            pointHighwindStroke: "rgba(151,0,205,1)",
            data: wind
        }
        ]
      };
      var windChart = $("#windChart").get(0).getContext("2d");
      $('#windChart').show();
      $('#windVal').show();
      var myLineChart = new Chart(windChart).Line(data);
    }

    </script>

<?php
  include_once('./footer.php');
?>

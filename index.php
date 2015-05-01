<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.0.2/jquery.simpleWeather.min.js"></script>

<script>
	function getCurrent() {
    var lat = 0;
    var lon = 0;

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById("data").innerHTML = "Finding closest weather station...";
        lat = position.coords.latitude;
        lon = position.coords.longitude;

        $.getJSON("currentData.php?latitude=" + lat + "&longitude=" + lon, function(data){
          console.log(data);

          if (data.error === "far") {
            $.simpleWeather({
              location: lat+","+lon,
              unit: 'f',
              success: function(data) {
                console.log(data);
                $("#data").html("<p>Temperature: "+data.temp+"&deg; F</p>");
                $("#data").append("<p>Humidity: "+data.humidity+"%</p>");
                $("#data").append("<p>Pressure: "+data.pressure+" "+data.units.pressure+"</p>");
                $("#data").append("<p>Wind speed: "+data.wind.speed+" mph</p>");
              },
              error: function(error) {
                $("#data").html('<p>'+error+'</p>');
              }
            });
          } else {

            $("#data").html("<p>Temperature: "+data.temp+"&deg; F</p>");
            $("#data").append("<p>Humidity: "+data.humidity+"%</p>");
            $("#data").append("<p>Pressure: "+data.pressure+" mbars</p>");
            $("#data").append("<p>Light: "+data.light+" lux</p>");
            $("#data").append("<p>Wind speed: "+data.wind+" mph</p>");
            $("#data").append("<p>ZIP code: "+data.zipcode+"</p>");
      
            if (data.light > 20) {
              
              if(data.humidity > 60) {
                $('#rain').show();
              } else if(data.humidity > 30) {
                $('#cloudy').show();
              } else {
                $('#sun').show();
              }
            } else {
                $('#moon').show();
            }
          }
        });
      });
    }
  }
  
  function getForecast() {
    var lat = 0;
    var lon = 0;

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        lat = position.coords.latitude;
        lon = position.coords.longitude;

        $.simpleWeather({
        location: lat+","+lon,
        	unit: 'f',
            success: function(data) {
            	console.log(data);
                $("#forecast").html("<p>Forecast for: "+data.city+", "+data.region+" on "+data.forecast[1].date);
                $("#forecast").append("High temperature: "+data.forecast[1].high+"&deg; F<br>");
                $("#forecast").append("Low temperature: "+data.forecast[1].low+"&deg; F<br>");
                $("#forecast").append(""+data.forecast[1].text+"</p>");
                $("#forecast").append("<p>Forecast on "+data.forecast[2].date);
                $("#forecast").append("High temperature: "+data.forecast[2].high+"&deg; F<br>");
                $("#forecast").append("Low temperature: "+data.forecast[2].low+"&deg; F<br>");
                $("#forecast").append(""+data.forecast[2].text+"</p>");
              },
            error: function(error) {
                $("#forecast").html('<p>'+error+'</p>');
              }
            });
	  	});
		}
	}
	
</script>

<p id="test"></p>

<div id="content" class="content">
	<h1>
		Welcome! Personal Pi in the Sky
	</h1>

	<script type="text/javascript">
		getCurrent();
		getForecast();
	</script>
	<p><span id="data">Getting current location...</span></p>
	<img id="sun" src="weathericons/sun.png" style="width:50px;height:50px;display:none">
	<img id="moon" src="weathericons/moon.png" style="width:50px;height:50px;display:none">
	<img id="rain" src="weathericons/rain.png" style="width:50px;height:50px;display:none">
	<img id="cloudy" src="weathericons/cloudy.png" style="width:50px;height:50px;display:none">
	<p><span id="forecast">Finding forecast...</span></p>
	<p>
		<br>
		Personal Pi in the Sky was created by Purdue University Computer Science students
		as part of a semester long software engineering class. To learn more about the class and our team, see the About Us page on our website.<br><br>
	</p>
</div>

<?php include_once('./footer.php'); ?>

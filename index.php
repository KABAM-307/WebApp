<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<script>

	function getCurrent() {
    var lat = 0;
    var lon = 0;

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById("data").innerHTML = "Finding closest weather station...";
        lat = position.coords.latitude;
        lon = position.coords.longitude;

        /*var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
          }
        }
        //document.getElementById("test").innerHTML = "currentData.php?latitude=" + lat + "&longitude=" + lon;
        xmlhttp.open("GET", "currentData.php?latitude=" + lat + "&longitude=" + lon);
		*/
		$.getJSON("currentData.php?latitude=" + lat + "&longitude=" + lon, function(data){
			
			//console.log(data);
			
			$("#data").html("<p>Temperature: "+data.temp+"&deg; F</p>");
			$("#data").append("<p>Humidity: "+data.humidity+"%</p>");
			$("#data").append("<p>Pressure: "+data.pressure+" mbars</p>");
			$("#data").append("<p>Light: "+data.light+" lux</p>");
//			$("#data").append("<p>Wind speed: "+data.wind+" mph</p>");
			$("#data").append("<p>ZIP code: "+data.zipcode+"</p>");
			
		});
		
		
        //xmlhttp.send();

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
	</script>
	<p><span id="data">Getting current location...</span></p>

	<p>
		<br>
		Personal Pi in the Sky was created by Purdue University Computer Science students
		as part of a semester long software engineering class. To learn more about the class and our team, see the About Us page on our website.<br><br>
	</p>
</div>

<?php include_once('./footer.php'); ?>

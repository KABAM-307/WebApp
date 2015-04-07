<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<script>
	function getCurrent() {
		var lat = 0;
		var lon = 0;
		if (navigator.geolocation) {
	  		navigator.geolocation.getCurrentPosition(function(position) {
    			lat = position.coords.latitude;
       			lon = position.coords.longitude;
       		});
   		}

	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("data").innerHTML = xmlhttp.responseText;
			}
   		}
		xmlhttp.open("GET", "currentData.php?latitude=" + lat + "&longitude=" + lon);
		xmlhttp.send();
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
	<p><span id="data"></span></p>

	<p>
		<br>
		Personal Pi in the Sky was created by Purdue University Computer Science students
		as part of a semester long software engineering class. To learn more about the class and our team, see the About Us page on our website.<br><br>
	</p>
</div>

<?php include_once('./footer.php'); ?>
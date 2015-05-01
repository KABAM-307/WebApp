<?php
    include_once('./header.php');
    include_once('./subnav.php');
?>

<script>

	function getParameterByName(name) {
    	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        	results = regex.exec(location.search);
    	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	function getCurrent() {
    	$.getJSON("getAlias.php?alias=" + getParameterByName("alias"), function(data) {
    		$("#data").html("<p>Temperature: "+data.temp+"&deg; F</p>");
            $("#data").append("<p>Humidity: "+data.humidity+"%</p>");
            $("#data").append("<p>Pressure: "+data.pressure+" mbars</p>");
            $("#data").append("<p>Light: "+data.light+" lux</p>");
            $("#data").append("<p>Wind speed: "+data.wind+" mph</p>");
            $("#data").append("<p>ZIP code: "+data.zipcode+"</p>");
    		}
    	});

</script>

<div id="basic" class="content">

	<script type="text/javascript">
		getCurrent();
	</script>
	<p><span id="data">Getting current location...</span></p>

	<div id="error" class="content">
		<p>We're sorry! The provided alias was not recognized by our system.</p>
	</div>
</div>

<?php
    include_once('./footer.php');
?>
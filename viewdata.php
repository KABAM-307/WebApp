<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<div id="basic" class="content">
	<h1>View Data</h1>
	<p>Search and filer historical weather data.</p>
	
	<form action="filterData.php" method="post">
		<fieldset>
			<legend>Weather Station Alias</legend>
			Enter a weather station alias:<br>
			alias: <input type="text" name="alias" value="none">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Location:</legend>
			Enter a location:<br>
			city: <input type="text" name="city" value="none">
			state: <input type="text" name="state" value="none">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Temperature</legend>
			Enter a temperature range:<br>
			low: <input type="number" name="lowTemp" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highTemp" size="7" min="-150" max="150" value="0">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Humidity</legend>
			Enter a humidity range:<br>
			low: <input type="number" name="lowHumid" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highHumid" size="7" min="-150" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Barometric Pressure</legend>
			Enter a pressure range:<br>
			low: <input type="number" name="lowPress" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highPress" size="7" min="-150" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Wind</legend>
			Enter a wind speed range:<br>
			low: <input type="number" name="lowSpeed" size="7" min="0" max="150" value="0">
			high: <input type="number" name="highSpeed" size="7" min="0" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset>
			<legend>Date</legend>
			Enter a date range:<br>
			<?php
				$date = getdate(date("U"));
				print_r(getdate());
				$maxDate = "$date[year]-$date[month]-$date[day]";
				echo $maxDate;
				<br>
				low: <input type="date" name="lowDate" size="7" min="2015-1-1" max=$maxDate value="2015-1-1">
				high: <input type="date" name="highDate" size="7" min="2015-1-1" max=$maxDate value=$maxDate>
			?>
			<br>
		</fieldset>
		<br>
		<input type="submit" value="submit">
	</form>
	<br><br>

</div>

<?php include_once('./footer.php'); ?>
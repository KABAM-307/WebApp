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
			high: <input type="number" name="highTemp" size="7" min="-150" max="150" value="100">
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
			<legend>Light</legend>
			Enter a light range:<br>
			low: <input type="number" name="lowLight" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highLight" size="7" min="-150" max="150" value="100">
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
				print_r(getdate());
				echo '<br>';
				$date = getdate();
				print_r($date);
				echo '<br>';
				$maxDate = $date[year]. "-" . $date[mon] . "-" . $date[day];
				echo '$maxDate';
				echo 'low: <input type="date" name="lowDate" size="7" min="2015-1-1" max=$maxDate value="2015-1-1">';
				echo 'high: <input type="date" name="highDate" size="7" min="2015-1-1" max=$maxDate value=$maxDate>';
			?>
			
			<br>
		</fieldset>
		<br>
		<input type="submit" value="submit">
	</form>
	<br><br>

</div>

<?php include_once('./footer.php'); ?>
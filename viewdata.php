<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<div id="basic" class="content">
	<h1>View Data</h1>
	<p>Search and filer historical weather data.</p>
	<label>
		<input type="checkbox" id="aliasCheck">alias</input>
		<input type="checkbox" id="locCheck">location</input>
		<input type="checkbox" id="tempCheck">temperature</input>
		<input type="checkbox" id="humidCheck">humidity</input>
		<input type="checkbox" id="lightCheck">light</input>
		<input type="checkbox" id="windCheck">wind</input>
		<input type="checkbox" id="dateCheck">date</input>
	</label>
	
	<form action="filterData.php" method="post">
		<fieldset id="alias" style="display:none">
			<legend>Weather Station Alias</legend>
			Enter a weather station alias:<br>
			alias: <input type="text" name="alias" value="none">
			<br>
		</fieldset>
		<br>
		<fieldset id="loc" style="display:none">
			<legend>Location:</legend>
			Enter a location:<br>
			city: <input type="text" name="city" value="none">
			state: <input type="text" name="state" value="none">
			<br>
		</fieldset>
		<br>
		<fieldset id="temp" style="display:none">
			<legend>Temperature</legend>
			Enter a temperature range:<br>
			low: <input type="number" name="lowTemp" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highTemp" size="7" min="-150" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset id="humid" style="display:none">
			<legend>Humidity</legend>
			Enter a humidity range:<br>
			low: <input type="number" name="lowHumid" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highHumid" size="7" min="-150" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset id="light" style="display:none">
			<legend>Light</legend>
			Enter a light range:<br>
			low: <input type="number" name="lowLight" size="7" min="-150" max="150" value="0">
			high: <input type="number" name="highLight" size="7" min="-150" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset id="wind" style="display:none">
			<legend>Wind</legend>
			Enter a wind speed range:<br>
			low: <input type="number" name="lowSpeed" size="7" min="0" max="150" value="0">
			high: <input type="number" name="highSpeed" size="7" min="0" max="150" value="100">
			<br>
		</fieldset>
		<br>
		<fieldset id="date" style="display:none">
			<legend>Date</legend>
			Enter a date range:<br>
			low: <input type="date" name="lowDate" size="10" min="2015-01-01" max="<?php echo date("Y-m-d");?>" value="2015-01-01">
			high: <input type="date" name="highDate" size="10" min="2015-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">			
			<br>
		</fieldset>
		<br>
		<input type="submit" value="submit">
	</form>
	<br><br>

</div>

<script>
	document.getElementById('aliasCheck').onchange = function() {
   		document.getElementById('alias').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('locCheck').onchange = function() {
    	document.getElementById('loc').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('tempCheck').onchange = function() {
    	document.getElementById('temp').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('humidCheck').onchange = function() {
    	document.getElementById('humid').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('lightCheck').onchange = function() {
    	document.getElementById('light').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('windCheck').onchange = function() {
    	document.getElementById('wind').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('dateCheck').onchange = function() {
    	document.getElementById('date').style.display = this.checked ? 'block' : 'none';
	};

</script>

<?php include_once('./footer.php'); ?>
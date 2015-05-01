<?php include_once('./header.php'); ?>

<?php include_once('./subnav.php'); ?>

<div id="basic" class="content">
	<h1>View Data</h1>
	<p>Search and filer historical weather data.</p>
	<br>
	
	<form action="filterData.php" method="post">
		<label>
			<input type="checkbox" id="aliasCheckid" name="aliasCheck">alias</input>
		</label>
		<label>
			<input type="checkbox" id="locCheckid" name="locCheck">location</input>
		</label>
		<label>
			<input type="checkbox" id="tempCheckid" name="tempCheck">temperature</input>
		</label>
		<label>
			<input type="checkbox" id="humidCheckid" name="humidCheck">humidity</input>
		</label>
		<label>
			<input type="checkbox" id="lightCheckid" name="lightCheck">light</input>
		</label>
		<label>
			<input type="checkbox" id="windCheckid" name="windCheck">wind</input>
		</label>
		<label>
			<input type="checkbox" id="dateCheckid" name="dateCheck">date</input>
		</label>
		<fieldset id="alias" style="display:none">
			<legend>Weather Station Alias</legend>
			Enter a weather station alias:<br>
			alias: <input type="text" name="alias" value="none">
			<br>
		</fieldset>
		<fieldset id="loc" style="display:none">
			<legend>Location:</legend>
			Enter a location:<br>
			city: <input type="text" name="city" value="none">
			state: <input type="text" name="state" value="none">
			<br>
		</fieldset>
		<fieldset id="temp" style="display:none">
			<legend>Temperature</legend>
			Enter a temperature range:<br>
			low: <input type="number" name="lowTemp" size="7" min="-40" max="120" value="30">
			high: <input type="number" name="highTemp" size="7" min="-40" max="120" value="80">
			<br>
		</fieldset>
		<fieldset id="humid" style="display:none">
			<legend>Humidity</legend>
			Enter a humidity range:<br>
			low: <input type="number" name="lowHumid" size="7" min="0" max="100" value="20">
			high: <input type="number" name="highHumid" size="7" min="0" max="100" value="80">
			<br>
		</fieldset>
		<fieldset id="light" style="display:none">
			<legend>Light</legend>
			Enter a light range:<br>
			low: <input type="number" name="lowLight" size="7" min="0" max="100" value="0">
			high: <input type="number" name="highLight" size="7" min="0" max="100" value="100">
			<br>
		</fieldset>
		<fieldset id="wind" style="display:none">
			<legend>Wind</legend>
			Enter a wind speed range:<br>
			low: <input type="number" name="lowSpeed" size="7" min="0" max="60" value="0">
			high: <input type="number" name="highSpeed" size="7" min="0" max="60" value="60">
			<br>
		</fieldset>
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
	document.getElementById('aliasCheckid').onchange = function() {
   		document.getElementById('alias').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('locCheckid').onchange = function() {
    	document.getElementById('loc').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('tempCheckid').onchange = function() {
    	document.getElementById('temp').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('humidCheckid').onchange = function() {
    	document.getElementById('humid').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('lightCheckid').onchange = function() {
    	document.getElementById('light').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('windCheckid').onchange = function() {
    	document.getElementById('wind').style.display = this.checked ? 'block' : 'none';
	};
	document.getElementById('dateCheckid').onchange = function() {
    	document.getElementById('date').style.display = this.checked ? 'block' : 'none';
	};

</script>

<?php include_once('./footer.php'); ?>
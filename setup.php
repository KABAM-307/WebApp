<?php include_once('./header.php'); ?>

<div id="sub_nav">
	<span class="button" id="sidebarbutton" onclick="setup_showCreate();">
		Create a Station
	</span>
	<span class="button" id="sidebarbutton" onclick="setup_showSource();">
		View Source Code
	</span>
	<span class="button" id="sidebarbutton" onclick="setup_showInfo();">
		Product Info
	</span>
	<a href="index.html">
			<span class="button hidden" id="sidebarbutton">
				Home
			</span>
		</a>
		<a href="viewdata.html">
			<span class="button hidden" id="sidebarbutton">
				View Data
			</span>
		</a>
		<a href="setup.html">
			<span class="button hidden" id="sidebarbutton">
				Set-up
			</span>
		</a>
		<a href="aboutus.html">
			<span class="button hidden" id="sidebarbutton">
				About
			</span>
		</a>
		<a href="contactus.html">
			<span class="button hidden" id="sidebarbutton">
				Contact Us
			</span>
		</a>
</div>

<div id="basic" class="content" >
	<h1>
		Learn How to Setup A Weather Station
	</h1>
	<p>
		So you want to create your own weather station? Well then you've found the right page! Making a Personal Pi in the Sky is rather simple.<br><br>
		Visit the tabs on the left to view instructions to set up your own Personal Pi in the Sky!
	</p>
</div>

<div id="create" style="display:none;" class="content">
	<h1>
		Create a Weather Station
	</h1>
	<p>
		First, you'll need all of the supplies in the list below:<br>
		Materials Needed:<br>
		<ul>
		<li>RaspberryPi:</li>
		<ol>
			<li>We used Raspberry Pi B+, but others should also work.</li>
			<li>Wires, resistors, and other materials to connect the sensors to the Raspberry Pi</li>
		</ol>
		<li>Sensors:</li>
		We purchased our sensors from Adafruit
		<ol>
			<li>Temperature/Humidity Sensor - http://www.adafruit.com/products/393</li>
			<li>Pressure Sensor - http://www.adafruit.com/products/1603</li>
			<li>Light Sensor - http://www.adafruit.com/products/161</li>
		</ol>
		</ul>
	</p>
	<p>
		After you have all of the materials, you're ready to start creating your own weather station.<br><br>
		First, download our software to your Raspberry Pi here.
		If you need a Raspberry Pi tutorial, click here.<br>
		Next, you're ready to start building. To connect your sensors, check out these tutorials:
		Check out the tutorial of how to connect the temperature sensor here.<br>
		Check out the tutorial of how to connect the pressure sensor here.<br>
		Check out the tutorial of how to connect the light sensor here.<br><br>
		After everything is connect and your weather station is set up, all you have to do is connect to our server.
		<br><br>
		You're done! You now have your very own Personal Pi in the Sky! Enjoy!
	</p>
</div>

<div id="source" style="display:none;" class="content">
	<h1>
		View Source Code
	</h1>
	<p>
		This page will display source code for the project upon completion.
	</p>
</div>

<div id="info" style="display:none;" class="content">
	<h1>
		Product Info
	</h1>
	<p>
		The Personal Pi in the Sky can be created by anyone. Follow the instructions on this page to learn how to create your own Personal Pi in the Sky.
	</p>
</div>

<div id="footer">
</div>

<?php include_once('./footer.php'); ?>
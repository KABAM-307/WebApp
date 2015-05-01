<?php include_once('./header.php'); ?>

<div id="sub_nav">
	<button id="sidebarbutton" onclick="setup_showCreate();">
		Create a Station
	</button>
	<button id="sidebarbutton" onclick="setup_showSource();">
		View Source Code
	</button>
	<button id="sidebarbutton" onclick="setup_showInfo();">
		Product Info
	</button>
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
		First, download our software to your Raspberry Pi by visiting our GitHub source code for the weatherStation <a href="https://github.com/KABAM-307/WeatherStation.git">here</a>.
		If you need a Raspberry Pi tutorial visit our Product Info page.  <br>
		Next, you're ready to start building. To connect your sensors, go to our Product Info page and check out the links!
		After the sensors are connected to the Pi and you have downloaded our weatherStation code to your Pi, the next step is to run the code. 
		
		To run our code navigate to the directory on your Pi that contains our WeatherStation code. 
		From there type "make" in your terminal to compile the Makefile we have provided. 
		If you setup everything correctly this Makefile should take care of all of the necessary code compilation for you.
		Lastly run the Main program by typing "java Main"
		This program will ask you a series of questions to define the settings for your weatherStation. 
		After you have completed answering all of the questions you should get a message that says "You've successfully setup your weather station!".
		If at anytime you would like to reconfigure the settings of your weatherStation just rerun the Main program with the flag --reconfig.
		Eg:  java Main --reconfig
		<br><br>
		You're done! You now have your very own Personal Pi in the Sky! Enjoy!
	</p>
</div>

<div id="source" style="display:none;" class="content">
	<h1>
		View Source Code
	</h1>
	<p>
		Our source code is publicly available on GitHub. 
		
		Clik <a href="https://github.com/KABAM-307">here</a> to view our source code.<br>
		
		The WeatherStation repository contains all of the code that the Raspberry Pi weather station uses to run.<br>
		
		The WebApp repository contains the code for the setup and running of the web application to view weather data.
	</p>
</div>

<div id="info" style="display:none;" class="content">
	<h1>
		Product Info
	</h1>
	<p>
		The Personal Pi in the Sky can be created by anyone. Follow the instructions on this page to learn how to create your own Personal Pi in the Sky.
		
		If you are new to the Raspberry Pi click <a href="https://www.youtube.com/watch?v=Jj4pjfU_-jo">here</a> for a quick tutorial.
		Specifics of the Raspberry Pi can be found here. <br>
		
		The sensors we used were all purchased from Adafruit. 
		For more information on each sensor and how to connect them to the Pi, visit the links below.<br>
		
		The Description section gives an overview of the sensor and how to connect it to the Pi.
		The Technical Details section provides the technical specs of the sensors. 
		The Learn section has additional videos that are great resources to learn about the sensors.<br>
		<ol>
			<li>Temperature/Humidity Sensor - http://www.adafruit.com/products/393</li>
			<li>Pressure Sensor - http://www.adafruit.com/products/1603</li>
			<li>Light Sensor - http://www.adafruit.com/products/161</li>
		</ol>
	</p>
</div>

<?php include_once('./footer.php'); ?>

<!DOCTYPE html>

<html>

<head>
	<title>
		Personal Pi in the Sky
	</title>
	<link rel="shortcut icon" href="berryicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script>
		function getCurrent() {
		    var xmlhttp = new XMLHttpRequest();
		     xmlhttp.onreadystatechange = function() {
		     	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		        	document.getElementById("currentData").innerHTML = xmlhttp.responseText;
		        }
		     }
			 var str = "current";
		     xmlhttp.open("GET", "server.php?q=" + str);
		     xmlhttp.send();   
		}
	</script>
</head>

<body>
	
	<div id="header">
		<h1>
			<a href="#"><img src="light_logo.png"/></a>
		</h1>
	</div>
			
	<div id="page_nav">
		<a href="index.html">
			<span class="button floatLeft" id="navbarbutton">
				Home
			</span>
		</a>
		<a href="viewdata.html">
			<span class="button floatLeft" id="navbarbutton">
				View Data
			</span>
		</a>
		<a href="setup.html">
			<span class="button floatLeft" id="navbarbutton">
				Set-up
			</span>
		</a>
		<a href="aboutus.html">
			<span class="button floatRight" id="navbarbutton">
				About
			</span>
		</a>
		<a href="contactus.html">
			<span class="button floatRight" id="navbarbutton">
				Contact Us
			</span>
		</a>
	</div>

<div id="sub_nav">
	<!-- Optional navigation bar here -->
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


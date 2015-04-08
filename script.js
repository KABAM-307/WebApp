/**
 * Functions below show divs based on sub navigations buttons
 */

 // Show historical data filter div on viewdata page
function view_showHistorical() {
	document.getElementById("historical").style.display = "block";
	document.getElementById("location").style.display = "none";
	document.getElementById("basic").style.display = "none";
}
// Show location search filter div on viewdata page
function view_showLocation() {
	document.getElementById("location").style.display = "block";
	document.getElementById("historical").style.display = "none";
	document.getElementById("basic").style.display = "none";
}
// Show create a station div on setup page
function setup_showCreate() {
	document.getElementById("basic").style.display = "none";
	document.getElementById("create").style.display = "block";
	document.getElementById("source").style.display = "none";
	document.getElementById("info").style.display = "none";
}
// Show view source code div on setup page
function setup_showSource() {
	document.getElementById("basic").style.display = "none";
	document.getElementById("create").style.display = "none";
	document.getElementById("source").style.display = "block";
	document.getElementById("info").style.display = "none";
}
// Show product info div on setup page
function setup_showInfo() {
	document.getElementById("basic").style.display = "none";
	document.getElementById("create").style.display = "none";
	document.getElementById("source").style.display = "none";
	document.getElementById("info").style.display = "block";
}


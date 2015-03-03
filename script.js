var main = function() {
	
	
	// these tools determine whether or not the side buttons have
	// been pressed or not
	var button1Pressed = false, button2Pressed = false, button3Pressed = false;
	  $(".button").hover(
			  function(){
				  $(this).addClass("active");
			  },
			  function(){
				  $(this).removeClass("active");
			  }
	  );
	  
	  /*
	   * 
	   * Clicking a side button
	   * */
	  $("#sidebarbutton:first").click(
			  function(){
				  
				if(!button1Pressed){
					$("#content>p").text($("#sidebarbutton:first").text());
					button1Pressed = true;
				}
				else{
					
					$("#content>p").text("View data here.");  
					button3Pressed = false; 
					button2Pressed = false; 
					button1Pressed = false;
				}
			  }
	  	);
	  
	  $("#sidebarbutton:nth-child(2)").click(
			  function(){
				  
				if(!button2Pressed){
					$("#content>p").text($("#sidebarbutton:nth-child(2)").text()); 
					button2Pressed = true;
				}
				else{
					
					$("#content>p").text("View data here.");  
					button3Pressed = false; 
					button2Pressed = false; 
					button1Pressed = false;
				}
			  }
	  	);
	  
	  $("#sidebarbutton:nth-child(3)").click(
			  function(){
				  
				if(!button3Pressed){
					$("#content>p").text($("#sidebarbutton:nth-child(3)").text());
					button3Pressed = true;
				}
				else{
					
					$("#content>p").text("View data here."); 
					button3Pressed = false; 
					button2Pressed = false; 
					button1Pressed = false;
				}
			  }
	  	);
	  
};
$(document).ready(main);

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


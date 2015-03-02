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

function showHistorical() {
	document.getElementById("historical").style.display = "block";
	document.getElementById("location").style.display = "none";
	document.getElementById("basic").style.display = "none";
}
function showLocation() {
	document.getElementById("location").style.display = "block";
	document.getElementById("historical").style.display = "none";
	document.getElementById("basic").style.display = "none";
}


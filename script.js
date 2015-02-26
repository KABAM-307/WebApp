var main = function() {
	
	
	// these bools determine whether or not the Location/Historical buttons have
	// been pressed or not
	var loc = false, hist = false;
	
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
	   * Clicking the "Location" button
	   * */
	  $("#sidebarbutton:first").click(
			  function(){
				  hist = false;
				if(!loc){
					$("#content>p").text("Search by Location");
				}
				else{
					
					$("#content>p").text("View data here."); 
				}
				loc = !loc;
			  }
	  	);
	  
	  /*
	   * Clicking the "Historical" button
	   * */
	  $("#sidebarbutton:nth-child(2)").click(
			  function(){
				  loc = false;
				if(!hist){
					$("#content>p").text("View Historical");  
				}
				else{
					
					$("#content>p").text("View data here.");
				} 
				hist = !hist;
			  }
	  	);
	  
	  
};
$(document).ready(main);


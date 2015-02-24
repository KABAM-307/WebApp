var main = function() {
	  $(".button").hover(
			  function(){
				  $(this).addClass("active");
			  },
			  function(){
				  $(this).removeClass("active");
			  }
	  );
	  
};
$(document).ready(main);


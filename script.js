var main = function() {
	  $("span").hover(
			  function(){
				  $(this).addClass("active");
			  },
			  function(){
				  $(this).removeClass("active");
			  }
	  );
	  
};
$(document).ready(main);


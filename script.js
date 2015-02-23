var main = function() {
  /* Push the body and the nav over by 285px over */
	var menuOpen = false; // this boolean is true when the "menu" bar is open
  $('.icon-menu').click(function() {
	  /* close menu when clicking the menu toggler when the menu is still open */
	  if(menuOpen == true){
		  $('.menu').animate({
		      left: "-285px"
		    }, 200);

		    $('body').animate({
		      left: "0px"
		    }, 200);
		  
	  }
	  
	  /* open menu */
	  else{
		  $('.menu').animate({
		      left: "0px"
		    }, 200);

		    $('body').animate({
		      left: "285px"
		    }, 200);  
		  
	  }
    menuOpen = !menuOpen;
  });

  /* close menu when clicking the X button */
  $('.icon-close').click(function() {
    $('.menu').animate({
      left: "-285px"
    }, 200);

    $('body').animate({
      left: "0px"
    }, 200);
    menuOpen = false;
  });
  
  
  /*  Make the menu buttons glow when cursor hovers above them  */
  $(".menu li").hover(
		  function(){
			  $(this).addClass("active");
		  },
		  function(){
			  $(this).removeClass("active");
		  }
  );
};




$(document).ready(main);
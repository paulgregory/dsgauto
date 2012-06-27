$(document).ready(function(

  // Meet the Team
  $('#meet-the-team-wrapper .team-member').hover(function() {
	  $(this).find('.team-member-bio').animate({
	    top: '0px'
	  }, 2000);
  }, function() {
	  $(this).find('.team-member-bio').animate({
	    top: '208px'
	  }, 2000);
  });


));
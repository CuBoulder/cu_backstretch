jQuery(document).ready(function(){
  jQuery("#page-wrapper").append('<a href="#" id="bg-toggle" class="show-background">Toggle Background</a>');
  jQuery("#bg-toggle").toggle(function(){
    jQuery("#page-wrapper").animate({
      marginLeft: "-960px",
    }, 1500 );
    jQuery("#bg-toggle").removeClass("show-background");
    jQuery("#bg-toggle").addClass("hide-background");
  }, function(){
    jQuery("#page-wrapper").animate({
      marginLeft: "0px",
    }, 1500 );
    jQuery("#bg-toggle").removeClass("hide-background");
    jQuery("#bg-toggle").addClass("show-background");
  });
  
  jQuery("#bg-toggle").scrollFollow({offset:20});
});


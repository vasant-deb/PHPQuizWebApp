(function($) {
  "use strict"; 
  

  /*----------------------------
  9. price-slider active
  ------------------------------ */  
    $( "#slider-range" ).slider({
     range: true,
     min: 0,
     max: 500,
     values: [ 25, 325 ],
     slide: function( event, ui ) {
    $( "#amount" ).val( "$" + ui.values[ 0 ] + "       $" + ui.values[ 1 ] );
     }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     "       $" + $( "#slider-range" ).slider( "values", 1 ) ); 

  
  

})(jQuery);
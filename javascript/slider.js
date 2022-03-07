$(document).ready(function() {
    $('#autoWidth,#autoWidth2').lightSlider({
        autoWidth:true,
        onSliderLoad: function() {
            $('#autoWidth,#autoWidth2').removeClass('cS-hidden');
        } 
    });  
  });
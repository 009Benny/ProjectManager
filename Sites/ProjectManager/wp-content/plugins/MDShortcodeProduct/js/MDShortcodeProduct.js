jQuery('#modalcontent').ready(function($){
  var slider = $('.slider-container'),
  selector = $('.control-slider');

  selector.on('click', function(){
    var position = parseInt($(this).attr('data-target'));
    var cant = '-'+(position*100)+'%';
    slider.animate({marginLeft:cant}, 400);
  });
});

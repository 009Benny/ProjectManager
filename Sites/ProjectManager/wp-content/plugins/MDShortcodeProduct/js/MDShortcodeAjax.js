jQuery(document).ready(function($){
  var modal_shadow = $('.modal-shadow'),
  modal_container = $('.modal-center'),
  close = $('.modal-shadow, .md-close-modal');

  $('.MDidentifer').on('click', function(){
    var id = $(this).attr('id');
    modal_shadow.fadeIn(300);
    modal_container.fadeIn(300);
    if(id == 'register' ){
      $('#modal-register').show();
    }else if ( id == 'login' ) {
      $('#modal-account').show();
    }else{
      $('#modalcontent, .glyphicon-container').show();
    }
  });

  close.on('click', function(){
    $('.modal-shadow, .modal-center, #modal-account, #modal-register, #modalcontent, .glyphicon-container').fadeOut(500);
  });

  window.addEventListener( "scroll", function( event ) {
		if(modal_shadow.is(":visible")){
			$('html, body').scrollTop(0);
		}
	});

  $('.MDidentifer').on('click', function(){
    $('.md-loader-container').toggle();
    var id_product = $(this).attr('id');
    $.ajax({
      url: obj_ajax.ajax_url,
      data: {
        'action':'loadShortcode',
        'id': id_product
      },
      success: function(data){
        $('.md-loader-container').toggle();
        $('#modalcontent').empty();
        $('#modalcontent').append(data);
        $('.control-slider').on('click', function(){
          var position = parseInt($(this).attr('data-target'));
          var cant = '-'+(position*100)+'%';
          $('.slider-container').animate({marginLeft:cant}, 400);
        });
        

        $('.substract-price').click(function(){
      		var container = $('.qty');
      		var n = container.val();
      		if(n>1){
      			n--;
      		}
      		container.val(n);
      	});

      	$('.sum-price').click(function(){
      		var container = $('.qty');
      		var n = container.val();
      		n++;
      		container.val(n);
      	});

        $('.modal-shadow, .md-close-modal').on('click', function(){
          $('.modal-shadow, .modal-center').fadeOut(500);
        });
      },
      error: function(errThrown) {
        console.log(errThrown);
      }
    });
  });
});
//$('#modalcontent').empty();
//$('#modalcontent').append(response);

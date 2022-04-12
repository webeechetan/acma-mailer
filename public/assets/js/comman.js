


$(function(){
	$('.mobile_trigger').click(function(){
		$(this).toggleClass('active');
		$('body').css({'overflow':'hidden'});
		//alert();
	$('.nav').slideDown();
	$('.menu-close').fadeIn();
	$('.mobile_trigger').fadeOut();
	})
	$('.menu-close').click(function(){
		$('body').css({'overflow':'auto'});
		$('.nav').slideUp();
		$('.mobile_trigger').fadeIn();
	$('.menu-close').fadeOut();
	});

	$('.oh-navitem-link-arrow').click(function(){
		$(this).toggleClass('active');
	})

	$('.expandtiny').click(function(){
		//alert();
		$(this).parent().parent('dl').toggleClass('active');
    //$('.mks').addClass('open').removeClass('open');

	})






})



$(document).ready(function(){

	$(window).resize(function(){
			resizeImage();
		});
		
		
		resizeImage();

});
	function resizeImage(){

	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	if(windowWidth > 980){
		$('ul#menu1 > li.second-layer').hover(
			function(){
			  $(this).find('>ul').slideDown(200);
			},
			function(){
		  var el=this;
		  setTimeout( function(){
			$(el).find('>ul').slideUp(200)
			}, 100 ,'easeOutExpo' );
			}
		  );
	}
	else{
		$('.oh-navitem-link-arrow').click(function(){
			$('.multilevel').slideToggle();
		})
		
	}
	
	}
$(window).load(function(){
			resizeImage();
			resizeImageNew();
		});
	

$(document).ready(function(){
  $(window).resize(function(){
			resizeImageNew();
		});
	resizeImageNew();

});

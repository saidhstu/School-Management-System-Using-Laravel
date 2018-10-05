$(document).ready(function(){
	$(window).scroll(function(){
		var scrolValue = $(window).scrollTop();
		if(scrolValue > 125) {			
			$('.navbar').addClass("navbar-fixed-top ");
			$('#nav-form').removeClass('hide');
		} else{
			$('#nav-form').addClass('hide');
			$('.navbar').removeClass("navbar-fixed-top ");
		}
	});

	$("#up").on('click',function(e){
		e.preventDefault();
		$('html,body').animate({
			'scrollTop':'0'
		},500);
	});

	$('a.navbar-brand').css({
		'color': 'white'
	});

	$('.btn-cart-button').css({
		'color': 'white',
		'paddingLeft': '20px',
		'paddingRight': '20px',
		'paddingTop': '8px',
		'paddingBottom': '8px'
	});

	
});
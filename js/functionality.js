$(document).ready(function(){
	$(window).scroll(function(){
		var scrolValue = $(window).scrollTop();
		if(scrolValue > 155) {
			$('#fixed-header').slideDown(400);
		} else{
			$('#fixed-header').slideUp(400);
		}
	});

	$("#up").on('click',function(e){
		e.preventDefault();
		$('html,body').animate({
			'scrollTop':'0'
		},500);
	});
});
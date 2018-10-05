$(document).ready(function() {
	
	$("#slider").slider();
	$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy/mm/dd',
		yearRange: '2000:2050'
	});
  $(".datepicker").keypress(function(event) {event.preventDefault();});

	$( "#slider").slider({
		range: true,
		min:1,
		max:10000,
		values: [ 1, 10000 ]
	});

	$("#min").text(1 + " ৳"); 
    $("#max").text(10000 + " ৳");

	$('#slider').on('slide',function(event, ui){     
        $("#min").text(ui.values[0] + " ৳"); 
        $("#max").text(ui.values[1] + " ৳"); 
    });

    $('#slider').on('slidechange',function(event, ui){     
        // alert("min is" + ui.values[0] + " max is" + ui.values[1]);
    });

    new WOW().init();
});
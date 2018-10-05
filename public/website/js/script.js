$(document).ready(function(){
	$(window).scroll(function(){
		var scrolValue = $(window).scrollTop();
		if(scrolValue > 50) {
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
$('.pres2').hide();
$(document).on('change','select#leave-type',function(){
    var leave = $('#leave-type').val();
    if(leave == 2 || leave == 3) {
        $('.pres1').hide();
        $('.pres2').show();
    }
});


$(document).on('click','.like',function(e) {  
    e.preventDefault();  
    var login_user,post_id;
    login_user = $("#is_login").text();
    post_id = $("#post-id").text();
    if(login_user != 0) {
        $.ajax({
            type: "POST",
            url: "get_liked_post.php",
            data:{post_id:post_id,user_id:login_user},            
            success: function(data){                    
                $("#s-post").html(data);                                  
            }
        });
    } else {
        $('#myModal').modal('show');
    }
});

$(document).on('click','.dislike',function(e) {  
    e.preventDefault();  
    var login_user,post_id;
    login_user = $("#is_login").text();
    post_id = $("#post-id").text();
    if(login_user != 0) {
        $.ajax({
            type: "POST",
            url: "get_disliked_post.php",
            data:{post_id:post_id,user_id:login_user},            
            success: function(data){                    
                $("#s-post").html(data);                                  
            }
        });
    } else {
        $('#myModal').modal('show');
    }
});

$('[data-toggle="tooltip"]').tooltip();



$("#latest-news > span").css("color","white");


$("#print").click(function(){
    $("#values").show().printMe();
});

$("#print1").click(function(){
    $("#values1").show().printMe();
});

dycalendar.draw({
    target : "#calender",
    type : "month",
    highlighttoday: true
});
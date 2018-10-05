var target;
target = $('.menu-head');
target.on('click',function(){
    $(this).css({
        'background-color':'#ecc64b',
        'color':'black'
    });
    target.not(this).css({
    	'background-color':'#355655',
    	'color':'white'
    });
});
$(".user-toggle").click(function(){
    $(this).css({'background-color':'#355655','color':'white'});
});
$(".image-container").hide();
$("#img-remover").hide();
$(".image-loader").hide();
var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    if(output.src) {
        $("#img-name").html($("#image").val());
        $(".image-loader").fadeIn().delay(700).fadeOut();
        $(".img-upload-section").css({"height":"120px","margin-bottom":"10px"});
        $(".image-container").delay(1300).fadeIn();
        $("#img-remover").delay(1300).fadeIn();
        $("#image").hide();
        $("#uploader").hide();
    } else {
        $("#img-name").html($("#image").val());
        $(".image-loader").fadeIn().delay(700).fadeOut();
        $(".img-upload-section").css({"height":"120px","margin-bottom":"10px"});        
        $(".image-container").delay(1300).fadeIn();
        $("#img-remover").delay(1300).fadeIn();
        $("#uploader").hide();
    }
    $("#img-remover").click(function(){
        $("#image").val("");
        $(".image-container").hide();
        $("#img-remover").hide();
        $("#uploader").fadeIn(700);
        $(".img-upload-section").css({"height":"2px","margin-bottom":"0"});
    });
};
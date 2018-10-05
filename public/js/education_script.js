$(document).ready(function() {  
    var target;
    target = $('.borno')
    var playing = false,
        audioPlayers = $('.punt audio');
    target.click(function() {  
        if (playing == false) {  
            $(this).find('audio').get(0).play();
             
            // $('img.i').hide();
            // $(this).find('img.i').show();
            playing = true;  
        } else {  
            audioPlayers.each(function(){
                this.pause();
                this.currentTime=0;
            });  
            
        }
        playing = false;   
    });  
});  
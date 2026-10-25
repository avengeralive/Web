$( document ).ready(function() {
    slider();
});
/*
 * 
function wheelStart(block)
{
    var timer;
    
    block.find(" div.r ").addClass('roll');

    timer = setTimeout(function () {
        block.find(" div.r ").css({
            "animation-duration": "0.6s",
            "animation-iteration-count": "infinite",
            "animation-timing-function": "linear"
          });
    }, 2100);
    
    var bb = block.find("div.r:eq(1) ");

    setTimeout(function () {
        wheelStop(block);
   }, 3000);
}

1 приз - 0% 54%     0
2 приз - 9% 63%     20
3 приз - 18% 72%    40
4 приз - 27% 81.5%  60
5 приз - 36% 91%    80
6 приз - 45% 100%   100

 * 
 * 
 */
function wheelStart(block)
{

    $.ajax({
        url: './post/roulette.php',
        type: 'POST',
        success: function (response) {
            if(!response) alert("ERROR!");
            var data = jQuery.parseJSON(response);
            block.find(" div.r ").animate({
               'background-position-y': '100%',
               "opacity": "0"
            }, 1000);
            block.find(" div.r ").css({
                'background-position-y': '0%'
            });
            setTimeout(function() { 
                if(data.priz)
                {
                    i=0;
                    for(i; i<3; i++)
                    {	
                        block.find(" div.r:eq("+i+") ").css({"background-position-y": "0%",opacity:"0.1"});
                        block.find(" div.r:eq("+i+") ").animate({ "background-position-y": data.priz+"%",opacity:1},1500+ ( randomInteger(i, 10)*100 ));
                    }


                }
            }, 3000);
                $("#r_key").html(data.keys);
                setTimeout(function() { 
                    $('#priz-block').show();
                    play=true;
                }, 5000);
        }
    });

}
function wheelStop(block)
{
    var timer;
    
    block.find("div.r").css({
       "animation-duration": "2s"
    });
    
    timer = setTimeout(function () {
        for(var i=0; i<3; i++){
            var bb = block.find("div.r:eq("+i+") ");
                
                bb.css({
                    "animationPlayState": "paused"
                });
                var yPos = $(bb).css('backgroundPositionY');
                console.log(yPos);
                var priz = 4;
                    bb.css({
                        "animation-iteration-count": "",
                        "animation-timing-function": ""
                    });

                if(yPos > 36 && yPos < 91){
                    bb.animate({
                        'background-position-y': '91%'
                    }, 1000+ ( randomInteger(i, 10)*100 ));
                }else{
                    bb.animate({
                        'background-position-y': '36%'
                    }, 1000+ ( randomInteger(i, 10)*100 ));
                }
                
                /*
                
                bb.animate({
                    'background-position-y': '27%'
                }, 1000+ ( randomInteger(i, 10)*100 ));
*/
        }
    }, 1700);
    

/*
    var rTime = Math.floor(Math.random() * 3000) + ( randomInteger(1, 10)*100 );
    
    
    for(i=0; i<3; i++){
        
        var bb = block.find("div.r:eq("+i+") ");

        bb.attr('style', '');
        bb.css({
                "animation-duration": "3s",
                "animation-iteration-count": "1",
                "animation-timing-function": "ease-out"
          });
        bb.css('animationPlayState', 'running');
    }
    */
}

function randomInteger(min, max) {
    var rand = (min + 1) - 0.5 + Math.random() * (max - (min + 1) + 1)
    rand = Math.round(rand);
    return rand;
}

function slider()
{
	var slider=$("div.roulette");
	var zapros = 0;
        play=true;
	slider.find(".trigger").mousedown(function()
	{
            if(play===true){
                play=false;
                var block = slider.find("ul");
                block.find(" div.r ").css({
                    'background-position-y': '0%',
                });
                $('#priz-block').hide();

                var keys = $("#r_key").text(); 
                if(keys > 0){
                    wheelStart(slider);
                }else{
                        new Noty({
                          text: 'У Вас нет ключей от лид-рулетки!',
                          type: 'error',
                          theme: 'nest',
                          timeout: 3000,
                          closeWith: ['click', 'button'],
                          layout: 'topRight'
                        }).show();
                }
            }
	});
}
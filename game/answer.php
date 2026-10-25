<?
$x = file_get_contents('./games/'.$_GET['game'].'/teams/'.$_GET['team'].'/.passwd');
$quests = json_decode(file_get_contents('./json/'.$_GET['game'].'.json'), true);
if ($x == $_GET['password']) {
?>
<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700,900" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">
<div id="particles-js"></div>
<div class="content">
<h2>Вопрос № <? echo $_GET['question']; ?></h2>
<!--<p id="quest"><? echo $quests[$_GET['question'] - 1]['question']; ?></p>-->
<p>Введите Ваш ответ:</p>
<form action="./save_answer.php">
	<input type="hidden" name="game" value="<? echo $_GET['game']; ?>">
	<input type="hidden" name="team" value="<? echo $_GET['team']; ?>">
	<input type="hidden" name="password" value="<? echo $_GET['password']; ?>">
	<input type="hidden" name="question" value="<? echo $_GET['question']; ?>">
	<input type="hidden" name="time" id="time">
	<textarea name="answer"></textarea>
	<button type="submit">Сохранить</button>
</form>
<div class="timer">
	
</div>
</div>
<script src="http://ebm.spb.ru/wp-content/themes/ebm/js/particles.min.js"></script>
<script type="text/javascript">
particlesJS('particles-js',
  
  {
    "particles": {
      "number": {
        "value": 80,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#ffffff"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#000000"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "value": 5,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 400,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 40,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true,
    "config_demo": {
      "hide_card": false,
      "background_color": "#b61924",
      "background_image": "",
      "background_position": "50% 50%",
      "background_repeat": "no-repeat",
      "background_size": "cover"
    }
  }

);
  </script>
<style>
/* =============================================================================
   HTML5 CSS Reset Minified - Eric Meyer
   ========================================================================== */

html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}
body{line-height:1}
article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}
nav ul{list-style:none}
blockquote,q{quotes:none}
blockquote:before,blockquote:after,q:before,q:after{content:none}
a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;text-decoration:none}
mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold}
del{text-decoration:line-through}
abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help}
table{border-collapse:collapse;border-spacing:0}
hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}
input,select{vertical-align:middle}
li{list-style:none}


/* =============================================================================
   My CSS
   ========================================================================== */

/* ---- base ---- */

html,body{ 
	width:100%;
	height:100%;
	background:#111;
}

html{
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

body{
  font:normal 75% Arial, Helvetica, sans-serif;
}

canvas{
  display:block;
  vertical-align:bottom;
}


/* ---- stats.js ---- */

.count-particles{
  background: #000022;
  position: absolute;
  top: 48px;
  left: 0;
  width: 80px;
  color: #13E8E9;
  font-size: .8em;
  text-align: left;
  text-indent: 4px;
  line-height: 14px;
  padding-bottom: 2px;
  font-family: Helvetica, Arial, sans-serif;
  font-weight: bold;
}

.js-count-particles{
  font-size: 1.1em;
}

#stats,
.count-particles{
  -webkit-user-select: none;
  margin-top: 5px;
  margin-left: 5px;
}

#stats{
  border-radius: 3px 3px 0 0;
  overflow: hidden;
}

.count-particles{
  border-radius: 0 0 3px 3px;
}


/* ---- particles.js container ---- */

#particles-js {
    position: absolute;
    z-index: 0;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    /*background: #3a3e60;*/
    background: linear-gradient(45deg, #7f1eff, #06212f);
}

.content {
    z-index: 1;
    position: absolute;
}
table {
    font-size: 14px;
    margin: 0 auto;
}
table td {
    padding: 3px 10px;
    color: #fff;
    text-align: center;
    font-family: "Montserrat";
    line-height: 20px;
    font-size: 14px;
}
.content {
    display: block; width: 100%; color: #fff; font-family: "Montserrat"; font-size: 16px;
}
a {
    color: #fff; font-family: "Montserrat";
}
form { text-align: center; }
tr:first-child {
    font-weight: bold;
    font-size: 18px !important;
}
td:nth-child(1),td:nth-child(2),td:nth-child(3) {
    font-weight: bold;
    font-size: 18px !important;
}
</style>
<?
}
?>
<script type="text/javascript">
	$(function(){
		setInterval(function(){
			$.ajax({
				url: './timerGet.php',
				method: 'get',
				success: function(data) {
					$("#time").val(data);
					$(".timer").html(data);
				}
			});
		}, 1000);
		
	});
</script>
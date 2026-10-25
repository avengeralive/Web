$(document).ready(function() {
	
	/* scroll */
	
	$("a[href^='#']").click(function(){
		var targer = $(this).attr("href");
		var target_offset = $(targer).offset().top-$(".fixed_section").innerHeight();
		$("html, body").animate({scrollTop: target_offset+"px"});
		return false;
	});

	/* timer */

	function update() {
		var Now = new Date(), Finish = new Date();
		Finish.setHours( 23);
		Finish.setMinutes( 59);
		Finish.setSeconds( 59);
		if( Now.getHours() === 23  &&  Now.getMinutes() === 59  &&  Now.getSeconds === 59) {
			Finish.setDate( Finish.getDate() + 1);
		}
		var sec = Math.floor( ( Finish.getTime() - Now.getTime()) / 1000);
		var hrs = Math.floor( sec / 3600);
		sec -= hrs * 3600;
		var min = Math.floor( sec / 60);
		sec -= min * 60;
		$(".timer .hours").text( pad(hrs));
		$(".timer .minutes").text( pad(min));
		$(".timer .seconds").text( pad(sec));
		setTimeout( update, 200);
	}
	function pad(s) { return ("00"+s).substr(-2) }
	update();

	var i, c, y, v, s, n;
	v = document.getElementsByClassName("youtube");
	if (v.length > 0) {
		s = document.createElement("style");
		s.type = "text/css";
		s.innerHTML = '.youtube{background-color:#000;max-width:100%;height:inherit;overflow:hidden;position:relative;cursor:hand;cursor:pointer}.youtube .thumb{bottom:0;display:block;left:0;margin:auto;max-width:100%;position:absolute;right:0;top:0;width:100%;height:auto}.youtube .play{filter:alpha(opacity=80);opacity:.8;height:77px;left:50%;margin-left:-38px;margin-top:-38px;position:absolute;top:50%;width:77px;background:url("img/youtube-play-icon.png") no-repeat}';
		document.body.appendChild(s)
	}
	for (n = 0; n < v.length; n++) {
		y = v[n];
		i = document.createElement("img");
		i.setAttribute("src", "https://i.ytimg.com/vi/" + y.id + "/hqdefault.jpg");
		i.setAttribute("class", "thumb");
		c = document.createElement("div");
		c.setAttribute("class", "play");
		y.appendChild(i);
		y.appendChild(c);
		y.onclick = function() {
			var a = document.createElement("iframe");
			a.setAttribute("src", "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1&rel=0&showinfo=0");
			a.setAttribute("allowfullscreen","");
			a.style.width = this.style.width;
			a.style.height = this.style.height;
			this.parentNode.replaceChild(a, this)
		}
	};

});
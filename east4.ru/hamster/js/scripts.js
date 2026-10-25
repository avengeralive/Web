$(document).ready(function() {

	var i, c, y, v, s, n;
v = document.getElementsByClassName("youtube");
if (v.length > 0) {
    s = document.createElement("style");
    s.type = "text/css";
    s.innerHTML = '.video-container{height:0;position:relative;padding-bottom:57.7%;}.video-container iframe, .video-container object, .video-container embed{position:absolute;display:block;width:100%;height:100%;top:0;left:0;}.youtube{position:absolute;left:0;top:0;width:100%;max-width:100%;height:100%;background-color:#000;overflow:hidden;cursor:hand;cursor:pointer;}.youtube .thumb{bottom:0;display:block;left:0;margin:auto;max-width:100%;position:absolute;right:0;top:0;width:100%;height:auto}.youtube .play{filter:alpha(opacity=80);opacity:.8;height:77px;left:50%;margin-left:-38px;margin-top:-38px;position:absolute;top:50%;width:77px;background:url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDMxNC4wNjggMzE0LjA2OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMzE0LjA2OCAzMTQuMDY4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGcgaWQ9Il94MzNfNTYuX1BsYXkiPgoJCTxnPgoJCQk8cGF0aCBkPSJNMjkzLjAwMiw3OC41M0MyNDkuNjQ2LDMuNDM1LDE1My42MTgtMjIuMjk2LDc4LjUyOSwyMS4wNjhDMy40MzQsNjQuNDE4LTIyLjI5OCwxNjAuNDQyLDIxLjA2NiwyMzUuNTM0ICAgICBjNDMuMzUsNzUuMDk1LDEzOS4zNzUsMTAwLjgzLDIxNC40NjUsNTcuNDdDMzEwLjYyNywyNDkuNjM5LDMzNi4zNzEsMTUzLjYyLDI5My4wMDIsNzguNTN6IE0yMTkuODM0LDI2NS44MDEgICAgIGMtNjAuMDY3LDM0LjY5Mi0xMzYuODk0LDE0LjEwNi0xNzEuNTc2LTQ1Ljk3M0MxMy41NjgsMTU5Ljc2MSwzNC4xNjEsODIuOTM1LDk0LjIzLDQ4LjI2ICAgICBjNjAuMDcxLTM0LjY5LDEzNi44OTQtMTQuMTA2LDE3MS41NzgsNDUuOTcxQzMwMC40OTMsMTU0LjMwNywyNzkuOTA2LDIzMS4xMTcsMjE5LjgzNCwyNjUuODAxeiBNMjEzLjU1NSwxNTAuNjUybC04Mi4yMTQtNDcuOTQ5ICAgICBjLTcuNDkyLTQuMzc0LTEzLjUzNS0wLjg3Ny0xMy40OTMsNy43ODlsMC40MjEsOTUuMTc0YzAuMDM4LDguNjY0LDYuMTU1LDEyLjE5MSwxMy42NjksNy44NTFsODEuNTg1LTQ3LjEwMyAgICAgQzIyMS4wMjksMTYyLjA4MiwyMjEuMDQ1LDE1NS4wMjYsMjEzLjU1NSwxNTAuNjUyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTwvZz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K) no-repeat center center}';
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
        a.setAttribute("src", "https://www.youtube.com/embed/" + this.id + "?autoplay=1&rel=0&showinfo=0&border=0&wmode=opaque&enablejsapi=1");
        a.setAttribute("allowfullscreen","");
        a.style.width = this.style.width;
        a.style.height = this.style.height;
        this.parentNode.replaceChild(a, this)
    }
};
	
	/* scroll */
	
	$("a[href^='#']").click(function(){
		var _href = $(this).attr("href");
		$("html, body").animate({scrollTop: $(_href).offset().top+"px"});
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
		$(".timer .hours").html( pad(hrs));
		$(".timer .minutes").html( pad(min));
		$(".timer .seconds").html( pad(sec));
		setTimeout( update, 200);
	}
	function pad(s) {
		s = ("00"+s).substr(-2);
		return "<span>" + s[0] + "</span><span>" + s[1] + "</span>";
	}
	update();

	/* sliders */

	$(".owl-carousel").owlCarousel({
		items: 1,
		loop: true,
		smartSpeed: 300,
		mouseDrag: false,
		pullDrag: false,
		dots: false,
		nav: true,
		autoHeight: true,
	});

});
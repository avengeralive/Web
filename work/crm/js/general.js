//важно - поиск
localStorage.removeItem('search');
//alert и confirm
function alert(a){
    $("body").append('<alert id="alert"><div class="alrt"><p>'+a+'</p><button onclick="dellallert()">ОК</button></div></alert>');
}
function dellallert(){
    $('#alert').remove();
}
// function removeInRole() {
// 	
// }
var confirm = function( params ){

    if( typeof(params) == 'string' ) {
        params = {
            text:   params
        }
    }

    var data = $.extend( {}, {
        text:   'Подтвердите выполнение операции',
        ok:     function() {},
        cancel: function() {}
    }, params );

    $("body").append('<confirm><div class="confirm"><p>'+data.text+'</p><a id="dellconfirm">Отмена</a><button id="okconfirm">ОК</button></div></confirm>');
    var b = function(data){
        $("confirm").remove();
        data.ok();
        return true;
    }
    var c = function(data){
        $("confirm").remove();
        data.cancel();
        return true;
    };
    $("#dellconfirm").click( c.bind(this,data) );
    $("#okconfirm").click( b.bind(this,data) );
};

	function playSound(param) {
		window.clearInterval(myVal);
		if (param == 1) {
		
			var faviconIndex = 0;
			var myVal = window.setInterval(function() {
				if (faviconIndex == 0) $("link[rel*='icon']").prop("href", "/cdn/lib/1.png");
				if (faviconIndex == 1) $("link[rel*='icon']").prop("href", "/cdn/lib/0.png");
				faviconIndex++;
				faviconIndex %= 2;
			}, 1000);
			
			var mp3Source = '<source src="/cdn/lib/event.mp3" type="audio/mpeg">';
			var oggSource = '<source src="/cdn/lib/event.ogg" type="audio/ogg">';
			var embedSource = '<embed hidden="true" autostart="true" loop="false" src="/cdn/lib/event.mp3">';
			
			$('audio[autoplay="autoplay"]').remove();
			if (!localStorage.mute) $('body').append('<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>');
			
		} else {
			window.clearInterval(myVal);
			$('audio[autoplay="autoplay"]').remove();
			$("link[rel*='icon']").prop("href", "/cdn/lib/0.png");
		}
	}
		
		
//   var faviconSize = 16;
// 
//   var canvas = document.createElement('canvas');
//   canvas.width = faviconSize;
//   canvas.height = faviconSize;
// 
//   var context = canvas.getContext('2d');
//   var img = document.createElement('img');
//   img.src = $("link[rel*='icon']").prop("href");
// 
// 
//   img.onload = () => {
//       // Draw Original Favicon as Background
//       context.drawImage(img, 0, 0, faviconSize, faviconSize);
// 
//       // Draw Notification Circle
//       context.beginPath();
//       context.arc( canvas.width - faviconSize / 3 , faviconSize / 3, faviconSize / 3, 0, 2*Math.PI);
//       context.fillStyle = '#FF0000';
//       context.fill();
// 
//       // Draw Notification Number
//       context.font = '10px "helvetica", sans-serif';
//       context.textAlign = "center";
//       context.textBaseline = "middle";
//       context.fillStyle = '#FFFFFF';
//       context.fillText(3, canvas.width - faviconSize / 3, faviconSize / 3);
// 
//       // Replace favicon
// 			$("link[rel*='icon']").prop("href", canvas.toDataURL('image/png'));
//     };


      
      
      
      
//используется в lib 
var GLOBAL = {
    current:    {
        list_id: 0,
    },
    cache:  {
        lists: {}
    }  
};
//важно! подгрузка скриптов
function lib(func, obj, context) {
    var co = (context) ? context : this;
    var script = document.createElement('script');
    //исправить в случае переезда папки скриптов на cdn
    script.src = '/js/core/' + func + '.js?v10';

    if (window[func])
        f.call(co, func, obj);
    else {
        head = document.getElementsByTagName('head')[0];
        head.appendChild(script);
        script.onload = f.bind(co, func, obj);
    }

    function f(func, obj) {
        if (window[func]) {
            if (obj) {
                if (typeof(window[func]) == 'function')
                    window[func].call(co, obj);
                else {
                    console.log('Функция обработчика ' + func + ' формат "' + typeof(window[func]) + '" не найдена');
                    console.log(window[func]);
                }

            } else
                window[func].call(co);
        } else
            console.log('Функция обработчика ' + func + ' в файле не найдена, проверьте имя функции в файле');
    };

}
function reload(selector) {
	var json = {};
    json.func = 'CCSS',
    json.action = 'pagecssjs',
	json.selector = selector,
    json.page = JSCat.page,
    $.ajax({
        url: '/json/',
        type: 'GET',
        data: json,
        success: function(result) {console.log(result)}
    });
}
function waitForElement(elementPath, callBack){
  window.setTimeout(function(){
    if($(elementPath).length){
      callBack(elementPath, $(elementPath));
    }else{
      waitForElement(elementPath, callBack);
    }
  },500)
}

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
//разбиваем цену по 000 в формах
function ifregexp() {
	$( '.price[data-view="add"]' ).change(function() {
		var n = $('.price[data-view="add"]').val().replace(/\s/g, '').replace(/(\d)(?=(\d{3})+\b)/g,'$1 ');
		$('.price[data-view="add"]').val(n);
	});
}
//разбиваем цену по 000 в карточках
function ifprices() {
	var prices = $('.price').html().replace(/(<([^>]+)>)/ig,"").replace(/(\d)(?=(\d{3})+\b)/g,'$1 ');
	$('.price').empty().append(prices+'<i></i>');
}
(function(e) {

    function t() {
        var e = document.createElement("input"),
            t = "onpaste";
        return e.setAttribute(t, ""), "function" == typeof e[t] ? "paste" : "input"
    }
    var n, a = t() + ".mask",
        r = navigator.userAgent,
        i = /iphone/i.test(r),
        o = /android/i.test(r);
    e.mask = {
        definitions: {
            9: "[0-9]",
            a: "[A-Za-z]",
            "*": "[A-Za-z0-9]"
        },
        dataName: "rawMaskFn",
        placeholder: "_"
    }, e.fn.extend({
        caret: function(e, t) {
            var n;
            if (0 !== this.length && !this.is(":hidden")) return "number" == typeof e ? (t = "number" == typeof t ? t : e, this.each(function() {
                this.setSelectionRange ? this.setSelectionRange(e, t) : this.createTextRange && (n = this.createTextRange(), n.collapse(!0), n.moveEnd("character", t), n.moveStart("character", e), n.select())
            })) : (this[0].setSelectionRange ? (e = this[0].selectionStart, t = this[0].selectionEnd) : document.selection && document.selection.createRange && (n = document.selection.createRange(), e = 0 - n.duplicate().moveStart("character", -1e5), t = e + n.text.length), {
                begin: e,
                end: t
            })
        },
        unmask: function() {
            return this.trigger("unmask")
        },
        mask: function(t, r) {
            var c, l, s, u, f, h;
            return !t && this.length > 0 ? (c = e(this[0]), c.data(e.mask.dataName)()) : (r = e.extend({
                placeholder: e.mask.placeholder,
                completed: null
            }, r), l = e.mask.definitions, s = [], u = h = t.length, f = null, e.each(t.split(""), function(e, t) {
                "?" == t ? (h--, u = e) : l[t] ? (s.push(RegExp(l[t])), null === f && (f = s.length - 1)) : s.push(null)
            }), this.trigger("unmask").each(function() {
                function c(e) {
                    for (; h > ++e && !s[e];);
                    return e
                }

                function d(e) {
                    for (; --e >= 0 && !s[e];);
                    return e
                }

                function m(e, t) {
                    var n, a;
                    if (!(0 > e)) {
                        for (n = e, a = c(t); h > n; n++)
                            if (s[n]) {
                                if (!(h > a && s[n].test(R[a]))) break;
                                R[n] = R[a], R[a] = r.placeholder, a = c(a)
                            }
                        b(), x.caret(Math.max(f, e))
                    }
                }

                function p(e) {
                    var t, n, a, i;
                    for (t = e, n = r.placeholder; h > t; t++)
                        if (s[t]) {
                            if (a = c(t), i = R[t], R[t] = n, !(h > a && s[a].test(i))) break;
                            n = i
                        }
                }

                function g(e) {
                    var t, n, a, r = e.which;
                    8 === r || 46 === r || i && 127 === r ? (t = x.caret(), n = t.begin, a = t.end, 0 === a - n && (n = 46 !== r ? d(n) : a = c(n - 1), a = 46 === r ? c(a) : a), k(n, a), m(n, a - 1), e.preventDefault()) : 27 == r && (x.val(S), x.caret(0, y()), e.preventDefault())
                }

                function v(t) {
                    var n, a, i, l = t.which,
                        u = x.caret();
                    t.ctrlKey || t.altKey || t.metaKey || 32 > l || l && (0 !== u.end - u.begin && (k(u.begin, u.end), m(u.begin, u.end - 1)), n = c(u.begin - 1), h > n && (a = String.fromCharCode(l), s[n].test(a) && (p(n), R[n] = a, b(), i = c(n), o ? setTimeout(e.proxy(e.fn.caret, x, i), 0) : x.caret(i), r.completed && i >= h && r.completed.call(x))), t.preventDefault())
                }

                function k(e, t) {
                    var n;
                    for (n = e; t > n && h > n; n++) s[n] && (R[n] = r.placeholder)
                }

                function b() {
                    x.val(R.join(""))
                }

                function y(e) {
                    var t, n, a = x.val(),
                        i = -1;
                    for (t = 0, pos = 0; h > t; t++)
                        if (s[t]) {
                            for (R[t] = r.placeholder; pos++ < a.length;)
                                if (n = a.charAt(pos - 1), s[t].test(n)) {
                                    R[t] = n, i = t;
                                    break
                                }
                            if (pos > a.length) break
                        } else R[t] === a.charAt(pos) && t !== u && (pos++, i = t);
                    return e ? b() : u > i + 1 ? (x.val(""), k(0, h)) : (b(), x.val(x.val().substring(0, i + 1))), u ? t : f
                }
                var x = e(this),
                    R = e.map(t.split(""), function(e) {
                        return "?" != e ? l[e] ? r.placeholder : e : void 0
                    }),
                    S = x.val();
                x.data(e.mask.dataName, function() {
                    return e.map(R, function(e, t) {
                        return s[t] && e != r.placeholder ? e : null
                    }).join("")
                }), x.attr("readonly") || x.one("unmask", function() {
                    x.unbind(".mask").removeData(e.mask.dataName)
                }).bind("focus.mask", function() {
                    clearTimeout(n);
                    var e;
                    S = x.val(), e = y(), n = setTimeout(function() {
                        b(), e == t.length ? x.caret(0, e) : x.caret(e)
                    }, 10)
                }).bind("blur.mask", function() {
                    y(), x.val() != S && x.change()
                }).bind("keydown.mask", g).bind("keypress.mask", v).bind(a, function() {
                    setTimeout(function() {
                        var e = y(!0);
                        x.caret(e), r.completed && e == x.val().length && r.completed.call(x)
                    }, 0)
                }), y()
            }))
        }
    });

})(jQuery);


const maxInt=2147483647,base=36,tMin=1,tMax=26,skew=38,damp=700,initialBias=72,initialN=128,delimiter="-",regexPunycode=/^xn--/,regexNonASCII=/[^\0-\x7E]/,regexSeparators=/[\x2E\u3002\uFF0E\uFF61]/g,errors={overflow:"Overflow: input needs wider integers to process","not-basic":"Illegal input >= 0x80 (not a basic code point)","invalid-input":"Invalid input"},baseMinusTMin=35,floor=Math.floor,stringFromCharCode=String.fromCharCode;function error(o){throw new RangeError(errors[o])}function map(o,e){const r=[];let t=o.length;for(;t--;)r[t]=e(o[t]);return r}function mapDomain(o,e){const r=o.split("@");let t="";return r.length>1&&(t=r[0]+"@",o=r[1]),t+map((o=o.replace(regexSeparators,".")).split("."),e).join(".")}function ucs2decode(o){const e=[];let r=0;const t=o.length;for(;r<t;){const n=o.charCodeAt(r++);if(n>=55296&&n<=56319&&r<t){const t=o.charCodeAt(r++);56320==(64512&t)?e.push(((1023&n)<<10)+(1023&t)+65536):(e.push(n),r--)}else e.push(n)}return e}const ucs2encode=o=>String.fromCodePoint(...o),basicToDigit=function(o){return o-48<10?o-22:o-65<26?o-65:o-97<26?o-97:36},digitToBasic=function(o,e){return o+22+75*(o<26)-((0!=e)<<5)},adapt=function(o,e,r){let t=0;for(o=r?floor(o/700):o>>1,o+=floor(o/e);o>455;t+=36)o=floor(o/35);return floor(t+36*o/(o+38))},decode=function(o){const e=[],r=o.length;let t=0,n=128,i=72,c=o.lastIndexOf("-");c<0&&(c=0);for(let r=0;r<c;++r)o.charCodeAt(r)>=128&&error("not-basic"),e.push(o.charCodeAt(r));for(let a=c>0?c+1:0;a<r;){let c=t;for(let e=1,n=36;;n+=36){a>=r&&error("invalid-input");const c=(s=o.charCodeAt(a++))-48<10?s-22:s-65<26?s-65:s-97<26?s-97:36;(c>=36||c>floor((maxInt-t)/e))&&error("overflow"),t+=c*e;const d=n<=i?1:n>=i+26?26:n-i;if(c<d)break;const l=36-d;e>floor(maxInt/l)&&error("overflow"),e*=l}const d=e.length+1;i=adapt(t-c,d,0==c),floor(t/d)>maxInt-n&&error("overflow"),n+=floor(t/d),t%=d,e.splice(t++,0,n)}var s;return String.fromCodePoint(...e)},encode=function(o){const e=[];let r=(o=ucs2decode(o)).length,t=128,n=0,i=72;for(const r of o)r<128&&e.push(stringFromCharCode(r));let c=e.length,s=c;for(c&&e.push("-");s<r;){let r=maxInt;for(const e of o)e>=t&&e<r&&(r=e);const a=s+1;r-t>floor((maxInt-n)/a)&&error("overflow"),n+=(r-t)*a,t=r;for(const r of o)if(r<t&&++n>maxInt&&error("overflow"),r==t){let o=n;for(let r=36;;r+=36){const t=r<=i?1:r>=i+26?26:r-i;if(o<t)break;const n=o-t,c=36-t;e.push(stringFromCharCode(digitToBasic(t+n%c,0))),o=floor(n/c)}e.push(stringFromCharCode(digitToBasic(o,0))),i=adapt(n,a,s==c),n=0,++s}++n,++t}return e.join("")},toUnicode=function(o){return mapDomain(o,function(o){return regexPunycode.test(o)?decode(o.slice(4).toLowerCase()):o})},toASCII=function(o){return mapDomain(o,function(o){return regexNonASCII.test(o)?"xn--"+encode(o):o})},punycode={version:"2.1.0",ucs2:{decode:ucs2decode,encode:ucs2encode},decode:decode,encode:encode,toASCII:toASCII,toUnicode:toUnicode};
//module.exports=punycode;

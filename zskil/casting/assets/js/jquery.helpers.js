
/* JQUERY COOKIE */
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1;}
var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}
expires='; expires='+date.toUTCString();}
var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}
return cookieValue;}};

/* JQUERY HOTKEYS */
var specialKeys = {8:"backspace",9:"tab",13:"return",16:"shift",17:"ctrl",18:"alt",19:"pause",20:"capslock",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"del",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9",106:"*",107:"+",109:"-",110:".",111:"/",112:"f1",113:"f2",114:"f3",115:"f4",116:"f5",117:"f6",118:"f7",119:"f8",120:"f9",121:"f10",122:"f11",123:"f12",144:"numlock",145:"scroll",191:"/",224:"meta"};
(function(jQuery){jQuery.hotkeys={version:"0.8",specialKeys:{8:"backspace",9:"tab",13:"return",16:"shift",17:"ctrl",18:"alt",19:"pause",20:"capslock",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"del",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9",106:"*",107:"+",109:"-",110:".",111:"/",112:"f1",113:"f2",114:"f3",115:"f4",116:"f5",117:"f6",118:"f7",119:"f8",120:"f9",121:"f10",122:"f11",123:"f12",144:"numlock",145:"scroll",191:"/",224:"meta"},shiftNums:{"`":"~","1":"!","2":"@","3":"#","4":"$","5":"%","6":"^","7":"&","8":"*","9":"(","0":")","-":"_","=":"+",";":": ","'":"\"",",":"<",".":">","/":"?","\\":"|"}};function keyHandler(handleObj){if(typeof handleObj.data!=="string"){return;}
var origHandler=handleObj.handler,keys=handleObj.data.toLowerCase().split(" ");handleObj.handler=function(event){if(this!==event.target&&(/textarea|select/i.test(event.target.nodeName)||event.target.type==="text")){return;}
var special=event.type!=="keypress"&&jQuery.hotkeys.specialKeys[event.which],character=String.fromCharCode(event.which).toLowerCase(),key,modif="",possible={};if(event.altKey&&special!=="alt"){modif+="alt+";}
if(event.ctrlKey&&special!=="ctrl"){modif+="ctrl+";}
if(event.metaKey&&!event.ctrlKey&&special!=="meta"){modif+="meta+";}
if(event.shiftKey&&special!=="shift"){modif+="shift+";}
if(special){possible[modif+special]=true;}else{possible[modif+character]=true;possible[modif+jQuery.hotkeys.shiftNums[character]]=true;if(modif==="shift+"){possible[jQuery.hotkeys.shiftNums[character]]=true;}}
for(var i=0,l=keys.length;i<l;i++){if(possible[keys[i]]){return origHandler.apply(this,arguments);}}};}
jQuery.each(["keydown","keyup","keypress"],function(){jQuery.event.special[this]={add:keyHandler};});})(jQuery);
/*Browser detection patch*/
jQuery.browser = {};
jQuery.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.opera=/opera/.test(navigator.userAgent.toLowerCase());
jQuery.browser.msie=/msie/.test(navigator.userAgent.toLowerCase());

/* JQUERY MASK */
// jQuery Mask Plugin v1.14.12
// github.com/igorescobar/jQuery-Mask-Plugin
var $jscomp={scope:{},findInternal:function(a,l,d){a instanceof String&&(a=String(a));for(var p=a.length,h=0;h<p;h++){var b=a[h];if(l.call(d,b,h,a))return{i:h,v:b}}return{i:-1,v:void 0}}};$jscomp.defineProperty="function"==typeof Object.defineProperties?Object.defineProperty:function(a,l,d){if(d.get||d.set)throw new TypeError("ES3 does not support getters and setters.");a!=Array.prototype&&a!=Object.prototype&&(a[l]=d.value)};
$jscomp.getGlobal=function(a){return"undefined"!=typeof window&&window===a?a:"undefined"!=typeof global&&null!=global?global:a};$jscomp.global=$jscomp.getGlobal(this);$jscomp.polyfill=function(a,l,d,p){if(l){d=$jscomp.global;a=a.split(".");for(p=0;p<a.length-1;p++){var h=a[p];h in d||(d[h]={});d=d[h]}a=a[a.length-1];p=d[a];l=l(p);l!=p&&null!=l&&$jscomp.defineProperty(d,a,{configurable:!0,writable:!0,value:l})}};
$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(a,d){return $jscomp.findInternal(this,a,d).v}},"es6-impl","es3");
(function(a,l,d){"function"===typeof define&&define.amd?define(["jquery"],a):"object"===typeof exports?module.exports=a(require("jquery")):a(l||d)})(function(a){var l=function(b,e,f){var c={invalid:[],getCaret:function(){try{var a,r=0,g=b.get(0),e=document.selection,f=g.selectionStart;if(e&&-1===navigator.appVersion.indexOf("MSIE 10"))a=e.createRange(),a.moveStart("character",-c.val().length),r=a.text.length;else if(f||"0"===f)r=f;return r}catch(C){}},setCaret:function(a){try{if(b.is(":focus")){var c,
g=b.get(0);g.setSelectionRange?g.setSelectionRange(a,a):(c=g.createTextRange(),c.collapse(!0),c.moveEnd("character",a),c.moveStart("character",a),c.select())}}catch(B){}},events:function(){b.on("keydown.mask",function(a){b.data("mask-keycode",a.keyCode||a.which);b.data("mask-previus-value",b.val());b.data("mask-previus-caret-pos",c.getCaret());c.maskDigitPosMapOld=c.maskDigitPosMap}).on(a.jMaskGlobals.useInput?"input.mask":"keyup.mask",c.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){b.keydown().keyup()},
100)}).on("change.mask",function(){b.data("changed",!0)}).on("blur.mask",function(){d===c.val()||b.data("changed")||b.trigger("change");b.data("changed",!1)}).on("blur.mask",function(){d=c.val()}).on("focus.mask",function(b){!0===f.selectOnFocus&&a(b.target).select()}).on("focusout.mask",function(){f.clearIfNotMatch&&!h.test(c.val())&&c.val("")})},getRegexMask:function(){for(var a=[],b,c,f,n,d=0;d<e.length;d++)(b=m.translation[e.charAt(d)])?(c=b.pattern.toString().replace(/.{1}$|^.{1}/g,""),f=b.optional,
(b=b.recursive)?(a.push(e.charAt(d)),n={digit:e.charAt(d),pattern:c}):a.push(f||b?c+"?":c)):a.push(e.charAt(d).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));a=a.join("");n&&(a=a.replace(new RegExp("("+n.digit+"(.*"+n.digit+")?)"),"($1)?").replace(new RegExp(n.digit,"g"),n.pattern));return new RegExp(a)},destroyEvents:function(){b.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(a){var c=b.is("input")?"val":"text";if(0<arguments.length){if(b[c]()!==a)b[c](a);
c=b}else c=b[c]();return c},calculateCaretPosition:function(){var a=b.data("mask-previus-value")||"",e=c.getMasked(),g=c.getCaret();if(a!==e){var f=b.data("mask-previus-caret-pos")||0,e=e.length,d=a.length,m=a=0,h=0,l=0,k;for(k=g;k<e&&c.maskDigitPosMap[k];k++)m++;for(k=g-1;0<=k&&c.maskDigitPosMap[k];k--)a++;for(k=g-1;0<=k;k--)c.maskDigitPosMap[k]&&h++;for(k=f-1;0<=k;k--)c.maskDigitPosMapOld[k]&&l++;g>d?g=10*e:f>=g&&f!==d?c.maskDigitPosMapOld[g]||(f=g,g=g-(l-h)-a,c.maskDigitPosMap[g]&&(g=f)):g>f&&
(g=g+(h-l)+m)}return g},behaviour:function(f){f=f||window.event;c.invalid=[];var e=b.data("mask-keycode");if(-1===a.inArray(e,m.byPassKeys)){var e=c.getMasked(),g=c.getCaret();setTimeout(function(){c.setCaret(c.calculateCaretPosition())},10);c.val(e);c.setCaret(g);return c.callbacks(f)}},getMasked:function(a,b){var g=[],d=void 0===b?c.val():b+"",n=0,h=e.length,q=0,l=d.length,k=1,r="push",p=-1,t=0,y=[],v,z;f.reverse?(r="unshift",k=-1,v=0,n=h-1,q=l-1,z=function(){return-1<n&&-1<q}):(v=h-1,z=function(){return n<
h&&q<l});for(var A;z();){var x=e.charAt(n),w=d.charAt(q),u=m.translation[x];if(u)w.match(u.pattern)?(g[r](w),u.recursive&&(-1===p?p=n:n===v&&(n=p-k),v===p&&(n-=k)),n+=k):w===A?(t--,A=void 0):u.optional?(n+=k,q-=k):u.fallback?(g[r](u.fallback),n+=k,q-=k):c.invalid.push({p:q,v:w,e:u.pattern}),q+=k;else{if(!a)g[r](x);w===x?(y.push(q),q+=k):(A=x,y.push(q+t),t++);n+=k}}d=e.charAt(v);h!==l+1||m.translation[d]||g.push(d);g=g.join("");c.mapMaskdigitPositions(g,y,l);return g},mapMaskdigitPositions:function(a,
b,e){a=f.reverse?a.length-e:0;c.maskDigitPosMap={};for(e=0;e<b.length;e++)c.maskDigitPosMap[b[e]+a]=1},callbacks:function(a){var h=c.val(),g=h!==d,m=[h,a,b,f],q=function(a,b,c){"function"===typeof f[a]&&b&&f[a].apply(this,c)};q("onChange",!0===g,m);q("onKeyPress",!0===g,m);q("onComplete",h.length===e.length,m);q("onInvalid",0<c.invalid.length,[h,a,b,c.invalid,f])}};b=a(b);var m=this,d=c.val(),h;e="function"===typeof e?e(c.val(),void 0,b,f):e;m.mask=e;m.options=f;m.remove=function(){var a=c.getCaret();
c.destroyEvents();c.val(m.getCleanVal());c.setCaret(a);return b};m.getCleanVal=function(){return c.getMasked(!0)};m.getMaskedVal=function(a){return c.getMasked(!1,a)};m.init=function(d){d=d||!1;f=f||{};m.clearIfNotMatch=a.jMaskGlobals.clearIfNotMatch;m.byPassKeys=a.jMaskGlobals.byPassKeys;m.translation=a.extend({},a.jMaskGlobals.translation,f.translation);m=a.extend(!0,{},m,f);h=c.getRegexMask();if(d)c.events(),c.val(c.getMasked());else{f.placeholder&&b.attr("placeholder",f.placeholder);b.data("mask")&&
b.attr("autocomplete","off");d=0;for(var l=!0;d<e.length;d++){var g=m.translation[e.charAt(d)];if(g&&g.recursive){l=!1;break}}l&&b.attr("maxlength",e.length);c.destroyEvents();c.events();d=c.getCaret();c.val(c.getMasked());c.setCaret(d)}};m.init(!b.is("input"))};a.maskWatchers={};var d=function(){var b=a(this),e={},f=b.attr("data-mask");b.attr("data-mask-reverse")&&(e.reverse=!0);b.attr("data-mask-clearifnotmatch")&&(e.clearIfNotMatch=!0);"true"===b.attr("data-mask-selectonfocus")&&(e.selectOnFocus=
!0);if(p(b,f,e))return b.data("mask",new l(this,f,e))},p=function(b,e,f){f=f||{};var c=a(b).data("mask"),d=JSON.stringify;b=a(b).val()||a(b).text();try{return"function"===typeof e&&(e=e(b)),"object"!==typeof c||d(c.options)!==d(f)||c.mask!==e}catch(t){}},h=function(a){var b=document.createElement("div"),d;a="on"+a;d=a in b;d||(b.setAttribute(a,"return;"),d="function"===typeof b[a]);return d};a.fn.mask=function(b,d){d=d||{};var e=this.selector,c=a.jMaskGlobals,h=c.watchInterval,c=d.watchInputs||c.watchInputs,
t=function(){if(p(this,b,d))return a(this).data("mask",new l(this,b,d))};a(this).each(t);e&&""!==e&&c&&(clearInterval(a.maskWatchers[e]),a.maskWatchers[e]=setInterval(function(){a(document).find(e).each(t)},h));return this};a.fn.masked=function(a){return this.data("mask").getMaskedVal(a)};a.fn.unmask=function(){clearInterval(a.maskWatchers[this.selector]);delete a.maskWatchers[this.selector];return this.each(function(){var b=a(this).data("mask");b&&b.remove().removeData("mask")})};a.fn.cleanVal=function(){return this.data("mask").getCleanVal()};
a.applyDataMask=function(b){b=b||a.jMaskGlobals.maskElements;(b instanceof a?b:a(b)).filter(a.jMaskGlobals.dataMaskAttr).each(d)};h={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&h("input"),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},
S:{pattern:/[a-zA-Z]/}}};a.jMaskGlobals=a.jMaskGlobals||{};h=a.jMaskGlobals=a.extend(!0,{},h,a.jMaskGlobals);h.dataMask&&a.applyDataMask();setInterval(function(){a.jMaskGlobals.watchDataMask&&a.applyDataMask()},h.watchInterval)},window.jQuery,window.Zepto);



/*! jQuery JSON plugin 2.4.0 | code.google.com/p/jquery-json */
(function($){'use strict';var escape=/["\\\x00-\x1f\x7f-\x9f]/g,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},hasOwn=Object.prototype.hasOwnProperty;$.toJSON=typeof JSON==='object'&&JSON.stringify?JSON.stringify:function(o){if(o===null){return'null';}
var pairs,k,name,val,type=$.type(o);if(type==='undefined'){return undefined;}
if(type==='number'||type==='boolean'){return String(o);}
if(type==='string'){return $.quoteString(o);}
if(typeof o.toJSON==='function'){return $.toJSON(o.toJSON());}
if(type==='date'){var month=o.getUTCMonth()+1,day=o.getUTCDate(),year=o.getUTCFullYear(),hours=o.getUTCHours(),minutes=o.getUTCMinutes(),seconds=o.getUTCSeconds(),milli=o.getUTCMilliseconds();if(month<10){month='0'+month;}
if(day<10){day='0'+day;}
if(hours<10){hours='0'+hours;}
if(minutes<10){minutes='0'+minutes;}
if(seconds<10){seconds='0'+seconds;}
if(milli<100){milli='0'+milli;}
if(milli<10){milli='0'+milli;}
return'"'+year+'-'+month+'-'+day+'T'+
hours+':'+minutes+':'+seconds+'.'+milli+'Z"';}
pairs=[];if($.isArray(o)){for(k=0;k<o.length;k++){pairs.push($.toJSON(o[k])||'null');}
return'['+pairs.join(',')+']';}
if(typeof o==='object'){for(k in o){if(hasOwn.call(o,k)){type=typeof k;if(type==='number'){name='"'+k+'"';}else if(type==='string'){name=$.quoteString(k);}else{continue;}
type=typeof o[k];if(type!=='function'&&type!=='undefined'){val=$.toJSON(o[k]);pairs.push(name+':'+val);}}}
return'{'+pairs.join(',')+'}';}};$.evalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){return eval('('+str+')');};$.secureEvalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){var filtered=str.replace(/\\["\\\/bfnrtu]/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,'');if(/^[\],:{}\s]*$/.test(filtered)){return eval('('+str+')');}
throw new SyntaxError('Error parsing JSON, source is not valid.');};$.quoteString=function(str){if(str.match(escape)){return'"'+str.replace(escape,function(a){var c=meta[a];if(typeof c==='string'){return c;}
c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16);})+'"';}
return'"'+str+'"';};}(jQuery));

/*!
 * clipboard.js v1.7.1
 * https://zenorocha.github.io/clipboard.js
 *
 * Licensed MIT © Zeno Rocha
 */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.Clipboard=t()}}(function(){var t,e,n;return function t(e,n,o){function i(a,c){if(!n[a]){if(!e[a]){var l="function"==typeof require&&require;if(!c&&l)return l(a,!0);if(r)return r(a,!0);var s=new Error("Cannot find module '"+a+"'");throw s.code="MODULE_NOT_FOUND",s}var u=n[a]={exports:{}};e[a][0].call(u.exports,function(t){var n=e[a][1][t];return i(n||t)},u,u.exports,t,e,n,o)}return n[a].exports}for(var r="function"==typeof require&&require,a=0;a<o.length;a++)i(o[a]);return i}({1:[function(t,e,n){function o(t,e){for(;t&&t.nodeType!==i;){if("function"==typeof t.matches&&t.matches(e))return t;t=t.parentNode}}var i=9;if("undefined"!=typeof Element&&!Element.prototype.matches){var r=Element.prototype;r.matches=r.matchesSelector||r.mozMatchesSelector||r.msMatchesSelector||r.oMatchesSelector||r.webkitMatchesSelector}e.exports=o},{}],2:[function(t,e,n){function o(t,e,n,o,r){var a=i.apply(this,arguments);return t.addEventListener(n,a,r),{destroy:function(){t.removeEventListener(n,a,r)}}}function i(t,e,n,o){return function(n){n.delegateTarget=r(n.target,e),n.delegateTarget&&o.call(t,n)}}var r=t("./closest");e.exports=o},{"./closest":1}],3:[function(t,e,n){n.node=function(t){return void 0!==t&&t instanceof HTMLElement&&1===t.nodeType},n.nodeList=function(t){var e=Object.prototype.toString.call(t);return void 0!==t&&("[object NodeList]"===e||"[object HTMLCollection]"===e)&&"length"in t&&(0===t.length||n.node(t[0]))},n.string=function(t){return"string"==typeof t||t instanceof String},n.fn=function(t){return"[object Function]"===Object.prototype.toString.call(t)}},{}],4:[function(t,e,n){function o(t,e,n){if(!t&&!e&&!n)throw new Error("Missing required arguments");if(!c.string(e))throw new TypeError("Second argument must be a String");if(!c.fn(n))throw new TypeError("Third argument must be a Function");if(c.node(t))return i(t,e,n);if(c.nodeList(t))return r(t,e,n);if(c.string(t))return a(t,e,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function i(t,e,n){return t.addEventListener(e,n),{destroy:function(){t.removeEventListener(e,n)}}}function r(t,e,n){return Array.prototype.forEach.call(t,function(t){t.addEventListener(e,n)}),{destroy:function(){Array.prototype.forEach.call(t,function(t){t.removeEventListener(e,n)})}}}function a(t,e,n){return l(document.body,t,e,n)}var c=t("./is"),l=t("delegate");e.exports=o},{"./is":3,delegate:2}],5:[function(t,e,n){function o(t){var e;if("SELECT"===t.nodeName)t.focus(),e=t.value;else if("INPUT"===t.nodeName||"TEXTAREA"===t.nodeName){var n=t.hasAttribute("readonly");n||t.setAttribute("readonly",""),t.select(),t.setSelectionRange(0,t.value.length),n||t.removeAttribute("readonly"),e=t.value}else{t.hasAttribute("contenteditable")&&t.focus();var o=window.getSelection(),i=document.createRange();i.selectNodeContents(t),o.removeAllRanges(),o.addRange(i),e=o.toString()}return e}e.exports=o},{}],6:[function(t,e,n){function o(){}o.prototype={on:function(t,e,n){var o=this.e||(this.e={});return(o[t]||(o[t]=[])).push({fn:e,ctx:n}),this},once:function(t,e,n){function o(){i.off(t,o),e.apply(n,arguments)}var i=this;return o._=e,this.on(t,o,n)},emit:function(t){var e=[].slice.call(arguments,1),n=((this.e||(this.e={}))[t]||[]).slice(),o=0,i=n.length;for(o;o<i;o++)n[o].fn.apply(n[o].ctx,e);return this},off:function(t,e){var n=this.e||(this.e={}),o=n[t],i=[];if(o&&e)for(var r=0,a=o.length;r<a;r++)o[r].fn!==e&&o[r].fn._!==e&&i.push(o[r]);return i.length?n[t]=i:delete n[t],this}},e.exports=o},{}],7:[function(e,n,o){!function(i,r){if("function"==typeof t&&t.amd)t(["module","select"],r);else if(void 0!==o)r(n,e("select"));else{var a={exports:{}};r(a,i.select),i.clipboardAction=a.exports}}(this,function(t,e){"use strict";function n(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var i=n(e),r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},a=function(){function t(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}return function(e,n,o){return n&&t(e.prototype,n),o&&t(e,o),e}}(),c=function(){function t(e){o(this,t),this.resolveOptions(e),this.initSelection()}return a(t,[{key:"resolveOptions",value:function t(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.action=e.action,this.container=e.container,this.emitter=e.emitter,this.target=e.target,this.text=e.text,this.trigger=e.trigger,this.selectedText=""}},{key:"initSelection",value:function t(){this.text?this.selectFake():this.target&&this.selectTarget()}},{key:"selectFake",value:function t(){var e=this,n="rtl"==document.documentElement.getAttribute("dir");this.removeFake(),this.fakeHandlerCallback=function(){return e.removeFake()},this.fakeHandler=this.container.addEventListener("click",this.fakeHandlerCallback)||!0,this.fakeElem=document.createElement("textarea"),this.fakeElem.style.fontSize="12pt",this.fakeElem.style.border="0",this.fakeElem.style.padding="0",this.fakeElem.style.margin="0",this.fakeElem.style.position="absolute",this.fakeElem.style[n?"right":"left"]="-9999px";var o=window.pageYOffset||document.documentElement.scrollTop;this.fakeElem.style.top=o+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,this.container.appendChild(this.fakeElem),this.selectedText=(0,i.default)(this.fakeElem),this.copyText()}},{key:"removeFake",value:function t(){this.fakeHandler&&(this.container.removeEventListener("click",this.fakeHandlerCallback),this.fakeHandler=null,this.fakeHandlerCallback=null),this.fakeElem&&(this.container.removeChild(this.fakeElem),this.fakeElem=null)}},{key:"selectTarget",value:function t(){this.selectedText=(0,i.default)(this.target),this.copyText()}},{key:"copyText",value:function t(){var e=void 0;try{e=document.execCommand(this.action)}catch(t){e=!1}this.handleResult(e)}},{key:"handleResult",value:function t(e){this.emitter.emit(e?"success":"error",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})}},{key:"clearSelection",value:function t(){this.trigger&&this.trigger.focus(),window.getSelection().removeAllRanges()}},{key:"destroy",value:function t(){this.removeFake()}},{key:"action",set:function t(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"copy";if(this._action=e,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function t(){return this._action}},{key:"target",set:function t(e){if(void 0!==e){if(!e||"object"!==(void 0===e?"undefined":r(e))||1!==e.nodeType)throw new Error('Invalid "target" value, use a valid Element');if("copy"===this.action&&e.hasAttribute("disabled"))throw new Error('Invalid "target" attribute. Please use "readonly" instead of "disabled" attribute');if("cut"===this.action&&(e.hasAttribute("readonly")||e.hasAttribute("disabled")))throw new Error('Invalid "target" attribute. You can\'t cut text from elements with "readonly" or "disabled" attributes');this._target=e}},get:function t(){return this._target}}]),t}();t.exports=c})},{select:5}],8:[function(e,n,o){!function(i,r){if("function"==typeof t&&t.amd)t(["module","./clipboard-action","tiny-emitter","good-listener"],r);else if(void 0!==o)r(n,e("./clipboard-action"),e("tiny-emitter"),e("good-listener"));else{var a={exports:{}};r(a,i.clipboardAction,i.tinyEmitter,i.goodListener),i.clipboard=a.exports}}(this,function(t,e,n,o){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function a(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function c(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function l(t,e){var n="data-clipboard-"+t;if(e.hasAttribute(n))return e.getAttribute(n)}var s=i(e),u=i(n),f=i(o),d="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},h=function(){function t(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}return function(e,n,o){return n&&t(e.prototype,n),o&&t(e,o),e}}(),p=function(t){function e(t,n){r(this,e);var o=a(this,(e.__proto__||Object.getPrototypeOf(e)).call(this));return o.resolveOptions(n),o.listenClick(t),o}return c(e,t),h(e,[{key:"resolveOptions",value:function t(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.action="function"==typeof e.action?e.action:this.defaultAction,this.target="function"==typeof e.target?e.target:this.defaultTarget,this.text="function"==typeof e.text?e.text:this.defaultText,this.container="object"===d(e.container)?e.container:document.body}},{key:"listenClick",value:function t(e){var n=this;this.listener=(0,f.default)(e,"click",function(t){return n.onClick(t)})}},{key:"onClick",value:function t(e){var n=e.delegateTarget||e.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new s.default({action:this.action(n),target:this.target(n),text:this.text(n),container:this.container,trigger:n,emitter:this})}},{key:"defaultAction",value:function t(e){return l("action",e)}},{key:"defaultTarget",value:function t(e){var n=l("target",e);if(n)return document.querySelector(n)}},{key:"defaultText",value:function t(e){return l("text",e)}},{key:"destroy",value:function t(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)}}],[{key:"isSupported",value:function t(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:["copy","cut"],n="string"==typeof e?[e]:e,o=!!document.queryCommandSupported;return n.forEach(function(t){o=o&&!!document.queryCommandSupported(t)}),o}}]),e}(u.default);t.exports=p})},{"./clipboard-action":7,"good-listener":4,"tiny-emitter":6}]},{},[8])(8)});

function extend( standart, params )	{

	if( typeof(params) == 'undefined' )
	var params = {};

	var settings = {};

	for( var index in standart )
		if( typeof(params[index]) == 'undefined' )
			if( typeof(standart[index]) == 'object' && standart[index] != null )
				settings[ index ] = extend( standart[index] );
			else
				settings[ index ] = standart[ index ];
		else
			if( typeof(params[index]) == 'object' && params[index] != null )
				settings[ index ] = extend( params[index] );
			else
				settings[ index ] = params[ index ];

	for( index in params )
	if( typeof(standart[index]) == 'undefined' )
	settings[ index ] = params[ index ];

	return settings;
}

/* jQuery jqEasySuggest plugin
 * Examples and documentation at: http://www.jqeasy.com/
 * Version: 1.0 (24/11/2011)
 */
	$.fn.extend({
		jqEasySuggest: function(options){
			var settings = {
				ajax_file_path:			"",
				min_keyword_length:		2,
				showLoadingImage:		false,
				focus_color:			"",
				keyupDelay:				300,
				id_element:				"",
				sql_match_type:			"starts",
				es_width:				"auto",
				es_opacity:				0.95,
				es_max_results:			10,
				es_offset_left:			0,
				es_offset_top:			1,
				es_absolute:			true,

				get_data_func:			null,
				gdata_callbackable:		false,

				show_all_ondblclick:	false,
				pointer:				null,
				onselect:				null,
				renderer:				null
			};

			return this.each(function(){
				var $this = $(this);

				var typingTimer;
				var tmp_id = Math.floor(Math.random()*100);

				// merge options with default settings
                if ( options ) {
					$.extend( settings, options );
				}

				settings . pointer = $( this );

				if( typeof(settings.get_data_func)=='undefined' || settings.get_data_func == null )
				settings.get_data_func = _getData;

				//var offset = $this.offset();

				var offset = $( this ).position();
				var current_border_width = $this.css("border-left-width");
				var current_border_style = $this.css("border-left-style");
				var current_border_color = $this.css("border-left-color");

				// set focus border style if defined
				if(settings.focus_color != ''){
					$this.focus(function() {
						$this.css("border",current_border_width + " " + current_border_style + " " + settings.focus_color);
					});
					$this.blur(function() {
						$this.css('border',current_border_width + " " + current_border_style + " " + current_border_color);
					});
				}

				if( settings.show_all_ondblclick )
				$this.dblclick(function(){ getData(''); });

				$this.keydown(function(event) {
					var keyword = $this.val();
					switch(event.keyCode) {
						case 40: // down arrow
							if(!$("#easy_suggest_"+tmp_id).length && ($.trim(keyword).length >= settings.min_keyword_length)){
								getData(keyword);
							}
							found = false;
							$("#easy_list_"+tmp_id+" li").each(function(){
								if ($(this).hasClass('selected'))
									found = true;
							});
							if(found) {
								var sel = $("#easy_list_"+tmp_id+" li[class='selected']");
								// if this is last element then add selected class to first element
								if(sel.next().text() == "")
									$("#easy_list_"+tmp_id+" li:first").addClass("selected");
								else
									sel.next().addClass("selected");
									sel.removeClass("selected");
							}
							else
								$("#easy_list_"+tmp_id+" li:first").addClass("selected");
							break;
						case 38: // up arrow
							found = false;
							$("#easy_list_"+tmp_id+" li").each(function(){
								if ($(this).hasClass('selected'))
									found = true;
							});
							if(found) {
								var sel = $("#easy_list_"+tmp_id+" li[class='selected']");
								// if this is first element then add selected class to last element
								if(sel.prev().text() == "")
									$("#easy_list_"+tmp_id+" li:last").addClass("selected");
								else
									sel.prev().addClass("selected");
									sel.removeClass("selected");
							}
							else
								$("#easy_list_"+tmp_id+" li:last").addClass("selected");
							break;
						case 13: // enter key
							var href = $("#easy_list_"+tmp_id+" li[class='selected']");
							str = $( href ).text();

							if(str.length){
								$this.val(str);
								// store id of the selected option
								if(settings.id_element != "" && settings.id_element != null){
									$("#"+settings.id_element).val($("#easy_list_"+tmp_id+" li[class='selected'] a").attr("id"));
								}
							} else if(keyword == ''){
								if(settings.id_element != "" && settings.id_element != null){
									$("#"+settings.id_element).val('');
								}
							}
							$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
								$(this).remove();
							});
							event.preventDefault();
							if( settings.onselect != null )
							settings.onselect( href );
							break;
						case 9: // tab key sets input values
							str = $("#easy_list_"+tmp_id+" li[class='selected']").text();
							if(str.length){
								$this.val(str);
								// store id of the selected option
								if(settings.id_element != "" && settings.id_element != null){
									$("#"+settings.id_element).val($("#easy_list_"+tmp_id+" li[class='selected'] a").attr("id"));
								}
								event.preventDefault();
								$this.focus();
							} else if(keyword == ''){
								if(settings.id_element != "" && settings.id_element != null){
									$("#"+settings.id_element).val('');
								}
							}
							$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
								$(this).remove();
							});
					}
				}).keyup(function(event){
					var keyword = $this.val();

					if($.trim(keyword).length >= settings.min_keyword_length){
						switch(event.keyCode) {
							case 40: case 38: case 13: case 9: // down arrow: up arrow: return/enter: tab:
								event.preventDefault();
								break;
							case 27: // esc key hides the list
								$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
									$(this).remove();
								});
								break;
							default:
								// show the loading image
								if(settings.showLoadingImage){
									$this.css("background","url('images/loading.gif') no-repeat scroll right center transparent");
								}
								// use a timer to introduce a slight delay when the user is typing
								// getData() doesn't fire until the user hasn't typed in a specified time (settings.keyupDelay) to reduce the number of ajax calls
								clearTimeout(typingTimer);
								typingTimer = setTimeout(function() { getData(keyword);	}, settings.keyupDelay)
						}
					} else {
						// keyword not min length
						$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
							$(this).remove();
						});
					}
				});

				function _getData( keyword )	{
					// get with ajax [ 'founded1', 'founded2' ] etc...

				}

				if( settings.renderer == null )
				settings.renderer = function default_render( key, val ) {
					if(settings.id_element != "" && settings.id_element != null)
						return '<li><a href="#" id="'+key+'">'+val+'</a></li>';
					else
						return '<li><a href="#">'+val+'</a></li>';
				}

				function getData( keyword ) {

					if( settings.gdata_callbackable )
						settings.get_data_func( keyword, draw_data );
					else
						draw_data(
							settings.get_data_func( keyword )
						);
				}

				function draw_data( data ){

					if( typeof(data) == 'undefined' )
					return;

					if( data.length ) {

						option_list = "<ul id='easy_list_"+tmp_id+"' class='easy_list'>";

							$.each(data, function(key, val) {
								option_list += settings.renderer( key, val );
							});

						option_list += "</ul>";

						if(!$("#easy_suggest_"+tmp_id).length){
							$( "<div id='easy_suggest_"+tmp_id+"' class='easy_suggest'></div>")
								.insertAfter( $this )
								.css( 'margin-top', 	parseInt(settings.es_offset_top) )
								.css( 'margin-left',	parseInt(settings.es_offset_left) )
								.css( 'opacity',		settings.es_opacity )
								.html( option_list )
								.css( 'display', 'block' )
							;

							if( settings.es_absolute ) {
								var position = $this.position();

								position.left += settings.es_offset_left;

								position.top += $this.height() + 1 + parseInt(settings.es_offset_top)

								$( 'body' ).prepend(
									$('#easy_suggest_'+tmp_id)
										.css({
											left:	position.left,
											top:	position.top
										})
								);
							}

							// set responce div width
							if(settings.es_width == "auto")
								$("#easy_suggest_"+tmp_id).css("width",parseInt($this.outerWidth()) - 2);
							else
								$("#easy_suggest_"+tmp_id).css("width",parseInt(settings.es_width));
						}
						else
							$("#easy_suggest_"+tmp_id).html(option_list).css("display","block");
					} else {
						$("#easy_suggest_"+tmp_id).fadeOut("fast", function(){
							$(this).remove();
						});
					}
				}

				// style list li on mouseover
				$("#easy_list_"+tmp_id+" li").live("mouseover",function () {
					$("#easy_list_"+tmp_id+" li[class='selected']").removeClass("selected");
					$(this).addClass("selected");
				});

				// set input values on li click
				$("#easy_list_"+tmp_id+" li").live("click",function () {
					var href = $("#easy_list_"+tmp_id+" li[class='selected']");
					str = $( href ).text();
					$this.val(str);
					// store id of the selected option
					if(settings.id_element != "" && settings.id_element != null){
						$("#"+settings.id_element).val($("li[class='selected'] a").attr("id"));
					}
					$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
						$(this).remove();
					});
					$this . trigger( 'focus' );

					if( settings.onselect != null )
					settings.onselect( href );

					return false;
				});

				// hide drop down on document click
				$(document).click(function(){
					if($("#easy_suggest_"+tmp_id).css("display") == "block"){
						$("#easy_suggest_"+tmp_id).fadeOut("fast", function() {
							$(this).remove();
						});
					}
				});
			});
		}
	});

/*
	jInputFile.js
	????????:				http://savvateev.org/blog/38
	???????? ???? ? ??????? ??????????:	post[-===-]cotfw.ru
*/
(function($) {
	$.fn.jInputFile = function(params) {

		var options = extend({
			onchange_LOW:	function( input ){
				var height = $( input ) . parent() . children( '.jInputFile-fnames' ) . height();

				height += 21;
				$( input ) . parent() . css( 'height', height );
			},
			onchange:			null,
			multiple:			false,
			postfix:			'',
			filename_newline:	false,

			delete_button:		true,
			multipleSingles:	false
		}, params );

		if( typeof(this.attr('multiple')) != 'undefined' )
		options.multiple = true;

		if(options.multiple)
		options.postfix = '-multiple';

		return this.each(function() {

			$(this).val('');
			$(this).wrap('<div class="jInput-root"></div>');
			$(this).parent().css('height', $(this).height());
			$(this).after('<div class="jInputFile-fakeButton'+options.postfix+'"></div><div class="jInputFile-blocker"></div><div class="jInputFile-activeBrowseButton'+options.postfix+' jInputFile-fakeButton'+options.postfix+'"></div><div class="jInputFile-fnames"><div class="jInputFile-fileName"></div></div>');
			$(this).addClass('jInputFile-customFile');

			$(this).hover(
				function () {
					$(this).parent().children('.jInputFile-activeBrowseButton'+options.postfix).css('display', 'block');
				},
				function () {
					$(this).parent().children('.jInputFile-activeBrowseButton'+options.postfix).css('display', 'none');
				}
			);

			$(this).change(function(){

				this.options = options;

				$(this).parent().children('.jInputFile-fnames').html( '' );


				var input = this;
				var $input = $( input );

				var show_file = function( file ){

					//??????? ???????? ????? ? ??? ??????????
					var reWin = /.*\\(.*)/;
					var fileName = file.replace(reWin, '$1');
					var reUnix = /.*\/(.*)/;
					fileName = fileName.replace(reUnix, '$1');
					var regExExt =/.*\.(.*)/;
					var ext = fileName.replace(regExExt, '$1');

					//?????????? ?????? ? ??? ?????
					var pos;
					if (ext){
						switch (ext.toLowerCase()) {
							case 'doc': pos = '0'; break;
							case 'bmp': pos = '16'; break;
							case 'jpg': pos = '32'; break;
							case 'jpeg': pos = '32'; break;
							case 'png': pos = '48'; break;
							case 'gif': pos = '64'; break;
							case 'psd': pos = '80'; break;
							case 'mp3': pos = '96'; break;
							case 'wav': pos = '96'; break;
							case 'ogg': pos = '96'; break;
							case 'avi': pos = '112'; break;
							case 'wmv': pos = '112'; break;
							case 'flv': pos = '112'; break;
							case 'pdf': pos = '128'; break;
							case 'exe': pos = '144'; break;
							case 'txt': pos = '160'; break;
							default: pos = '176'; break
						};

						var div = document.createElement( 'div' );
						$( div )
							.html( fileName )
							.attr( 'class', 'jInputFile-fileName' )
							.css({
								'background-position':	('0px -'+pos+'px'),
								'background-repeat':	'no-repeat',
								'display':				'block'
							});

						var $parent = $input.parent().children( '.jInputFile-fnames' );

						$parent.append( div );

						if( options.filename_newline )
						$parent.append( $('<br />') );
					};
				}

				if( typeof(input.files) != 'undefined' )
					$( input.files ) . map(function(){
						show_file( this.name );
					});
				else
					show_file( $input.val() );

				if( options.onchange_LOW != null )
				options.onchange_LOW( this );

				var input_name	= $input.attr('name');

				if( options.multipleSingles ) {
					$file = $input;
					var path = $file.val();

					// check if there is no empty input[type="file"]
					var has_empty_inputs = false;
					$file.parent().parent().parent().find('input:file').map(function(){

						if( $(this).val() == '' )
						has_empty_inputs = true;

					});

					if( !has_empty_inputs ) {
						// counting insert before
						var $pointer	= $file.parent().parent();
						var new_input	= $('<div class="row jInputFile-item"><input type="file" name="'+input_name+'" /></div>');

						var next;
						do {
							next = $pointer.next();
							if( next.length )
								$pointer = $pointer.next();
							else
								break;

						} while( $pointer.hasClass('jInputFile-item') );

						if( next.length )
							new_input.insertBefore( $pointer )
						else
							new_input.insertAfter( $pointer );


						new_input.find('input:first').jInputFile({
								delete_button:		options.delete_button,
								multipleSingles:	true
							})
						;
					}
				}

				if( options.delete_button ) {

					var $delete_container = $input.parent().find( '.jInputFile-fileName:first' );

					var $delete_button = $delete_container.find('>.jInputFile-remove');

					var filename = $input.val();

					if( filename == '' && $delete_button.length )
						$delete_button.remove();
					else
						$delete_container.append(
							$( '<img src="'+URI+'/assets/images/jInputFile/delete.gif" class="jInputFile-remove" />' ).click(function(){

								var $root_parent = $input.parent().parent().parent();

								$input.val( '' );
								$input.parent().parent().remove();

								if( !options.multipleSingles ) {
									var new_input	= $('<div class="jInputFile-item"><input type="file" name="'+input_name+'" /></div>');

										$root_parent.append( new_input );

										new_input.find('input:first').jInputFile(options);
								}

								return false;
							})
						);

				}

				if( options.onchange != null )
				options.onchange( this );
			});
		});
	}
})(jQuery);


String.prototype.translit = (function( ){

	var replacement = {
		'?':'A','?':'a','?':'B','?':'b','?':'V','?':'v','?':'G','?':'g',
		'?':'D','?':'d','?':'E','?':'e','?':'Yo','?':'yo','?':'Zh','?':'zh',
		'?':'Z','?':'z','?':'I','?':'i','?':'Y','?':'y','?':'K','?':'k',
		'?':'L','?':'l','?':'M','?':'m','?':'N','?':'n','?':'O','?':'o',
		'?':'P','?':'p','?':'R','?':'r','?':'S','?':'s','?':'T','?':'t',
		'?':'U','?':'u','?':'F','?':'f','?':'Kh','?':'kh','?':'Ts','?':'ts',
		// '?':'Ch','?':'ch','?':'Sh','?':'sh','?':'Sch','?':'sch','?':'"','?':'"',
		'?':'Ch','?':'ch','?':'Sh','?':'sh','?':'Sch','?':'sch',
		// '?':'Y','?':'y','?':"'",'?':"'",'?':'E','?':'e','?':'Yu','?':'yu',
		'?':'Y','?':'y','?':'E','?':'e','?':'Yu','?':'yu',
		'?':'Ya','?':'ya',
		' ':'-','-':'-','_':'-',
		'A':'A','B':'B','C':'C','D':'D','E':'E','F':'F','G':'G','H':'H','I':'I','J':'J','K':'K','L':'L','M':'M','N':'N','O':'O','P':'P','Q':'Q','R':'R','S':'S','T':'T','U':'U','V':'V','W':'W','X':'X','Y':'Y','Z':'Z','a':'a','b':'b','c':'c','d':'d','e':'e','f':'f','g':'g','h':'h','i':'i','j':'j','k':'k','l':'l','m':'m','n':'n','o':'o','p':'p','q':'q','r':'r','s':'s','t':'t','u':'u','v':'v','w':'w','x':'x','y':'y','z':'z',
		'0':'0','1':'1','2':'2','3':'3','4':'4','5':'5','6':'6','7':'7','8':'8','9':'9'
	};

	return function( tolower ){

		if( typeof(tolower) == 'undefined' )
		var tolower = true;

		// create string
		var replaced = '';
		var c = '';
		for( var i = 0;i < this.length;i++ ){
			c = this.substr(i,1);

			if( typeof(replacement[c]) != 'undefined' )
			replaced += replacement[c];
		}

		// removing unnecessary dash symbols
		replaced = replaced.replace( /[-]{1,}/gim, '-' );

		// remove dash at the end
		if( replaced.substr(replaced.length-1,1) == '-' )
		replaced = replaced . substr( 0, replaced.length-1 );

		// to lower
		if( tolower )
		replaced = replaced . toLowerCase();

		return replaced;
	}
})();


function extend( standart, params )	{

	if( typeof(params) == 'undefined' )
	var params = {};

	var settings = {};

	for( var index in standart )
		if( typeof(params[index]) == 'undefined' )
			if( typeof(standart[index]) == 'object' && standart[index] != null )
				settings[ index ] = extend( standart[index] );
			else
				settings[ index ] = standart[ index ];
		else
			if( typeof(params[index]) == 'object' && params[index] != null )
				settings[ index ] = extend( params[index] );
			else
				settings[ index ] = params[ index ];

	for( index in params )
	if( typeof(standart[index]) == 'undefined' )
	settings[ index ] = params[ index ];

	return settings;
}


$.extend($.fn, {
	center: function() {
		return this.each(function(){
			var $this = $( this );

			$this.css({
				position:		'fixed',
				left:			'50%',
				top:			'50%'
			})
			$this.css({
				'margin-left':	-parseInt($this.innerWidth() / 2) + 'px',
				'margin-top':	-parseInt($this.innerHeight() / 2) + 'px'
			});
		});
	},
	toggleClick: function(fn1, fn2) {

		return this.each(function(){
			var self = this;
			var semafor = true;
			$( this ) . click(function( ev ){
				if( semafor ){
					semafor = false;
					return fn1.call( self, ev );
				}
				else{
					semafor = true;
					return fn2.call( self, ev );
				}
			});
		});
	},
	selectChangeExt:	function( handler ) {
		return this.each(function(){
			var self = this;
			$( self )
				.change( handler )
				// firefox bug
				.keydown(function(){
					setTimeout(function(){
						handler.call( self );
					}, 0 );
				})
			;
		});
	},
	getImageRealSize:	function( callback ) {
		return this.each(function(){
			$( new Image() )
				.attr( 'src', this.src )
				.load(function(){
					callback({ width:this.width, height:this.height });
				})
			;
		})
	},
	hasAttr:	function(name) {
		return this.attr(name) !== undefined;
	}
});

$.fn.getStyleObject = function(){
	var dom = this.get(0);
	var style;
	var returns = {};
	if(window.getComputedStyle){
		var camelize = function(a,b){
			return b.toUpperCase();
		};
		style = window.getComputedStyle(dom, null);
		if( style != null )
		for(var i = 0, l = style.length; i < l; i++){
			var prop = style[i];
			var camel = prop.replace(/\-([a-z])/g, camelize);
			var val = style.getPropertyValue(prop);
			returns[camel] = val;
		};
		return returns;
	};
	if(style = dom.currentStyle){
		for(var prop in style)
			returns[prop] = style[prop];
		return returns;
	};
	return this.css();
}

$.fn.visible = function() {
	return this.each(function(){
		this.style.visibility = 'visible';
	});
}
$.fn.unvisible = function() {
	return this.each(function(){
		this.style.visibility = 'hidden';
	});
}

$.fn.onmouseoverModal = function(params) {
	var options = $.extend(true, {}, {

	}, params);

	return this.each(function(){

		var $self		= $( this );
		var $text		= $self.parent().find( '.js-mouseover-modal-text' );

		$text.css({
			// 'margin-top':	parseInt( $text.outerHeight( true ) ) * (-1)
			'margin-top':	parseInt( $self.outerHeight( true ) ) + 2
		})

		$self
			.mouseenter(function(){
				$text.stop().slideDown();
			})
			.mouseleave(function(){
				$text.stop().slideUp();
			})
		;

	});
}

$.fn.copyCSS = function(source){
	var styles = $(source).getStyleObject();
	this.css(styles);
}

$.fn.beauTextInput = function() {

	var $this;

	return this.each(function(){

		$this = $( this );
		var default_value = $this.attr( 'default-value' );

		$( this )
			.mouseenter(function(){
				if( this.value == default_value )
				this.value = '';
			})
			.mouseleave(function(){
				if( this.value == '' )
				this.value = default_value;
			})
		;

	});
}
$.fn.getSelectedOption = function() {
	var $this = $( this );
	var tagName = $this.prop( 'tagName' ).toLowerCase();

	if( tagName == 'option' ) {
		if( $this.attr('selected') ) {
			return $this;
		} else {
			return new Array();
		}
	} else {
		return $( this ).find( '>option:selected:first' );
	}
}


var keycodes = {
	numeric:	[48,49,50,51,52,53,54,55,56,57],
	doubl:		[190,188,110]
}

function validate_number( evt, second ) {
	var e = evt || window.event;
	var key = e.keyCode || e.which;

	var allowkeys_assoc = {};
	var allowkeys = new Array();
	var ontype = function(){ };
	var type = typeof( second );
	if( type != 'undefined' )
		if( type == 'function' )
			ontype = second;
		else {
			allowkeys = second;

			for( var i = 0;i < allowkeys.length;i++ )
			allowkeys_assoc[ allowkeys[i] ] = true;
		}

	if( !e.shiftKey && !e.altKey && !e.ctrlKey &&
		// numbers
		key >= 48 && key <= 57 ||

		// Numeric keypad
		key >= 96 && key <= 105 ||

		// Backspace and Tab and Enter
		key == 8 || key == 9 || key == 13 ||

		// Home and End
		key == 35 || key == 36 ||

		// left and right arrows
		key == 37 || key == 39 ||

		// minus
		key == 173 ||

		// comma, period and minus, . on keypad
		// key == 190 || key == 188 || key == 109 || key == 110 ||
		// Del and Ins

		key == 46 || key == 45 ||
		typeof(allowkeys_assoc[key]) != 'undefined'
	) {
		// input is VALID
		ontype.call();
	} else {
		if(
			typeof(specialKeys[key]) != 'undefined'		||
			e.shiftKey || e.altKey || e.ctrlKey
		) {
			return true;
		} else {
			// input is INVALID
			e.returnValue = false;

			if( e.preventDefault )
			e.preventDefault();
		}
	}
}

$.fn.fadeOutAndRemove = function(speed){
	if( !speed ) {
		var speed = 500;
	}
    $(this).fadeOut(speed,function(){
        $(this).remove();
    })
}

$(function(){
	$( '.numeric' ).keydown( validate_number );
	$( '.numeric-float' ).keydown( function(event){
		validate_number( event, keycodes.numeric.concat( keycodes.doubl ) );
	});

	$( '.js-select-text-on-focus' ).focus(function(){
		$( this ).select();
	});

	$('.js-mask-date').mask('AB/CD/E000', {
		translation:{
            A:	{pattern: /[0-3]/},
            B:	{pattern: /[0-9]/},
            C:	{pattern: /[0-1]/},
            D:	{pattern: /[0-9]/},
			E:	{pattern: /[1-2]/},
        },
        onKeyPress: function(a, b, c, d) {

            if (!a) return;

            var m = a.match(/(\d{1})/g)

            if(!m)return;

            if(parseInt(m[0]) === 3){
                d.translation.B.pattern = /[0-1]/;
            }else{
                d.translation.B.pattern = /[0-9]/;
            }
            if (parseInt(m[2]) === 1){
                d.translation.D.pattern = /[0-2]/;
            }else{
                d.translation.D.pattern = /[0-9]/;
            }

            //unmask the input to apply a new mask
            c.unmask().mask("AB/CD/0000", d);

            //update the input value with itself cause
            //when we unmask and mask again
            //the caret bugs, so replacing the value
            //the cursor goes to end like expected
            c.val(c.val());

        },
		placeholder: "__/__/____",
		autoclear: false
	});
	$('.js-mask-phone').mask('+7 (000) 000-00-00', {placeholder: "+7 (___) ___-__-__"});
});

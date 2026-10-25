<?php

/* layout_server1.twig */
class __TwigTemplate_e6f6a509968f980084f8b936bc33b40e3d9ef6fc42081dba3aa0a48ec44a238d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html class=\"no-js\" lang=\"ru\">
\t<head>
\t\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE9\">
\t\t<!--[if IE]>
\t  \t<style>
\t  \t\t.saphire .saphire__label {
\t\t\t\tbackground: url(../images/check.svg) no-repeat left 3px top 3px !important;
\t\t\t\tbackground-size: 12px 12px !important;
\t  \t\t}
\t\t\t.saphire__input:checked+.saphire__label {
\t\t\t    background: url(../images/check-active.svg) no-repeat left 3px top 3px !important;
\t\t\t\tbackground-size: 12px 12px !important;
\t\t\t}
\t  \t</style>
\t  \t<![endif]-->
\t\t<meta charset=\"utf-8\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">
\t\t<meta name=\"format-detection\" content=\"telephone=no\">
\t\t<meta name=\"copyright\" content=\"Создание сайтов - Cetera Labs, www.cetera.ru, 2016\">
\t\t<meta name=\"author\" content=\"Cetera Labs, http://www.cetera.ru/, создание сайтов, поддержка сайтов, продвижение сайтов\">
\t\t<meta name=\"cmsmagazine\" content=\"f21b68cb09efe1a7161ca2caaacaf749\">

\t";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showTitle", array(), "method"), "html", null, true);
        echo "
\t";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showMeta", array(0 => "description"), "method"), "html", null, true);
        echo "
\t";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showMeta", array(0 => "keywords"), "method"), "html", null, true);
        echo "
\t\t";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showCSS", array(), "method"), "html", null, true);
        echo "
\t";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showHeadStrings", array(), "method"), "html", null, true);
        echo "

\t";
        // line 33
        echo "
\t\t<script type=\"text/javascript\">window.Modernizr=function(e,t,n){function r(e){b.cssText=e}function o(e,t){return r(S.join(e+\";\")+(t||\"\"))}function a(e,t){return typeof e===t}function i(e,t){return!!~(\"\"+e).indexOf(t)}function c(e,t){for(var r in e){var o=e[r];if(!i(o,\"-\")&&b[o]!==n)return\"pfx\"==t?o:!0}return!1}function s(e,t,r){for(var o in e){var i=t[e[o]];if(i!==n)return r===!1?e[o]:a(i,\"function\")?i.bind(r||t):i}return!1}function u(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),o=(e+\" \"+k.join(r+\" \")+r).split(\" \");return a(t,\"string\")||a(t,\"undefined\")?c(o,t):(o=(e+\" \"+T.join(r+\" \")+r).split(\" \"),s(o,t,n))}function l(){p.input=function(n){for(var r=0,o=n.length;o>r;r++)j[n[r]]=!!(n[r]in E);return j.list&&(j.list=!(!t.createElement(\"datalist\")||!e.HTMLDataListElement)),j}(\"autocomplete autofocus list placeholder max min multiple pattern required step\".split(\" \")),p.inputtypes=function(e){for(var r,o,a,i=0,c=e.length;c>i;i++)E.setAttribute(\"type\",o=e[i]),r=\"text\"!==E.type,r&&(E.value=x,E.style.cssText=\"position:absolute;visibility:hidden;\",/^range\$/.test(o)&&E.style.WebkitAppearance!==n?(g.appendChild(E),a=t.defaultView,r=a.getComputedStyle&&\"textfield\"!==a.getComputedStyle(E,null).WebkitAppearance&&0!==E.offsetHeight,g.removeChild(E)):/^(search|tel)\$/.test(o)||(r=/^(url|email)\$/.test(o)?E.checkValidity&&E.checkValidity()===!1:E.value!=x)),P[e[i]]=!!r;return P}(\"search tel url email datetime date month week time datetime-local number range color\".split(\" \"))}var d,f,m=\"2.8.3\",p={},h=!0,g=t.documentElement,v=\"modernizr\",y=t.createElement(v),b=y.style,E=t.createElement(\"input\"),x=\":)\",w={}.toString,S=\" -webkit- -moz- -o- -ms- \".split(\" \"),C=\"Webkit Moz O ms\",k=C.split(\" \"),T=C.toLowerCase().split(\" \"),N={svg:\"http://www.w3.org/2000/svg\"},M={},P={},j={},\$=[],D=\$.slice,F=function(e,n,r,o){var a,i,c,s,u=t.createElement(\"div\"),l=t.body,d=l||t.createElement(\"body\");if(parseInt(r,10))for(;r--;)c=t.createElement(\"div\"),c.id=o?o[r]:v+(r+1),u.appendChild(c);return a=[\"&#173;\",'<style id=\"s',v,'\">',e,\"</style>\"].join(\"\"),u.id=v,(l?u:d).innerHTML+=a,d.appendChild(u),l||(d.style.background=\"\",d.style.overflow=\"hidden\",s=g.style.overflow,g.style.overflow=\"hidden\",g.appendChild(d)),i=n(u,e),l?u.parentNode.removeChild(u):(d.parentNode.removeChild(d),g.style.overflow=s),!!i},z=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t)&&n(t).matches||!1;var r;return F(\"@media \"+t+\" { #\"+v+\" { position: absolute; } }\",function(t){r=\"absolute\"==(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle).position}),r},A=function(){function e(e,o){o=o||t.createElement(r[e]||\"div\"),e=\"on\"+e;var i=e in o;return i||(o.setAttribute||(o=t.createElement(\"div\")),o.setAttribute&&o.removeAttribute&&(o.setAttribute(e,\"\"),i=a(o[e],\"function\"),a(o[e],\"undefined\")||(o[e]=n),o.removeAttribute(e))),o=null,i}var r={select:\"input\",change:\"input\",submit:\"form\",reset:\"form\",error:\"img\",load:\"img\",abort:\"img\"};return e}(),L={}.hasOwnProperty;f=a(L,\"undefined\")||a(L.call,\"undefined\")?function(e,t){return t in e&&a(e.constructor.prototype[t],\"undefined\")}:function(e,t){return L.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if(\"function\"!=typeof t)throw new TypeError;var n=D.call(arguments,1),r=function(){if(this instanceof r){var o=function(){};o.prototype=t.prototype;var a=new o,i=t.apply(a,n.concat(D.call(arguments)));return Object(i)===i?i:a}return t.apply(e,n.concat(D.call(arguments)))};return r}),M.flexbox=function(){return u(\"flexWrap\")},M.flexboxlegacy=function(){return u(\"boxDirection\")},M.canvas=function(){var e=t.createElement(\"canvas\");return!(!e.getContext||!e.getContext(\"2d\"))},M.canvastext=function(){return!(!p.canvas||!a(t.createElement(\"canvas\").getContext(\"2d\").fillText,\"function\"))},M.webgl=function(){return!!e.WebGLRenderingContext},M.touch=function(){var n;return\"ontouchstart\"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:F([\"@media (\",S.join(\"touch-enabled),(\"),v,\")\",\"{#modernizr{top:9px;position:absolute}}\"].join(\"\"),function(e){n=9===e.offsetTop}),n},M.geolocation=function(){return\"geolocation\"in navigator},M.postmessage=function(){return!!e.postMessage},M.websqldatabase=function(){return!!e.openDatabase},M.indexedDB=function(){return!!u(\"indexedDB\",e)},M.hashchange=function(){return A(\"hashchange\",e)&&(t.documentMode===n||t.documentMode>7)},M.history=function(){return!(!e.history||!history.pushState)},M.draganddrop=function(){var e=t.createElement(\"div\");return\"draggable\"in e||\"ondragstart\"in e&&\"ondrop\"in e},M.websockets=function(){return\"WebSocket\"in e||\"MozWebSocket\"in e},M.rgba=function(){return r(\"background-color:rgba(150,255,150,.5)\"),i(b.backgroundColor,\"rgba\")},M.hsla=function(){return r(\"background-color:hsla(120,40%,100%,.5)\"),i(b.backgroundColor,\"rgba\")||i(b.backgroundColor,\"hsla\")},M.multiplebgs=function(){return r(\"background:url(https://),url(https://),red url(https://)\"),/(url\\s*\\(.*?){3}/.test(b.background)},M.backgroundsize=function(){return u(\"backgroundSize\")},M.borderimage=function(){return u(\"borderImage\")},M.borderradius=function(){return u(\"borderRadius\")},M.boxshadow=function(){return u(\"boxShadow\")},M.textshadow=function(){return\"\"===t.createElement(\"div\").style.textShadow},M.opacity=function(){return o(\"opacity:.55\"),/^0.55\$/.test(b.opacity)},M.cssanimations=function(){return u(\"animationName\")},M.csscolumns=function(){return u(\"columnCount\")},M.cssgradients=function(){var e=\"background-image:\",t=\"gradient(linear,left top,right bottom,from(#9f9),to(white));\",n=\"linear-gradient(left top,#9f9, white);\";return r((e+\"-webkit- \".split(\" \").join(t+e)+S.join(n+e)).slice(0,-e.length)),i(b.backgroundImage,\"gradient\")},M.cssreflections=function(){return u(\"boxReflect\")},M.csstransforms=function(){return!!u(\"transform\")},M.csstransforms3d=function(){var e=!!u(\"perspective\");return e&&\"webkitPerspective\"in g.style&&F(\"@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}\",function(t,n){e=9===t.offsetLeft&&3===t.offsetHeight}),e},M.csstransitions=function(){return u(\"transition\")},M.fontface=function(){var e;return F('@font-face {font-family:\"font\";src:url(\"https://\")}',function(n,r){var o=t.getElementById(\"smodernizr\"),a=o.sheet||o.styleSheet,i=a?a.cssRules&&a.cssRules[0]?a.cssRules[0].cssText:a.cssText||\"\":\"\";e=/src/i.test(i)&&0===i.indexOf(r.split(\" \")[0])}),e},M.generatedcontent=function(){var e;return F([\"#\",v,\"{font:0/0 a}#\",v,':after{content:\"',x,'\";visibility:hidden;font:3px/1 a}'].join(\"\"),function(t){e=t.offsetHeight>=3}),e},M.video=function(){var e=t.createElement(\"video\"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('video/ogg; codecs=\"theora\"').replace(/^no\$/,\"\"),n.h264=e.canPlayType('video/mp4; codecs=\"avc1.42E01E\"').replace(/^no\$/,\"\"),n.webm=e.canPlayType('video/webm; codecs=\"vp8, vorbis\"').replace(/^no\$/,\"\"))}catch(r){}return n},M.audio=function(){var e=t.createElement(\"audio\"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('audio/ogg; codecs=\"vorbis\"').replace(/^no\$/,\"\"),n.mp3=e.canPlayType(\"audio/mpeg;\").replace(/^no\$/,\"\"),n.wav=e.canPlayType('audio/wav; codecs=\"1\"').replace(/^no\$/,\"\"),n.m4a=(e.canPlayType(\"audio/x-m4a;\")||e.canPlayType(\"audio/aac;\")).replace(/^no\$/,\"\"))}catch(r){}return n},M.localstorage=function(){try{return localStorage.setItem(v,v),localStorage.removeItem(v),!0}catch(e){return!1}},M.sessionstorage=function(){try{return sessionStorage.setItem(v,v),sessionStorage.removeItem(v),!0}catch(e){return!1}},M.webworkers=function(){return!!e.Worker},M.applicationcache=function(){return!!e.applicationCache},M.svg=function(){return!!t.createElementNS&&!!t.createElementNS(N.svg,\"svg\").createSVGRect},M.inlinesvg=function(){var e=t.createElement(\"div\");return e.innerHTML=\"<svg/>\",(e.firstChild&&e.firstChild.namespaceURI)==N.svg},M.smil=function(){return!!t.createElementNS&&/SVGAnimate/.test(w.call(t.createElementNS(N.svg,\"animate\")))},M.svgclippaths=function(){return!!t.createElementNS&&/SVGClipPath/.test(w.call(t.createElementNS(N.svg,\"clipPath\")))};for(var H in M)f(M,H)&&(d=H.toLowerCase(),p[d]=M[H](),\$.push((p[d]?\"\":\"no-\")+d));return p.input||l(),p.addTest=function(e,t){if(\"object\"==typeof e)for(var r in e)f(e,r)&&p.addTest(r,e[r]);else{if(e=e.toLowerCase(),p[e]!==n)return p;t=\"function\"==typeof t?t():t,\"undefined\"!=typeof h&&h&&(g.className+=\" \"+(t?\"\":\"no-\")+e),p[e]=t}return p},r(\"\"),y=E=null,function(e,t){function n(e,t){var n=e.createElement(\"p\"),r=e.getElementsByTagName(\"head\")[0]||e.documentElement;return n.innerHTML=\"x<style>\"+t+\"</style>\",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=y.elements;return\"string\"==typeof e?e.split(\" \"):e}function o(e){var t=v[e[h]];return t||(t={},g++,e[h]=g,v[g]=t),t}function a(e,n,r){if(n||(n=t),l)return n.createElement(e);r||(r=o(n));var a;return a=r.cache[e]?r.cache[e].cloneNode():p.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!a.canHaveChildren||m.test(e)||a.tagUrn?a:r.frag.appendChild(a)}function i(e,n){if(e||(e=t),l)return e.createDocumentFragment();n=n||o(e);for(var a=n.frag.cloneNode(),i=0,c=r(),s=c.length;s>i;i++)a.createElement(c[i]);return a}function c(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return y.shivMethods?a(n,e,t):t.createElem(n)},e.createDocumentFragment=Function(\"h,f\",\"return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(\"+r().join().replace(/[\\w\\-]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c(\"'+e+'\")'})+\");return n}\")(y,t.frag)}function s(e){e||(e=t);var r=o(e);return!y.shivCSS||u||r.hasCSS||(r.hasCSS=!!n(e,\"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}\")),l||c(e,r),e}var u,l,d=\"3.7.0\",f=e.html5||{},m=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)\$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)\$/i,h=\"_html5shiv\",g=0,v={};!function(){try{var e=t.createElement(\"a\");e.innerHTML=\"<xyz></xyz>\",u=\"hidden\"in e,l=1==e.childNodes.length||function(){t.createElement(\"a\");var e=t.createDocumentFragment();return\"undefined\"==typeof e.cloneNode||\"undefined\"==typeof e.createDocumentFragment||\"undefined\"==typeof e.createElement}()}catch(n){u=!0,l=!0}}();var y={elements:f.elements||\"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video\",version:d,shivCSS:f.shivCSS!==!1,supportsUnknownElements:l,shivMethods:f.shivMethods!==!1,type:\"default\",shivDocument:s,createElement:a,createDocumentFragment:i};e.html5=y,s(t)}(this,t),p._version=m,p._prefixes=S,p._domPrefixes=T,p._cssomPrefixes=k,p.mq=z,p.hasEvent=A,p.testProp=function(e){return c([e])},p.testAllProps=u,p.testStyles=F,p.prefixed=function(e,t,n){return t?u(e,t,n):u(e,\"pfx\")},g.className=g.className.replace(/(^|\\s)no-js(\\s|\$)/,\"\$1\$2\")+(h?\" js \"+\$.join(\" \"):\"\"),p}(this,this.document);
\t\t</script>
\t";
        echo "

\t</head>
\t<body>

\t\t<div class=\"reveal small\" id=\"add-to-favourites-auth-popup\" data-reveal>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"show-for-medium large-12 column\"><img src=\"";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "i/image.svg\" alt=\"изображение\"></div>
\t\t\t\t<div class=\"small-24 large-12 text-center column\">
\t\t\t\t\t<h3>Товар добавлен в список любимых товаров!</h3>
\t\t\t\t\t<p>Чтобы сохранить список, вам нужно:</p><a class=\"button expanded\" href=\"login.html\" title=\"\">Войти</a>
\t\t\t\t\t<p>или</p><a class=\"button expanded\" href=\"login.html\" title=\"\">Зарегистрироваться</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<button class=\"close-button\" data-close aria-label=\"Закрыть\"><span aria-hidden=\"true\">&times;</span></button>
\t\t</div>
\t\t<div class=\"bar text-center\" /*id=\"bar\"*/><a class=\"bar__close\" data-responsive-toggle=\"bar\" data-hide-for=\"large\">
\t\t\t\t<button type=\"button\" data-toggle=\"\"><img src=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/cross.svg\" alt=\"\"></button></a>
\t\t\t<div class=\"bar__top\"><a class=\"bar__link\" data-toggle=\"example-dropdown\"><img src=\"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/menu.svg\" alt=\"\"></a>
\t\t\t\t<div class=\"dropdown-pane taking text-left\" id=\"example-dropdown\" data-dropdown data-auto-focus=\"true\">

\t\t\t";
        // line 54
        try {
            \Cetera\Application::getInstance()->getWidget("Menu", array("catalog" => (isset($context["server"]) ? $context["server"] : $this->getContext($context, "server")), "css_class" => "emerald", "css_class_submenu" => "emerald", "template" => "menu.twig", "depth" => 3))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 55
        echo "\t\t\t\t</div><a class=\"bar__link\" data-toggle=\"dropdown1\"><img src=\"";
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/search.svg\" alt=\"\"></a>
\t\t\t\t<div class=\"dropdown-pane small text-left\" id=\"dropdown1\" data-dropdown data-auto-focus=\"true\">
\t\t\t\t\t<form class=\"cliff\" action=\"/search\" method=\"get\">
\t\t\t\t\t\t<input class=\"cliff__input\" type=\"text\" name=\"query\" placeholder=\"Поиск\">
\t\t\t\t\t\t<button type=\"submit\" style=\"position: absolute; top: 8px; right: 50px; line-height: 1; font-size: 2em;\"><img src=\"/themes/shop/images/search.svg\" alt=\"\"></button>
\t\t\t\t\t\t<button class=\"close-button\" data-close=\"\" aria-label=\"Close modal\" type=\"button\"><img src=\"/themes/shop/images/cross.svg\" alt=\"\" style=\"width: 14px; height: 14px;\"></button>
\t\t\t\t\t</form>
\t\t\t\t</div>
\t\t";
        // line 63
        if ((isset($context["cart"]) ? $context["cart"] : $this->getContext($context, "cart"))) {
            // line 64
            echo "
\t\t\t";
            // line 65
            try {
                \Cetera\Application::getInstance()->getWidget("Sale.Cart.Line", array("path_to_cart" => "/cart/"))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 66
            echo "\t\t";
        }
        // line 67
        echo "\t\t\t\t<!--<div class=\"dropdown-pane small text-left\" id=\"dropdown2\" data-dropdown data-auto-focus=\"true\">
\t\t\t\t\t<div><a href=\"#\">Быстрая связь</a></div>
\t\t\t\t\t<div><a href=\"tel:+74996505372\">+7499650-53-72</a></div>
\t\t\t\t\t<div><a href=\"tel:+79683930083\">+7968393-00-83</a></div>
\t\t\t\t\t<div><a href=\"#\">Менеджеры<br>(запрос цены)</a></div>
\t\t\t\t</div>-->




\t\t";
        // line 77
        if ((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user"))) {
            // line 78
            echo "\t\t\t<a class=\"bar__link\" href=\"/personal/wishlist\"><img src=\"";
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/heart.svg\" alt=\"\">
\t\t\t<div class=\"bar__num\">";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "getWishList", array(), "method"), "getProductsCount", array(), "method"), "html", null, true);
            echo "</div>
\t\t\t</a>
\t\t";
        } else {
            // line 82
            echo "\t\t\t";
            try {
                \Cetera\Application::getInstance()->getWidget("SaleWishlist.Line", array("wishlist_url" => "/personal/wishlist/"))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 83
            echo "\t\t";
        }
        // line 84
        echo "
\t\t\t<a class=\"bar__link\" href=\"/map/site\"><img src=\"";
        // line 85
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/sitemap.svg\" alt=\"\"></a>
\t\t\t</div>
\t\t\t<div class=\"bar__bottom\">
\t\t\t<a class=\"bar__link\" href=\"https://www.instagram.com/velvetin/\" target=\"_blank\"><img src=\"";
        // line 88
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/insta.svg\" alt=\"\"></a>
\t\t\t<a class=\"bar__link\" href=\"https://www.facebook.com/VelvetinJewellery/\" target=\"_blank\"><img src=\"";
        // line 89
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/fb.svg\" alt=\"\"></a>
\t\t\t<a class=\"bar__link\" href=\"https://vk.com/velvetin\" target=\"_blank\"><img src=\"";
        // line 90
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/vk.svg\" alt=\"\"></a></div>
\t\t</div>
\t";
        // line 92
        if (($this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "REQUEST_URI", array()) == "/")) {
            // line 93
            echo "
\t";
            // line 94
            try {
                \Cetera\Application::getInstance()->getWidget("List", array("template" => "main_slider.twig", "catalog" => 507))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 95
            echo "
\t\t<header class=\"header\">
\t\t\t<div class=\"sticky js-information\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"large-4 medium-6 small-12 columns header__logo\"><a href=\"/\"><img src=\"";
            // line 99
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/logo.svg\" alt=\"\"></a></div>
\t\t\t\t\t<div class=\"large-8 medium-18 small-24 columns header__info text-left medium-text-left small-text-left\">
\t\t\t\t\t\t<span class=\"header__toggle\" data-responsive-toggle=\"bar\" data-hide-for=\"large\">
\t\t\t\t\t\t<button type=\"button\" data-toggle=\"\"><img src=\"";
            // line 102
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/menu.svg\" alt=\"\"></button></span>
\t\t\t\t\t\t<div class=\"x1\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, дом 11с11, офис 204
\t\t\t\t\t\t\t<!--";
            // line 104
            echo $this->getAttribute((isset($context["config"]) ? $context["config"] : $this->getContext($context, "config")), "address", array());
            echo "-->
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"x2\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, д. 11с11, оф. 204</div>
\t\t\t\t\t\t<div class=\"phones\"><a href=\"tel:+74996505372\">+7 (499) 650-53-72,</a><br class=\"hide-for-medium\"><span class=\"hide-for-small-only\">&nbsp;&nbsp;</span><a href=\"tel:+79683930083\">+7 (968) 393-00-83</a></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</header>
\t\t<div class=\"beads\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"large-8 large-offset-16 medium-18 medium-offset-6 small-16 small-offset-8 columns js-info small-text-left\">
\t\t\t\t\t<div class=\"hide-for-small-only x1\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, дом 11с11, офис 204</div>
\t\t\t\t\t<div class=\"hide-for-small-only x2\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, д. 11с11, оф. 204</div>
\t\t\t\t\t<div class=\"hide-for-small-only\"><a href=\"tel:+74996505372\">+7 (499) 650-53-72,</a><br class=\"hide-for-medium\"><span class=\"hide-for-small-only\">&nbsp;&nbsp;</span><a href=\"tel:+79683930083\">+7 (968) 393-00-83</a></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t<br><br>
\t\t</div>
\t\t<style>
\t\t\t\t\t@media (min-width: 1025px) and (max-width: 1340px) {
\t\t\t\t\t\t.x1 { display: none; }
\t\t\t\t\t\t.x2 { display: block !important; }
\t\t\t\t\t}
\t\t\t\t\t@media (max-width: 1024px) {
\t\t\t\t\t\t.x2 { display: none; }
\t\t\t\t\t}
\t\t\t\t\t@media (min-width: 1341px) {
\t\t\t\t\t\t.x2 { display: none; }
\t\t\t\t\t}
\t\t\t\t</style>
\t";
        } else {
            // line 135
            echo "\t <header class=\"header\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"large-4 medium-6 small-12 columns header__logo\"><a href=\"/\"><img src=\"";
            // line 137
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/logo.svg\" alt=\"\"></a></div>
\t\t\t\t<div class=\"large-8 medium-18 small-24 columns header__info text-left medium-text-left\">
\t\t\t\t\t<span class=\"header__toggle\" data-responsive-toggle=\"bar\" data-hide-for=\"large\">
\t\t\t\t\t\t<button type=\"button\" data-toggle=\"\"><img src=\"";
            // line 140
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/menu.svg\" alt=\"\"></button></span>
\t\t\t\t\t<div class=\"x1\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, дом 11с11, офис 204
\t\t\t\t\t\t\t<!--";
            // line 142
            echo $this->getAttribute((isset($context["config"]) ? $context["config"] : $this->getContext($context, "config")), "address", array());
            echo "--></div>
\t\t\t\t\t\t\t<div class=\"x2\">Ювелирные украшения со смыслом<br>Москва, ул. Орджоникидзе, д. 11с11, оф. 204</div>
\t\t\t\t\t<div class=\"phones\"><a href=\"tel:+74996505372\">+7 (499) 650-53-72,</a><br class=\"hide-for-medium\"><span  class=\"hide-for-small-only\">&nbsp;&nbsp;</span><a href=\"tel:+79683930083\">+7 (968) 393-00-83</a></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</header>
\t\t<style>
\t\t\t\t\t@media (min-width: 1025px) and (max-width: 1340px) {
\t\t\t\t\t\t.x1 { display: none; }
\t\t\t\t\t\t.x2 { display: block !important; }
\t\t\t\t\t}
\t\t\t\t\t@media (max-width: 1024px) {
\t\t\t\t\t\t.x2 { display: none; }
\t\t\t\t\t}
\t\t\t\t\t@media (min-width: 1341px) {
\t\t\t\t\t\t.x2 { display: none; }
\t\t\t\t\t}
\t\t\t\t</style>
\t";
        }
        // line 161
        echo "
\t";
        // line 162
        $this->displayBlock('main', $context, $blocks);
        // line 163
        echo "
\t\t<footer class=\"footer\">
\t\t<div class=\"row columns\">
\t\t\t<hr class=\"individual-hr\">
\t\t</div>

\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"large-16 medium-8 medium-uncentered hide-for-small-only columns\">
\t\t\t\t\t<p><a href=\"tel:+74996505372\">+7 (499) 650-53-72</a><br><a href=\"tel:+79683930083\">+7 (968) 393-00-83</a><br><a href=\"mailto:gold@velvetin.ru\">gold@velvetin.ru</a><br>© Velvetin 2017</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"large-4 medium-8 small-12 columns\">
\t\t\t\t\t";
        // line 174
        try {
            \Cetera\Application::getInstance()->getWidget("MenuUser", array("css_class" => "jewel", "alias" => "bottom"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 175
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"large-4 medium-8 small-12 columns\">
\t\t\t\t\t";
        // line 177
        try {
            \Cetera\Application::getInstance()->getWidget("MenuUser", array("css_class" => "jewel", "alias" => "bottom2"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 178
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"row columns hide-for-medium hide-for-large\">
\t\t\t\t\t<hr class=\"individual-hr\">
\t\t\t\t</div>
\t\t\t\t<div class=\"hide-for-medium hide-for-large small-24 columns\">
\t\t\t\t\t<div class=\"small-12 columns\" style=\"padding-left: 0px;\">
\t\t\t\t\t\t<p><a href=\"tel:+74996505372\">+7 (499) 650-53-72</a><br><a href=\"tel:+79683930083\">+7 (968) 393-00-83</a></p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"small-12 columns\" style=\"padding-right: 0px;\">
\t\t\t\t\t\t<p><a href=\"mailto:gold@velvetin.ru\">gold@velvetin.ru</a><br>© Velvetin 2017</p>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</div>
\t\t\t</div>
\t\t</footer>
";
        // line 193
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "showScripts", array(), "method"), "html", null, true);
        echo "

<!--script type=\"text/javascript\" src=\"//consultsystems.ru/script/34937/\" async charset=\"utf-8\"></script-->


\t\t<!--<script type=\"text/javascript\" src=\"//consultsystems.ru/script/34937/\" async charset=\"utf-8\"></script>-->
\t\t<script type=\"text/javascript\">
\t\t\t\t\$(\"#example-dropdown\").mouseleave(function() {
\t\t\t\t\t\t\$(\".bar__link\").first().click();
\t\t\t\t});
\t\t</script>
\t\t<div class=\"dobavl\" style=\"display: none; position: fixed; width: 100%; height: 100vh; background: rgba(0,0,0,.5); overflow: hidden; flex-direction: column; justify-content: center; top: 0; left: 0;\">
\t\t\t<div class=\"mesg\" style=\"width: 460px; margin: 0 auto; background: #eeeceb; padding: 20px; position: relative; padding-top: 55px; margin-left: calc((100% - 48px - 460px) / 2);\">
\t\t\t\t<button onclick=\"\$('.dobavl').hide();\" class=\"close-button\" data-close=\"\" aria-label=\"Close modal\" type=\"button\" style=\"right: 20px !important; top: 10px !important;\"><img src=\"/themes/shop/images/cross.svg\" alt=\"\" style=\"width: 17px; height: 17px;\"></button>
\t\t\t\t<h2 style=\"font-size: 18px; text-transform: none;\">Товар добавлен в корзину</h2>
\t\t\t\t<a onclick=\"\$('.dobavl').hide();\" style=\"font-size: 18px; width: 200px; padding: 12.5px 0px; border: none; background: #fff; margin-bottom: 0px;\" class=\"button return\">Продолжить покупки</a>
\t\t\t\t<a href=\"/cart/\" style=\"font-size: 18px; width: 200px; color: #eeeceb; background: #56483a; padding: 12.5px 0px; margin-left: 15px; margin-bottom: 0px;\" class=\"button tocart\">Перейти в корзину</a>
\t\t\t</div>
\t\t</div>
\t\t<!-- Yandex.Metrika counter -->
<script type=\"text/javascript\" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, \"script\", \"https://mc.yandex.ru/metrika/tag.js\", \"ym\");

   ym(51439594, \"init\", {
        id:51439594,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src=\"https://mc.yandex.ru/watch/51439594\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>
<!-- /Yandex.Metrika counter -->
\t</body>
</html>
";
    }

    // line 162
    public function block_main($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout_server1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  388 => 162,  347 => 193,  330 => 178,  323 => 177,  319 => 175,  312 => 174,  299 => 163,  297 => 162,  294 => 161,  272 => 142,  267 => 140,  261 => 137,  257 => 135,  223 => 104,  218 => 102,  212 => 99,  206 => 95,  199 => 94,  196 => 93,  194 => 92,  189 => 90,  185 => 89,  181 => 88,  175 => 85,  172 => 84,  169 => 83,  161 => 82,  155 => 79,  150 => 78,  148 => 77,  136 => 67,  133 => 66,  126 => 65,  123 => 64,  121 => 63,  109 => 55,  102 => 54,  96 => 51,  92 => 50,  79 => 40,  66 => 33,  61 => 28,  57 => 27,  53 => 26,  49 => 25,  45 => 24,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout_server1.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/layout_server1.twig");
    }
}

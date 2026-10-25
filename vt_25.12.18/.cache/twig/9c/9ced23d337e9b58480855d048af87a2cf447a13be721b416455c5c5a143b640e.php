<?php

/* @widget/comments.add/default.twig */
class __TwigTemplate_ff3f19dd95b59e9202aa11e6c598ccd70bb9b55069856ad9b6e2158d245e60ad extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
        // line 55
        echo "
";
        // line 56
        ob_start();
        // line 57
        echo "\t<script>
\t";
        // line 58
        $this->displayBlock('script', $context, $blocks);
        // line 144
        echo "\t</script>
";
        $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 146
        $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))), "method");
    }

    // line 1
    public function block_html($context, array $blocks = array())
    {
        // line 2
        echo "\t
\t";
        // line 3
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 4
            echo "\t\t<a name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-anchor\"></a>
\t\t";
            // line 5
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array());
            echo "
\t\t<div id=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-wrapper\">
\t";
        }
        // line 7
        echo "\t
\t
\t\t<form action=\"#";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
        echo "-anchor\" method=\"post\" data-abide=\"\" novalidate=\"novalidate\" class=\"x-form\">

\t\t\t";
        // line 11
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "statusText", array())) {
            // line 12
            echo "\t\t\t<div class=\"row column\"><p><span class=\"label success\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "statusText", array()), "html", null, true);
            echo "</span></p></div>
\t\t\t";
        }
        // line 14
        echo "\t\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "errorText", array())) {
            // line 15
            echo "\t\t\t<div class=\"row column\"><p><span class=\"label alert\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "errorText", array()), "html", null, true);
            echo "</span></p></div>
\t\t\t";
        }
        // line 16
        echo "\t\t\t

\t\t\t";
        // line 18
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "showNicknameInput", array())) {
            // line 19
            echo "\t\t\t<div class=\"row column\">
\t\t\t\t<input name=\"nickname\" type=\"text\" placeholder=\"";
            // line 20
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Представьтесь")), "html", null, true);
            echo "\" required=\"\">
\t\t\t\t<p class=\"help-text\">";
            // line 21
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Ваше имя для комментария")), "html", null, true);
            echo "</p>
\t\t\t</div>
\t\t\t";
        }
        // line 24
        echo "\t\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "showRecaptcha", array())) {
            // line 25
            echo "\t\t\t<div class=\"g-recaptcha\" data-sitekey=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "recaptcha_site_key"), "method"), "html", null, true);
            echo "\"></div>
\t\t\t";
        }
        // line 27
        echo "\t\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "rating"), "method")) {
            // line 28
            echo "\t\t\t<div class=\"row column x-rating\">
\t\t\t\t<label>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "rating_text"), "method"), "html", null, true);
            echo "</label>
\t\t\t\t<input class=\"x-rating-value\" name=\"rating\" type=\"hidden\">
\t\t\t\t<div class=\"product-rating fa-2x\">
\t\t\t\t<i class=\"x-rating-star fa fa-star-o\">   </i>
\t\t\t\t<i class=\"x-rating-star fa fa-star-o\">   </i>
\t\t\t\t<i class=\"x-rating-star fa fa-star-o\">   </i>
\t\t\t\t<i class=\"x-rating-star fa fa-star-o\">   </i>
\t\t\t\t<i class=\"x-rating-star fa fa-star-o\"></i>
\t\t\t\t</div>\t\t\t
\t\t\t</div>
\t\t\t";
        }
        // line 40
        echo "\t\t\t<div class=\"row column\">
\t\t\t\t<textarea name=\"text\" required=\"\" rows=\"5\" placeholder=\"";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Текст комментария")), "html", null, true);
        echo "\"></textarea>
\t\t\t</div>
\t\t\t<div class=\"row column\">
\t\t\t\t<button type=\"submit\" class=\"button x-submit\">";
        // line 44
        echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "submit_text"), "method");
        echo "</button>
\t\t\t</div>
\t\t\t\t\t  
\t\t\t";
        // line 47
        echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "hiddenFields", array());
        echo "
\t\t</form>
\t
\t";
        // line 50
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 51
            echo "\t\t</div>
\t";
        }
        // line 53
        echo "\t
";
    }

    // line 58
    public function block_script($context, array $blocks = array())
    {
        echo " 
\t
\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t
\t\t\tjQuery('.x-rating-star').hover( function(){
\t\t\t
\t\t\t\tvar all = jQuery(this).parents('.x-rating').find('.x-rating-star');
\t\t\t\tall.removeClass('fa-star').addClass('fa-star-o');
\t\t\t\tjQuery(this).addClass('fa-star').removeClass('fa-star-o');
\t\t\t\tall.each( function(){
\t\t\t\t\tif ( jQuery(this).hasClass('fa-star') ) return false;
\t\t\t\t\tjQuery(this).addClass('fa-star').removeClass('fa-star-o');
\t\t\t\t} );
\t\t\t
\t\t\t}, function() {
\t\t\t
\t\t\t\tvar all = jQuery(this).parents('.x-rating').find('.x-rating-star');
\t\t\t\tall.removeClass('fa-star').addClass('fa-star-o');
\t\t\t\tvar value = parseInt( jQuery(this).parents('.x-rating').find('.x-rating-value').val() );
\t\t\t\tif (isNaN(value)) return;
\t\t\t\tvar i = 1;
\t\t\t\tall.each( function(){
\t\t\t\t\tjQuery(this).addClass('fa-star').removeClass('fa-star-o');
\t\t\t\t\tif (i++ == value) return false;
\t\t\t\t} );\t\t\t\t
\t\t\t
\t\t\t} ).click( function() {
\t\t\t
\t\t\t\tvar value = 0;
\t\t\t\tvar all = jQuery(this).parents('.x-rating').find('.x-rating-star');
\t\t\t\tall.each( function(){
\t\t\t\t\tif ( !jQuery(this).hasClass('fa-star') ) return false;
\t\t\t\t\tvalue++;
\t\t\t\t} );
\t\t\t\tjQuery(this).parents('.x-rating').find('.x-rating-value').val( value );
\t\t\t\t
\t\t\t} );

\t\t});\t\t
\t
\t\t";
        // line 98
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajax"), "method") &&  !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method"))) {
            // line 99
            echo "
\t\tvar new_comment = new Event('new_comment');
\t\t
\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t\t";
            // line 103
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook();
\t\t});
\t\tfunction ";
            // line 105
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook(){
\t\t    var form = document.querySelector(\"#";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper .x-form\");\t\t\t\t
\t\t\tform.addEventListener(\"submit\", function(e){
\t\t\t\te.preventDefault();
\t\t\t\tvar request = new XMLHttpRequest();
\t\t\t\tvar body = '";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "params", array()));
            foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                echo "params[";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "]=";
                echo twig_escape_filter($this->env, twig_urlencode_filter($context["value"]), "html", null, true);
                echo "&";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "';
\t\t\t\tvar form = document.querySelector(\"#";
            // line 111
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper .x-form\");
\t\t\t\tfor (var i = 0; i < form.elements.length; i++)
\t\t\t\t\tif (form.elements[i].getAttribute('name'))
\t\t\t\t\t\tbody += '&'+form.elements[i].getAttribute('name')+'='+form.elements[i].value;
\t\t\t\trequest.open('POST', '";
            // line 115
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getAjaxUrl", array(), "method");
            echo "', true);
\t\t\t\trequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
\t\t\t\trequest.onload = function (e) {
\t\t\t\t\tif (request.readyState === 4) {
\t\t\t\t\t\tif (request.status === 200) {
\t\t\t\t\t\t\tvar form = document.querySelector(\"#";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper .x-form\");
\t\t\t\t\t\t\tvar widget = document.querySelector(\"#";
            // line 121
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper\");
\t\t\t\t\t\t\twidget.innerHTML = request.responseText;
\t\t\t\t\t\t\tform.dispatchEvent(new_comment);
\t\t\t\t\t\t\t";
            // line 124
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook();
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t};
\t\t\t\trequest.onerror = function (e) {
\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t};
\t\t\t\tvar submit = document.querySelector(\"#";
            // line 133
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper .x-submit\");
\t\t\t\tif (submit) {
\t\t\t\t\tsubmit.innerHTML = '";
            // line 135
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Отправка")), "html", null, true);
            echo " ...';
\t\t\t\t\tsubmit.setAttribute('disabled',1);
\t\t\t\t}
\t\t\t\trequest.send(body);\t\t\t\t
\t\t\t});
\t\t}
\t\t
\t\t";
        }
        // line 143
        echo "\t";
    }

    public function getTemplateName()
    {
        return "@widget/comments.add/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  305 => 143,  294 => 135,  289 => 133,  277 => 124,  271 => 121,  267 => 120,  259 => 115,  252 => 111,  237 => 110,  230 => 106,  226 => 105,  221 => 103,  215 => 99,  213 => 98,  169 => 58,  164 => 53,  160 => 51,  158 => 50,  152 => 47,  146 => 44,  140 => 41,  137 => 40,  123 => 29,  120 => 28,  117 => 27,  111 => 25,  108 => 24,  102 => 21,  98 => 20,  95 => 19,  93 => 18,  89 => 16,  83 => 15,  80 => 14,  74 => 12,  72 => 11,  67 => 9,  63 => 7,  58 => 6,  54 => 5,  49 => 4,  47 => 3,  44 => 2,  41 => 1,  37 => 146,  33 => 144,  31 => 58,  28 => 57,  26 => 56,  23 => 55,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/comments.add/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/plugins/comments/widgets/comments.add/default.twig");
    }
}

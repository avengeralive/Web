<?php

/* @widget/user.recover/default.twig */
class __TwigTemplate_0c93d197f98c66bf176d2eaec5d58dd7a4a5d946fb1cbff9df32a42443719b24 extends Twig_Template
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
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 2
            echo "\t<div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-wrapper\">
";
        }
        // line 3
        echo "\t

";
        // line 5
        $this->displayBlock('html', $context, $blocks);
        // line 21
        echo "\t

";
        // line 23
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 24
            echo "\t</div>
";
        }
        // line 26
        echo "
";
        // line 27
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajax"), "method") &&  !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method"))) {
            // line 28
            echo "\t";
            ob_start();
            // line 29
            echo "\t\t<script>
\t\t";
            // line 30
            $this->displayBlock('script', $context, $blocks);
            // line 71
            echo "\t\t</script>
\t";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 73
            echo "\t";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))), "method");
        }
    }

    // line 5
    public function block_html($context, array $blocks = array())
    {
        echo "\t
\t<form method=\"post\" class=\"x-form\">
\t\t<input type=\"hidden\" name=\"UserRecover\" value=\"1\" />
\t\t
\t\t";
        // line 9
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error", array())) {
            // line 10
            echo "\t\t<div class=\"callout alert\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error", array()), "html", null, true);
            echo "</div>
\t\t";
        }
        // line 12
        echo "\t\t
\t\t";
        // line 13
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "success", array())) {
            // line 14
            echo "\t\t<div class=\"callout success\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "success", array()), "html", null, true);
            echo "</div>
\t\t";
        }
        // line 16
        echo "\t\t
\t\t<label>";
        // line 17
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Логин или Email")), "html", null, true);
        echo "</label>
\t\t<input type=\"text\" required name=\"value\" value=\"";
        // line 18
        if ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : null), "post", array(), "any", false, true), "value", array(), "any", true, true)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array()), "value", array()), "html", null, true);
        }
        echo "\">
\t\t<button type=\"submit\" class=\"button small-expanded x-submit\">";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Восстановить пароль")), "html", null, true);
        echo "</button>
    </form>
";
    }

    // line 30
    public function block_script($context, array $blocks = array())
    {
        echo " 
\t\t\t
\t\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t\t\t";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "_hook();
\t\t\t});
\t\t\tfunction ";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "_hook(){
\t\t\t\tvar form = document.querySelector(\"#";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "-wrapper form\");\t\t\t\t
\t\t\t\tform.addEventListener(\"submit\", function(e){
\t\t\t\t\te.preventDefault();
\t\t\t\t\tvar request = new XMLHttpRequest();
\t\t\t\t\tvar body = '";
        // line 40
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
\t\t\t\t\tvar form = document.querySelector(\"#";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "-wrapper form\");
\t\t\t\t\tfor (var i = 0; i < form.elements.length; i++)
\t\t\t\t\t\tif (form.elements[i].getAttribute('name'))
\t\t\t\t\t\t\tbody += '&'+form.elements[i].getAttribute('name')+'='+form.elements[i].value;
\t\t\t\t\trequest.open('POST', '";
        // line 45
        echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getAjaxUrl", array(), "method");
        echo "', true);
\t\t\t\t\trequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
\t\t\t\t\trequest.onload = function (e) {
\t\t\t\t\t\tif (request.readyState === 4) {
\t\t\t\t\t\t\tif (request.status === 200) {
\t\t\t\t\t\t\t\tvar widget = document.querySelector(\"#";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "-wrapper\");
\t\t\t\t\t\t\t\twidget.innerHTML = request.responseText;
\t\t\t\t\t\t\t\t";
        // line 52
        echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
        echo "_hook();
\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t\t\t\t}
\t\t\t\t\t\t}
\t\t\t\t\t};
\t\t\t\t\trequest.onerror = function (e) {
\t\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t\t};
\t\t\t\t\tvar submit = document.querySelector(\"#";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "-wrapper .x-submit\");
\t\t\t\t\tif (submit) {
\t\t\t\t\t\tsubmit.innerHTML = '";
        // line 63
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Отправка")), "html", null, true);
        echo " ...';
\t\t\t\t\t\tsubmit.setAttribute('disabled',1);
\t\t\t\t\t}
\t\t\t\t\trequest.send(body);\t\t\t\t
\t\t\t\t});
\t\t\t}
\t\t\t
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/user.recover/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  190 => 63,  185 => 61,  173 => 52,  168 => 50,  160 => 45,  153 => 41,  138 => 40,  131 => 36,  127 => 35,  122 => 33,  115 => 30,  108 => 19,  102 => 18,  98 => 17,  95 => 16,  89 => 14,  87 => 13,  84 => 12,  78 => 10,  76 => 9,  68 => 5,  62 => 73,  58 => 71,  56 => 30,  53 => 29,  50 => 28,  48 => 27,  45 => 26,  41 => 24,  39 => 23,  35 => 21,  33 => 5,  29 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/user.recover/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/user.recover/default.twig");
    }
}

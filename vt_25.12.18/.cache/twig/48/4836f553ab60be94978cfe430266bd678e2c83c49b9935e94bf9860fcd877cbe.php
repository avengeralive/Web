<?php

/* @widget/sale.cart.line/default.twig */
class __TwigTemplate_b1b44cf021c5a8d615d8e53b7c294a9e4354333af5848ec909d7d7cd697eff15 extends Twig_Template
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
            echo "\t<span id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">
";
        }
        // line 4
        echo "
\t";
        // line 5
        $this->displayBlock('html', $context, $blocks);
        // line 17
        echo "
";
        // line 18
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 19
            echo "\t</span> 
";
        }
        // line 21
        echo "
";
        // line 22
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 23
            echo "\t";
            ob_start();
            // line 24
            echo "\t\t";
            $this->displayBlock('script', $context, $blocks);
            // line 54
            echo "\t";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 55
            echo "\t";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
        }
    }

    // line 5
    public function block_html($context, array $blocks = array())
    {
        // line 6
        echo "\t<a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "cart_url"), "method"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Корзина")), "html", null, true);
        echo "\" class=\"bar__link\">
\t\t<img src=\"";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/basket.svg\" alt=\"\">

\t\t\t";
        // line 9
        if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProductsCount", array(), "method") == 0)) {
            // line 10
            echo "\t\t\t\t<div class=\"x-cart-count\"></div>
\t\t\t";
        } else {
            // line 12
            echo "\t\t\t\t<div class=\"bar__num x-cart-count\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProductsCount", array(), "method"), "html", null, true);
            echo "</div>
\t\t\t";
        }
        // line 14
        echo "\t\t\t
\t</a>\t\t 
\t";
    }

    // line 24
    public function block_script($context, array $blocks = array())
    {
        // line 25
        echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t
\t\tjQuery(document).on(\"cetera.sale.basket.add\", function(e,data){\t
\t\t
\t\t\tif (!isNaN(parseInt(data.count)))
\t\t\t{
\t\t\t\tif ((parseInt(data.count) == 0))
\t\t\t\t{
\t\t\t\t\tjQuery(\"#";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-count\").removeClass(\"bar__num\");
\t\t\t\t\tjQuery(\"#";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-count\").empty();

\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tjQuery(\"#";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-count\").addClass(\"bar__num\");
\t\t\t\t
\t\t\t\t\tjQuery(\"#";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-count\").html(data.count);
\t\t\t\t\tjQuery(\"#";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-total\").html(data.total);
\t\t\t\t\tjQuery(\"#";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-cart-total-display\").html(data.total_display);
\t\t\t\t}
\t\t\t\t\t

\t\t\t\t
\t\t\t}
\t\t\t
\t\t});
\t\t
\t\t});
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/sale.cart.line/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 43,  130 => 42,  126 => 41,  121 => 39,  113 => 34,  109 => 33,  99 => 25,  96 => 24,  90 => 14,  84 => 12,  80 => 10,  78 => 9,  73 => 7,  66 => 6,  63 => 5,  57 => 55,  54 => 54,  51 => 24,  48 => 23,  46 => 22,  43 => 21,  39 => 19,  37 => 18,  34 => 17,  32 => 5,  29 => 4,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.cart.line/default.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/sale.cart.line/default.twig");
    }
}

<?php

/* @widget/salewishlist.line/default.twig */
class __TwigTemplate_0e3cba5124bed20da1fd316e084bfb23ec0352d9da069d72021fdde0923449e4 extends Twig_Template
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
        echo "
";
        // line 2
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 3
            echo "\t<span id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">
";
        }
        // line 5
        echo "
\t";
        // line 6
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
            // line 50
            echo "\t";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 51
            echo "\t";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
        }
    }

    // line 6
    public function block_html($context, array $blocks = array())
    {
        // line 7
        echo "\t<a class=\"bar__link\" href=\"/personal/wishlist\"><img src=\"";
        echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
        echo "images/heart.svg\" alt=\"\">

\t";
        // line 9
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getCount", array(), "method") == 0)) {
            // line 10
            echo "\t\t<div class=\"x-wishlist-count\"></div>
\t";
        } else {
            // line 12
            echo "\t\t<div class=\"bar__num x-wishlist-count\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getCount", array(), "method"), "html", null, true);
            echo "</div>
\t";
        }
        // line 14
        echo "\t\t\t
\t</a>\t 
\t";
    }

    // line 24
    public function block_script($context, array $blocks = array())
    {
        // line 25
        echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\tjQuery(document).on(\"cetera.sale.wishlist.add\", function(e,data){\t
\t\t
\t\t\tif (!isNaN(parseInt(data.count)))
\t\t\t{
\t\t\t\tif ((parseInt(data.count) == 0))
\t\t\t\t{
\t\t\t\t\tjQuery(\"#";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-wishlist-count\").removeClass(\"bar__num\");
\t\t\t\t\tjQuery(\"#";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-wishlist-count\").empty();

\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tjQuery(\"#";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-wishlist-count\").addClass(\"bar__num\");
\t\t
\t\t\t\t\tjQuery(\"#";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-wishlist-count\").html(data.count);

\t\t\t\t}
\t\t\t\t\t
\t\t\t}
\t\t\t
\t\t});
\t\t
\t\t});
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/salewishlist.line/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 40,  117 => 38,  109 => 33,  105 => 32,  96 => 25,  93 => 24,  87 => 14,  81 => 12,  77 => 10,  75 => 9,  69 => 7,  66 => 6,  60 => 51,  57 => 50,  54 => 24,  51 => 23,  49 => 22,  46 => 21,  42 => 19,  40 => 18,  37 => 17,  35 => 6,  32 => 5,  26 => 3,  24 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/salewishlist.line/default.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/salewishlist.line/default.twig");
    }
}

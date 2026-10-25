<?php

/* @widget/list/slider.twig */
class __TwigTemplate_17c3dd6d4ef4d69fa472139b1d33bf548713eacda8c5feb6a66a5860ad112f80 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 2
            echo "\t\t\t";
            if ($this->getAttribute($context["m"], "name", array())) {
                // line 3
                echo " 
 <div class=\"row\">
        <div class=\"large-16 columns large-centered\">
            <h5 class=\"individual\">";
                // line 6
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
                echo "</h5>
        </div>
        </div>\t\t\t
\t\t\t
\t\t\t";
            }
            // line 10
            echo "\t\t\t
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "<div class=\"row\">
<div class=\"small-24 medium-centered column\">\t\t
<div class=\"carousel-about carousel-main\">
\t";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            echo "\t\t  
\t\t  <div class=\"carousel-main__item\">
\t\t\t<img src=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"\">
\t\t  </div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "\t  
</div></div>
</div>
<div class=\"row\">
\t<div class=\"column small-24 medium-18 large-16 medium-centered\">
\t\t<div class=\"text-about\">
\t\t\t";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 26
            echo "\t\t\t\t";
            echo $this->getAttribute($context["m"], "text", array());
            echo "
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "\t\t</div>
\t</div>
</div>

";
    }

    public function getTemplateName()
    {
        return "@widget/list/slider.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 28,  80 => 26,  76 => 25,  68 => 19,  59 => 17,  52 => 15,  47 => 12,  40 => 10,  32 => 6,  27 => 3,  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/slider.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/list/slider.twig");
    }
}

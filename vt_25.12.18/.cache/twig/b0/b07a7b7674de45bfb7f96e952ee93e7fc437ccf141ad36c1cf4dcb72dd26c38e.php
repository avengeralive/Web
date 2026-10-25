<?php

/* @widget/list/slider.twig */
class __TwigTemplate_9914408bbbffe76f3e1346fdde2f84bfcf114bc9d9757137da5ba5a58e6952aa extends Twig_Template
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

        <div class=\"large-16 columns large-centered\">
\t\t\t\t<h5 class=\"individual\">";
                // line 6
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
                echo "</h5>
\t\t</div>\t\t
\t\t\t
\t\t\t";
            }
            // line 9
            echo "\t\t\t
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "<div class=\"row\">
<div class=\"small-24 medium-centered column\">\t\t
<div class=\"carousel-about carousel-main\">
\t";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            echo "\t\t  
\t\t  <div class=\"carousel-main__item\">
\t\t\t<img src=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"\">
\t\t  </div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "\t  
</div></div>
</div>
<div class=\"row\">
\t<div class=\"column small-24 medium-18 large-16 medium-centered\">
\t\t<div class=\"text-about\">
\t\t\t";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 25
            echo "\t\t\t\t";
            echo $this->getAttribute($context["m"], "text", array());
            echo "
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
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
        return array (  88 => 27,  79 => 25,  75 => 24,  67 => 18,  58 => 16,  51 => 14,  46 => 11,  39 => 9,  32 => 6,  27 => 3,  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/slider.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/list/slider.twig");
    }
}

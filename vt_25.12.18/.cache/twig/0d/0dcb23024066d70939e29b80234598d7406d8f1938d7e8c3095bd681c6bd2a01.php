<?php

/* @widget/list/main_slider.twig */
class __TwigTemplate_b569f4ceb1d1d6eccbea6950f7275590e8bd932b22097f2590ebd55fd51f9ed4 extends Twig_Template
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
        echo "<div class=\"necklace\" id=\"somethingTop\">

";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 4
            echo "
<div class=\"necklace__slide\">
  <a href=\"#\"> <img src=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"\"></a>
</div>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo " </div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/main_slider.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 10,  31 => 6,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_slider.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/list/main_slider.twig");
    }
}

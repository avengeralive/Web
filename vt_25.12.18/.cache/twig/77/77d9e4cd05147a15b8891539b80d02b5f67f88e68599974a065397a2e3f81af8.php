<?php

/* @widget/list/slider-gallery-star-clients.twig */
class __TwigTemplate_8a6986140d1908f50b9b9a398f5ef3ddec6dcfbe7e02bd006d8666565a5d33ff extends Twig_Template
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
        echo "
<div class=\"row columns\">
\t<hr class=\"individual-hr\" style=\"margin-top: 40px !important;\">
\t<h4 class=\"individual\" style=\"margin-left: 0px;\"><a href=\"/stars/\">Звёздные клиенты</a></h4>
\t<div class=\"small-24 large-16 columns large-centered\" style=\"width: 1025px; max-width: 100%;\">
        <div class=\"star-clients__slider\">

\t\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 9
            echo "\t\t\t\t\t<div class=\"chain text-center\">
\t\t\t\t\t  <a class=\"tap\" href=\"/stars/";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "alias", array()), "html", null, true);
            echo "?id=";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "star_logo", array()), "html", null, true);
            echo "\" style=\"display:block;
  margin: auto;\" alt=\"\"></a><br>
\t\t\t\t\t  <a href=\"/stars/?id=";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\"><p>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</p></a>
\t\t\t\t\t</div>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/slider-gallery-star-clients.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 15,  44 => 12,  35 => 10,  32 => 9,  28 => 8,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/slider-gallery-star-clients.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/list/slider-gallery-star-clients.twig");
    }
}

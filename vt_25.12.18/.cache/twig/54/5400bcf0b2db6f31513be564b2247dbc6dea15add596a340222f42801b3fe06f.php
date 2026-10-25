<?php

/* @widget/list/delivery_list.twig */
class __TwigTemplate_7a2760d4c65e4109f8067ab59707f173a21a85c3a7973be725dccb1c402b325e extends Twig_Template
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
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 3
            echo "
<div class=\"row\">
\t\t<div class=\"large-16 columns large-centered\">
\t\t\t\t<h5 class=\"individual\" style=\"margin-bottom: 0px !important;\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</h5>
\t\t</div>
<div class=\"columns\">
\t<hr class=\"individual-hr\">
</div>

<div class=\"large-16 columns large-centered\">

";
            // line 14
            echo $this->getAttribute($context["m"], "text", array());
            echo "

</div>
</div>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@widget/list/delivery_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 14,  31 => 6,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/delivery_list.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/list/delivery_list.twig");
    }
}

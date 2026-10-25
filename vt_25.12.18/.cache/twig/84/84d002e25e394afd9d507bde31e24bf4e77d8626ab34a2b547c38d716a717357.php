<?php

/* @widget/list/contacts-worktime-list.twig */
class __TwigTemplate_5015bd97db4916555e7f0e201b3ca3e507ec28de7b87c6c5e602e5b75a9c1bf5 extends Twig_Template
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
<div class=\"row column contacts__schedule\"><br>
<h4 class=\"contacts__schedule-title\"><strong>";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
        echo "</strong></h4>
<p class=\"contacts__schedule-desc\">
";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()), "orderBy", array(0 => "tag"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 6
            echo "
    ";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "day", array()), "html", null, true);
            echo "<br>
    ";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "time", array()), "html", null, true);
            echo "<br>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/contacts-worktime-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 11,  39 => 8,  35 => 7,  32 => 6,  28 => 5,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/contacts-worktime-list.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/list/contacts-worktime-list.twig");
    }
}

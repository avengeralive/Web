<?php

/* @widget/list/stars-collections_list.twig */
class __TwigTemplate_ab5bf17ca2c6b3c92d4faefa775a0810c4f52f3e46720c3e7fc178c572cb76ec extends Twig_Template
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
        echo "    <div class=\"row large-up-2 medium-up-2 small-up-1\">
\t\t";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 3
            echo "\t\t\t  <div class=\"column\">
\t\t\t\t<div class=\"product\">
\t\t\t\t  <div class=\"chain chain_collection\">
\t\t\t\t  </div><a class=\"product__title\" href=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\">
          <strong>";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</strong></a>
\t\t\t\t  <div class=\"product__img\"><a href=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"\"></a></div>
\t\t\t\t</div>
\t\t\t  </div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "\t</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/stars-collections_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 12,  39 => 8,  35 => 7,  31 => 6,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/stars-collections_list.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/list/stars-collections_list.twig");
    }
}

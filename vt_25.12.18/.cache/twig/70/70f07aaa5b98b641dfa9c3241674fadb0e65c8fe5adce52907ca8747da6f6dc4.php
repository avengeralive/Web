<?php

/* @widget/list/main_sect.twig */
class __TwigTemplate_ff8320d4b0d71f7442a41bcf7e820ba7b31735e5ceffbcbd3f2e9da1773a9536 extends Twig_Template
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
        echo "<div class=\"row large-up-3 medium-up-2 small-up-1 text-center medium-text-left\">
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 3
            echo "        <div class=\"column\">
          <div class=\"product\"><a class=\"product__title\" href=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\"><b>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</b></a>
            <div class=\"product__img\"><a href=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></div>
          </div>
        </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "@widget/list/main_sect.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 9,  35 => 5,  29 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_sect.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/list/main_sect.twig");
    }
}

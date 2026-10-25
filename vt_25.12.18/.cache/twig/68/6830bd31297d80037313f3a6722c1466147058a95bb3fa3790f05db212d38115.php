<?php

/* @widget/list/main_news.twig */
class __TwigTemplate_3448dccf347e3f8410e1b50cde5efc19825613a979d745d5c855867fe056eb3d extends Twig_Template
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
        echo "<div class=\"row columns\">
      <h4 class=\"individual\" style=\"margin-left: 0px;\"><a href=\"/about/stocks/\">Акции</a></h4>
    </div>
    <div class=\"row large-up-3 medium-up-3 small-up-1\" data-equalizer data-equalize-by-row=\"true\">
\t";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 6
            echo "      <div class=\"columns news\">
        <div data-equalizer-watch style=\"padding-bottom: 10px;\">
          <p style=\"margin-bottom: 10px;\">";
            // line 8
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["m"], "dat", array()), "d.m.Y"), "html", null, true);
            echo "</p>
          <p class=\"news__title\"><a href=\"/about/stocks/#act";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></p>
        </div>
        <a class=\"news__more\" href=\"/about/stocks/#act";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\">Подробнее</a>
        <hr>
      </div>
     ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/main_news.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 15,  44 => 11,  37 => 9,  33 => 8,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_news.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/list/main_news.twig");
    }
}

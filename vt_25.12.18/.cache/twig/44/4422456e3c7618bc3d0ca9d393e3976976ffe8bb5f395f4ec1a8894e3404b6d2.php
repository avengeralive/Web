<?php

/* @widget/list/stocks.twig */
class __TwigTemplate_4bbdc7dc48eda00c11a8cc247a76dfdf451b2fd3a1755e3ef6946f3e8b4b934a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/list/stocks.twig", 1)->display($context);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 4
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 5
            echo "  <div class=\"row stocksitem active\" id=\"act";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\">
      <div class=\"columns\">
        <div class=\"date\">
          ";
            // line 8
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["m"], "dat", array()), "d.m.Y"), "html", null, true);
            echo "
        </div>
        <div class=\"content\">
          <a class=\"news__more\" href=\"";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\" onclick=\"return false;\"><h4>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</h4></a>
          ";
            // line 12
            if (($this->getAttribute($context["m"], "pic", array()) != "")) {
                echo "<img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                echo "\">";
            }
            // line 13
            echo "          <div class=\"materialall\">";
            echo $this->getAttribute($context["m"], "text", array());
            echo "</div>
        </div>
      </div>
  </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "  \t
";
    }

    public function getTemplateName()
    {
        return "@widget/list/stocks.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 18,  61 => 13,  55 => 12,  49 => 11,  43 => 8,  36 => 5,  31 => 4,  25 => 3,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/stocks.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/list/stocks.twig");
    }
}

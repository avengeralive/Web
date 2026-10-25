<?php

/* @widget/list/contacts-route-list.twig */
class __TwigTemplate_95a8325c3c819e24b3a4b53c3a7368ee6c30e94bdfcf6590d2a1cf16dfbe8fe8 extends Twig_Template
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
    <div class=\"column contacts large-16 large-centered\">
\t\t<div class=\"row column\">
          <h4 class=\"contacts__scheme-travel-title\"><strong>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
        echo "</strong></h4>
        <div class='contacts__scheme-travel-decs'>
          ";
        // line 6
        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), 0, array(), "array"), "text", array());
        echo "
        </div>
\t\t</div>
  </div>

  <div class=\"row column contacts_map show-for-large\" style=\"width: 860px; margin: 0 auto;\"><script type=\"text/javascript\" charset=\"utf-8\" async src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), 0, array(), "array"), "map_large", array()), "html", null, true);
        echo "\"></script></div>

\t<div class=\"row column contacts_map show-for-medium-only\"><script type=\"text/javascript\" charset=\"utf-8\" async src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), 0, array(), "array"), "map_medium", array()), "html", null, true);
        echo "\"></script></div>

\t<div class=\"row column contacts_map show-for-small-only\"><script type=\"text/javascript\" charset=\"utf-8\" async src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), 0, array(), "array"), "map_small", array()), "html", null, true);
        echo "\"></script></div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/contacts-route-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 15,  42 => 13,  37 => 11,  29 => 6,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/contacts-route-list.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/list/contacts-route-list.twig");
    }
}

<?php

/* @widget/list/contacts-list.twig */
class __TwigTemplate_8886ee944d1402d5ffe194a36fc1e9d57eab0bbef8c25ae4fba8e7ecbb7d505a extends Twig_Template
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
        echo "<div class=\"row column\">
  <h4 class=\"contacts__our-managers-title\"><strong>";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
        echo "</strong></h4>
<div class=\"row\">
<div class=\"large-19 large-centered columns\">

";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()), "orderBy", array(0 => "tag"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 7
            echo "<div class=\"media-object\">
  <div class=\"media-object-section\">
    <div class=\"thumbnail\"><img src=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\" height=\"100\" width=\"100\"></div>
  </div>
  <div class=\"media-object-section\">
    <h4 class=\"media-object-section__title\">";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</h4>
    ";
            // line 13
            echo $this->getAttribute($context["m"], "text", array());
            echo "
  </div>
</div>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "


</div>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/contacts-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 18,  49 => 13,  45 => 12,  37 => 9,  33 => 7,  29 => 6,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/contacts-list.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/list/contacts-list.twig");
    }
}

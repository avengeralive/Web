<?php

/* @widget/list/faq.twig */
class __TwigTemplate_3c1cf10f3db56a3cb442dd2566c1ad364c93a1de3aea5f35f901c4c9fdcc7415 extends Twig_Template
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
<div class=\"large-16 columns large-centered\">
    <ul class=\"accordion amber\" data-accordion=\"\" data-allow-all-closed=\"true\" data-multi-expand=\"true\">

";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getChildren", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["q"]) {
            // line 6
            echo "<!-- ВОПРОС! -->
<li class=\"accordion-item\" data-accordion-item=\"\">
<a class=\"accordion-title\" href=\"#\">
  ";
            // line 10
            echo "  ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["q"], "name", array()), "html", null, true);
            echo "

</a>
    <div class=\"accordion-content\" data-tab-content=\"\">
        <div class=\"row\">
            <div class=\"large-18 large-offset-6 columns\">
              ";
            // line 17
            echo "              ";
            echo $this->getAttribute($context["q"], "text", array());
            echo "

            </div>
        </div>
    </div>
</li>
<!-- ВОПРОС! -->

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['q'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "

    </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/faq.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 26,  44 => 17,  34 => 10,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/faq.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/list/faq.twig");
    }
}

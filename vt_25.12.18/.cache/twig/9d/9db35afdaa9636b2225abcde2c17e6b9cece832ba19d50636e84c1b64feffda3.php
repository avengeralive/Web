<?php

/* @widget/forms/default.twig */
class __TwigTemplate_2f4793cc26e3c87fad102e0264ed1f2ad20d088334dc989ec80a6a08cbb8cb6f extends Twig_Template
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
        echo "<form id=\"form";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "formID", array()), "html", null, true);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" action=\"#form";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "formID", array()), "html", null, true);
        echo "\">
    <input type=\"hidden\" name=\"webform\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "formID", array()), "html", null, true);
        echo "\" />
    ";
        // line 3
        echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "formHTML", array());
        echo "
</form>";
    }

    public function getTemplateName()
    {
        return "@widget/forms/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 3,  26 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/forms/default.twig", "/home/velvetin/velvetin.ru/docs/plugins/forms/widgets/forms/default.twig");
    }
}

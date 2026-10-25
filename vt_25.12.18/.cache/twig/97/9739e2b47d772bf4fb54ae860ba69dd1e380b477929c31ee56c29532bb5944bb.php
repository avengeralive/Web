<?php

/* page_calculation.twig */
class __TwigTemplate_c9244126a51655fe685911063ed4e471e1129af196c6f72ae9ceb20000d2e176 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_calculation.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
      <div class=\"large-20 large-offset-4 columns\">
        <h5 class=\"individual\">";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h5>
      </div>
    </div>
    <div class=\"row column\"
      <div class=\"content\">
\t";
        // line 11
        try {
            \Cetera\Application::getInstance()->getWidget("forms", array("form" => 1))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 12
        echo "\t</div>
\t</div>


";
    }

    public function getTemplateName()
    {
        return "page_calculation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 12,  42 => 11,  34 => 6,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_calculation.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/design/page_calculation.twig");
    }
}

<?php

/* page_stocks.twig */
class __TwigTemplate_948626c6198793283516b65bbdf20adee46841e509dc277f6ddd2cbc5dd8e67e extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_stocks.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"row\">
\t<div class=\"large-16 columns large-centered\">
        <h5 class=\"individual\" style=\"margin-bottom: 0px !important;\">Акции</h5>
    </div>
      <div class=\"columns\">
  <hr class=\"individual-hr\" style=\"margin-bottom: 0px !important;\">
</div>
      <div class=\"large-16 columns large-centered text-center stocks\">
        ";
        // line 13
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "stocks.twig", "catalog" => 477))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 14
        echo "      </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "page_stocks.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 14,  41 => 13,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_stocks.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_stocks.twig");
    }
}

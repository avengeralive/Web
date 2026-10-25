<?php

/* page_order.twig */
class __TwigTemplate_3a696dfcf5de0f20e74ec5c767e08d8db4a4ac746756c02c1ce40144f6a448fe extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_order.twig", 1);
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
\t<div class=\"content\">
\t";
        // line 6
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Order", array("catalog_url" => "/catalog/"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 7
        echo "\t</div>
\t
";
    }

    public function getTemplateName()
    {
        return "page_order.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 7,  34 => 6,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_order.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/design/page_order.twig");
    }
}

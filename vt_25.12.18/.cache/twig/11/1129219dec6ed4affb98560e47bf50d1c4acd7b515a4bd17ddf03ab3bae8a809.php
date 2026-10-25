<?php

/* page_news.twig */
class __TwigTemplate_6a5f4548557b6e5300a2587d8319511bf3982e9c1728132933c6b6da39144869 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_news.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        echo "  

    <div class=\"row column\">
       ";
        // line 6
        try {
            \Cetera\Application::getInstance()->getWidget("Breadcrumbs", array())->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 7
        echo "    </div>
\t\t
\t<div class=\"row column\">
        ";
        // line 10
        try {
            \Cetera\Application::getInstance()->getWidget("Section", array("list_template" => "tiles.twig", "list_limit" => 6, "material_share_buttons" => 1))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 11
        echo "    </div>\t
             
";
    }

    public function getTemplateName()
    {
        return "page_news.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 11,  46 => 10,  41 => 7,  34 => 6,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_news.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_news.twig");
    }
}

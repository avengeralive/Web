<?php

/* page_star-collections.twig */
class __TwigTemplate_a4f304c5518a5470478bd75215040d5ffc21b333852e3a9d4b3169fd3afd17b0 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_star-collections.twig", 1);
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



\t";
        // line 8
        try {
            \Cetera\Application::getInstance()->getWidget("Section", array("template" => "star_collections.twig", "material_template" => "stars_material.twig", "list_template" => "stars_list.twig"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 9
        echo "

";
    }

    public function getTemplateName()
    {
        return "page_star-collections.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 9,  36 => 8,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_star-collections.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/design/page_star-collections.twig");
    }
}

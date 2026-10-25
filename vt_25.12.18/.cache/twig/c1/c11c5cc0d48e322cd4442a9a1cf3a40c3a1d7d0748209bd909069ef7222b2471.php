<?php

/* page_catalog_server1.twig */
class __TwigTemplate_46c0c293bd97a92c7064d6f13de30ba01354c968ecd23b8321fd4126320553b4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout_server1.twig", "page_catalog_server1.twig", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout_server1.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_main($context, array $blocks = array())
    {
        // line 5
        echo "<style>footer { padding-top: 100px !important; } .individual-hr, .news hr { margin-top: 25px; margin-bottom: 25px; } footer .individual-hr { margin-top: 0px; margin-bottom: 20px; }</style>
\t
\t<div class=\"row dptc\">
\t";
        // line 8
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Catalog", array("product_catalog" =>             // line 9
(isset($context["product_catalog"]) ? $context["product_catalog"] : $this->getContext($context, "product_catalog")), "filter" => 1, "list_limit" => 12, "item_show_properties" => "code,brand", "item_show_tabs" => array(0 => array("field" => "text"), 1 => array("page" => call_user_func_array($this->env->getFunction('_')->getCallable(), array("Характеристики"))))))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 24
        echo "\t</div>
\t
";
    }

    public function getTemplateName()
    {
        return "page_catalog_server1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 24,  38 => 9,  36 => 8,  31 => 5,  28 => 4,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_catalog_server1.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_catalog_server1.twig");
    }
}

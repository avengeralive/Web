<?php

/* page_metals_stones.twig */
class __TwigTemplate_60af903f458b0cfac88949f66b0c900cca1fd734af3d8fd52c6d0c61661988f8 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_metals_stones.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "  <div class=\"row column\">
    <div class='column small-24 medium-18 large-16 medium-centered'>
      <div class='text-about'>
      ";
        // line 6
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "metals_stones_list.twig", "catalog" => 488))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 7
        echo "      </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "page_metals_stones.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 7,  35 => 6,  30 => 3,  27 => 2,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_metals_stones.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/design/page_metals_stones.twig");
    }
}

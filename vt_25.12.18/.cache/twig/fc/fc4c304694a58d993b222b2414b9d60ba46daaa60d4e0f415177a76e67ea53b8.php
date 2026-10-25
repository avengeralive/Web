<?php

/* page_stars_clients.twig */
class __TwigTemplate_d650e2569d19967125f41ddb8c5bc8102d50285229e0ac2c1a3087256532f844 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_stars_clients.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<style>footer { padding-top: 60px !important; }</style>
<div class=\"row\">

    <div class=\"large-16 columns large-centered\">
        <h5 class=\"individual\" style=\"margin-bottom: 0px !important;\">";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h5>
    </div>
    <div class=\"columns\">
  <hr class=\"individual-hr\">
</div>
    

    <div class='row'>
      <div class=\"large-19 columns large-centered text-center sclients\">
        ";
        // line 17
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "stars_clients_list.twig", "catalog" => 498))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 18
        echo "      </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "page_stars_clients.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 18,  48 => 17,  36 => 8,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_stars_clients.twig", "/usr/www/users/alivel/velvetin/themes/shop/design/page_stars_clients.twig");
    }
}

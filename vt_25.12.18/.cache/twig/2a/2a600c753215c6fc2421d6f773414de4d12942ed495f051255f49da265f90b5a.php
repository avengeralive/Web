<?php

/* page_mass_media.twig */
class __TwigTemplate_939901821b635729518e102e065522f861022fc2aea5c62570e556a8b3164ee1 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_mass_media.twig", 1);
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
        <h5 class=\"individual\" style=\"margin-bottom: 0px !important;\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h5>
    </div>
      <div class=\"columns\">
  <hr class=\"individual-hr\" style=\"margin-bottom: 0px !important;\">
</div>


      <div class=\"large-16 columns large-centered text-center stocks\">
        ";
        // line 15
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "template" => "mass_media.twig", "catalog" => 478, "limit" => 4, "paginator" => 1, "paginator_template" => "default.twig"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 16
        echo "      </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "page_mass_media.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 16,  46 => 15,  35 => 7,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_mass_media.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_mass_media.twig");
    }
}

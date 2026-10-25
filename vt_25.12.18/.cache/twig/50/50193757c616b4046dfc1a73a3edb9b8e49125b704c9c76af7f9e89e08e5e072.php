<?php

/* page_stocks.twig */
class __TwigTemplate_851ae51de90d7a591b878b57180b98958cef1b28818384c1f1155c5d20a21820 extends Twig_Template
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
<div class=\"row columns large-centered\">
\t<div class=\"large-24\">
        <h4 class=\"individual\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h4>
        <hr>
        </div>
      </div>
    

    <div class='row'>
      <div class=\"large-19 columns large-centered text-center stocks\">
        ";
        // line 15
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "stocks.twig", "catalog" => 477))->display();
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
        return "page_stocks.twig";
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
        return new Twig_Source("", "page_stocks.twig", "/usr/www/users/alivel/velvetin/themes/shop/design/page_stocks.twig");
    }
}

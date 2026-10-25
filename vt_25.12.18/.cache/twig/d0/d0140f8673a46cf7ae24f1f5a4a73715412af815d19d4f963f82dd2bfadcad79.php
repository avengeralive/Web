<?php

/* page_sitemap.twig */
class __TwigTemplate_931c7bea2b2107c272ba9de87c02a2d6f12186d3a4922db337f8e19084d9dc0a extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_sitemap.twig", 1);
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


\t    <div class=\"row\">
        <div class=\"large-16 columns large-centered\">
            <h5><b>";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</b></h5>
        </div>
\t\t<div class=\"columns\">
\t\t\t<hr>
\t\t\t<p></p>
\t\t</div>


\t\t<div class=\"large-16 columns large-centered\">

\t\t\t";
        // line 19
        try {
            \Cetera\Application::getInstance()->getWidget("Menu", array("catalog" => (isset($context["server"]) ? $context["server"] : $this->getContext($context, "server")), "css_class" => "emerald", "css_class_submenu" => "emerald", "template" => "sitemap.twig", "depth" => 3))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 20
        echo "
\t\t</div>

\t</div>

";
    }

    public function getTemplateName()
    {
        return "page_sitemap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 20,  50 => 19,  37 => 9,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_sitemap.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/design/page_sitemap.twig");
    }
}

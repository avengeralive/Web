<?php

/* page_blog.twig */
class __TwigTemplate_f09e767bfd508118937cae1845ba3c750c452a1c90fccc3c81d3010ef3d7c5d4 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_blog.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "  <div class=\"row\">
\t\t<div class=\"large-16 columns large-centered\">
\t\t\t\t<h5 class=\"individual\" style=\"margin-bottom: 0px !important;\">Блог</h5>
\t\t</div>
<div class=\"columns\">
\t<hr class=\"individual-hr\">
</div>

<div class=\"large-16 columns large-centered\">

<p>Страница в разработке.</p>

</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "page_blog.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_blog.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/design/page_blog.twig");
    }
}

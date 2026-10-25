<?php

/* page_404.twig */
class __TwigTemplate_6275121325e1ede859c2dcaa83770e68939588de29eaf3314142fc92763e13c8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("@widget/_common/page404.twig", "page_404.twig", 1)->display($context);
    }

    public function getTemplateName()
    {
        return "page_404.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_404.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/design/page_404.twig");
    }
}

<?php

/* page_cart.twig */
class __TwigTemplate_01aa9e5ee67af33dc21855ab6a51029b64ce4a8b2511d96bdf7ed14efe453a20 extends Twig_Template
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
        return $this->loadTemplate((isset($context["personal"]) ? $context["personal"] : $this->getContext($context, "personal")), "page_cart.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    public function block_main($context, array $blocks = array())
    {
        // line 9
        echo "
\t\t";
        // line 10
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Cart", array("catalog_url" => "/catalog/"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        echo "\t

";
    }

    public function getTemplateName()
    {
        return "page_cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 10,  30 => 9,  27 => 8,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_cart.twig", "/usr/www/users/alivel/velvetin/themes/shop/design/page_cart.twig");
    }
}

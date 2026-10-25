<?php

/* page_personal_wishlist.twig */
class __TwigTemplate_1f86a43f5a3acb90973b61b39333e46af2e92eb7a54c00509f80ee1bc2eb7784 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'personal_content' => array($this, 'block_personal_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["personal"]) ? $context["personal"] : $this->getContext($context, "personal")), "page_personal_wishlist.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_personal_content($context, array $blocks = array())
    {
        // line 4
        echo "
\t";
        // line 5
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Wish.List", array("widgetTitle" => (("<h2>" . call_user_func_array($this->env->getFunction('_')->getCallable(), array("Любимые товары"))) . "</h2>")))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 6
        echo "\t
";
    }

    public function getTemplateName()
    {
        return "page_personal_wishlist.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 6,  33 => 5,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_personal_wishlist.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/design/page_personal_wishlist.twig");
    }
}

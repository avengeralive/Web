<?php

/* page_personal.twig */
class __TwigTemplate_0a9a35a46eda25a693ee2206e1238965e9530a05a79ef4d26fa903aac178346c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'personal_content' => array($this, 'block_personal_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_personal.twig", 1);
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
<div class='row favorites-products'>
<div class='columns'>

<h4> <b>Избранные изделия</b> </h4>
</div>
</div>


";
        // line 13
        $this->displayBlock('personal_content', $context, $blocks);
        // line 16
        echo "
";
    }

    // line 13
    public function block_personal_content($context, array $blocks = array())
    {
        // line 14
        echo "\t\t\t";
        try {
            \Cetera\Application::getInstance()->getWidget("User.Profile.Edit", array("widgetTitle" => (("<h2>" . call_user_func_array($this->env->getFunction('_')->getCallable(), array("Личные данные"))) . "</h2>"), "change_login" => 1, "change_password" => 1))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

    }

    public function getTemplateName()
    {
        return "page_personal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 14,  49 => 13,  44 => 16,  42 => 13,  31 => 4,  28 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_personal.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_personal.twig");
    }
}

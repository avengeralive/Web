<?php

/* page_search_server1.twig */
class __TwigTemplate_5bb617aa4d1bd72ae02a626a4a23bac8cce0026ce89675fd0df35b5dc66348ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_search_server1.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Поиск")), "html", null, true);
    }

    // line 5
    public function block_main($context, array $blocks = array())
    {
        // line 6
        echo "
<div class=\"row column\">
        ";
        // line 8
        try {
            \Cetera\Application::getInstance()->getWidget("VjcSearch", array("morphology" => 1, "min_length" => 2, "fields" => "code, name, text, short", "type" => array(0 => (isset($context["products_type"]) ? $context["products_type"] : $this->getContext($context, "products_type")), 1 => 1, 2 => 15, 3 => 16, 4 => 12, 5 => 17, 6 => 13)))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 9
        echo "</div>

";
    }

    public function getTemplateName()
    {
        return "page_search_server1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 9,  41 => 8,  37 => 6,  34 => 5,  28 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_search_server1.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/design/page_search_server1.twig");
    }
}

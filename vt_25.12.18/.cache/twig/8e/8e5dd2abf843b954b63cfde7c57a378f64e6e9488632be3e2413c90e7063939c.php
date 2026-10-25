<?php

/* page_faq.twig */
class __TwigTemplate_d6b1cc290d7cc0eb00e24cba0eed2cfa168a9fcac6b2764ff22c7c5d3d24d55d extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_faq.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
        <div class=\"large-16 columns large-centered\">
            <h5 class=\"individual\">";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h5>
        </div>
        <div class=\"columns\">
            <hr class=\"individual-hr\">
        </div>

        ";
        // line 12
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "faq.twig", "catalog" => 474))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 13
        echo "
        <div class=\"columns\">
            <hr class=\"individual-hr\"/>
        </div>
    </div>

    <div class=\"row column\">
        <div class=\"large-16 large-centered columns\">
            <h5><strong>Нет нужного ответа?&nbsp;</strong>Задайте свой вопрос</h5>
        </div>

        <div class=\"large-17 large-centered columns\">
            ";
        // line 25
        try {
            \Cetera\Application::getInstance()->getWidget("forms", array("form" => 2))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 26
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "page_faq.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 26,  64 => 25,  50 => 13,  43 => 12,  34 => 6,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_faq.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/design/page_faq.twig");
    }
}

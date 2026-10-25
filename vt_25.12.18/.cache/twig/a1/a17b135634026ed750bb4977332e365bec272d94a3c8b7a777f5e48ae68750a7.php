<?php

/* page_faq.twig */
class __TwigTemplate_a5f2f5a047157a280e8e2847d2908216054f26e16ef4e51ca10b60c4556608d5 extends Twig_Template
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
        echo "    <style>.contacts__contact-us-title { display: none; }
    @media (min-width: 900px) { #form2, .contcc { width: 900px; } 
        .end img {
            margin-top: 10px !important; 
            margin-bottom: 10px !important;
        }
    }
    </style>

    <div class=\"row\">
        <div class=\"large-16 columns large-centered\">
            <h5 class=\"individual\">";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "name", array()), "html", null, true);
        echo "</h5>
        </div>
        <div class=\"columns\">
            <hr class=\"individual-hr\" style=\"margin-top: 0px;\">
        </div>

        ";
        // line 21
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "faq.twig", "catalog" => 474))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 22
        echo "
        <div class=\"columns\">
            <hr class=\"individual-hr\"/>
        </div>
    </div>

    <div class=\"row column\">
        <div class=\"large-16 large-centered columns contcc\" style=\"padding: 15px 20px;\">
            <h5><strong>Нет нужного ответа?&nbsp;</strong>Задайте свой вопрос</h5>
        </div>

        <div class=\"large-16 large-centered columns contcc\" style=\"padding: 0px;\">
            ";
        // line 34
        try {
            \Cetera\Application::getInstance()->getWidget("forms", array("form" => 2))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 35
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
        return array (  80 => 35,  73 => 34,  59 => 22,  52 => 21,  43 => 15,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_faq.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_faq.twig");
    }
}

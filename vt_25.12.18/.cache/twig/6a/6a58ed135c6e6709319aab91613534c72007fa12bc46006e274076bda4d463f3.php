<?php

/* page_index.twig */
class __TwigTemplate_0c99ca7ce67160e5caa2929131763b6feed374fe39384aa7b12198dda581a247 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout_server1.twig", "page_index.twig", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout_server1.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<style>footer { padding-top: 100px !important; } .individual-hr, .news hr { margin-top: 40px; margin-bottom: 40px; } footer .individual-hr { margin-top: 0px; margin-bottom: 20px; } .row+p{ margin-bottom: 15px !important; }</style>
";
        // line 5
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("limit" => 6, "template" => "main_sect.twig", "iterator" => $this->getAttribute($this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "getById", array(0 => 465), "method"), "getChildren", array(), "method")))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 6
        echo $this->getAttribute($this->getAttribute((isset($context["application"]) ? $context["application"] : $this->getContext($context, "application")), "getWidget", array(0 => "area"), "method"), "getHtml", array(), "method");
        echo "

 ";
        // line 9
        echo "
";
        // line 10
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("template" => "slider-gallery-star-clients.twig", "iterator" => $this->getAttribute($this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "getById", array(0 => 498), "method"), "getMaterials", array(), "method")))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 11
        echo "

    <div class=\"row columns\">
      <hr class=\"individual-hr\">
    </div>

     ";
        // line 17
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("limit" => 3, "template" => "main_news.twig", "order" => "dat", "sort" => "DESC", "catalog" => 477))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 19
        echo "

";
    }

    public function getTemplateName()
    {
        return "page_index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 19,  64 => 17,  56 => 11,  49 => 10,  46 => 9,  41 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_index.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/design/page_index.twig");
    }
}

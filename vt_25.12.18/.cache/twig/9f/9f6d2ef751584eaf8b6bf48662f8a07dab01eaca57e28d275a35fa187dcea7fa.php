<?php

/* @widget/section/star_collections.twig */
class __TwigTemplate_9c91704ee96a548b3cf491bdf6c9f423a6a53228de8ed3c45fdf190460aaae47 extends Twig_Template
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
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error404", array())) {
            // line 2
            echo "
\t";
            // line 3
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "page404_template"), "method")) {
                // line 4
                echo "\t\t";
                $this->loadTemplate($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "page404_template"), "method"), "@widget/section/star_collections.twig", 4)->display($context);
                // line 5
                echo "\t";
            } else {
                // line 6
                echo "\t\t<div class=\"content\">
\t\t\t";
                // line 7
                $this->loadTemplate("@widget/_common/page404.twig", "@widget/section/star_collections.twig", 7)->display($context);
                // line 8
                echo "\t\t</div>
\t";
            }
            // line 9
            echo "\t

";
        } elseif ($this->getAttribute(        // line 11
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array())) {
            // line 12
            echo "
\t";
            // line 13
            try {
                \Cetera\Application::getInstance()->getWidget("Material", array("catalog" => $this->getAttribute($this->getAttribute(                // line 14
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "id", array()), "template" => "stars_material.twig", "material_id" => $this->getAttribute($this->getAttribute(                // line 16
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "share_buttons" => $this->getAttribute(                // line 17
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "material_share_buttons"), "method"), "show_pic" => $this->getAttribute(                // line 18
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "material_show_pic"), "method"), "show_meta" => $this->getAttribute(                // line 19
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_meta"), "method")))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 20
            echo "\t

";
        } else {
            // line 23
            echo "
\t";
            // line 24
            try {
                \Cetera\Application::getInstance()->getWidget("List", array("catalog" => $this->getAttribute($this->getAttribute(                // line 25
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "id", array()), "template" => "stars-collections_list.twig", "where" => $this->getAttribute(                // line 27
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_where"), "method"), "page" => $this->getAttribute(                // line 28
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_page"), "method"), "page_param" => $this->getAttribute(                // line 29
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_page_param"), "method"), "limit" => $this->getAttribute(                // line 30
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_limit"), "method"), "order" => $this->getAttribute(                // line 31
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_order"), "method"), "sort" => $this->getAttribute(                // line 32
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_sort"), "method"), "paginator" => $this->getAttribute(                // line 33
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_paginator"), "method"), "css_class" => $this->getAttribute(                // line 34
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_css_class"), "method"), "paginator_template" => $this->getAttribute(                // line 35
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator_template"), "method")))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 37
            echo "\t

";
        }
    }

    public function getTemplateName()
    {
        return "@widget/section/star_collections.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 37,  81 => 35,  80 => 34,  79 => 33,  78 => 32,  77 => 31,  76 => 30,  75 => 29,  74 => 28,  73 => 27,  72 => 25,  70 => 24,  67 => 23,  62 => 20,  56 => 19,  55 => 18,  54 => 17,  53 => 16,  52 => 14,  50 => 13,  47 => 12,  45 => 11,  41 => 9,  37 => 8,  35 => 7,  32 => 6,  29 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/section/star_collections.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/section/star_collections.twig");
    }
}

<?php

/* @widget/section/default.twig */
class __TwigTemplate_a4369153b30640b3ba79a8e71d84369a1907e1f68c7860f4c19f2631beb23422 extends Twig_Template
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
                $this->loadTemplate($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "page404_template"), "method"), "@widget/section/default.twig", 4)->display($context);
                // line 5
                echo "\t";
            } else {
                // line 6
                echo "\t\t<div class=\"content\">
\t\t\t";
                // line 7
                $this->loadTemplate("@widget/_common/page404.twig", "@widget/section/default.twig", 7)->display($context);
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
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "id", array()), "template" => $this->getAttribute(                // line 15
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "material_template"), "method"), "material_id" => $this->getAttribute($this->getAttribute(                // line 16
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
\t<h1>";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
            echo "</h1>

\t";
            // line 26
            try {
                \Cetera\Application::getInstance()->getWidget("List", array("catalog" => $this->getAttribute($this->getAttribute(                // line 27
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "id", array()), "template" => $this->getAttribute(                // line 28
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_template"), "method"), "where" => $this->getAttribute(                // line 29
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_where"), "method"), "page" => $this->getAttribute(                // line 30
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_page"), "method"), "page_param" => $this->getAttribute(                // line 31
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_page_param"), "method"), "limit" => $this->getAttribute(                // line 32
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_limit"), "method"), "order" => $this->getAttribute(                // line 33
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_order"), "method"), "sort" => $this->getAttribute(                // line 34
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_sort"), "method"), "paginator" => $this->getAttribute(                // line 35
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_paginator"), "method"), "css_class" => $this->getAttribute(                // line 36
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_css_class"), "method"), "paginator_template" => $this->getAttribute(                // line 37
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator_template"), "method")))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 38
            echo "\t
\t
";
        }
    }

    public function getTemplateName()
    {
        return "@widget/section/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 38,  88 => 37,  87 => 36,  86 => 35,  85 => 34,  84 => 33,  83 => 32,  82 => 31,  81 => 30,  80 => 29,  79 => 28,  78 => 27,  76 => 26,  71 => 24,  68 => 23,  63 => 20,  57 => 19,  56 => 18,  55 => 17,  54 => 16,  53 => 15,  52 => 14,  50 => 13,  47 => 12,  45 => 11,  41 => 9,  37 => 8,  35 => 7,  32 => 6,  29 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/section/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/section/default.twig");
    }
}

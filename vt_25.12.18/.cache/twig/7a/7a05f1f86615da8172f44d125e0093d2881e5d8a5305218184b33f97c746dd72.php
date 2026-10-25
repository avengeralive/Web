<?php

/* @widget/list/tiles.twig */
class __TwigTemplate_bf3d794c2647b0cc594fd7ff063b92fb6318a824b77d650879dace4ea908e2f0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@widget/list/default.twig", "@widget/list/tiles.twig", 1);
        $this->blocks = array(
            'html' => array($this, 'block_html'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@widget/list/default.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_html($context, array $blocks = array())
    {
        // line 4
        echo "
\t";
        // line 5
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 6
            echo "\t<div class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
            echo "\">

\t\t";
            // line 8
            if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array()) || $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "catalog_link"), "method"))) {
                // line 9
                echo "\t\t  <div class=\"row\">
\t\t\t<div class=\"small-12 medium-8 columns\">
\t\t\t  ";
                // line 11
                if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array())) {
                    echo "<h2>";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array()), "html", null, true);
                    echo "</h2>";
                }
                // line 12
                echo "\t\t\t</div>
\t\t\t<div class=\"small-12 medium-4 columns medium-text-right\">
\t\t\t\t";
                // line 14
                if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "catalog_link"), "method")) {
                    // line 15
                    echo "\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "url", array()), "html", null, true);
                    echo "\" class=\"button\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "catalog_link"), "method"), "html", null, true);
                    echo "&nbsp;<i class=\"fa fa-long-arrow-right\"></i></a>
\t\t\t\t";
                }
                // line 17
                echo "\t\t\t</div>
\t\t  </div>
\t\t ";
            }
            // line 20
            echo "
\t\t<div id=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper\">
\t";
        }
        // line 22
        echo "\t 

\t\t  <div data-equalizer=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "-eq\" data-equalize-by-row=\"true\" class=\"row ";
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_row"), "method")) {
            echo "small-up-1 medium-up-3 large-up-3";
        } else {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_row"), "method"), "html", null, true);
        }
        echo "\">
\t\t  ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 26
            echo "\t\t\t<div class=\"column\">
\t\t\t\t<div class=\"callout text-left\" data-equalizer-watch=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-eq\">
\t\t\t\t\t";
            // line 28
            if ($this->getAttribute($context["m"], "pic", array())) {
                // line 29
                echo "\t\t\t\t\t<p class=\"text-center\"><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
                echo "\"><img style=\"width:100%\" src=\"/imagetransform/width_600_height_338_fit_3";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
                echo "\"></a></p>
\t\t\t\t\t";
            }
            // line 31
            echo "\t\t\t\t\t<h4><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></h4>
\t\t\t\t\t";
            // line 32
            echo $this->getAttribute($context["m"], "short", array());
            echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "\t\t  </div>
\t\t  
\t\t  ";
        // line 38
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 39
            echo "\t\t  <div class=\"row column x-pages\">
\t\t\t";
            // line 40
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
\t\t  </div>
\t\t  ";
        }
        // line 43
        echo "\t\t  
\t";
        // line 44
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            echo "\t  \t\t  
\t\t</div>
\t\t 
\t</div>
\t 
\t";
        }
        // line 49
        echo "\t 

";
    }

    public function getTemplateName()
    {
        return "@widget/list/tiles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 49,  153 => 44,  150 => 43,  144 => 40,  141 => 39,  139 => 38,  135 => 36,  125 => 32,  118 => 31,  108 => 29,  106 => 28,  102 => 27,  99 => 26,  95 => 25,  85 => 24,  81 => 22,  76 => 21,  73 => 20,  68 => 17,  60 => 15,  58 => 14,  54 => 12,  48 => 11,  44 => 9,  42 => 8,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/tiles.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/list/tiles.twig");
    }
}

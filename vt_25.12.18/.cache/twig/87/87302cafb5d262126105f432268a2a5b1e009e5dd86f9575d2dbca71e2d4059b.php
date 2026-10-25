<?php

/* @widget/list/default.twig */
class __TwigTemplate_36ac31963abd4343c31a92ee4cb68a193b570f342e29ecfbfa7d0778dd59f53c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'script' => array($this, 'block_script'),
            'loading' => array($this, 'block_loading'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
        // line 40
        echo "
";
        // line 41
        $this->displayBlock('script', $context, $blocks);
    }

    // line 1
    public function block_html($context, array $blocks = array())
    {
        // line 2
        echo "
\t";
        // line 3
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 4
            echo "\t<div class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
            echo "\">
\t
\t\t";
            // line 6
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array());
            echo "

\t\t<div id=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-wrapper\">
\t";
        }
        // line 9
        echo "\t 

\t";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            echo "    
\t\t<div class=\"";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
            echo "__item ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_row"), "method"), "html", null, true);
            echo "\">
\t\t\t<a class=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
            echo "__link\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "
\t\t\t</a>
\t\t</div>    
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "
\t\t";
        // line 19
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 20
            echo "\t\t<div class=\"x-pages\">
\t\t\t";
            // line 21
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
\t\t</div>
\t\t";
        }
        // line 23
        echo "\t

\t";
        // line 25
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 26
            echo "
\t\t</div>";
            // line 27
            echo "\t\t
\t\t
\t\t";
            // line 29
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "catalog_link"), "method")) {
                // line 30
                echo "\t\t<div>
\t\t\t<a class=\"button hollow expanded\" href=\"";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "url", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "catalog_link"), "method"), "html", null, true);
                echo "</a>
\t\t</div>
\t\t";
            }
            // line 33
            echo "\t
\t\t
\t</div>
\t\t
\t";
        }
        // line 37
        echo "\t\t

";
    }

    // line 41
    public function block_script($context, array $blocks = array())
    {
        // line 42
        echo "\t";
        ob_start();
        $this->displayBlock('loading', $context, $blocks);
        $context["loading"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 43
        echo "\t";
        $this->loadTemplate("@widget/_common/ajax-paginator.twig", "@widget/list/default.twig", 43)->display(array_merge($context, array("loading" => (isset($context["loading"]) ? $context["loading"] : $this->getContext($context, "loading")))));
    }

    // line 42
    public function block_loading($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите ...")), "html", null, true);
    }

    public function getTemplateName()
    {
        return "@widget/list/default.twig";
    }

    public function getDebugInfo()
    {
        return array (  153 => 42,  148 => 43,  143 => 42,  140 => 41,  134 => 37,  127 => 33,  119 => 31,  116 => 30,  114 => 29,  110 => 27,  107 => 26,  105 => 25,  101 => 23,  95 => 21,  92 => 20,  90 => 19,  87 => 18,  77 => 14,  71 => 13,  65 => 12,  59 => 11,  55 => 9,  50 => 8,  45 => 6,  39 => 4,  37 => 3,  34 => 2,  31 => 1,  27 => 41,  24 => 40,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/list/default.twig");
    }
}

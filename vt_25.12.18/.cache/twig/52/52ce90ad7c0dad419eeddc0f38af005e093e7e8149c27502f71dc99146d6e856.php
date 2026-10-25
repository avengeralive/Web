<?php

/* @widget/menuuser/default.twig */
class __TwigTemplate_082bf948ecbbf89c99ba1a2c08cf3034aa77c4aa2f0b3ad4a53a15a5e15ca920 extends Twig_Template
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
        echo "<ul";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method")) {
            echo " class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
            echo "\"";
        }
        echo ">

\t";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 4
            echo "    
    <li";
            // line 5
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method")) {
                echo " class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
                echo "__item\"";
            }
            echo ">    
        <a href=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "url", array()), "html", null, true);
            echo "\"";
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method")) {
                echo " class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
                echo "__link\"";
            }
            echo ">";
            echo $this->getAttribute($context["c"], "name", array());
            echo "</a>        
    </li>
    
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "    
</ul>";
    }

    public function getTemplateName()
    {
        return "@widget/menuuser/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 10,  44 => 6,  36 => 5,  33 => 4,  29 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/menuuser/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/menuuser/default.twig");
    }
}

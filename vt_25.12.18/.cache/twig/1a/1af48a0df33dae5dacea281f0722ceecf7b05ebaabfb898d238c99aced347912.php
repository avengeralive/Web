<?php

/* @widget/paginator/default.twig */
class __TwigTemplate_10c6da84de3ddb101fc76050f5f5ca3e0d6e2a2a2c53aac05fd0eeb461c92b69 extends Twig_Template
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
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "hasPages", array(), "method")) {
            // line 2
            echo "
<ul class=\"pagination\" role=\"navigation\">

\t<li class=\"pagination-previous";
            // line 5
            if ((1 == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                echo " disabled";
            }
            echo "\">
\t\t";
            // line 6
            if ((1 == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                // line 7
                echo "\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Предыдущая")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span>
\t\t";
            } else {
                // line 9
                echo "\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPreviousPage", array(), "method")), "method"), "html", null, true);
                echo "\" data-page=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPreviousPage", array(), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Предыдущая")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span></a>
\t\t";
            }
            // line 11
            echo "\t</li>                                  
\t\t
\t";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                echo "\t
\t<li";
                // line 14
                if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                    echo " class=\"current\"";
                }
                echo ">
\t\t";
                // line 15
                if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                    // line 16
                    echo "\t\t\t<span class=\"show-for-sr\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "
\t\t";
                } else {
                    // line 18
                    echo "\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $context["i"]), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a>
\t\t";
                }
                // line 20
                echo "\t</li>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "\t\t
\t<li class=\"pagination-next";
            // line 23
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                echo " disabled";
            }
            echo "\">
\t\t";
            // line 24
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                // line 25
                echo "\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Следующая")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span>
\t\t";
            } else {
                // line 27
                echo "\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1)), "method"), "html", null, true);
                echo "\" data-page=\"";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Следующая")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span></a>
\t\t";
            }
            // line 29
            echo "\t</li>\t
\t
</ul>

";
        }
    }

    public function getTemplateName()
    {
        return "@widget/paginator/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 29,  116 => 27,  108 => 25,  106 => 24,  100 => 23,  97 => 22,  90 => 20,  80 => 18,  72 => 16,  70 => 15,  64 => 14,  58 => 13,  54 => 11,  42 => 9,  34 => 7,  32 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/paginator/default.twig", "/usr/www/users/alivel/velvetin/cms/widgets/paginator/default.twig");
    }
}

<?php

/* @widget/paginator/default.twig */
class __TwigTemplate_8fe44f620df54c44e53d6f3043f18cd1baae5d7ac7475949fce5984b1ed95450 extends Twig_Template
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
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("<")), "html", null, true);
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
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("<")), "html", null, true);
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
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") < 9)) {
                // line 14
                echo "\t\t
\t";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    echo "\t
\t<li";
                    // line 16
                    if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                        echo " class=\"current\"";
                    }
                    echo ">
\t\t";
                    // line 17
                    if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                        // line 18
                        echo "\t\t\t<span class=\"show-for-sr\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                        echo " </span>";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "
\t\t";
                    } else {
                        // line 20
                        echo "\t\t\t<a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $context["i"]), "method"), "html", null, true);
                        echo "\" data-page=\"";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "</a>
\t\t";
                    }
                    // line 22
                    echo "\t</li>\t\t
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 24
                echo "
\t";
            } else {
                // line 26
                echo "
\t";
                // line 27
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") > 3)) {
                    // line 28
                    echo "\t
\t<li>
\t\t<a href=\"";
                    // line 30
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t</li>\t
\t<li>
\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t</li>

\t";
                    // line 36
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), min(($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"))));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        echo "\t
\t<li";
                        // line 37
                        if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                            echo " class=\"current\"";
                        }
                        echo ">
\t\t";
                        // line 38
                        if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                            // line 39
                            echo "\t\t\t<span class=\"show-for-sr\">";
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                            echo " </span>";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "
\t\t";
                        } else {
                            // line 41
                            echo "\t\t\t<a href=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $context["i"]), "method"), "html", null, true);
                            echo "\" data-page=\"";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "</a>
\t\t";
                        }
                        // line 43
                        echo "\t</li>\t\t
\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 45
                    echo "
\t";
                    // line 46
                    if ((($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 2) < $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"))) {
                        // line 47
                        echo "\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t";
                    }
                    // line 51
                    echo "<li>
\t\t\t<a href=\"";
                    // line 52
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t";
                } else {
                    // line 56
                    echo "
\t";
                    // line 57
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1)));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        echo "\t
\t<li";
                        // line 58
                        if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                            echo " class=\"current\"";
                        }
                        echo ">
\t\t";
                        // line 59
                        if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                            // line 60
                            echo "\t\t\t<span class=\"show-for-sr\">";
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                            echo " </span>";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "
\t\t";
                        } else {
                            // line 62
                            echo "\t\t\t<a href=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $context["i"]), "method"), "html", null, true);
                            echo "\" data-page=\"";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                            echo "</a>
\t\t";
                        }
                        // line 64
                        echo "\t</li>\t\t
\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 66
                    echo "
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 71
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>


\t";
                }
                // line 76
                echo "
\t";
            }
            // line 78
            echo "\t\t
\t<li class=\"pagination-next";
            // line 79
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                echo " disabled";
            }
            echo "\">
\t\t";
            // line 80
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                // line 81
                echo "\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array(">")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span>
\t\t";
            } else {
                // line 83
                echo "\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1)), "method"), "html", null, true);
                echo "\" data-page=\"";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array(">")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span></a>
\t\t";
            }
            // line 85
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
        return array (  288 => 85,  276 => 83,  268 => 81,  266 => 80,  260 => 79,  257 => 78,  253 => 76,  241 => 71,  234 => 66,  227 => 64,  217 => 62,  209 => 60,  207 => 59,  201 => 58,  195 => 57,  192 => 56,  181 => 52,  178 => 51,  172 => 47,  170 => 46,  167 => 45,  160 => 43,  150 => 41,  142 => 39,  140 => 38,  134 => 37,  128 => 36,  115 => 30,  111 => 28,  109 => 27,  106 => 26,  102 => 24,  95 => 22,  85 => 20,  77 => 18,  75 => 17,  69 => 16,  63 => 15,  60 => 14,  58 => 13,  54 => 11,  42 => 9,  34 => 7,  32 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/paginator/default.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/paginator/default.twig");
    }
}

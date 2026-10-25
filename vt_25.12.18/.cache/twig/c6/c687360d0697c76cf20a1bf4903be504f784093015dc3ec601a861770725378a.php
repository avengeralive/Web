<?php

/* @widget/paginator/default.twig */
class __TwigTemplate_6b1beb06b9d937fa20cefa8cea80cc9d7db97ed66d9ac7e8b3f85a49f16b2024 extends Twig_Template
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
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= 6)) {
                // line 14
                echo "\t\t
\t\t";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 16
                    echo "\t\t<li";
                    if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                        echo " class=\"current\"";
                    }
                    echo ">
\t\t\t";
                    // line 17
                    if (($context["i"] == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                        // line 18
                        echo "\t\t\t\t<span class=\"show-for-sr\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                        echo " </span>";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "
\t\t\t";
                    } else {
                        // line 20
                        echo "\t\t\t\t<a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $context["i"]), "method"), "html", null, true);
                        echo "\" data-page=\"";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                        echo "</a>
\t\t\t";
                    }
                    // line 22
                    echo "\t\t</li>\t\t
\t\t";
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
\t\t";
                // line 27
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == 1)) {
                    // line 28
                    echo "
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 30
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo 1;
                    echo "
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 33
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 2), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 2;
                    echo "\">";
                    echo 2;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 43
                echo "
\t\t";
                // line 44
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == 2)) {
                    // line 45
                    echo "\t\t<li>
\t\t\t<a href=\"";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 49
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo 2;
                    echo "
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 52
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 3), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 3;
                    echo "\">";
                    echo 3;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 58
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 62
                echo "
\t\t";
                // line 63
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == 3)) {
                    // line 64
                    echo "
\t\t<li>
\t\t\t<a href=\"";
                    // line 66
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 69
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 2), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 2;
                    echo "\">";
                    echo 2;
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 72
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo 3;
                    echo "
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 75
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 4), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 4;
                    echo "\">";
                    echo 4;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 81
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>


\t\t";
                }
                // line 86
                echo "
\t\t";
                // line 87
                if ((($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") >= 4) && ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") < ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") - 2)))) {
                    // line 88
                    echo "\t\t
\t\t<li>
\t\t\t<a href=\"";
                    // line 90
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 96
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 99
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 102
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                    echo "</a>
\t\t</li>\t
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 108
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 112
                echo "
\t\t";
                // line 113
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") - 2))) {
                    // line 114
                    echo "
\t\t<li>
\t\t\t<a href=\"";
                    // line 116
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 122
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 125
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 128
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") + 1), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 131
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 135
                echo "
\t\t";
                // line 136
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") - 1))) {
                    // line 137
                    echo "
\t\t<li>
\t\t\t<a href=\"";
                    // line 139
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 145
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 148
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 151
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method")), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 155
                echo "
\t\t";
                // line 156
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method"))) {
                    // line 157
                    echo "
\t\t<li>
\t\t\t<a href=\"";
                    // line 159
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => 1), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo 1;
                    echo "\">";
                    echo 1;
                    echo "</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"\" onclick=\"return false;\">...</a>
\t\t</li>
\t\t<li>
\t\t\t<a href=\"";
                    // line 165
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUrl", array(0 => ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1)), "method"), "html", null, true);
                    echo "\" data-page=\"";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method") - 1), "html", null, true);
                    echo "</a>
\t\t</li>
\t\t<li class=\"current\">
\t\t\t<span class=\"show-for-sr\">";
                    // line 168
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы на странице")), "html", null, true);
                    echo " </span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"), "html", null, true);
                    echo "</a>
\t\t</li>

\t\t";
                }
                // line 172
                echo "
\t";
            }
            // line 174
            echo "
\t<li class=\"pagination-next";
            // line 175
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                echo " disabled";
            }
            echo "\">
\t\t";
            // line 176
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getPageCount", array(), "method") <= $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getIterator", array(), "method"), "getCurrentPageNumber", array(), "method"))) {
                // line 177
                echo "\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array(">")), "html", null, true);
                echo "<span class=\"show-for-sr\"> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("страница")), "html", null, true);
                echo "</span>
\t\t";
            } else {
                // line 179
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
            // line 181
            echo "\t</li>
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
        return array (  510 => 181,  498 => 179,  490 => 177,  488 => 176,  482 => 175,  479 => 174,  475 => 172,  466 => 168,  456 => 165,  443 => 159,  439 => 157,  437 => 156,  434 => 155,  423 => 151,  415 => 148,  405 => 145,  392 => 139,  388 => 137,  386 => 136,  383 => 135,  372 => 131,  362 => 128,  354 => 125,  344 => 122,  331 => 116,  327 => 114,  325 => 113,  322 => 112,  311 => 108,  298 => 102,  290 => 99,  280 => 96,  267 => 90,  263 => 88,  261 => 87,  258 => 86,  246 => 81,  233 => 75,  225 => 72,  215 => 69,  205 => 66,  201 => 64,  199 => 63,  196 => 62,  185 => 58,  172 => 52,  164 => 49,  154 => 46,  151 => 45,  149 => 44,  146 => 43,  135 => 39,  122 => 33,  114 => 30,  110 => 28,  108 => 27,  105 => 26,  101 => 24,  94 => 22,  84 => 20,  76 => 18,  74 => 17,  67 => 16,  63 => 15,  60 => 14,  58 => 13,  54 => 11,  42 => 9,  34 => 7,  32 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/paginator/default.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/paginator/default.twig");
    }
}

<?php

/* @widget/vjcsearch/default.twig */
class __TwigTemplate_da7c71a6e122c76e33618fc627be2c0661c7647b2eaa054e36f7a84ece4e86fd extends Twig_Template
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
        echo "<style>
.search-result-desc a:hover {
\ttext-decoration: none;
}
</style>
<div class='row'>
\t<div class='large-16 columns large-centered'>
\t\t\t<h5 class=\"individual\">Результаты поиска</h5>
\t</div>

\t<div class='row'>
\t\t<hr>
\t\t<p></p>
\t</div>

\t<div class=\"large-16 columns large-centered\">

";
        // line 18
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "querySubmitted", array(), "method")) {
            // line 19
            echo "
\t";
            // line 20
            $context["list"] = $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getResults", array(), "method");
            // line 21
            echo "\t";
            if (( !(isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")) ||  !$this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCountAll", array(), "method"))) {
                // line 22
                echo "
\t\t";
                // line 23
                $context["list"] = null;
                // line 24
                echo "
\t";
            } else {
                // line 26
                echo "
\t\t";
                // line 27
                $context["first"] = ((($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") - 1) * $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "items_per_page"), "method")) + 1);
                // line 28
                echo "\t\t";
                $context["last"] = ((($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") == $this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getPageCount", array(), "method"))) ? ($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCountAll", array(), "method")) : (($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") * $this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "count", array(), "method"))));
                // line 29
                echo "
\t";
            }
            // line 31
            echo "
\t";
            // line 32
            if ( !(isset($context["list"]) ? $context["list"] : $this->getContext($context, "list"))) {
                // line 33
                echo "\t\t<div class=\"search-result-block\" style=\"margin: 20px 0px;\">
\t\t\t<p>";
                // line 34
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Поиск не дал результатов")), "html", null, true);
                echo "</p>
\t\t</div>
\t\t

\t";
            } else {
                // line 39
                echo "\t";
                // line 40
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 41
                    echo "
\t\t\t<div class='search-result-block' style=\"margin: 20px 0px;\">
\t\t\t<p class='search-result-desc'><a href=\"";
                    // line 43
                    if (($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materialsType", array()) == 5)) {
                        // line 44
                        $context["itrProducts"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materials", array()), "orderBy", array(0 => "tag"), "method");
                        // line 45
                        echo "\t\t";
                        $context["isNotFound"] = true;
                        // line 46
                        echo "\t\t";
                        $context["productsPerPage"] = 12;
                        // line 47
                        echo "\t\t";
                        $context["productPosition"] = 1;
                        // line 48
                        echo "
\t\t";
                        // line 50
                        echo "\t\t";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["itrProducts"]) ? $context["itrProducts"] : $this->getContext($context, "itrProducts")));
                        foreach ($context['_seq'] as $context["_key"] => $context["Prod"]) {
                            if ((isset($context["isNotFound"]) ? $context["isNotFound"] : $this->getContext($context, "isNotFound"))) {
                                // line 51
                                echo "\t\t\t";
                                if (($this->getAttribute($context["Prod"], "id", array()) == $this->getAttribute($context["m"], "id", array()))) {
                                    // line 52
                                    echo "\t\t\t\t";
                                    $context["isNotFound"] = false;
                                    // line 53
                                    echo "\t\t\t";
                                } else {
                                    // line 54
                                    echo "\t\t\t\t";
                                    $context["productPosition"] = ((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) + 1);
                                    // line 55
                                    echo "\t\t\t";
                                }
                                // line 56
                                echo "\t\t";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Prod'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 57
                        echo "
\t\t";
                        // line 59
                        echo "\t\t";
                        if (((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) > (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage")))) {
                            // line 60
                            echo "\t\t\t";
                            $context["pageNum"] = (int) floor(((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) / 12));
                            // line 61
                            echo "\t\t\t\t";
                            if ((((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) * (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage"))) < (isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")))) {
                                // line 62
                                echo "\t\t\t\t\t";
                                $context["pageNum"] = ((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) + 1);
                                // line 63
                                echo "\t\t\t\t";
                            }
                            // line 64
                            echo "\t\t";
                        } else {
                            // line 65
                            echo "\t\t\t";
                            $context["pageNum"] = 1;
                            // line 66
                            echo "\t\t";
                        }
                        // line 67
                        echo "\t\t\t";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "url", array()), "html", null, true);
                        echo "?page=";
                        echo twig_escape_filter($this->env, (isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")), "html", null, true);
                        echo "&id=";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                    } else {
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
                    }
                    echo "\">

\t\t\t";
                    // line 69
                    echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "markupTextAndCut", array(0 => $this->getAttribute(                    // line 70
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMorphs", array(0 => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "queryValue", array())), "method"), 1 => strip_tags($this->getAttribute(                    // line 71
$context["m"], "name", array())), 2 => strip_tags($this->getAttribute(                    // line 72
$context["m"], "short", array())), 3 => strip_tags($this->getAttribute(                    // line 73
$context["m"], "text", array()))), "method");
                    // line 75
                    echo "</a>
\t\t\t</p>



\t\t";
                    // line 80
                    if (($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materialsType", array()) == 5)) {
                        // line 81
                        echo "
\t\t";
                        // line 83
                        echo "\t\t";
                        $context["itrProducts"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materials", array()), "orderBy", array(0 => "tag"), "method");
                        // line 84
                        echo "\t\t";
                        $context["isNotFound"] = true;
                        // line 85
                        echo "\t\t";
                        $context["productsPerPage"] = 12;
                        // line 86
                        echo "\t\t";
                        $context["productPosition"] = 1;
                        // line 87
                        echo "
\t\t";
                        // line 89
                        echo "\t\t";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["itrProducts"]) ? $context["itrProducts"] : $this->getContext($context, "itrProducts")));
                        foreach ($context['_seq'] as $context["_key"] => $context["Prod"]) {
                            if ((isset($context["isNotFound"]) ? $context["isNotFound"] : $this->getContext($context, "isNotFound"))) {
                                // line 90
                                echo "\t\t\t";
                                if (($this->getAttribute($context["Prod"], "id", array()) == $this->getAttribute($context["m"], "id", array()))) {
                                    // line 91
                                    echo "\t\t\t\t";
                                    $context["isNotFound"] = false;
                                    // line 92
                                    echo "\t\t\t";
                                } else {
                                    // line 93
                                    echo "\t\t\t\t";
                                    $context["productPosition"] = ((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) + 1);
                                    // line 94
                                    echo "\t\t\t";
                                }
                                // line 95
                                echo "\t\t";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Prod'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 96
                        echo "
\t\t";
                        // line 98
                        echo "\t\t";
                        if (((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) > (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage")))) {
                            // line 99
                            echo "\t\t\t";
                            $context["pageNum"] = (int) floor(((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) / 12));
                            // line 100
                            echo "\t\t\t\t";
                            if ((((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) * (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage"))) < (isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")))) {
                                // line 101
                                echo "\t\t\t\t\t";
                                $context["pageNum"] = ((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) + 1);
                                // line 102
                                echo "\t\t\t\t";
                            }
                            // line 103
                            echo "\t\t";
                        } else {
                            // line 104
                            echo "\t\t\t";
                            $context["pageNum"] = 1;
                            // line 105
                            echo "\t\t";
                        }
                        // line 106
                        echo "\t\t";
                        // line 107
                        echo "\t\t<a href='";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "url", array()), "html", null, true);
                        echo "?page=";
                        echo twig_escape_filter($this->env, (isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")), "html", null, true);
                        echo "&id=";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                        echo "' class=\"search-result-link\">Подробнее</a>
\t\t";
                    } else {
                        // line 109
                        echo "\t\t\t<a href='";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
                        echo "' class=\"search-result-link\">Подробнее</a>
\t\t";
                    }
                    // line 111
                    echo "

\t\t</div>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 115
                echo "\t\t<hr>
\t</div>
</div>
\t\t<div class=\"mb40\"></div>

\t\t<div class=row>
\t\t<div class='large-8 columns large-centered'>
\t\t";
                // line 122
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
                echo "
\t
\t";
            }
        }
        // line 126
        echo "</div>
</div>";
    }

    public function getTemplateName()
    {
        return "@widget/vjcsearch/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  311 => 126,  304 => 122,  295 => 115,  286 => 111,  280 => 109,  270 => 107,  268 => 106,  265 => 105,  262 => 104,  259 => 103,  256 => 102,  253 => 101,  250 => 100,  247 => 99,  244 => 98,  241 => 96,  234 => 95,  231 => 94,  228 => 93,  225 => 92,  222 => 91,  219 => 90,  213 => 89,  210 => 87,  207 => 86,  204 => 85,  201 => 84,  198 => 83,  195 => 81,  193 => 80,  186 => 75,  184 => 73,  183 => 72,  182 => 71,  181 => 70,  180 => 69,  167 => 67,  164 => 66,  161 => 65,  158 => 64,  155 => 63,  152 => 62,  149 => 61,  146 => 60,  143 => 59,  140 => 57,  133 => 56,  130 => 55,  127 => 54,  124 => 53,  121 => 52,  118 => 51,  112 => 50,  109 => 48,  106 => 47,  103 => 46,  100 => 45,  98 => 44,  96 => 43,  92 => 41,  87 => 40,  85 => 39,  77 => 34,  74 => 33,  72 => 32,  69 => 31,  65 => 29,  62 => 28,  60 => 27,  57 => 26,  53 => 24,  51 => 23,  48 => 22,  45 => 21,  43 => 20,  40 => 19,  38 => 18,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/vjcsearch/default.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/vjcsearch/default.twig");
    }
}

<?php

/* @widget/vjcsearch/default.twig */
class __TwigTemplate_cc8ee2eb8da62c2dbadfd0682e6709f912d92e0ca0be542034e7dc6b2c81d886 extends Twig_Template
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
        echo "<div class='row'>
\t<div class='large-16 columns large-centered'>
\t\t\t<h5 class=\"individual\">Результаты поиска</h5>
\t</div>

\t<div class='row'>
\t\t<hr>
\t\t<p></p>
\t</div>

\t<div class=\"large-16 columns large-centered\">

";
        // line 13
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "querySubmitted", array(), "method")) {
            // line 14
            echo "
\t";
            // line 15
            $context["list"] = $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getResults", array(), "method");
            // line 16
            echo "\t";
            if (( !(isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")) ||  !$this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCountAll", array(), "method"))) {
                // line 17
                echo "
\t\t";
                // line 18
                $context["list"] = null;
                // line 19
                echo "
\t";
            } else {
                // line 21
                echo "
\t\t";
                // line 22
                $context["first"] = ((($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") - 1) * $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "items_per_page"), "method")) + 1);
                // line 23
                echo "\t\t";
                $context["last"] = ((($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") == $this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getPageCount", array(), "method"))) ? ($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCountAll", array(), "method")) : (($this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "getCurrentPageNumber", array(), "method") * $this->getAttribute((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")), "count", array(), "method"))));
                // line 24
                echo "
\t";
            }
            // line 26
            echo "
\t";
            // line 27
            if ( !(isset($context["list"]) ? $context["list"] : $this->getContext($context, "list"))) {
                // line 28
                echo "
\t\t<p>";
                // line 29
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Поиск не дал результатов")), "html", null, true);
                echo "</p>

\t";
            } else {
                // line 32
                echo "\t";
                // line 33
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : $this->getContext($context, "list")));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 34
                    echo "
\t\t\t<div class='search-result-block'>
\t\t\t<p class='search-result-desc'>

\t\t\t";
                    // line 38
                    echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "markupTextAndCut", array(0 => $this->getAttribute(                    // line 39
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMorphs", array(0 => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "queryValue", array())), "method"), 1 => strip_tags($this->getAttribute(                    // line 40
$context["m"], "name", array())), 2 => strip_tags($this->getAttribute(                    // line 41
$context["m"], "short", array())), 3 => strip_tags($this->getAttribute(                    // line 42
$context["m"], "text", array()))), "method");
                    // line 44
                    echo "
\t\t</p>



\t\t";
                    // line 49
                    if (($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materialsType", array()) == 5)) {
                        // line 50
                        echo "
\t\t";
                        // line 52
                        echo "\t\t";
                        $context["itrProducts"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "materials", array()), "orderBy", array(0 => "tag"), "method");
                        // line 53
                        echo "\t\t";
                        $context["isNotFound"] = true;
                        // line 54
                        echo "\t\t";
                        $context["productsPerPage"] = 12;
                        // line 55
                        echo "\t\t";
                        $context["productPosition"] = 1;
                        // line 56
                        echo "
\t\t";
                        // line 58
                        echo "\t\t";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["itrProducts"]) ? $context["itrProducts"] : $this->getContext($context, "itrProducts")));
                        foreach ($context['_seq'] as $context["_key"] => $context["Prod"]) {
                            if ((isset($context["isNotFound"]) ? $context["isNotFound"] : $this->getContext($context, "isNotFound"))) {
                                // line 59
                                echo "\t\t\t";
                                if (($this->getAttribute($context["Prod"], "id", array()) == $this->getAttribute($context["m"], "id", array()))) {
                                    // line 60
                                    echo "\t\t\t\t";
                                    $context["isNotFound"] = false;
                                    // line 61
                                    echo "\t\t\t";
                                } else {
                                    // line 62
                                    echo "\t\t\t\t";
                                    $context["productPosition"] = ((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) + 1);
                                    // line 63
                                    echo "\t\t\t";
                                }
                                // line 64
                                echo "\t\t";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Prod'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 65
                        echo "
\t\t";
                        // line 67
                        echo "\t\t";
                        if (((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) > (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage")))) {
                            // line 68
                            echo "\t\t\t";
                            $context["pageNum"] = (int) floor(((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) / 12));
                            // line 69
                            echo "\t\t\t\t";
                            if ((((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) * (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage"))) < (isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")))) {
                                // line 70
                                echo "\t\t\t\t\t";
                                $context["pageNum"] = ((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) + 1);
                                // line 71
                                echo "\t\t\t\t";
                            }
                            // line 72
                            echo "\t\t";
                        } else {
                            // line 73
                            echo "\t\t\t";
                            $context["pageNum"] = 1;
                            // line 74
                            echo "\t\t";
                        }
                        // line 75
                        echo "\t\t";
                        // line 76
                        echo "\t\t<a href='";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["m"], "catalog", array()), "url", array()), "html", null, true);
                        echo "?page=";
                        echo twig_escape_filter($this->env, (isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")), "html", null, true);
                        echo "&id=";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                        echo "' class=\"search-result-link\">Подробнее</a>
\t\t";
                    } else {
                        // line 78
                        echo "\t\t\t<a href='";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
                        echo "' class=\"search-result-link\">Подробнее</a>
\t\t";
                    }
                    // line 80
                    echo "

\t\t</div>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 84
                echo "\t\t<hr>
\t</div>
</div>
\t\t<div class=\"mb40\"></div>

\t\t<div class=row>
\t\t<div class='large-8 columns large-centered'>
\t\t";
                // line 91
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
                echo "
\t</div>
</div>
\t";
            }
        }
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
        return array (  215 => 91,  206 => 84,  197 => 80,  191 => 78,  181 => 76,  179 => 75,  176 => 74,  173 => 73,  170 => 72,  167 => 71,  164 => 70,  161 => 69,  158 => 68,  155 => 67,  152 => 65,  145 => 64,  142 => 63,  139 => 62,  136 => 61,  133 => 60,  130 => 59,  124 => 58,  121 => 56,  118 => 55,  115 => 54,  112 => 53,  109 => 52,  106 => 50,  104 => 49,  97 => 44,  95 => 42,  94 => 41,  93 => 40,  92 => 39,  91 => 38,  85 => 34,  80 => 33,  78 => 32,  72 => 29,  69 => 28,  67 => 27,  64 => 26,  60 => 24,  57 => 23,  55 => 22,  52 => 21,  48 => 19,  46 => 18,  43 => 17,  40 => 16,  38 => 15,  35 => 14,  33 => 13,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/vjcsearch/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/vjcsearch/default.twig");
    }
}

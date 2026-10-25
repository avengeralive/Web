<?php

/* @widget/sale.wish.list/default.twig */
class __TwigTemplate_6f69221ab7343e21e65df5d7e5b128b1dd8a6ca751cbafd351aff7d7ed43328f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'items' => array($this, 'block_items'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/sale.wish.list/default.twig", 1)->display($context);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 4
        echo "
\t";
        // line 5
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()))) {
            // line 6
            echo "
\t\t";
            // line 7
            $this->displayBlock('items', $context, $blocks);
            // line 153
            echo "

    ";
        }
        // line 156
        echo "    ";
    }

    // line 7
    public function block_items($context, array $blocks = array())
    {
        // line 8
        echo "
\t\t\t";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 10
            echo "\t\t\t";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 11
            echo "    <div class=\"columns\">
        <div class=\"bracelet\" id=\"";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
            <div class=\"bracelet__code\">Код: ";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
\t\t\t\t<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
\t\t\t\t<div class=\"row small-up-2\">

\t\t\t\t\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t\t\t\t\t<div class=\"columns bracelet__price\">
        ";
            // line 19
            if (($this->getAttribute($context["m"], "price", array()) == 1)) {
                // line 20
                echo "        <a href=\"/about/calculation/\">Рассчитать цену</a>
        ";
            } else {
                // line 22
                echo "        ";
                if (($this->getAttribute($context["m"], "bIsHidden", array()) == 1)) {
                    // line 23
                    echo "        <a data-toggle=\"drop-prod\">
        ";
                    // line 24
                    echo $this->getAttribute($context["m"], "strHiddenPrice", array());
                    echo "
        </a>
        ";
                } else {
                    // line 27
                    echo "        <a data-toggle=\"drop-prod\">
        ";
                    // line 28
                    echo $this->getAttribute($context["m"], "displayFullPrice", array());
                    echo "
        </a>
      ";
                }
                // line 31
                echo "      ";
            }
            // line 32
            echo "
\t\t\t\t</div>
            </div>
        </div>
    </div>

    ";
            // line 38
            $context["d"] = 0;
            // line 39
            echo "\t\t\t\t  ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 40
                echo "                      ";
                $context["d"] = 3;
                // line 41
                echo "                  ";
            } else {
                // line 42
                echo "                      ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 43
                echo "                  ";
            }
            // line 44
            echo "
\t\t\t\t  ";
            // line 45
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 46
                echo "
    </div>
    <div class=\"row\">
        ";
                // line 50
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(($this->getAttribute($context["loop"], "index", array()) - (isset($context["d"]) ? $context["d"] : $this->getContext($context, "d"))), $this->getAttribute($context["loop"], "index0", array())));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 51
                    echo "            <div class=\"columns x-product\">
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 55
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <p><img src=\"/imagetransform/width_840_height_550_fit_2";
                    // line 62
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col\" data-equalizer-watch>
                                    <div class=\"hide\" id=\"defprice";
                    // line 65
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                    <p><a href=\"/about/calculation/\">";
                    // line 66
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array()) == 1)) {
                        echo "Рассчитать цену";
                    } else {
                        echo "</a>

                                      ";
                        // line 68
                        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array()) == 0)) {
                            // line 69
                            echo "\t\t\t\t\t\t\t\t\t                             <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "</span>
                                      ";
                        } else {
                            // line 71
                            echo "                                              <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array());
                            echo "</span>
                                      ";
                        }
                        // line 73
                        echo "
                                    <br>";
                    }
                    // line 75
                    echo "\t\t\t\t\t\t\t\t\t";
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                    } else {
                        echo "цена с гравировкой";
                    }
                    echo "</p>
                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 77
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->

\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 79
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>


                                    <div class='filter__col-footer'>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t      ";
                    // line 85
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array()) == 0)) {
                        // line 86
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    } else {
                        // line 88
                        echo "                                      <a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
                                    ";
                    }
                    // line 90
                    echo "                                        </div>




                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 98
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 99
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 100
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 102
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 104
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 106
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 112
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["of"]) {
                            // line 113
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 115
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">

                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                            // line 121
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\"
                                                                       value=\"";
                            // line 122
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                       id=\"offer";
                            // line 123
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                       ";
                            // line 124
                            if ($this->getAttribute($context["loop"], "first", array())) {
                                echo "checked";
                            }
                            echo ">

                                                                <label class=\"saphire__label g_price\" for=\"offer";
                            // line 126
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            // line 127
                            if (($this->getAttribute($context["of"], "displayPrice", array()) == 1)) {
                                echo "<a href=\"/about/calculation/\">По запросу</a>";
                            } else {
                                // line 128
                                echo "
                                                                    ";
                                // line 129
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 130
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 131
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 132
                            echo "                                                                </label>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['of'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 138
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 142
                    echo "                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 149
                echo "    </div>
<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 151
            echo "    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 152
        echo "    ";
    }

    public function getTemplateName()
    {
        return "@widget/sale.wish.list/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  450 => 152,  436 => 151,  432 => 149,  412 => 142,  406 => 138,  387 => 132,  382 => 131,  379 => 130,  376 => 129,  373 => 128,  369 => 127,  365 => 126,  358 => 124,  354 => 123,  350 => 122,  346 => 121,  337 => 115,  333 => 113,  316 => 112,  307 => 106,  303 => 104,  299 => 102,  295 => 100,  292 => 99,  290 => 98,  280 => 90,  276 => 88,  270 => 86,  268 => 85,  259 => 79,  252 => 77,  243 => 75,  239 => 73,  231 => 71,  223 => 69,  221 => 68,  214 => 66,  208 => 65,  202 => 62,  192 => 55,  186 => 51,  168 => 50,  163 => 46,  161 => 45,  158 => 44,  155 => 43,  152 => 42,  149 => 41,  146 => 40,  143 => 39,  141 => 38,  133 => 32,  130 => 31,  124 => 28,  121 => 27,  115 => 24,  112 => 23,  109 => 22,  105 => 20,  103 => 19,  98 => 17,  90 => 14,  86 => 13,  82 => 12,  79 => 11,  74 => 10,  57 => 9,  54 => 8,  51 => 7,  47 => 156,  42 => 153,  40 => 7,  37 => 6,  35 => 5,  32 => 4,  26 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.wish.list/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/sale.wish.list/default.twig");
    }
}

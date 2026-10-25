<?php

/* @widget/sale.goods.list/default.twig */
class __TwigTemplate_e4d065d1ab914ee763ea83d0541157f2945a63f65fd733e08d67134680e2cd23 extends Twig_Template
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
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/sale.goods.list/default.twig", 1)->display($context);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 5
            echo "\t\t<div class=\"row column x-pages\">
\t\t    ";
            // line 6
            ob_start();
            // line 7
            echo "            ";
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
            ";
            $context["paginator"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 9
            echo "            ";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "setPageProperty", array(0 => "list-paginator", 1 => (isset($context["paginator"]) ? $context["paginator"] : $this->getContext($context, "paginator"))), "method");
            // line 10
            echo "        </div>
    ";
        }
        // line 12
        echo "
\t";
        // line 13
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()))) {
            // line 14
            echo "\t\t";
            $this->displayBlock('items', $context, $blocks);
            // line 176
            echo "


    ";
            // line 179
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
                // line 180
                echo "        <center><div class=\"row column x-pages\">
            ";
                // line 181
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
                echo "
        </div></center>
    ";
            }
            // line 184
            echo "
    ";
        }
        // line 186
        echo "    ";
    }

    // line 14
    public function block_items($context, array $blocks = array())
    {
        // line 15
        echo "\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), "orderBy", array(0 => "tag"), "method"));
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
            // line 16
            echo "\t\t\t";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 17
            echo "    <div class=\"columns\">
        <div class=\"bracelet\" id=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
            <div class=\"bracelet__code\">Код: ";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
\t\t\t\t<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
\t\t\t\t<div class=\"row small-up-2\">

\t\t\t\t\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t\t\t\t\t<div class=\"columns bracelet__price\">
            ";
            // line 25
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 26
                echo "              ";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 27
                    echo "                ";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 28
                        echo "                  <a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
                  ";
                    } else {
                        // line 30
                        echo "                  <a href=\"/about/calculation/\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                        echo "</a>
                ";
                    }
                    // line 32
                    echo "              ";
                } else {
                    // line 33
                    echo "                <a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
              ";
                }
                // line 35
                echo "            ";
            } else {
                // line 36
                echo "            <a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
            ";
            }
            // line 38
            echo "\t\t\t\t</div>
            </div>
        </div>
    </div>

    ";
            // line 43
            $context["d"] = 0;
            // line 44
            echo "\t\t\t\t  ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 45
                echo "                      ";
                $context["d"] = 3;
                // line 46
                echo "                  ";
            } else {
                // line 47
                echo "                      ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 48
                echo "                  ";
            }
            // line 49
            echo "
\t\t\t\t  ";
            // line 50
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 51
                echo "
    </div>
    <div class=\"row\">
        ";
                // line 55
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
                    // line 56
                    echo "            <div class=\"columns x-product\">
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 60
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <p><img src=\"/imagetransform/width_840_height_550_fit_2";
                    // line 67
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col\" data-equalizer-watch>
                                ";
                    // line 71
                    echo "                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 75
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 76
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 77
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 78
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                                echo "</span>
                                                    ";
                            } else {
                                // line 80
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo "</span>
                                                   ";
                            }
                            // line 82
                            echo "                                                 ";
                        } else {
                            // line 83
                            echo "                                                <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span>
                                                 ";
                        }
                        // line 85
                        echo "                                               ";
                    } else {
                        // line 86
                        echo "                                               <span data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>
                                               ";
                    }
                    // line 88
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 93
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 94
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <div class='filter__col-footer'>
                                    <p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                    // line 97
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

                                    ";
                    // line 100
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 101
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 102
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 103
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 105
                                echo "                                          <a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
                                        ";
                            }
                            // line 107
                            echo "                                      ";
                        } else {
                            // line 108
                            echo "                                          <a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
                                      ";
                        }
                        // line 110
                        echo "                                    ";
                    } else {
                        // line 111
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 113
                    echo "                                    </div>


                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 119
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 120
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 121
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 123
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 125
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 127
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 133
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method"));
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
                            // line 134
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 136
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 140
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 141
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 142
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 143
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 144
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 145
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 146
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 148
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 149
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 151
                                echo "
                                                                    ";
                                // line 152
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 153
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 154
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 155
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
                        // line 161
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 165
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
                // line 172
                echo "    </div>
<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 174
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
        // line 175
        echo "    ";
    }

    public function getTemplateName()
    {
        return "@widget/sale.goods.list/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  534 => 175,  520 => 174,  516 => 172,  496 => 165,  490 => 161,  471 => 155,  466 => 154,  463 => 153,  460 => 152,  457 => 151,  451 => 149,  448 => 148,  443 => 146,  437 => 145,  433 => 144,  429 => 143,  425 => 142,  422 => 141,  420 => 140,  413 => 136,  409 => 134,  392 => 133,  383 => 127,  379 => 125,  375 => 123,  371 => 121,  368 => 120,  366 => 119,  358 => 113,  352 => 111,  349 => 110,  345 => 108,  342 => 107,  338 => 105,  332 => 103,  329 => 102,  326 => 101,  324 => 100,  318 => 97,  312 => 94,  306 => 93,  299 => 88,  291 => 86,  288 => 85,  280 => 83,  277 => 82,  269 => 80,  261 => 78,  258 => 77,  255 => 76,  253 => 75,  247 => 71,  241 => 67,  231 => 60,  225 => 56,  207 => 55,  202 => 51,  200 => 50,  197 => 49,  194 => 48,  191 => 47,  188 => 46,  185 => 45,  182 => 44,  180 => 43,  173 => 38,  167 => 36,  164 => 35,  158 => 33,  155 => 32,  149 => 30,  143 => 28,  140 => 27,  137 => 26,  135 => 25,  130 => 23,  122 => 20,  118 => 19,  114 => 18,  111 => 17,  106 => 16,  88 => 15,  85 => 14,  81 => 186,  77 => 184,  71 => 181,  68 => 180,  66 => 179,  61 => 176,  58 => 14,  56 => 13,  53 => 12,  49 => 10,  46 => 9,  40 => 7,  38 => 6,  35 => 5,  32 => 4,  26 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/sale.goods.list/default.twig");
    }
}

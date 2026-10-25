<?php

/* @widget/sale.goods.list/stars_collection_goods_list.twig */
class __TwigTemplate_9082416379e4059a14dbd944db8c8c19fca02c08dbc6408c5a9dc2c7df594c15 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'items' => array($this, 'block_items'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('items', $context, $blocks);
    }

    public function block_items($context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 3
        $context["prods"] = $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "products_list"), "method");
        // line 4
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")));
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
            // line 5
            echo "
";
            // line 6
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 7
            echo "<div class=\"columns\">
<div class=\"bracelet\" id=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
\t\t<div class=\"bracelet__code\">Код: ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
<div class=\"row small-up-2\">

\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t<div class=\"columns bracelet__price\">
\t\t";
            // line 15
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 16
                echo "\t\t";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 17
                    echo "\t\t\t";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 18
                        echo "\t\t\t\t<a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
\t\t\t\t";
                    } else {
                        // line 20
                        echo "      \t<a href=\"/about/calculation/\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                        echo "</a>
\t\t\t";
                    }
                    // line 22
                    echo "\t\t";
                } else {
                    // line 23
                    echo "\t\t<a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
\t\t";
                }
                // line 25
                echo "\t";
            } else {
                // line 26
                echo "\t<a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
\t";
            }
            // line 28
            echo "</div>
\t\t</div>
</div>
</div>

";
            // line 33
            $context["d"] = 0;
            // line 34
            echo "\t";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 35
                echo "\t\t\t\t\t\t\t";
                $context["d"] = 3;
                // line 36
                echo "\t\t\t\t\t";
            } else {
                // line 37
                echo "\t\t\t\t\t\t\t";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 38
                echo "\t\t\t\t\t";
            }
            // line 39
            echo "
\t";
            // line 40
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 41
                echo "
</div>
<div class=\"row\">
";
                // line 45
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
                    // line 46
                    echo "\t\t<div class=\"columns x-product\">
\t\t\t\t<div class=\"filter filter_product text-left hide\">
\t\t\t\t\t\t<div class=\"filter__triangle\"></div>
\t\t\t\t\t\t<button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
\t\t\t\t\t\t\t\t\t\t\t\tsrc=\"";
                    // line 50
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"large-16 columns large-offset-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"row\" data-equalizer>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p><img src=\"/imagetransform/width_840_height_550_fit_2";
                    // line 57
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-9 large-8 xlarge-6 filter__col\" data-equalizer-watch>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 61
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t <a href=\"/about/calculation/\"></a>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    // line 65
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 66
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 67
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 68
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            } else {
                                // line 70
                                echo "                                             <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            }
                            // line 72
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        } else {
                            // line 73
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        }
                        // line 75
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    } else {
                        // line 76
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    }
                    // line 78
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<br>


\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__art\">Aрт.
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 83
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t<br>";
                    // line 84
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class='filter__col-footer'>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                    // line 87
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 90
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 91
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 92
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 93
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 95
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 97
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 98
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 100
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 101
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 103
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 109
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 110
                        echo "\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 111
                            echo "\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t";
                        } else {
                            // line 113
                            echo "\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t";
                        }
                        // line 115
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"table-scroll\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table class=\"gold\" id=\"";
                        // line 117
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr style=\"background: white;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Металл и камни</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Цена</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 123
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method"));
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
                            // line 124
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"g_name\">";
                            // line 126
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"saphire\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 130
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 131
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class=\"x-offer saphire__input\" type=\"radio\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t name=\"offer";
                                // line 132
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t value=\"";
                                // line 133
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t id=\"offer";
                                // line 134
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                                // line 135
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"saphire__label g_price\" for=\"offer";
                                // line 136
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 138
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 139
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 141
                                echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 142
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 143
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 144
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 145
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
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
                        // line 151
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 155
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t</div>
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
                // line 162
                echo "</div>
<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
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
    }

    public function getTemplateName()
    {
        return "@widget/sale.goods.list/stars_collection_goods_list.twig";
    }

    public function getDebugInfo()
    {
        return array (  460 => 162,  440 => 155,  434 => 151,  415 => 145,  410 => 144,  407 => 143,  404 => 142,  401 => 141,  395 => 139,  392 => 138,  387 => 136,  381 => 135,  377 => 134,  373 => 133,  369 => 132,  366 => 131,  364 => 130,  357 => 126,  353 => 124,  336 => 123,  327 => 117,  323 => 115,  319 => 113,  315 => 111,  312 => 110,  310 => 109,  302 => 103,  296 => 101,  293 => 100,  289 => 98,  286 => 97,  282 => 95,  276 => 93,  273 => 92,  270 => 91,  268 => 90,  262 => 87,  256 => 84,  250 => 83,  243 => 78,  235 => 76,  232 => 75,  224 => 73,  221 => 72,  213 => 70,  205 => 68,  202 => 67,  199 => 66,  197 => 65,  191 => 61,  185 => 57,  175 => 50,  169 => 46,  152 => 45,  147 => 41,  145 => 40,  142 => 39,  139 => 38,  136 => 37,  133 => 36,  130 => 35,  127 => 34,  125 => 33,  118 => 28,  112 => 26,  109 => 25,  103 => 23,  100 => 22,  94 => 20,  88 => 18,  85 => 17,  82 => 16,  80 => 15,  75 => 13,  67 => 10,  63 => 9,  59 => 8,  56 => 7,  52 => 6,  49 => 5,  31 => 4,  29 => 3,  26 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/stars_collection_goods_list.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/sale.goods.list/stars_collection_goods_list.twig");
    }
}

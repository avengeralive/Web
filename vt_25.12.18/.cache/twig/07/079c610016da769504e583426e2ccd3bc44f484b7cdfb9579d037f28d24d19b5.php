<?php

/* @widget/sale.goods.list/stars_material.twig */
class __TwigTemplate_e01d7075d1692a7a02d7250384a0e387dafdec237f41de3b80d173da62a928a4 extends Twig_Template
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
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/sale.goods.list/stars_material.twig", 1)->display($context);
        // line 2
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 3
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMaterial", array())) {
            // line 4
            echo "
<div class=\"row\">
\t<div class=\"large-16 large-centered columns\">
\t\t<h4 class=\"individual\">";
            // line 7
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array());
            echo "</h4>
\t</div>
</div>

<div class=\"row\">
";
            // line 12
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()))) {
                // line 13
                echo "
<div class=\"columns\">
\t<div class=\"princess\">
\t";
                // line 16
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
                    // line 17
                    echo "\t<div><img alt=\"\" src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "file", array()), "html", null, true);
                    echo "\" /></div>
";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 19
                echo "\t</div>

";
            }
            // line 22
            echo "
<div class=\"large-16 large-centered columns celebrity\">
";
            // line 24
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "text", array());
            echo "
</div>
</div>

";
            // line 28
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()))) {
                // line 29
                $context["prods"] = array();
                // line 30
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 31
                    $context["prods"] = twig_array_merge((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), array($this->getAttribute($context["m"], "name", array()) => $this->getAttribute((isset($context["product_catalog"]) ? $context["product_catalog"] : $this->getContext($context, "product_catalog")), "getMaterialById", array(0 => $this->getAttribute($context["m"], "name", array())), "method")));
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 33
                echo "
\t";
                // line 34
                $this->displayBlock('items', $context, $blocks);
                // line 192
                echo "
";
            }
            // line 194
            echo "




";
        }
    }

    // line 34
    public function block_items($context, array $blocks = array())
    {
        // line 35
        echo "
\t\t";
        // line 36
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
            // line 37
            echo "
\t";
            // line 38
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 39
            echo "<div class=\"columns\">
\t<div class=\"bracelet\" id=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
\t\t\t<div class=\"bracelet__code\">Код: ";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
\t<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
\t<div class=\"row small-up-2\">

\t\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t\t<div class=\"columns bracelet__price\">
\t\t\t";
            // line 47
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 48
                echo "\t\t\t";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 49
                    echo "\t\t\t\t";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 50
                        echo "\t\t\t\t\t<a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
\t\t\t\t";
                    }
                    // line 52
                    echo "\t\t\t";
                } else {
                    // line 53
                    echo "\t\t\t<a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
\t\t\t";
                }
                // line 55
                echo "\t\t";
            } else {
                // line 56
                echo "\t\t<a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
\t\t";
            }
            // line 58
            echo "\t</div>
\t\t\t</div>
\t</div>
</div>

";
            // line 63
            $context["d"] = 0;
            // line 64
            echo "\t\t";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 65
                echo "\t\t\t\t\t\t\t\t";
                $context["d"] = 3;
                // line 66
                echo "\t\t\t\t\t\t";
            } else {
                // line 67
                echo "\t\t\t\t\t\t\t\t";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 68
                echo "\t\t\t\t\t\t";
            }
            // line 69
            echo "
\t\t";
            // line 70
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 71
                echo "
</div>
<div class=\"row\">
\t";
                // line 75
                echo "\t";
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
                    // line 76
                    echo "\t\t\t<div class=\"columns x-product\">
\t\t\t\t\t<div class=\"filter filter_product text-left hide\">
\t\t\t\t\t\t\t<div class=\"filter__triangle\"></div>
\t\t\t\t\t\t\t<button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
\t\t\t\t\t\t\t\t\t\t\t\t\tsrc=\"";
                    // line 80
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
\t\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"large-16 columns large-offset-4\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\" data-equalizer>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p><img src=\"/imagetransform/width_840_height_550_fit_2";
                    // line 87
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-9 large-8 xlarge-6 filter__col\" data-equalizer-watch>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"hide\" id=\"defprice";
                    // line 90
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t <a href=\"/about/calculation/\"></a>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    // line 95
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 96
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 97
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 98
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            }
                            // line 100
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        } else {
                            // line 101
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        }
                        // line 103
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    } else {
                        // line 104
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    }
                    // line 106
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<br>


\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__art\">Aрт.
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 111
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t<br>";
                    // line 112
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class='filter__col-footer'>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                    // line 115
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 118
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 119
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 120
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 121
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 123
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 124
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 126
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 127
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 129
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 135
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 136
                        echo "\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 137
                            echo "\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t";
                        } else {
                            // line 139
                            echo "\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t";
                        }
                        // line 141
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"table-scroll\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table class=\"gold\" id=\"";
                        // line 143
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr style=\"background: white;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Металл и камни</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Цена</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 149
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
                            // line 150
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"g_name\">";
                            // line 152
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"saphire\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 156
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 157
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class=\"x-offer saphire__input\" type=\"radio\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t name=\"offer";
                                // line 158
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t value=\"";
                                // line 159
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t id=\"offer";
                                // line 160
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                                // line 161
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"saphire__label g_price\" for=\"offer";
                                // line 162
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 164
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 165
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t \t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 167
                                echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 168
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 169
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 170
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 171
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
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
                        // line 177
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 181
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t</div>
\t";
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
                // line 188
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
        return "@widget/sale.goods.list/stars_material.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  534 => 188,  514 => 181,  508 => 177,  489 => 171,  484 => 170,  481 => 169,  478 => 168,  475 => 167,  469 => 165,  466 => 164,  461 => 162,  455 => 161,  451 => 160,  447 => 159,  443 => 158,  440 => 157,  438 => 156,  431 => 152,  427 => 150,  410 => 149,  401 => 143,  397 => 141,  393 => 139,  389 => 137,  386 => 136,  384 => 135,  376 => 129,  370 => 127,  367 => 126,  363 => 124,  360 => 123,  354 => 121,  351 => 120,  348 => 119,  346 => 118,  340 => 115,  334 => 112,  328 => 111,  321 => 106,  313 => 104,  310 => 103,  302 => 101,  299 => 100,  291 => 98,  288 => 97,  285 => 96,  283 => 95,  273 => 90,  267 => 87,  257 => 80,  251 => 76,  233 => 75,  228 => 71,  226 => 70,  223 => 69,  220 => 68,  217 => 67,  214 => 66,  211 => 65,  208 => 64,  206 => 63,  199 => 58,  193 => 56,  190 => 55,  184 => 53,  181 => 52,  175 => 50,  172 => 49,  169 => 48,  167 => 47,  162 => 45,  154 => 42,  150 => 41,  146 => 40,  143 => 39,  139 => 38,  136 => 37,  119 => 36,  116 => 35,  113 => 34,  103 => 194,  99 => 192,  97 => 34,  94 => 33,  88 => 31,  84 => 30,  82 => 29,  80 => 28,  73 => 24,  69 => 22,  64 => 19,  55 => 17,  51 => 16,  46 => 13,  44 => 12,  36 => 7,  31 => 4,  29 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/stars_material.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/sale.goods.list/stars_material.twig");
    }
}

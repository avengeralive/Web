<?php

/* @widget/sale.goods.list/stars_collection_goods_list.twig */
class __TwigTemplate_8c89d06ad89315d347e16b48078b92f56a528324d70e4e0eb983c6d3a4c32aca extends Twig_Template
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
        echo "<link rel=\"stylesheet\" href=\"/themes/shop/css/drift-basic.css\">
<script src=\"/themes/shop/js/Drift.js\"></script>
";
        // line 4
        $context["prods"] = $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "products_list"), "method");
        // line 5
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
            // line 6
            echo "
";
            // line 7
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 8
            echo "<div class=\"columns\">
<div class=\"bracelet\" id=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
\t\t<div class=\"bracelet__code\">Код: ";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
<div class=\"row small-up-2\">

\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t<div class=\"columns bracelet__price\">
\t\t";
            // line 16
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 17
                echo "\t\t";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 18
                    echo "\t\t\t";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 19
                        echo "\t\t\t\t<a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
\t\t\t\t";
                    } else {
                        // line 21
                        echo "      \t<a href=\"/about/calculation/\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                        echo "</a>
\t\t\t";
                    }
                    // line 23
                    echo "\t\t";
                } else {
                    // line 24
                    echo "\t\t<a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
\t\t";
                }
                // line 26
                echo "\t";
            } else {
                // line 27
                echo "\t<a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
\t";
            }
            // line 29
            echo "</div>
\t\t</div>
</div>
</div>

";
            // line 34
            $context["d"] = 0;
            // line 35
            echo "\t";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 36
                echo "\t\t\t\t\t\t\t";
                $context["d"] = 3;
                // line 37
                echo "\t\t\t\t\t";
            } else {
                // line 38
                echo "\t\t\t\t\t\t\t";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 39
                echo "\t\t\t\t\t";
            }
            // line 40
            echo "
\t";
            // line 41
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 42
                echo "
</div>
<div class=\"\">
";
                // line 46
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
                    // line 47
                    echo "\t\t<div class=\"columns x-product\">
\t\t\t\t<div class=\"filter filter_product text-left hide\">
\t\t\t\t\t\t<div class=\"filter__triangle\"></div>
\t\t\t\t\t\t<button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
\t\t\t\t\t\t\t\t\t\t\t\tsrc=\"";
                    // line 51
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"large-16 columns large-offset-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"row\" data-equalizer>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img class=\"drift-demo-trigger";
                    // line 58
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 60
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 62
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t <a href=\"/about/calculation/\"></a>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    // line 66
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 67
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 68
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 69
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            } else {
                                // line 71
                                echo "                                             <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo " ";
                                if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                    echo "<br>цена с гравировкой";
                                }
                                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                            }
                            // line 73
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        } else {
                            // line 74
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo " ";
                            if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                        }
                        // line 76
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    } else {
                        // line 77
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo " ";
                        if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            echo "<br>цена с гравировкой";
                        }
                        echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                    }
                    // line 79
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<br>


\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__art\">Aрт.
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 84
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t<br>";
                    // line 85
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 88
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 89
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'),
      inlinePane: 900,
      inlineOffsetY: -85,
      containInline: true,
      hoverBoundingBox: true
    });
    
  </script>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class='filter__col-footer'>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                    // line 98
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 101
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 102
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 103
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 104
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 106
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 108
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 109
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner expanded\" href=\"/about/calculation/\">Рассчитать цену</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 111
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 112
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 114
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"columns\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mb15\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 120
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 121
                        echo "\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 122
                            echo "\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t";
                        } else {
                            // line 124
                            echo "\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t";
                        }
                        // line 126
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"table-scroll\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table class=\"gold\" id=\"";
                        // line 128
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr style=\"background: white;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Металл и камни</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"gold__th\">Цена</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 134
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
                            // line 135
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"g_name\">";
                            // line 137
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"saphire\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 141
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 142
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class=\"x-offer saphire__input\" type=\"radio\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t name=\"offer";
                                // line 143
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t value=\"";
                                // line 144
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t id=\"offer";
                                // line 145
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ";
                                // line 146
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"saphire__label g_price\" for=\"offer";
                                // line 147
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 149
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 150
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 152
                                echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 153
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 154
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 155
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 156
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
                        // line 162
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 166
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
                // line 173
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
        return array (  496 => 173,  476 => 166,  470 => 162,  451 => 156,  446 => 155,  443 => 154,  440 => 153,  437 => 152,  431 => 150,  428 => 149,  423 => 147,  417 => 146,  413 => 145,  409 => 144,  405 => 143,  402 => 142,  400 => 141,  393 => 137,  389 => 135,  372 => 134,  363 => 128,  359 => 126,  355 => 124,  351 => 122,  348 => 121,  346 => 120,  338 => 114,  332 => 112,  329 => 111,  325 => 109,  322 => 108,  318 => 106,  312 => 104,  309 => 103,  306 => 102,  304 => 101,  298 => 98,  286 => 89,  282 => 88,  276 => 85,  270 => 84,  263 => 79,  251 => 77,  248 => 76,  236 => 74,  233 => 73,  221 => 71,  213 => 69,  210 => 68,  207 => 67,  205 => 66,  199 => 62,  195 => 60,  186 => 58,  176 => 51,  170 => 47,  153 => 46,  148 => 42,  146 => 41,  143 => 40,  140 => 39,  137 => 38,  134 => 37,  131 => 36,  128 => 35,  126 => 34,  119 => 29,  113 => 27,  110 => 26,  104 => 24,  101 => 23,  95 => 21,  89 => 19,  86 => 18,  83 => 17,  81 => 16,  76 => 14,  68 => 11,  64 => 10,  60 => 9,  57 => 8,  53 => 7,  50 => 6,  32 => 5,  30 => 4,  26 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/stars_collection_goods_list.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/sale.goods.list/stars_collection_goods_list.twig");
    }
}

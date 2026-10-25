<?php

/* @widget/sale.goods.list/stars_collection_goods_list.twig */
class __TwigTemplate_09ad7016862403de8dfd46a794b85d12e31ccf420c1c44738fd0251f74a94c34 extends Twig_Template
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
                // line 8
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">
";
            }
            // line 10
            echo "  <div class=\"columns\">
    <div class=\"bracelet\" id=\"";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
\t\t  <div class=\"bracelet__code\">Код: ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
        <p class=\"bracelet__img\">
          <a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a>
        </p>
        <div class=\"row small-up-2\">
          <div class=\"columns\">
            <a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a>
          </div>
          <div class=\"columns bracelet__price\">
\t\t      ";
            // line 21
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 22
                echo "\t\t        ";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 23
                    echo "              ";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 24
                        echo "\t\t\t\t        <a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
\t\t\t\t      ";
                    } else {
                        // line 26
                        echo "                <a href=\"/about/calculation/\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                        echo "</a>
              ";
                    }
                    // line 28
                    echo "\t\t          ";
                } else {
                    // line 29
                    echo "\t\t            <a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
\t\t          ";
                }
                // line 31
                echo "              ";
            } else {
                // line 32
                echo "                <a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
              ";
            }
            // line 34
            echo "          </div>
\t\t    </div>
    </div>
  </div>

";
            // line 39
            $context["d"] = 0;
            // line 40
            echo "\t";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 41
                echo "\t\t\t\t\t\t\t";
                $context["d"] = 3;
                // line 42
                echo "\t\t\t\t\t";
            } else {
                // line 43
                echo "\t\t\t\t\t\t\t";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 44
                echo "\t\t\t\t\t";
            }
            // line 45
            echo "
\t";
            // line 46
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 47
                echo "</div>
<div class=\"row\">
";
                // line 50
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
                    echo "\t\t<div class=\"columns x-product\">
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

                                    <img class=\"drift-demo-trigger";
                    // line 62
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\"  src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 64
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                <div class=\"hide\" id=\"defprice";
                    // line 65
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 70
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 71
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 72
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 73
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
                                echo "</span> <span>";
                                if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                    echo "<br>цена с гравировкой";
                                }
                                echo "</span>
                                                    ";
                            } else {
                                // line 75
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo "</span> <span>";
                                if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                    echo "<br>цена с гравировкой";
                                }
                                echo "</span>
                                                   ";
                            }
                            // line 77
                            echo "                                                 ";
                        } else {
                            // line 78
                            echo "                                                <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                                 ";
                        }
                        // line 80
                        echo "                                               ";
                    } else {
                        // line 81
                        echo "                                               ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 82
                            echo "                                               <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\"><!--";
                            echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "-->";
                            echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        } else {
                            // line 84
                            echo "                                               ";
                            echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        }
                        // line 86
                        echo "                                               ";
                    }
                    // line 87
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 92
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 93
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 96
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 97
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'),
      inlinePane: 900,
      inlineOffsetY: -85,
      containInline: true,
      hoverBoundingBox: true
    });
    
  </script>
                                    <div class='filter__col-footer'>
                                    <p class='filter__col-footer-desc'>";
                    // line 106
                    if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "isInWishList", array(), "method")) {
                        echo "<a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a>";
                    } else {
                        // line 108
                        echo "                                    <a class=\"filter__heart x-remove-from-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart\"></i>В избранном</a>";
                    }
                    // line 109
                    echo "</p>

                                    ";
                    // line 111
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 112
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 113
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 114
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 116
                                echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                                // line 117
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                                echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                                // line 118
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                                echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                        ";
                            }
                            // line 121
                            echo "                                      ";
                        } else {
                            // line 122
                            echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                            // line 123
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                            echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                            // line 124
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                            echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                      ";
                        }
                        // line 127
                        echo "                                    ";
                    } else {
                        // line 128
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 130
                    echo "                                    </div>
                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 134
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                        // line 135
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 136
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 138
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 140
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 142
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 148
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method"));
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
                            // line 149
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 151
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 155
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 156
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 157
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 158
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 159
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 160
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 161
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 163
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 164
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 166
                                echo "
                                                                    ";
                                // line 167
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 168
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 169
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 170
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
                        // line 176
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 180
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
                // line 187
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
        // line 190
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/sale.goods.list/stars_collection_goods_list.twig";
    }

    public function getDebugInfo()
    {
        return array (  569 => 190,  553 => 187,  533 => 180,  527 => 176,  508 => 170,  503 => 169,  500 => 168,  497 => 167,  494 => 166,  488 => 164,  485 => 163,  480 => 161,  474 => 160,  470 => 159,  466 => 158,  462 => 157,  459 => 156,  457 => 155,  450 => 151,  446 => 149,  429 => 148,  420 => 142,  416 => 140,  412 => 138,  408 => 136,  405 => 135,  403 => 134,  397 => 130,  391 => 128,  388 => 127,  382 => 124,  378 => 123,  375 => 122,  372 => 121,  366 => 118,  362 => 117,  359 => 116,  353 => 114,  350 => 113,  347 => 112,  345 => 111,  341 => 109,  335 => 108,  328 => 106,  316 => 97,  312 => 96,  306 => 93,  300 => 92,  293 => 87,  290 => 86,  280 => 84,  266 => 82,  263 => 81,  260 => 80,  248 => 78,  245 => 77,  233 => 75,  221 => 73,  218 => 72,  215 => 71,  213 => 70,  203 => 65,  199 => 64,  190 => 62,  180 => 55,  174 => 51,  157 => 50,  153 => 47,  151 => 46,  148 => 45,  145 => 44,  142 => 43,  139 => 42,  136 => 41,  133 => 40,  131 => 39,  124 => 34,  118 => 32,  115 => 31,  109 => 29,  106 => 28,  100 => 26,  94 => 24,  91 => 23,  88 => 22,  86 => 21,  80 => 18,  71 => 14,  66 => 12,  62 => 11,  59 => 10,  55 => 8,  53 => 7,  50 => 6,  32 => 5,  30 => 4,  26 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/stars_collection_goods_list.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/sale.goods.list/stars_collection_goods_list.twig");
    }
}

<?php

/* @widget/sale.goods.list/stars_collection_goods_list.twig */
class __TwigTemplate_825eb983cd776a7f9c4c30d32f322e52a8e5156dcbf22b7890c8b71e4a28f3f2 extends Twig_Template
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
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 51
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <img class=\"drift-demo-trigger";
                    // line 58
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\"  src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 60
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                <div class=\"hide\" id=\"defprice";
                    // line 61
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 66
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 67
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 68
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 69
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
                                // line 71
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
                            // line 73
                            echo "                                                 ";
                        } else {
                            // line 74
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
                        // line 76
                        echo "                                               ";
                    } else {
                        // line 77
                        echo "                                               ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 78
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
                            // line 80
                            echo "                                               ";
                            echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        }
                        // line 82
                        echo "                                               ";
                    }
                    // line 83
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 88
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 89
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 92
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 93
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
                    // line 102
                    if ( !$this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "isInWishList", array(), "method")) {
                        echo "<a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a>";
                    } else {
                        // line 104
                        echo "                                    <a class=\"filter__heart x-remove-from-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart\"></i>В избранном</a>";
                    }
                    // line 105
                    echo "</p>

                                    ";
                    // line 107
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 108
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 109
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 110
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 112
                                echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                                // line 113
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                                echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                                // line 114
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                                echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                        ";
                            }
                            // line 117
                            echo "                                      ";
                        } else {
                            // line 118
                            echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                            // line 119
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "code", array()), "html", null, true);
                            echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                            // line 120
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "name", array()), "html", null, true);
                            echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                      ";
                        }
                        // line 123
                        echo "                                    ";
                    } else {
                        // line 124
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 126
                    echo "                                    </div>
                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 130
                    if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "hasOffers", array())) {
                        // line 131
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 132
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 134
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 136
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 138
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 144
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
                            // line 145
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 147
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 151
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 152
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 153
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 154
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 155
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 156
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 157
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 159
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 160
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 162
                                echo "
                                                                    ";
                                // line 163
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 164
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 165
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 166
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
                        // line 172
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 176
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
                // line 183
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
        return array (  549 => 183,  529 => 176,  523 => 172,  504 => 166,  499 => 165,  496 => 164,  493 => 163,  490 => 162,  484 => 160,  481 => 159,  476 => 157,  470 => 156,  466 => 155,  462 => 154,  458 => 153,  455 => 152,  453 => 151,  446 => 147,  442 => 145,  425 => 144,  416 => 138,  412 => 136,  408 => 134,  404 => 132,  401 => 131,  399 => 130,  393 => 126,  387 => 124,  384 => 123,  378 => 120,  374 => 119,  371 => 118,  368 => 117,  362 => 114,  358 => 113,  355 => 112,  349 => 110,  346 => 109,  343 => 108,  341 => 107,  337 => 105,  331 => 104,  324 => 102,  312 => 93,  308 => 92,  302 => 89,  296 => 88,  289 => 83,  286 => 82,  276 => 80,  262 => 78,  259 => 77,  256 => 76,  244 => 74,  241 => 73,  229 => 71,  217 => 69,  214 => 68,  211 => 67,  209 => 66,  199 => 61,  195 => 60,  186 => 58,  176 => 51,  170 => 47,  153 => 46,  148 => 42,  146 => 41,  143 => 40,  140 => 39,  137 => 38,  134 => 37,  131 => 36,  128 => 35,  126 => 34,  119 => 29,  113 => 27,  110 => 26,  104 => 24,  101 => 23,  95 => 21,  89 => 19,  86 => 18,  83 => 17,  81 => 16,  76 => 14,  68 => 11,  64 => 10,  60 => 9,  57 => 8,  53 => 7,  50 => 6,  32 => 5,  30 => 4,  26 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/stars_collection_goods_list.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/sale.goods.list/stars_collection_goods_list.twig");
    }
}

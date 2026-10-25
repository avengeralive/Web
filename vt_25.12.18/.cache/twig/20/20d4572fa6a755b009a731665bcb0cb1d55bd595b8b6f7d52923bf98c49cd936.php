<?php

/* @widget/sale.goods.list/default.twig */
class __TwigTemplate_7556022197d4e6e5efced8a6a7a12669a6ab2f592b542d7c8d729f7f7594e695 extends Twig_Template
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
        echo "<link rel=\"stylesheet\" href=\"/themes/shop/css/drift-basic.css\">
<script src=\"/themes/shop/js/Drift.js\"></script>
    ";
        // line 6
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 7
            echo "\t\t<div class=\"row column x-pages\">
\t\t    ";
            // line 8
            ob_start();
            // line 9
            echo "            ";
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
            ";
            $context["paginator"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 11
            echo "            ";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "setPageProperty", array(0 => "list-paginator", 1 => (isset($context["paginator"]) ? $context["paginator"] : $this->getContext($context, "paginator"))), "method");
            // line 12
            echo "        </div>
    ";
        }
        // line 14
        echo "
\t";
        // line 15
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()))) {
            // line 16
            echo "\t\t";
            $this->displayBlock('items', $context, $blocks);
            // line 250
            echo "


    ";
            // line 253
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
                // line 254
                echo "        <center><div class=\"row column x-pages\">
            ";
                // line 255
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
                echo "
        </div></center>
    ";
            }
            // line 258
            echo "
    ";
        }
        // line 260
        echo "    ";
    }

    // line 16
    public function block_items($context, array $blocks = array())
    {
        // line 17
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
            // line 18
            echo "\t\t\t";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 19
            echo "    <div class=\"columns\">
        <div class=\"bracelet\" id=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
            <div class=\"bracelet__code\">Код: ";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "code", array()), "html", null, true);
            echo "</div>
\t\t\t\t<p class=\"bracelet__img\"><a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_840_height_550_fit_2";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
\t\t\t\t<div class=\"row small-up-2\">

\t\t\t\t\t<div class=\"columns\"><a class=\"bracelet__title\" data-toggle=\"drop-prod\">";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></div>
\t\t\t\t\t<div class=\"columns bracelet__price\">
            ";
            // line 27
            if ($this->getAttribute($context["m"], "bIsHidden", array())) {
                // line 28
                echo "              ";
                if ($this->getAttribute($context["m"], "hasOffers", array())) {
                    // line 29
                    echo "                ";
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                        // line 30
                        echo "                  <a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                        echo "</a>
                  ";
                    } else {
                        // line 32
                        echo "                  <a href=\"/about/calculation/\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                        echo "</a>
                ";
                    }
                    // line 34
                    echo "              ";
                } else {
                    // line 35
                    echo "                <a href=\"/about/calculation/\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "strHiddenPrice", array()), "html", null, true);
                    echo "</a>
              ";
                }
                // line 37
                echo "            ";
            } else {
                // line 38
                echo "            <a data-toggle=\"drop-prod\">";
                echo $this->getAttribute($context["m"], "displayFullPrice", array());
                echo "</a>
            ";
            }
            // line 40
            echo "\t\t\t\t</div>
            </div>
        </div>
    </div>

    ";
            // line 45
            $context["d"] = 0;
            // line 46
            echo "\t\t\t\t  ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 47
                echo "                      ";
                $context["d"] = 3;
                // line 48
                echo "                  ";
            } else {
                // line 49
                echo "                      ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 50
                echo "                  ";
            }
            // line 51
            echo "
\t\t\t\t  ";
            // line 52
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 53
                echo "
    </div>
    <div class=\"row\">
        ";
                // line 57
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
                    // line 58
                    echo "            <div class=\"columns x-product\">
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 62
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <img class=\"drift-demo-trigger";
                    // line 69
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\"  src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 71
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                ";
                    // line 73
                    echo "                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 77
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 78
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 79
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 80
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "displayFullPrice", array());
                                echo "</span>
                                                    ";
                            } else {
                                // line 82
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo "</span>
                                                   ";
                            }
                            // line 84
                            echo "                                                 ";
                        } else {
                            // line 85
                            echo "                                                <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span>
                                                 ";
                        }
                        // line 87
                        echo "                                               ";
                    } else {
                        // line 88
                        echo "                                               <span data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>
                                               ";
                    }
                    // line 90
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 95
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 96
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 99
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 100
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'),
      inlinePane: 900,
      inlineOffsetY: -85,
      containInline: true,
      hoverBoundingBox: true
    });
    
  </script>
                                    <div class='filter__col-footer'>
                                    <p class='filter__col-footer-desc'>";
                    // line 109
                    if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "isInWishList", array(), "method")) {
                        echo "<a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a>";
                    } else {
                        // line 111
                        echo "                                    <a class=\"filter__heart x-remove-from-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart\"></i>В избранном</a>";
                    }
                    // line 112
                    echo "</p>

                                    ";
                    // line 114
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 115
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 116
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "price", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 117
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 119
                                echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                                // line 120
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                                echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                                // line 121
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                                echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                        ";
                            }
                            // line 124
                            echo "                                      ";
                        } else {
                            // line 125
                            echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                            // line 126
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                            echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                            // line 127
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                            echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                      ";
                        }
                        // line 130
                        echo "                                    ";
                    } else {
                        // line 131
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 133
                    echo "                                    </div>
                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 137
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 138
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 139
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 141
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 143
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 145
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 151
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
                            // line 152
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 154
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 158
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 159
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 160
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 161
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 162
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 163
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 164
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 166
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 167
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 169
                                echo "
                                                                    ";
                                // line 170
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 171
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 172
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 173
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
                        // line 179
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 183
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
                // line 190
                echo "    </div>
    <script type=\"text/javascript\">
        document.addEventListener('DOMContentLoaded', function () {
          jQuery('.x-product').each(function(me){
            me = jQuery('.x-product')[me];
            me = \$(me);
            var data = {
              action: 'is_in_cart',
              id: me.find('.x-add-to-cart').attr('data-id')
            }
            var o = me.find('.x-offer');
            if (o.length == 1) {
              data.offer_id = me.find('.x-offer').val();
            }
            else if (o.length > 1) {
              data.offer_id = me.find('.x-offer:checked').val();
            }
            //console.log(data);
            jQuery.ajax({
                url : '/plugins/sale/ajax.php',
                data: data,
                dataType: 'json',
                success: function (data) {
                  if (data.total) {
                    me.find('.x-add-to-cart').addClass('in_cart');
                    me.find('.x-add-to-cart').attr('disabled', 'disabled');
                    me.find('.x-add-to-cart').html('В корзине');
                  }
                }     
            }); 
        });
        \$('.x-offer').on('change', function(){
            me = \$(this).closest('.x-product');
            var data = {
              action: 'is_in_cart',
              id: me.find('.x-add-to-cart').attr('data-id')
            }
            data.offer_id = \$(this).val();
            jQuery.ajax({
                url : '/plugins/sale/ajax.php',
                data: data,
                dataType: 'json',
                success: function (data) {
                  if (data.total) {
                    me.find('.x-add-to-cart').addClass('in_cart');
                    me.find('.x-add-to-cart').attr('disabled', 'disabled');
                    me.find('.x-add-to-cart').html('В корзине');
                  }
                  else {
                    me.find('.x-add-to-cart').removeClass('in_cart');
                    me.find('.x-add-to-cart').html('В корзину');
                  }
                }     
            });
        });
      });
    </script>
<div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 248
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
        // line 249
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
        return array (  643 => 249,  629 => 248,  569 => 190,  549 => 183,  543 => 179,  524 => 173,  519 => 172,  516 => 171,  513 => 170,  510 => 169,  504 => 167,  501 => 166,  496 => 164,  490 => 163,  486 => 162,  482 => 161,  478 => 160,  475 => 159,  473 => 158,  466 => 154,  462 => 152,  445 => 151,  436 => 145,  432 => 143,  428 => 141,  424 => 139,  421 => 138,  419 => 137,  413 => 133,  407 => 131,  404 => 130,  398 => 127,  394 => 126,  391 => 125,  388 => 124,  382 => 121,  378 => 120,  375 => 119,  369 => 117,  366 => 116,  363 => 115,  361 => 114,  357 => 112,  351 => 111,  344 => 109,  332 => 100,  328 => 99,  322 => 96,  316 => 95,  309 => 90,  301 => 88,  298 => 87,  290 => 85,  287 => 84,  279 => 82,  271 => 80,  268 => 79,  265 => 78,  263 => 77,  257 => 73,  253 => 71,  244 => 69,  234 => 62,  228 => 58,  210 => 57,  205 => 53,  203 => 52,  200 => 51,  197 => 50,  194 => 49,  191 => 48,  188 => 47,  185 => 46,  183 => 45,  176 => 40,  170 => 38,  167 => 37,  161 => 35,  158 => 34,  152 => 32,  146 => 30,  143 => 29,  140 => 28,  138 => 27,  133 => 25,  125 => 22,  121 => 21,  117 => 20,  114 => 19,  109 => 18,  91 => 17,  88 => 16,  84 => 260,  80 => 258,  74 => 255,  71 => 254,  69 => 253,  64 => 250,  61 => 16,  59 => 15,  56 => 14,  52 => 12,  49 => 11,  43 => 9,  41 => 8,  38 => 7,  36 => 6,  32 => 4,  26 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/default.twig", "/usr/www/users/alivel/velvetin/plugins/sale/widgets/sale.goods.list/default.twig");
    }
}

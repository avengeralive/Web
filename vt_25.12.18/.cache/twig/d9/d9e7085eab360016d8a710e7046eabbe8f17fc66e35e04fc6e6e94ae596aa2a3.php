<?php

/* @widget/sale.goods.list/default.twig */
class __TwigTemplate_47ab749b3c335699735a9332a0c8ace7c32b4cfde4942133d5166b0a2f57f523 extends Twig_Template
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
            // line 256
            echo "


    ";
            // line 259
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
                // line 260
                echo "        <center><div class=\"row column x-pages\">
            ";
                // line 261
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
                echo "
        </div></center>
    ";
            }
            // line 264
            echo "
    ";
        }
        // line 266
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
                    if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "bIsHidden", array())) {
                        // line 30
                        echo "                  <a data-toggle=\"drop-prod\">";
                        echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
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
                echo "              ";
                if (($this->getAttribute($context["m"], "hasOffers", array()) && ($this->getAttribute($this->getAttribute($context["m"], "offers", array()), "count", array()) > 1))) {
                    // line 39
                    echo "              ";
                    echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($context["m"], "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
                    echo "
              ";
                } else {
                    // line 41
                    echo "                  ";
                    echo $this->getAttribute($context["m"], "displayFullPrice", array());
                    echo "
              ";
                }
                // line 43
                echo "            ";
            }
            // line 44
            echo "\t\t\t\t</div>
            </div>
        </div>
    </div>

    ";
            // line 49
            $context["d"] = 0;
            // line 50
            echo "\t\t\t\t  ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 51
                echo "                      ";
                $context["d"] = 3;
                // line 52
                echo "                  ";
            } else {
                // line 53
                echo "                      ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 54
                echo "                  ";
            }
            // line 55
            echo "
\t\t\t\t  ";
            // line 56
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 57
                echo "
    </div>
    <div class=\"row\">
        ";
                // line 61
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
                    // line 62
                    echo "            <div class=\"columns x-product\">
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 66
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <img class=\"drift-demo-trigger";
                    // line 73
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\"  src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 75
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                <div class=\"hide\" id=\"defprice";
                    // line 76
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 81
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 82
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 83
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 84
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
                                echo "</span> <span>";
                                if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                    echo "<br>цена с гравировкой";
                                }
                                echo "</span>
                                                    ";
                            } else {
                                // line 86
                                echo "                                                     <span data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                                echo "</span> <span>";
                                if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                    echo "<br>цена с гравировкой";
                                }
                                echo "</span>
                                                   ";
                            }
                            // line 88
                            echo "                                                 ";
                        } else {
                            // line 89
                            echo "                                                <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "strHiddenPrice", array()), "html", null, true);
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                                 ";
                        }
                        // line 91
                        echo "                                               ";
                    } else {
                        // line 92
                        echo "                                               ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 93
                            echo "                                               <span data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\"><!--";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "-->";
                            echo $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method")), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        } else {
                            // line 95
                            echo "                                               ";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        }
                        // line 97
                        echo "                                               ";
                    }
                    // line 98
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 103
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
\t\t\t\t\t\t\t\t\t\t<br>";
                    // line 104
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 107
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 108
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
                    // line 117
                    if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "isInWishList", array(), "method")) {
                        echo "<a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a>";
                    } else {
                        // line 119
                        echo "                                    <a class=\"filter__heart x-remove-from-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart\"></i>В избранном</a>";
                    }
                    // line 120
                    echo "</p>

                                    ";
                    // line 122
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 123
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 124
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 125
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 127
                                echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                                // line 128
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                                echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                                // line 129
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                                echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                        ";
                            }
                            // line 132
                            echo "                                      ";
                        } else {
                            // line 133
                            echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                            // line 134
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                            echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                            // line 135
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                            echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                      ";
                        }
                        // line 138
                        echo "                                    ";
                    } else {
                        // line 139
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 141
                    echo "                                    </div>
                                </div>
                                <div class=\"columns\">
                                \t<div class=\"mb15\"></div>
                                    ";
                    // line 145
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                        // line 146
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 147
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 149
                            echo "\t\t\t\t\t\t\t\t\t\t\t<p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях с учетом гравировки.</p>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 151
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 153
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 159
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "ASC"), "method"));
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
                            // line 160
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 162
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 166
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 167
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 168
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 169
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 170
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 171
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 172
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 174
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t     ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 175
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 177
                                echo "
                                                                    ";
                                // line 178
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 179
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 180
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 181
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
                        // line 187
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 191
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
                // line 198
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
            // line 254
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
        // line 255
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
        return array (  691 => 255,  677 => 254,  619 => 198,  599 => 191,  593 => 187,  574 => 181,  569 => 180,  566 => 179,  563 => 178,  560 => 177,  554 => 175,  551 => 174,  546 => 172,  540 => 171,  536 => 170,  532 => 169,  528 => 168,  525 => 167,  523 => 166,  516 => 162,  512 => 160,  495 => 159,  486 => 153,  482 => 151,  478 => 149,  474 => 147,  471 => 146,  469 => 145,  463 => 141,  457 => 139,  454 => 138,  448 => 135,  444 => 134,  441 => 133,  438 => 132,  432 => 129,  428 => 128,  425 => 127,  419 => 125,  416 => 124,  413 => 123,  411 => 122,  407 => 120,  401 => 119,  394 => 117,  382 => 108,  378 => 107,  372 => 104,  366 => 103,  359 => 98,  356 => 97,  346 => 95,  332 => 93,  329 => 92,  326 => 91,  314 => 89,  311 => 88,  299 => 86,  287 => 84,  284 => 83,  281 => 82,  279 => 81,  269 => 76,  265 => 75,  256 => 73,  246 => 66,  240 => 62,  222 => 61,  217 => 57,  215 => 56,  212 => 55,  209 => 54,  206 => 53,  203 => 52,  200 => 51,  197 => 50,  195 => 49,  188 => 44,  185 => 43,  179 => 41,  173 => 39,  170 => 38,  167 => 37,  161 => 35,  158 => 34,  152 => 32,  146 => 30,  143 => 29,  140 => 28,  138 => 27,  133 => 25,  125 => 22,  121 => 21,  117 => 20,  114 => 19,  109 => 18,  91 => 17,  88 => 16,  84 => 266,  80 => 264,  74 => 261,  71 => 260,  69 => 259,  64 => 256,  61 => 16,  59 => 15,  56 => 14,  52 => 12,  49 => 11,  43 => 9,  41 => 8,  38 => 7,  36 => 6,  32 => 4,  26 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.list/default.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/sale.goods.list/default.twig");
    }
}

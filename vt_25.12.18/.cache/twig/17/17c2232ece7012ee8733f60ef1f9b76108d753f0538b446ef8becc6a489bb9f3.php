<?php

/* @widget/list/main_pop.twig */
class __TwigTemplate_d9491935144b68eb6b2882709b4fd1ffafff3fd88adda240d9a2565743a04590 extends Twig_Template
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
        echo "
";
        // line 2
        $this->displayBlock('items', $context, $blocks);
    }

    public function block_items($context, array $blocks = array())
    {
        // line 3
        echo "<link rel=\"stylesheet\" href=\"/themes/shop/css/drift-basic.css\">
<script src=\"/themes/shop/js/Drift.js\"></script>
 ";
        // line 5
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
            // line 6
            echo " ";
            if ($this->getAttribute($context["loop"], "first", array())) {
                // line 7
                echo "                <div class=\"row medium-up-6\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 8
            echo "                    <div class=\"columns\">
                        <div class=\"bracelet bracelete-pop\" id=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
                            <p class=\"bracelet__img\"> <a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_400_height_260_fit_2";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"> </a> </p>
                        </div>
                    </div>

                    ";
            // line 14
            $context["d"] = 0;
            // line 15
            echo "                    ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 6) == 0)) {
                // line 16
                echo "                        ";
                $context["d"] = 6;
                // line 17
                echo "                    ";
            } else {
                // line 18
                echo "                        ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 6);
                // line 19
                echo "                    ";
            }
            // line 20
            echo "
                    ";
            // line 21
            if ((((($this->getAttribute($context["loop"], "index", array()) % 6) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 22
                echo "
                </div>
                <div class=\"row\">
                    ";
                // line 25
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
                    // line 26
                    echo "                        <div class=\"columns x-product\">
                <div class=\"filter filter_product text-left hide\">
                    <div class=\"filter__triangle\"></div>
                    <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                src=\"";
                    // line 30
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                    <div class=\"mb15\"></div>
                    <div class=\"row\">
                        <div class=\"large-16 columns large-offset-4\">
                            <div class=\"row\" data-equalizer>
                                <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                    <img class=\"drift-demo-trigger";
                    // line 37
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\"  src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\">
                                </div>
                                <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                <div class=\"hide\" id=\"defprice";
                    // line 40
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                    <p>

                                     <a href=\"/about/calculation/\"></a>

                                               ";
                    // line 45
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 46
                        echo "                                                 ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 47
                            echo "                                                   ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 48
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
                                // line 50
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
                            // line 52
                            echo "                                                 ";
                        } else {
                            // line 53
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
                        // line 55
                        echo "                                               ";
                    } else {
                        // line 56
                        echo "                                               ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 57
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
                            // line 59
                            echo "                                               ";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                            echo "</span> <span>";
                            if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                                echo "<br>цена с гравировкой";
                            }
                            echo "</span>
                                               ";
                        }
                        // line 61
                        echo "                                               ";
                    }
                    // line 62
                    echo "
                                    <br>


                                    <p class=\"filter__art\">Aрт.
                                        ";
                    // line 67
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->
                                        <br>";
                    // line 68
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                    </p>
                                    <script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 71
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 72
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
                    // line 81
                    if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "isInWishList", array(), "method")) {
                        echo "<a class=\"filter__heart x-add-to-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart-o\"></i>Добавить в избранное</a>";
                    } else {
                        // line 83
                        echo "                                    <a class=\"filter__heart x-remove-from-wishlist\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                    <i class=\"fa fa-heart\"></i>В избранном</a>";
                    }
                    // line 84
                    echo "</p>

                                    ";
                    // line 86
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "bIsHidden", array())) {
                        // line 87
                        echo "                                      ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                            // line 88
                            echo "                                        ";
                            if ( !$this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "offers", array()), "orderBy", array(0 => "tag", 1 => "DESC"), "method")), "bIsHidden", array())) {
                                // line 89
                                echo "                                          <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\">В корзину</a>
                                          ";
                            } else {
                                // line 91
                                echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                                // line 92
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                                echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                                // line 93
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                                echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                        ";
                            }
                            // line 96
                            echo "                                      ";
                        } else {
                            // line 97
                            echo "                                          <form action=\"/about/calculation/\" method=\"post\">
                                          <input type=\"hidden\" name=\"art\" value=\"";
                            // line 98
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                            echo "\">
                                          <input type=\"hidden\" name=\"pr_name\" value=\"";
                            // line 99
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                            echo "\">
                                          <button class=\"button inner expanded\">Рассчитать цену</button></form>
                                      ";
                        }
                        // line 102
                        echo "                                    ";
                    } else {
                        // line 103
                        echo "                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">В корзину</a>
                                    ";
                    }
                    // line 105
                    echo "                                    </div>
                                </div>
                                <div class=\"columns\">
                                    <div class=\"mb15\"></div>
                                    ";
                    // line 109
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array())) {
                        // line 110
                        echo "                                        ";
                        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            // line 111
                            echo "                                            <p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях.</p>
                                        ";
                        } else {
                            // line 113
                            echo "                                            <p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия. Цены указаны в рублях с учетом гравировки.</p>
                                        ";
                        }
                        // line 115
                        echo "
                                        <div class=\"table-scroll\">
                                            <table class=\"gold\" id=\"";
                        // line 117
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                <tr style=\"background: white;\">
                                                    <td class=\"gold__th\">Металл и камни</td>
                                                    <td class=\"gold__th\">Цена</td>
                                                </tr>

                                                ";
                        // line 123
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
                            // line 124
                            echo "                                                    <tr>
                                                        <td>
                                                            <span class=\"g_name\">";
                            // line 126
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                        </td>
                                                        <td>
                                                            <div class=\"saphire\">
                                                                ";
                            // line 130
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 0)) {
                                // line 131
                                echo "                                                                <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                       name=\"offer";
                                // line 132
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                                echo "\"
                                                                       value=\"";
                                // line 133
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       id=\"offer";
                                // line 134
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\"
                                                                       ";
                                // line 135
                                if ($this->getAttribute($context["loop"], "first", array())) {
                                    echo "checked";
                                }
                                echo ">
                                                                <label class=\"saphire__label g_price\" for=\"offer";
                                // line 136
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                                echo "\">
                                                                ";
                            }
                            // line 138
                            echo "                                                             ";
                            if (($this->getAttribute($context["of"], "bIsHidden", array()) == 1)) {
                                // line 139
                                echo "                                 <a href=\"/about/calculation/\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "strPriceHidden", array()), "html", null, true);
                                echo "</a>
                                 ";
                            } else {
                                // line 141
                                echo "
                                                                    ";
                                // line 142
                                echo $this->getAttribute($context["of"], "displayPrice", array());
                            }
                            // line 143
                            echo "                                                                    ";
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 144
                                echo "                                                                        <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 145
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
                        // line 151
                        echo "                                            </table>
                                        </div>

                                    ";
                    }
                    // line 155
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
                // line 162
                echo "                </div>
                <div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 164
            echo "                    ";
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
        return "@widget/list/main_pop.twig";
    }

    public function getDebugInfo()
    {
        return array (  499 => 164,  495 => 162,  475 => 155,  469 => 151,  450 => 145,  445 => 144,  442 => 143,  439 => 142,  436 => 141,  430 => 139,  427 => 138,  422 => 136,  416 => 135,  412 => 134,  408 => 133,  404 => 132,  401 => 131,  399 => 130,  392 => 126,  388 => 124,  371 => 123,  362 => 117,  358 => 115,  354 => 113,  350 => 111,  347 => 110,  345 => 109,  339 => 105,  333 => 103,  330 => 102,  324 => 99,  320 => 98,  317 => 97,  314 => 96,  308 => 93,  304 => 92,  301 => 91,  295 => 89,  292 => 88,  289 => 87,  287 => 86,  283 => 84,  277 => 83,  270 => 81,  258 => 72,  254 => 71,  248 => 68,  242 => 67,  235 => 62,  232 => 61,  222 => 59,  208 => 57,  205 => 56,  202 => 55,  190 => 53,  187 => 52,  175 => 50,  163 => 48,  160 => 47,  157 => 46,  155 => 45,  145 => 40,  141 => 39,  132 => 37,  122 => 30,  116 => 26,  99 => 25,  94 => 22,  92 => 21,  89 => 20,  86 => 19,  83 => 18,  80 => 17,  77 => 16,  74 => 15,  72 => 14,  63 => 10,  59 => 9,  56 => 8,  53 => 7,  50 => 6,  33 => 5,  29 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_pop.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/list/main_pop.twig");
    }
}

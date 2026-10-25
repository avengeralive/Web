<?php

/* @widget/list/main_pop.twig */
class __TwigTemplate_89c9f2ceae0db37b5f92e827b9df055ff1c1e1d5514d682d8cbd5ece6debb309 extends Twig_Template
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
                          ";
                    // line 27
                    $context["id_item"] = "x-product-";
                    // line 28
                    echo "                          ";
                    $context["id_item"] = ((isset($context["id_item"]) ? $context["id_item"] : $this->getContext($context, "id_item")) . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()));
                    // line 29
                    echo "                            <div class=\"filter filter_product text-left hide\" id=\"";
                    echo twig_escape_filter($this->env, (isset($context["id_item"]) ? $context["id_item"] : $this->getContext($context, "id_item")), "html", null, true);
                    echo "\">
                                <div class=\"filter__triangle \"></div>
                                <button class=\"close-button close-desc\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img
                                            src=\"";
                    // line 32
                    echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
                    echo "images/cross.svg\" alt=\"\"></button>
                                <div class=\"mb15\"></div>
                                <div class=\"row\">
                                    <div class=\"large-16 columns large-offset-4\">
                                        <div class=\"row\" data-equalizer>
                                            <div class=\"columns medium-15 large-16 xlarge-18\" data-equalizer-watch>

                                                <p><img class=\"drift-demo-trigger";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" src=\"/imagetransform/width_840_height_550_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
                                            </div>
                                            <div class=\"columns medium-9 large-8 xlarge-6 filter__col filter__col";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\" data-equalizer-watch>
                                                <div class=\"hide\" id=\"defprice";
                    // line 42
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                                <p><a href=\"/about/calculation/\">";
                    // line 43
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array()) == 1)) {
                        echo "Рассчитать цену";
                    } else {
                        echo "</a>

                                                    <span data-id=\"";
                        // line 45
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>

                                                    ";
                        // line 47
                        if ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "no_engraving", array())) {
                            echo "<br>цена с гравировкой";
                        }
                    }
                    echo "</p>
                                                <p class=\"filter__art\">Aрт.
                                                    ";
                    // line 49
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->

                                                    <br>";
                    // line 51
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                                </p>
<script>
  new Drift(document.querySelector('.drift-demo-trigger";
                    // line 54
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'), {
      paneContainer: document.querySelector('.filter__col";
                    // line 55
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "'),
      inlinePane: 900,
      inlineOffsetY: -85,
      containInline: true,
      hoverBoundingBox: true
    });
    
  </script>

                                                <div class='filter__col-footer'>
                                                    <p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\"
                                                                                          data-id=\"";
                    // line 66
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\"><i
                                                                    class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

                                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                    // line 69
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">В
                                                        корзину</a>
                                                </div>
                                            </div>
                                            <div class=\"columns\">
                                                <div class=\"mb15\"></div>
                                                ";
                    // line 75
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 76
                        echo "                                                    <p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.
                                                        Цены указаны в рублях с учетом гравировки.</p>
                                                    <div class=\"table-scroll\">
                                                        <table class=\"gold\" id=\"";
                        // line 79
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                            <tr style=\"background: white;\">
                                                                <td class=\"gold__th\">Металл и камни</td>
                                                                <td class=\"gold__th\">Цена</td>
                                                            </tr>

                                                            ";
                        // line 85
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
                            // line 86
                            echo "                                                                <tr>
                                                                    <td>
                                                                        <span class=\"g_name\">";
                            // line 88
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class=\"saphire\">

                                                                            <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                                   name=\"offer";
                            // line 94
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\"
                                                                                   value=\"";
                            // line 95
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                                   id=\"offer";
                            // line 96
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                                   ";
                            // line 97
                            if ($this->getAttribute($context["loop"], "first", array())) {
                                echo "checked";
                            }
                            echo ">

                                                                            <label class=\"saphire__label g_price\" for=\"offer";
                            // line 99
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\">
                                                                                ";
                            // line 100
                            echo $this->getAttribute($context["of"], "displayPrice", array());
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 101
                                echo "                                                                                    <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 102
                            echo "                                                                            </label>

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
                        // line 108
                        echo "                                                        </table>
                                                    </div>

                                                ";
                    }
                    // line 112
                    echo "                                            </div>
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
                // line 119
                echo "                </div>
                <div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 121
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
        return array (  354 => 121,  350 => 119,  330 => 112,  324 => 108,  305 => 102,  300 => 101,  297 => 100,  293 => 99,  286 => 97,  282 => 96,  278 => 95,  274 => 94,  265 => 88,  261 => 86,  244 => 85,  235 => 79,  230 => 76,  228 => 75,  219 => 69,  213 => 66,  199 => 55,  195 => 54,  189 => 51,  182 => 49,  174 => 47,  167 => 45,  160 => 43,  154 => 42,  150 => 41,  141 => 39,  131 => 32,  124 => 29,  121 => 28,  119 => 27,  116 => 26,  99 => 25,  94 => 22,  92 => 21,  89 => 20,  86 => 19,  83 => 18,  80 => 17,  77 => 16,  74 => 15,  72 => 14,  63 => 10,  59 => 9,  56 => 8,  53 => 7,  50 => 6,  33 => 5,  29 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_pop.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/list/main_pop.twig");
    }
}

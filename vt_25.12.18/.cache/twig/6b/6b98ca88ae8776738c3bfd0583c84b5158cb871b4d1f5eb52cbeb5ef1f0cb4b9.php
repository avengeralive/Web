<?php

/* @widget/list/main_pop.twig */
class __TwigTemplate_7bfe2bf7e6d6ad9564f27e5862a048c908615a04527cfd153f13c4a95fc66327 extends Twig_Template
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
        echo " ";
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
            // line 4
            echo " ";
            if ($this->getAttribute($context["loop"], "first", array())) {
                // line 5
                echo "                <div class=\"row medium-up-6\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 6
            echo "                    <div class=\"columns\">
                        <div class=\"bracelet bracelete-pop\" id=\"";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" data-equalizer-watch>
                            <p class=\"bracelet__img\"> <a class=\"view\" data-toggle=\"drop-prod\"><img src=\"/imagetransform/width_200_height_130_fit_2";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"> </a> </p>
                        </div>
                    </div>

                    ";
            // line 12
            $context["d"] = 0;
            // line 13
            echo "                    ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 6) == 0)) {
                // line 14
                echo "                        ";
                $context["d"] = 6;
                // line 15
                echo "                    ";
            } else {
                // line 16
                echo "                        ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 6);
                // line 17
                echo "                    ";
            }
            // line 18
            echo "
                    ";
            // line 19
            if ((((($this->getAttribute($context["loop"], "index", array()) % 6) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 20
                echo "
                </div>
                <div class=\"row\">
                    ";
                // line 23
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
                    // line 24
                    echo "                        <div class=\"columns x-product\">
                          ";
                    // line 25
                    $context["id_item"] = "x-product-";
                    // line 26
                    echo "                          ";
                    $context["id_item"] = ((isset($context["id_item"]) ? $context["id_item"] : $this->getContext($context, "id_item")) . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()));
                    // line 27
                    echo "                            <div class=\"filter filter_product text-left hide\" id=\"";
                    echo twig_escape_filter($this->env, (isset($context["id_item"]) ? $context["id_item"] : $this->getContext($context, "id_item")), "html", null, true);
                    echo "\">
                                <div class=\"filter__triangle \"></div>
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

                                                <p><img src=\"/imagetransform/width_840_height_550_fit_2";
                    // line 37
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "pic", array()), "html", null, true);
                    echo "\" alt=\"\"></p>
                                            </div>
                                            <div class=\"columns medium-9 large-8 xlarge-6 filter__col\" data-equalizer-watch>
                                                <div class=\"hide\" id=\"defprice";
                    // line 40
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                    echo "</div>
                                                <p><a href=\"/about/calculation/\">";
                    // line 41
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array()) == 1)) {
                        echo "Рассчитать цену";
                    } else {
                        echo "</a>

                                                    <span data-id=\"";
                        // line 43
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "displayFullPrice", array());
                        echo "</span>

                                                    <br>цена с гравировкой";
                    }
                    // line 45
                    echo "</p>
                                                <p class=\"filter__art\">Aрт.
                                                    ";
                    // line 47
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "code", array()), "html", null, true);
                    echo "<!--br>";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "short", array());
                    echo "<br-->

                                                    <br>";
                    // line 49
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "name", array()), "html", null, true);
                    echo "
                                                </p>


                                                <div class='filter__col-footer'>
                                                    <p class='filter__col-footer-desc'><a class=\"filter__heart x-add-to-wishlist\"
                                                                                          data-id=\"";
                    // line 55
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\"><i
                                                                    class=\"fa fa-heart-o\"></i>Добавить в избранное</a></p>

                                                    <a class=\"button inner x-add-to-cart expanded\" data-id=\"";
                    // line 58
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                    echo "\">В
                                                        корзину</a>
                                                </div>
                                            </div>
                                            <div class=\"columns\">
                                                <div class=\"mb15\"></div>
                                                ";
                    // line 64
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "hasOffers", array(), "method")) {
                        // line 65
                        echo "                                                    <p class=\"filter__desc\">Стоимость других вариантов исполнения данного изделия.
                                                        Цены указаны в рублях с учетом гравировки.</p>
                                                    <div class=\"table-scroll\">
                                                        <table class=\"gold\" id=\"";
                        // line 68
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                        echo "\">
                                                            <tr style=\"background: white;\">
                                                                <td class=\"gold__th\">Металл и камни</td>
                                                                <td class=\"gold__th\">Цена</td>
                                                            </tr>

                                                            ";
                        // line 74
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
                            // line 75
                            echo "                                                                <tr>
                                                                    <td>
                                                                        <span class=\"g_name\">";
                            // line 77
                            echo $this->getAttribute($context["of"], "name", array());
                            echo "</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class=\"saphire\">

                                                                            <input class=\"x-offer saphire__input\" type=\"radio\"
                                                                                   name=\"offer";
                            // line 83
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "id", array()), "html", null, true);
                            echo "\"
                                                                                   value=\"";
                            // line 84
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                                   id=\"offer";
                            // line 85
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\"
                                                                                   ";
                            // line 86
                            if ($this->getAttribute($context["loop"], "first", array())) {
                                echo "checked";
                            }
                            echo ">

                                                                            <label class=\"saphire__label g_price\" for=\"offer";
                            // line 88
                            echo twig_escape_filter($this->env, $this->getAttribute($context["of"], "id", array()), "html", null, true);
                            echo "\">
                                                                                ";
                            // line 89
                            echo $this->getAttribute($context["of"], "displayPrice", array());
                            if (($this->getAttribute($context["of"], "discount", array()) > 0)) {
                                // line 90
                                echo "                                                                                    <del class=\"text-dark-gray\">";
                                echo $this->getAttribute($context["of"], "displayFullPrice", array());
                                echo "</del>";
                            }
                            // line 91
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
                        // line 97
                        echo "                                                        </table>
                                                    </div>

                                                ";
                    }
                    // line 101
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
                // line 108
                echo "                </div>
                <div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 110
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
        return array (  326 => 110,  322 => 108,  302 => 101,  296 => 97,  277 => 91,  272 => 90,  269 => 89,  265 => 88,  258 => 86,  254 => 85,  250 => 84,  246 => 83,  237 => 77,  233 => 75,  216 => 74,  207 => 68,  202 => 65,  200 => 64,  191 => 58,  185 => 55,  176 => 49,  169 => 47,  165 => 45,  157 => 43,  150 => 41,  144 => 40,  138 => 37,  128 => 30,  121 => 27,  118 => 26,  116 => 25,  113 => 24,  96 => 23,  91 => 20,  89 => 19,  86 => 18,  83 => 17,  80 => 16,  77 => 15,  74 => 14,  71 => 13,  69 => 12,  60 => 8,  56 => 7,  53 => 6,  50 => 5,  47 => 4,  29 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/main_pop.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/list/main_pop.twig");
    }
}

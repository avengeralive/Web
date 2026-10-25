<?php

/* @widget/sale.filter/default.twig */
class __TwigTemplate_1d68680136b141f2f7ab6d08d41a7d4eddddab816ff12977f297934675c59847 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'responsive_toggle' => array($this, 'block_responsive_toggle'),
            'checkbox' => array($this, 'block_checkbox'),
            'numeric_slider' => array($this, 'block_numeric_slider'),
            'numeric' => array($this, 'block_numeric'),
            'radio' => array($this, 'block_radio'),
            'dropdown' => array($this, 'block_dropdown'),
            'buttons' => array($this, 'block_buttons'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
        // line 140
        echo "
";
        // line 141
        ob_start();
        // line 142
        $this->displayBlock('script', $context, $blocks);
        $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 646
        $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("
<script>" .         // line 647
(isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
    }

    // line 1
    public function block_html($context, array $blocks = array())
    {
        // line 2
        echo "<div id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "\" class=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
        echo "\">

    ";
        // line 4
        $this->displayBlock('responsive_toggle', $context, $blocks);
        // line 10
        echo "
    <div id=\"filter-";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "\">

        <div class=\"row\">
            <div class=\"large-17 columns large-centered\">

                <form action=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "action"), "method"), "html", null, true);
        echo "\">

                    ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "getInfo", array(), "method"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 19
            echo "                    <p></p>
                    <hr class=\"filter__hr\">
                    <div class=\"row filter__name\">
                        ";
            // line 23
            echo "                        <div class=\"columns medium-6\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "describ", array()), "html", null, true);
            echo "</div>
                        <div class=\"columns medium-18\">
                        \t<div class=\"row\">
                            ";
            // line 26
            if (($this->getAttribute($context["f"], "filter_type", array()) == twig_constant("\\Sale\\Filter::TYPE_CHECKBOX"))) {
                // line 27
                echo "
                            ";
                // line 28
                $this->displayBlock('checkbox', $context, $blocks);
                // line 49
                echo "
                            ";
            }
            // line 51
            echo "                            ";
            if (($this->getAttribute($context["f"], "filter_type", array()) == twig_constant("\\Sale\\Filter::TYPE_NUMERIC_SLIDER"))) {
                // line 52
                echo "
                            ";
                // line 53
                $this->displayBlock('numeric_slider', $context, $blocks);
                // line 69
                echo "
                            ";
            }
            // line 71
            echo "
                            ";
            // line 72
            if (($this->getAttribute($context["f"], "filter_type", array()) == twig_constant("\\Sale\\Filter::TYPE_NUMERIC"))) {
                // line 73
                echo "
                            ";
                // line 74
                $this->displayBlock('numeric', $context, $blocks);
                // line 86
                echo "
                            ";
            }
            // line 88
            echo "
                            ";
            // line 89
            if (($this->getAttribute($context["f"], "filter_type", array()) == twig_constant("\\Sale\\Filter::TYPE_RADIO"))) {
                // line 90
                echo "                            ";
                $this->displayBlock('radio', $context, $blocks);
                // line 96
                echo "                            ";
            }
            // line 97
            echo "
                            ";
            // line 98
            if (($this->getAttribute($context["f"], "filter_type", array()) == twig_constant("\\Sale\\Filter::TYPE_DROPDOWN"))) {
                // line 99
                echo "                            ";
                $this->displayBlock('dropdown', $context, $blocks);
                // line 108
                echo "                            ";
            }
            // line 109
            echo "                        </div>
                    \t</div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "
                    <p></p>
                    <hr class=\"filter__hr\">
                    ";
        // line 116
        $this->displayBlock('buttons', $context, $blocks);
        // line 131
        echo "
                </form>


            </div>
        </div>
    </div>
</div>
";
    }

    // line 4
    public function block_responsive_toggle($context, array $blocks = array())
    {
        // line 5
        echo "    <!--<p class=\"show-for-small-only\" data-responsive-toggle=\"filter-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "\" data-hide-for=\"medium\">
        <span class=\"button light-gray expanded\" data-toggle><i
                class=\"fa fa-lg fa-filter\"></i>&nbsp;";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Фильтр")), "html", null, true);
        echo "</span>
    </p>-->
    ";
    }

    // line 28
    public function block_checkbox($context, array $blocks = array())
    {
        // line 29
        echo "                            ";
        if ($this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array())) {
            // line 30
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array()));
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
                // line 31
                echo "
                            <div
                                class=\"saphire ";
                // line 33
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array())) > 0)) {
                    echo "large-8 columns ";
                    if ($this->getAttribute($context["loop"], "last", array())) {
                        echo "end";
                    }
                }
                echo "\">
                                <input id=\"";
                // line 34
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "\" class=\"saphire__input\"
                                       name=\"";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
                echo "[";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
                echo "][";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "]\" ";
                if (($this->getAttribute($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "value", array(), "any", false, true), $this->getAttribute($context["m"], "id", array()), array(), "array", true, true) && $this->getAttribute($this->getAttribute(                // line 36
(isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value", array()), $this->getAttribute($context["m"], "id", array()), array(), "array"))) {
                    echo "checked";
                }
                echo " value=\"1\" type=\"checkbox\">
                                <label class=\"saphire__label\" for=\"";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
                echo "</label>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "                            ";
        } else {
            // line 41
            echo "                            <div class=\"saphire ";
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array())) > 0)) {
                echo "large-8 columns end";
            }
            echo "\">
                                <input id=\"";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "id", array()), "html", null, true);
            echo "\" class=\"saphire__input\"
                                       name=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
            echo "[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
            echo "]\" ";
            if (($this->getAttribute($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "value", array(), "any", false, true), $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "id", array()), array(), "array", true, true) && $this->getAttribute($this->getAttribute(            // line 44
(isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value", array()), $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "id", array()), array(), "array"))) {
                echo "checked";
            }
            echo " value=\"1\" type=\"checkbox\">
                                <label class=\"saphire__label\" for=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "name", array()), "html", null, true);
            echo "</label>
                            </div>
                            ";
        }
        // line 48
        echo "                            ";
    }

    // line 53
    public function block_numeric_slider($context, array $blocks = array())
    {
        // line 54
        echo "                            <div class=\"x-sale-slider-range\" data-control-start=\"sliderOutputStart\"
                                 data-control-end=\"sliderOutputEnd\" data-start=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "min", array()), "html", null, true);
        echo "\" data-end=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "max", array()), "html", null, true);
        echo "\"
                                 data-initial-start=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_min", array()), "html", null, true);
        echo "\" data-initial-end=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_max", array()), "html", null, true);
        echo "\"></div>

                            <div class=\"row collapse\">
                                <div class=\"small-6 column\">
                                    <input name=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
        echo "_min]\" id=\"sliderOutputStart\"
                                           data-default=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "min", array()), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_min", array()), "html", null, true);
        echo "\" type=\"text\">
                                </div>
                                <div class=\"small-6 column\">
                                    <input name=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
        echo "_max]\" id=\"sliderOutputEnd\"
                                           data-default=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "max", array()), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_max", array()), "html", null, true);
        echo "\" type=\"text\">
                                </div>
                            </div>
                            ";
    }

    // line 74
    public function block_numeric($context, array $blocks = array())
    {
        // line 75
        echo "                            <div class=\"row collapse\">
                                <div class=\"small-6 column\">
                                    <input name=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
        echo "_min]\" id=\"sliderOutputStart\"
                                           data-default=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "min", array()), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_min", array()), "html", null, true);
        echo "\" type=\"text\">
                                </div>
                                <div class=\"small-6 column\">
                                    <input name=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
        echo "_max]\" id=\"sliderOutputEnd\"
                                           data-default=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "max", array()), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value_max", array()), "html", null, true);
        echo "\" type=\"text\">
                                </div>
                            </div>
                            ";
    }

    // line 90
    public function block_radio($context, array $blocks = array())
    {
        // line 91
        echo "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 92
            echo "                            <label><input name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
            echo "[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
            echo "]\" ";
            if (($this->getAttribute($context["m"], "id", array()) == $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value", array()))) {
                echo "checked";
            }
            // line 93
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\" type=\"radio\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</label>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        echo "                            ";
    }

    // line 99
    public function block_dropdown($context, array $blocks = array())
    {
        // line 100
        echo "                            <select name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "name", array()), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "name", array()), "html", null, true);
        echo "]\">
                                <option value=\"\"></option>
                                ";
        // line 102
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "iterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 103
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\"
                                ";
            // line 104
            if (($this->getAttribute($context["m"], "id", array()) == $this->getAttribute((isset($context["f"]) ? $context["f"] : $this->getContext($context, "f")), "value", array()))) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        echo "                            </select>
                            ";
    }

    // line 116
    public function block_buttons($context, array $blocks = array())
    {
        // line 117
        echo "                    <p></p>
                    <div class=\"";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
        echo "__buttons row medium-up-2\">
                        <div class=\"columns\">
                            <button class=\"button reset expanded x-clear-all ";
        // line 120
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
        echo "__clear\">
                                Сбросить
                            </button>
                        </div>
                        <div class=\"columns\">
                            <button class=\"button apply expanded ";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "css_class"), "method"), "html", null, true);
        echo "__submit\"
                                    type=\"submit\">Применить
                            </button>
                        </div>
                    </div>
                    ";
    }

    // line 142
    public function block_script($context, array $blocks = array())
    {
        // line 143
        echo "
var ColorsBlockList = new Object();
ColorsBlockList = {};
var MetalBlockList = new Object()
MetalBlockList = {};
var StoneBlockList = new Object();
StoneBlockList = {};
var PendentSizeBlockList = new Object();
PendentSizeBlockList = {};
var PendentTypeBlockList = new Object();
PendentTypeBlockList = {};



var brilliantColors = ['stone_color_46','stone_color_47','stone_color_48','stone_color_49','stone_color_51'];
var turmalineColors = ['stone_color_55'];
var saphireColors = ['stone_color_47','stone_color_50','stone_color_49','stone_color_51','stone_color_53'];
var rubineColors = ['stone_color_54'];
var izumrudColors = ['stone_color_56'];
var fianitColors = ['stone_color_46', 'stone_color_47', 'stone_color_48','stone_color_50','stone_color_51',
'stone_color_52','stone_color_53','stone_color_54','stone_color_55','stone_color_56'];
var shpinelColors = ['stone_color_47','stone_color_49'];
var serebroRule = ['stone_38','stone_44'];

var kulBoyRule = ['pendent_size_88','pendent_size_89','pendent_size_90','pendent_size_91','pendent_size_92',
'pendent_size_93','pendent_size_94','pendent_size_95','pendent_size_100'];
var kulGirlRule = ['pendent_size_88','pendent_size_89','pendent_size_90','pendent_size_91','pendent_size_92',
'pendent_size_93','pendent_size_94','pendent_size_95','pendent_size_100'];
var kulCoronaRule = ['pendent_size_90','pendent_size_92','pendent_size_94','pendent_size_95'];
var kulLegsRule = ['pendent_size_88','pendent_size_90'];
var kulMomRule = ['pendent_size_91','pendent_size_95','pendent_size_97','pendent_size_98','pendent_size_99',
'pendent_size_100','pendent_size_105'];
var kulHeartRule = ['pendent_size_84','pendent_size_85','pendent_size_86','pendent_size_90','pendent_size_97',
'pendent_size_98','pendent_size_101'];
var kulStarRule = ['pendent_size_84','pendent_size_90','pendent_size_95'];
var kulEyeRule = ['pendent_size_86','pendent_size_90'];




document.addEventListener('DOMContentLoaded', function () {

jQuery('#";
        // line 185
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-clear').click(function(){
saleClearFilter( jQuery(this).parents('.x-filter') );
return false;
});

jQuery('#";
        // line 190
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-clear-all').click(function(){
saleClearFilter( jQuery('#";
        // line 191
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "') );
jQuery('#";
        // line 192
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " form').submit();
return false;
});

jQuery('#";
        // line 196
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "').find('.x-filter').each(function(){
saleCheckFilter( jQuery(this) );
});

jQuery('#";
        // line 200
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " input, #";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " select').on('change', function(){
saleCheckFilter( jQuery(this).parents('.x-filter') );
});


//
jQuery('#";
        // line 206
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " input, #";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " select').on('change', function()
{
  inputsSwitcher(\$(this).prop('id'), \$(this).prop('checked'));
  console.log('click on ' + \$(this).prop('id') + '; checked:' + \$(this).prop('checked') + \"; disabled: \" + \$(this).prop('disabled'));
});

//Восстанавливаем блокировку чекбоксов после обновления страницы
jQuery(document).ready(function()
{
  var listInputsMetal = document.querySelectorAll(\"input[name*='filter[metal]']:checked\");
  listInputsMetal.forEach(function(Input)
  {
    inputsSwitcher(Input.id,true);
  });

  var listInputsStones = document.querySelectorAll(\"input[name*='filter[stone]']:checked\");
  listInputsStones.forEach(function(Input)
  {
    inputsSwitcher(Input.id,true);
  });

  var listPendentTypes = document.querySelectorAll(\"input[name*='filter[pendent_type]']:checked\");
  listPendentTypes.forEach(function(Input)
  {
    inputsSwitcher(Input.id,true);
  });

});


//

});


function inputsSwitcher(inputID,checkState)
{
  switch (inputID)
  {
    //Бриллианты
    case 'stone_39':
    {
      if (checkState)
      {
        ColorsBlockList['stone_39'] = (brilliantColors);
      }
      else
      {
        delete ColorsBlockList['stone_39'];
      }
      break;
    }
    //Турмалины какието
    case 'stone_40':
    {
      if (checkState)
      {
        ColorsBlockList['stone_40'] = (turmalineColors);
      }
      else
      {
        delete ColorsBlockList['stone_40'];
      }
      break;
    }
    //Сапфиры
    case 'stone_41':
    {
      if (checkState)
      {
        ColorsBlockList['stone_41'] = (saphireColors);
      }
      else
      {
        delete ColorsBlockList['stone_41'];
      }
      break;
    }
    //Рубины
    case 'stone_42':
    {
      if (checkState)
      {
        ColorsBlockList['stone_42'] = (rubineColors);
      }
      else
      {
        delete ColorsBlockList['stone_42'];
      }
      break;
    }
    //Изумруды
    case 'stone_43':
    {
      if (checkState)
      {
        ColorsBlockList['stone_43'] = (izumrudColors);
      }
      else
      {
        delete ColorsBlockList['stone_43'];
      }
      break;
    }
    //Фианиты
    case 'stone_44':
    {
      if (checkState)
      {
        ColorsBlockList['stone_44'] = (fianitColors);
      }
      else
      {
        delete ColorsBlockList['stone_44'];
      }
      break;
    }
    //Шпинель
    case 'stone_45':
    {
      if (checkState)
      {
        ColorsBlockList['stone_45'] = (shpinelColors);
      }
      else
      {
        delete ColorsBlockList['stone_45'];
      }
      break;
    }
    //Без камней
    case 'stone_38':
    {
      if (checkState)
      {
          var stoneRule = ['stone_38'];
          if (document.getElementById('metal_79').checked)
          {
            delete StoneBlockList['metal_79'];
          }
          StoneBlockList['stone_38'] = (stoneRule);
          ColorsBlockList = {};
          ColorsBlockList['stone_38'] = 'BLOCK_ALL_INPUTS';
      }
      else
      {
        if (document.getElementById('metal_79').checked)
        {
          StoneBlockList['metal_79'] = (serebroRule);
        }
        delete StoneBlockList['stone_38'];
        delete ColorsBlockList['stone_38'];
      }
      break;
    }
    //металл серебро
    case 'metal_79':
    {
      if (checkState)
      {
        StoneBlockList['metal_79'] = (serebroRule);
      }
      else
      {
        delete StoneBlockList['metal_79'];
      }
      break;
    }
    case 'pendent_type_57':
    {
      if (checkState)
      {
        PendentSizeBlockList['pendent_type_57'] = (kulBoyRule);
      }
      else
      {
        delete PendentSizeBlockList['pendent_type_57'];
      }
      break;
    }
    case 'pendent_type_58':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_58'] = (kulGirlRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_58'];
      }
      break;
    }

    case 'pendent_type_59':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_59'] = (kulCoronaRule);
          PendentTypeBlockList['pendent_type_59'] = ['pendent_type_57','pendent_type_58','pendent_type_59'];
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_59'];
          delete PendentTypeBlockList['pendent_type_59'];
      }
      break;
    }

    case 'pendent_type_60':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_60'] = (kulLegsRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_60'];
      }
      break;
    }

    case 'pendent_type_61':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_61'] = (kulMomRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_61'];
      }
      break;
    }
    case 'pendent_type_62':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_62'] = (kulHeartRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_62'];
      }
      break;
    }

    case 'pendent_type_64':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_64'] = (kulStarRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_64'];
      }
      break;
    }

    case 'pendent_type_71':
    {
      if (checkState)
      {
          PendentSizeBlockList['pendent_type_71'] = (kulEyeRule);
      }
      else
      {
          delete PendentSizeBlockList['pendent_type_71'];
      }
      break;
    }
    default:
    {
      return 0;
    }



  }

//  console.log('Switch: ',inputID + \" Checked: \" + checkState);
  experementalBlocker();
}

function experementalBlocker()
{
  if (jQuery.isEmptyObject(StoneBlockList))
  {
      filterUnblockThisInputs(\"input[name*='filter[stone]']\");
  }
  else
  {
    filterBlockThisInputs(\"input[name*='filter[stone]']\");
    \$.each(StoneBlockList, function(index, value)
    {
      value.forEach(function(elem)
      {
        \$(document.getElementById(elem)).prop('disabled', false);
      });

    filterUncheckBlockedInputs(\"input[name*='filter[stone]']\");
  });
  }


  if (jQuery.isEmptyObject(ColorsBlockList))
  {
    filterUnblockThisInputs(\"input[name*='filter[stone_color]']\")
  }
  else
  {
    filterBlockThisInputs(\"input[name*='filter[stone_color]']\");
    \$.each(ColorsBlockList, function(index, value)
    {
      if (value != ('BLOCK_ALL_INPUTS'))
      {
        value.forEach(function(elem)
        {
            //document.getElementById(elem).disabled = false;
            \$(document.getElementById(elem)).prop('disabled', false);
        //    console.log('unblock: ',elem);
        });
      }
      filterUncheckBlockedInputs(\"input[name*='filter[stone_color]']\");
  });
  }

  if (jQuery.isEmptyObject(PendentSizeBlockList))
  {
    filterUnblockThisInputs(\"input[name*='filter[pendent_size]']\")
  }
  else
  {
    filterBlockThisInputs(\"input[name*='filter[pendent_size]']\");
    \$.each(PendentSizeBlockList, function(index, value)
    {
      value.forEach(function(elem)
      {
          //document.getElementById(elem).disabled = false;
          \$(document.getElementById(elem)).prop('disabled', false);
      });

    filterUncheckBlockedInputs(\"input[name*='filter[pendent_size]']\");
  });
  }

  if (jQuery.isEmptyObject(PendentTypeBlockList))
  {
    filterUnblockThisInputs(\"input[name*='filter[pendent_type]']\")
  }
  else
  {
    filterBlockThisInputs(\"input[name*='filter[pendent_type]']\");
    \$.each(PendentTypeBlockList, function(index, value)
    {
      value.forEach(function(elem)
      {
          //document.getElementById(elem).disabled = false;
          \$(document.getElementById(elem)).prop('disabled', false);
      });

    filterUncheckBlockedInputs(\"input[name*='filter[pendent_type]']\");
  });
  }

}

//блокирует все инпуты с принятого селектора
function filterBlockThisInputs(inputsSelector)
{
  var listInputs = document.querySelectorAll(inputsSelector);
  listInputs.forEach(function(element)
  {
    //  console.log('Block ' + element.id);
    //  element.disabled = true;
      \$(document.getElementById(element.id)).prop('disabled', true);
  });
}
//Разблокировывает все инпуты с принятого селектора
function filterUnblockThisInputs(inputsSelector)
{
  var listInputs = document.querySelectorAll(inputsSelector);
  listInputs.forEach(function(input)
  {
  //  console.log('Unblock ' + input.id)
  //  input.disabled = false;

    \$(document.getElementById(input.id)).prop('disabled', false);
  //  \$(input).prop('disabled', false);
  });
}
//Принимает селектор, и снимает чек со всех хаблокирвоанных инпутов
function filterUncheckBlockedInputs(inputsSelector)
{
  //inputsSelector = inputsSelector + ':disabled';
  var blockedinputs = document.querySelectorAll(inputsSelector)
  {
    blockedinputs.forEach(function(element)
    {
      var elem = document.getElementById(element.id);
      if(\$(elem).prop('checked') && \$(elem).prop('disabled'))
      {
        //  console.log('Unchek on ',elem.id + ' Disabled: ' + elem.disabled);
          \$(elem).prop('checked', false).trigger('change');
      }
    });

  }
}


function saleClearFilter(elm) {
elm.find('input[type=\"text\"]').each(function(){
jQuery(this).val( jQuery(this).attr('data-default') ).trigger('change');
});
elm.find('input:checked').prop('checked', false);
elm.find('select').val('');
saleCheckFilter(elm);
}
function saleCheckFilter(elm) {
var c = elm.find('.x-clear');
if (elm.find('input[type=\"checkbox\"], input[type=\"radio\"]').length>0)
{
c.toggle(  elm.find(':checked').length > 0 );
}
if (elm.find('select').length>0)
{
c.toggle( elm.find('select').val() != '' );
}
if (elm.find('input[type=\"text\"]').length>0)
{
var f = false;
elm.find('input[type=\"text\"]').each(function(){
if (jQuery(this).val() != jQuery(this).attr('data-default')) f = true;
});
c.toggle( f );
}
}
";
    }

    public function getTemplateName()
    {
        return "@widget/sale.filter/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  605 => 206,  594 => 200,  587 => 196,  580 => 192,  576 => 191,  572 => 190,  564 => 185,  520 => 143,  517 => 142,  507 => 125,  499 => 120,  494 => 118,  491 => 117,  488 => 116,  483 => 106,  471 => 104,  466 => 103,  462 => 102,  454 => 100,  451 => 99,  447 => 95,  436 => 93,  427 => 92,  422 => 91,  419 => 90,  409 => 82,  403 => 81,  395 => 78,  389 => 77,  385 => 75,  382 => 74,  372 => 65,  366 => 64,  358 => 61,  352 => 60,  343 => 56,  337 => 55,  334 => 54,  331 => 53,  327 => 48,  317 => 45,  311 => 44,  306 => 43,  300 => 42,  293 => 41,  290 => 40,  269 => 37,  263 => 36,  256 => 35,  250 => 34,  241 => 33,  237 => 31,  219 => 30,  216 => 29,  213 => 28,  206 => 7,  200 => 5,  197 => 4,  185 => 131,  183 => 116,  178 => 113,  161 => 109,  158 => 108,  155 => 99,  153 => 98,  150 => 97,  147 => 96,  144 => 90,  142 => 89,  139 => 88,  135 => 86,  133 => 74,  130 => 73,  128 => 72,  125 => 71,  121 => 69,  119 => 53,  116 => 52,  113 => 51,  109 => 49,  107 => 28,  104 => 27,  102 => 26,  95 => 23,  90 => 19,  73 => 18,  68 => 16,  60 => 11,  57 => 10,  55 => 4,  47 => 2,  44 => 1,  40 => 647,  38 => 646,  35 => 142,  33 => 141,  30 => 140,  28 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.filter/default.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/sale.filter/default.twig");
    }
}

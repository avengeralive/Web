<?php

/* @widget/list/stars_clients_list.twig */
class __TwigTemplate_a6f8e5a1c1c226d026f3f9818c8e9b08bc89cf0557bc7dfe9ef6955423789638 extends Twig_Template
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
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/list/stars_clients_list.twig", 1)->display($context);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 4
        echo "
  \t";
        // line 5
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()))) {
            // line 6
            echo "
\t\t";
            // line 7
            $this->displayBlock('items', $context, $blocks);
            // line 58
            echo "
</div>
    ";
        }
        // line 61
        echo "    ";
    }

    // line 7
    public function block_items($context, array $blocks = array())
    {
        // line 8
        echo "
\t\t\t";
        // line 9
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
            // line 10
            echo "\t\t\t";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "<div class=\"row\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 11
            echo "    <div class=\"columns medium-8\">
        <div class=\"bracelet bracelet_star\" id='";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "' data-equalizer-watch>
          <p><a href=\"#\"><img src=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "star_logo", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "\"></a></p>
          <p><a class=\"bracelet__price\" href=\"#\">";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</a></p>

        </div>
    </div>
    ";
            // line 18
            $context["d"] = 0;
            // line 19
            echo "\t\t\t\t  ";
            if ((($this->getAttribute($context["loop"], "index", array()) % 3) == 0)) {
                // line 20
                echo "                      ";
                $context["d"] = 3;
                // line 21
                echo "                  ";
            } else {
                // line 22
                echo "                      ";
                $context["d"] = ($this->getAttribute($context["loop"], "index", array()) % 3);
                // line 23
                echo "                  ";
            }
            // line 24
            echo "
\t\t\t\t  ";
            // line 25
            if ((((($this->getAttribute($context["loop"], "index", array()) % 3) == 0) || (($this->getAttribute($context["loop"], "index", array()) + 1) == $this->getAttribute($context["loop"], "last", array()))) || $this->getAttribute($context["loop"], "last", array()))) {
                // line 26
                echo "    </div>
    <div class=\"row\">
        ";
                // line 28
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
                    // line 29
                    echo "        <div class=\"columns medium-16 starcard\">
          <div class=\"filter filter_product filter_star text-left hide\">
            <div class=\"filter__triangle\"></div>
            <button class=\"close-button\" aria-label=\"Dismiss alert\" type=\"button\" data-close=\"\"><img src=\"/themes/shop/images/cross.svg\" alt=\"\" style=\"width: 14px; height: 14px;\"></button>
            <!--<div class=\"mb15\"></div>-->
            <div class=\"row\">
              <div class=\"column\" style=\"padding: 0px; height: 38px;\">
                <p style=\"margin-bottom: 20px; line-height: 18px;\"><a href=\"";
                    // line 36
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "instagram", array()), "html", null, true);
                    echo "\" target=\"_blank\" style=\"font-family: 'FedraSansAltPro-Bold',sans-serif;\">";
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "instsign", array()) == true)) {
                        echo "<img src=\"/uploads/images/insta-star.svg\" alt=\"\" style=\"width: 18px;\"> ";
                    }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "nicknameinst", array()), "html", null, true);
                    echo "</a></p>
              </div>
            </div>
            <div class=\"row\">

              ";
                    // line 41
                    if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "image", array()))) {
                        // line 42
                        echo "                <div class=\"filter__img columns medium-24 large-24 xlarge-24\" data-equalizer-watch><img src=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "image", array()), "html", null, true);
                        echo "\" alt=\"\" style=\"width: 100%; height: auto;\"></div>
              ";
                    }
                    // line 44
                    echo "
            </div>
            <div class=\"row\">
              <div class=\"columns filter__text\">
                ";
                    // line 48
                    echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), $context["i"], array(), "array"), "text", array());
                    echo "
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
                // line 54
                echo "    </div>
    <div class=\"row medium-up-3\" data-equalizer data-equalize-by-row=\"true\">";
            }
            // line 56
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
        // line 57
        echo "    ";
    }

    public function getTemplateName()
    {
        return "@widget/list/stars_clients_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 57,  202 => 56,  198 => 54,  178 => 48,  172 => 44,  166 => 42,  164 => 41,  151 => 36,  142 => 29,  125 => 28,  121 => 26,  119 => 25,  116 => 24,  113 => 23,  110 => 22,  107 => 21,  104 => 20,  101 => 19,  99 => 18,  92 => 14,  86 => 13,  82 => 12,  79 => 11,  74 => 10,  57 => 9,  54 => 8,  51 => 7,  47 => 61,  42 => 58,  40 => 7,  37 => 6,  35 => 5,  32 => 4,  26 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/stars_clients_list.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/list/stars_clients_list.twig");
    }
}

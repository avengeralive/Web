<?php

/* @widget/material/stars_material.twig */
class __TwigTemplate_55376c40ae97149e6d3f86dd5a95504f8afd6ff34d0494ac3f861790c2a49657 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'products' => array($this, 'block_products'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
";
        // line 2
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 3
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMaterial", array())) {
            // line 4
            echo "
\t\t<div class=\"row\">
\t\t\t<div class=\"large-16 large-centered columns\">
\t\t\t\t<h4 class=\"individual\">";
            // line 7
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array());
            echo "</h4>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"row\">
\t\t\t";
            // line 12
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()))) {
                // line 13
                echo "\t\t\t<div class=\"columns\">
\t\t\t\t<div class=\"princess\">
\t\t\t\t";
                // line 15
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "video", array()) != "")) {
                    // line 16
                    echo "\t\t\t\t\t<div>
\t\t\t\t\t\t<iframe width=\"100%\" height=\"850\" class=\"yt-player\" src=\"https://www.youtube.com/embed/";
                    // line 17
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "video", array()), "html", null, true);
                    echo "?controls=1&rel=0&enablejsapi=1\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>
\t\t\t\t\t</div>
\t\t\t\t";
                }
                // line 20
                echo "\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
                    // line 21
                    echo "\t\t\t\t\t<div>
\t\t\t\t\t\t<img alt=\"\" src=\"";
                    // line 22
                    echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "file", array()), "html", null, true);
                    echo "\" />
\t\t\t\t\t</div>
\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 25
                echo "\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            }
            // line 28
            echo "
\t\t\t<div class=\"large-16 large-centered columns celebrity\">
\t\t\t";
            // line 30
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "text", array());
            echo "
\t\t\t</div>
\t\t</div>

\t\t\t";
            // line 34
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()))) {
                // line 35
                echo "
\t\t\t";
                // line 36
                $context["prods"] = array();
                // line 37
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 38
                    echo "\t\t\t";
                    $context["prods"] = twig_array_merge((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), array($this->getAttribute($context["m"], "name", array()) => $this->getAttribute((isset($context["product_catalog"]) ? $context["product_catalog"] : $this->getContext($context, "product_catalog")), "getMaterialById", array(0 => $this->getAttribute($context["m"], "name", array())), "method")));
                    // line 39
                    echo "\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 40
                echo "\t\t\t";
                $this->displayBlock('products', $context, $blocks);
                // line 43
                echo "\t\t";
            }
            // line 44
            echo "
\t\t";
        }
    }

    // line 40
    public function block_products($context, array $blocks = array())
    {
        // line 41
        echo "\t\t\t";
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Goods.List", array("template" => "stars_collection_goods_list.twig", "products_list" => (isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods"))))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 42
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/material/stars_material.twig";
    }

    public function getDebugInfo()
    {
        return array (  139 => 42,  131 => 41,  128 => 40,  122 => 44,  119 => 43,  116 => 40,  110 => 39,  107 => 38,  102 => 37,  100 => 36,  97 => 35,  95 => 34,  88 => 30,  84 => 28,  79 => 25,  70 => 22,  67 => 21,  62 => 20,  56 => 17,  53 => 16,  51 => 15,  47 => 13,  45 => 12,  37 => 7,  32 => 4,  30 => 3,  24 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/material/stars_material.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/material/stars_material.twig");
    }
}

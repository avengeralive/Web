<?php

/* @widget/material/stars_material.twig */
class __TwigTemplate_1b1551c254466f57b62feb0c85230d904f136d1ac79ec4e271a9f0d220283ccd extends Twig_Template
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
\t\t";
            // line 12
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()))) {
                // line 13
                echo "\t\t\t<div class=\"columns\">
\t\t\t<div class=\"princess\">
\t\t\t";
                // line 15
                if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "video", array()) != "")) {
                    // line 16
                    echo "\t\t\t<div><iframe width=\"100%\" height=\"850\" class=\"yt-player\" src=\"https://www.youtube.com/embed/";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "video", array()), "html", null, true);
                    echo "?controls=1&rel=0&enablejsapi=1\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe></div>
\t\t\t";
                }
                // line 18
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
                    // line 19
                    echo "\t\t\t\t<div><img alt=\"\" src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "file", array()), "html", null, true);
                    echo "\" /></div>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 21
                echo "\t\t\t</div>
\t\t";
            }
            // line 23
            echo "
\t\t<div class=\"large-16 large-centered columns celebrity\">
\t\t";
            // line 25
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "text", array());
            echo "
\t\t</div>
\t\t</div>

\t\t\t";
            // line 29
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()))) {
                // line 30
                echo "
\t\t\t";
                // line 31
                $context["prods"] = array();
                // line 32
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 33
                    echo "\t\t\t";
                    $context["prods"] = twig_array_merge((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), array($this->getAttribute($context["m"], "name", array()) => $this->getAttribute((isset($context["product_catalog"]) ? $context["product_catalog"] : $this->getContext($context, "product_catalog")), "getMaterialById", array(0 => $this->getAttribute($context["m"], "name", array())), "method")));
                    // line 34
                    echo "\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 35
                echo "\t\t\t";
                $this->displayBlock('products', $context, $blocks);
                // line 38
                echo "\t\t";
            }
            // line 39
            echo "
\t\t";
        }
    }

    // line 35
    public function block_products($context, array $blocks = array())
    {
        // line 36
        echo "\t\t\t";
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Goods.List", array("template" => "stars_collection_goods_list.twig", "products_list" => (isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods"))))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 37
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/material/stars_material.twig";
    }

    public function getDebugInfo()
    {
        return array (  132 => 37,  124 => 36,  121 => 35,  115 => 39,  112 => 38,  109 => 35,  103 => 34,  100 => 33,  95 => 32,  93 => 31,  90 => 30,  88 => 29,  81 => 25,  77 => 23,  73 => 21,  64 => 19,  59 => 18,  53 => 16,  51 => 15,  47 => 13,  45 => 12,  37 => 7,  32 => 4,  30 => 3,  24 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/material/stars_material.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/material/stars_material.twig");
    }
}

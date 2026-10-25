<?php

/* @widget/material/stars_material.twig */
class __TwigTemplate_9813fcc0be7b5ff0ca67a5c120c9d863f78a936d5cbb5eb1ad548dd42b216191 extends Twig_Template
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
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "slider", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
                    // line 16
                    echo "\t\t\t\t<div><img alt=\"\" src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "file", array()), "html", null, true);
                    echo "\" /></div>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                echo "\t\t\t</div>
\t\t";
            }
            // line 20
            echo "
\t\t<div class=\"large-16 large-centered columns celebrity\">
\t\t";
            // line 22
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "text", array());
            echo "
\t\t</div>
\t\t</div>

\t\t\t";
            // line 26
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()))) {
                // line 27
                echo "
\t\t\t";
                // line 28
                $context["prods"] = array();
                // line 29
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "products", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                    // line 30
                    echo "\t\t\t";
                    $context["prods"] = twig_array_merge((isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods")), array($this->getAttribute($context["m"], "name", array()) => $this->getAttribute((isset($context["product_catalog"]) ? $context["product_catalog"] : $this->getContext($context, "product_catalog")), "getMaterialById", array(0 => $this->getAttribute($context["m"], "name", array())), "method")));
                    // line 31
                    echo "\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 32
                echo "\t\t\t";
                $this->displayBlock('products', $context, $blocks);
                // line 35
                echo "\t\t";
            }
            // line 36
            echo "

\t\t";
        }
    }

    // line 32
    public function block_products($context, array $blocks = array())
    {
        // line 33
        echo "\t\t\t";
        try {
            \Cetera\Application::getInstance()->getWidget("Sale.Goods.List", array("template" => "stars_collection_goods_list.twig", "products_list" => (isset($context["prods"]) ? $context["prods"] : $this->getContext($context, "prods"))))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 34
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/material/stars_material.twig";
    }

    public function getDebugInfo()
    {
        return array (  124 => 34,  116 => 33,  113 => 32,  106 => 36,  103 => 35,  100 => 32,  94 => 31,  91 => 30,  86 => 29,  84 => 28,  81 => 27,  79 => 26,  72 => 22,  68 => 20,  64 => 18,  55 => 16,  51 => 15,  47 => 13,  45 => 12,  37 => 7,  32 => 4,  30 => 3,  24 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/material/stars_material.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/material/stars_material.twig");
    }
}

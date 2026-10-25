<?php

/* @widget/menu/menu.twig */
class __TwigTemplate_330af35a7e52177ec5467aae635f3693c5ac35cc6b605bbbbfcbfad5e718498b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (((twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMaterials", array(), "method")) > 0))) {
            // line 2
            echo "<ul class=\"emerald\">
\t";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 4
                echo "    <li class=\"emerald__item\">
    
        <a href=\"";
                // line 6
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "prototype", array()), "url", array()), "html", null, true);
                echo "\" ";
                if (($this->getAttribute($context["c"], "id", array()) == 4)) {
                    echo " style=\"pointer-events: none;\" ";
                }
                echo " ";
                if ((($this->getAttribute($context["c"], "id", array()) == 492) || ($this->getAttribute($context["c"], "id", array()) == 493))) {
                    echo " style=\"display: none;\" ";
                }
                echo "class=\"emerald__link \">";
                echo $this->getAttribute($context["c"], "name", array());
                echo "</a>
\t\t";
                // line 7
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "showSubmenu", array(0 => $context["c"]), "method");
                echo "

    </li>
    
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "

</ul>
";
        }
    }

    public function getTemplateName()
    {
        return "@widget/menu/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 12,  46 => 7,  32 => 6,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/menu/menu.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/menu/menu.twig");
    }
}

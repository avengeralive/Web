<?php

/* @widget/menu/sitemap.twig */
class __TwigTemplate_762a422c73484ad86d40d1d2db3eacf69c58a41f36c5f1927815a7c9a825a792 extends Twig_Template
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
            echo "<ul class=\"emerald\" style=\"padding-left: 0px;\">
\t";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 4
                echo "
\t\t<li class=\"emerald__item\">
\t\t
\t\t\t<a href=\"";
                // line 7
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "prototype", array()), "url", array()), "html", null, true);
                echo "\" ";
                if (($this->getAttribute($context["c"], "id", array()) == 4)) {
                    echo " style=\"pointer-events: none;\" ";
                }
                echo " class=\"\">";
                echo $this->getAttribute($context["c"], "name", array());
                echo "</a>

\t\t\t";
                // line 9
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "showSubmenu", array(0 => $context["c"]), "method");
                echo "

\t\t\t";
                // line 11
                if (($this->getAttribute($context["c"], "id", array()) == 487)) {
                    // line 12
                    echo "\t\t\t\t<ul class=\"emerald\">
\t\t\t\t\t<li class=\"emerald__item\">
\t\t\t\t\t\t<a class=\"\" href=\"/jewellry/star_collections/anastasii-tsvetaevoj/\">Звездная коллекция Анастасии Цветаевой</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>\t\t
\t\t\t";
                }
                // line 18
                echo "\t\t\t
\t\t</li>
    
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "

</ul>
";
        }
    }

    public function getTemplateName()
    {
        return "@widget/menu/sitemap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 22,  59 => 18,  51 => 12,  49 => 11,  44 => 9,  33 => 7,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/menu/sitemap.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/menu/sitemap.twig");
    }
}

<?php

/* @widget/breadcrumbs/default.twig */
class __TwigTemplate_febfb77d52fb51a05da4e8232d0f8a47e027f94cedbf703830709ad38d0ac6f8 extends Twig_Template
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
        echo "<ul class=\"breadcrumbs\">
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "items", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 3
            echo "
\t<li";
            // line 4
            if ($this->getAttribute($context["loop"], "last", array())) {
                echo " class=\"current\"";
            }
            echo ">
\t\t<a href=\"";
            // line 5
            if ($this->getAttribute($context["c"], "url", array(), "any", true, true)) {
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "url", array()), "html", null, true);
            }
            echo "\">";
            echo twig_escape_filter($this->env, strip_tags($this->getAttribute($context["c"], "name", array())), "html", null, true);
            echo "</a>
\t</li>

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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "\t
</ul>";
    }

    public function getTemplateName()
    {
        return "@widget/breadcrumbs/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 8,  48 => 5,  42 => 4,  39 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/breadcrumbs/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/breadcrumbs/default.twig");
    }
}

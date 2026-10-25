<?php

/* @widget/list/contacts-info-list.twig */
class __TwigTemplate_6fab040282d90b093edae6151625cdedca49a9cd85d4f0197c2ca4dfe0dac98c extends Twig_Template
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
        echo "<div class=\"large-16 columns large-centered\">
  ";
        // line 3
        echo "  <h5 class=\"individual\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
        echo "</h5>
</div>
<div class=\"columns\">
    <hr class=\"individual-hr\" style=\"margin-top: 0px;\">
</div>
<div class=\"column contacts large-16 large-centered\">

  ";
        // line 10
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()))) {
            // line 11
            echo "  ";
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
                // line 12
                echo "
  <div class=\"row\">
  <div class=\"columns large-6\" style=\"padding-left: 0px;\">
    <p>";
                // line 15
                echo $this->getAttribute($context["m"], "name", array());
                echo "</p>
  </div>

  <div class=\"columns large-18\">
    ";
                // line 19
                echo $this->getAttribute($context["m"], "short", array());
                echo "
  </div>
  </div>

  ";
                // line 23
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    // line 24
                    echo "  
  ";
                }
                // line 26
                echo "
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
            // line 28
            echo "  ";
        }
        // line 29
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "@widget/list/contacts-info-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 29,  93 => 28,  78 => 26,  74 => 24,  72 => 23,  65 => 19,  58 => 15,  53 => 12,  35 => 11,  33 => 10,  22 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/contacts-info-list.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/list/contacts-info-list.twig");
    }
}

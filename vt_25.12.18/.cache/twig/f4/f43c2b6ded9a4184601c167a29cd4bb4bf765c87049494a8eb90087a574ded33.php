<?php

/* @widget/list/metals_stones_list.twig */
class __TwigTemplate_07d16b0f2e929a4cbd7bc9ce89e783624daa7bf4eab3d263fde6ccae1e733d5e extends Twig_Template
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
        echo "
";
        // line 3
        echo "
";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()), "orderBy", array(0 => "tag"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 5
            echo "<p>
    <strong>";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</strong>

<p>
<p>&nbsp<p>
";
            // line 10
            if (twig_length_filter($this->env, $this->getAttribute($context["m"], "images", array()))) {
                // line 11
                echo "
<div class=\"row\">
  <div class=\"large-18 columns large-centered\">
    <div class=\"row large-up-4 medium-up-4 small-up-4 text-center\">
      ";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["m"], "images", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 16
                    echo "      <div class=\"columns chain\">
        <div class=\"chain__img\">
          <p><a href=\"/jewelry/stones/\"><img alt=\"Металлы\" src=\"";
                    // line 18
                    echo twig_escape_filter($this->env, $this->getAttribute($context["i"], "file", array()), "html", null, true);
                    echo "\" /> </a></p>
        </div>
      </div>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "    </div>
  </div>
</div>
";
            }
            // line 26
            echo "<p>&nbsp</p>

<p>  ";
            // line 28
            echo $this->getAttribute($context["m"], "text", array());
            echo " </p>
<p>&nbsp</p>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@widget/list/metals_stones_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 28,  71 => 26,  65 => 22,  55 => 18,  51 => 16,  47 => 15,  41 => 11,  39 => 10,  32 => 6,  29 => 5,  25 => 4,  22 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/metals_stones_list.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/list/metals_stones_list.twig");
    }
}

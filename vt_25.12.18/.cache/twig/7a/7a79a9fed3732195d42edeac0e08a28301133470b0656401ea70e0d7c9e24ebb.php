<?php

/* page_intermed.twig */
class __TwigTemplate_d25c7911dbea85a750d7a693f0fdd7b2d019de6f12d60e1c7bc769425f947299 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_intermed.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_main($context, array $blocks = array())
    {
        // line 5
        echo "
<!--

    <div class=\"row large-up-2 medium-up-2 small-up-1\">
        <div class=\"column\">
          <div class=\"product\"><a class=\"product__title\" href=\"/jewellry/bracelets/gold_silver_bracelets/\"><b>Браслеты из золота и серебра</b></a>
            <div class=\"product__img\"><a href=\"/jewellry/bracelets/gold_silver_bracelets/\"><img src=\"/themes/shop/i/gs_bracelet.png\" alt=\"\"></a></div>
          </div>
        </div>
        <div class=\"column\">
          <div class=\"product\"><a class=\"product__title\" href=\"/jewellry/bracelets/bracelets-threads/\"><b>Браслеты-нити</b></a>
            <div class=\"product__img\"><a href=\"/jewellry/bracelets/bracelets-threads/\"><img src=\"/themes/shop/i/st_bracelet.png\" alt=\"\"></a></div>
          </div>
        </div>
    </div>

  -->
<div class=\"row large-up-2 medium-up-2 small-up-1\">
  ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 24
            echo "
  <div class=\"column\">
    <div class=\"product\"><a class=\"product__title\" href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "url", array()), "html", null, true);
            echo "\"><b>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</b></a>
      <div class=\"product__img\"><a href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "url", array()), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "pic", array()), "html", null, true);
            echo "\" alt=\"\"></a></div>
    </div>
  </div>

  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "page_intermed.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 32,  64 => 27,  58 => 26,  54 => 24,  50 => 23,  30 => 5,  27 => 4,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_intermed.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/design/page_intermed.twig");
    }
}

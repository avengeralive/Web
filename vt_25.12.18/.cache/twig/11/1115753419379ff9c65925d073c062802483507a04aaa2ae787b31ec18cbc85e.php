<?php

/* @widget/_common/favorite.twig */
class __TwigTemplate_01f383b5fb5ae11ab8728d689098d70956a5870f551a3128c3b971c970c012d9 extends Twig_Template
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
        echo "<div id=\"add-to-favourites-auth-popup\" data-reveal class=\"reveal tiny\">
      <div class=\"row column text-center\">

          <p>";
        // line 4
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Чтобы сохранять список, вам нужно:")), "html", null, true);
        echo "</p><a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "login_url"), "method"), "html", null, true);
        echo "\" title=\"\" class=\"button expanded\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Войти")), "html", null, true);
        echo "</a>
          <p>";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("или")), "html", null, true);
        echo "</p><a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "register_url"), "method"), "html", null, true);
        echo "\" title=\"\" class=\"button expanded\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Зарегистрироваться")), "html", null, true);
        echo "</a>

      </div>
      <button data-close aria-label=\"Закрыть\" class=\"close-button\"><span aria-hidden=\"true\">&times;</span></button>
</div>";
    }

    public function getTemplateName()
    {
        return "@widget/_common/favorite.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/_common/favorite.twig", "/home/velvetin/alfa.velvetin.ru/docs/plugins/sale/widgets/_common/favorite.twig");
    }
}

<?php

/* page_recover-password.twig */
class __TwigTemplate_685237b138369c3ae302119b02439a4ed761543b3bb06e31a83d7b7d47ca4d7c extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_recover-password.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "
\t<div class=\"content\">
      <div class=\"row\">
        <div class=\"small-24 medium-12 large-8 medium-centered column\">
          <h1>";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Восстановить пароль")), "html", null, true);
        echo "</h1>
          <p class=\"text-dark-gray\">";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Введите адрес электронной почты (email), указанный при регистрации. Вы получите новый пароль.")), "html", null, true);
        echo "</p>
\t\t  ";
        // line 10
        try {
            \Cetera\Application::getInstance()->getWidget("User.Recover", array())->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 11
        echo "          <p><a href=\"/login\">← ";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вернуться")), "html", null, true);
        echo "</a></p>
        </div>
      </div>
    </div>
\t
";
    }

    public function getTemplateName()
    {
        return "page_recover-password.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 11,  44 => 10,  40 => 9,  36 => 8,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_recover-password.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_recover-password.twig");
    }
}

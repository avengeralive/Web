<?php

/* page_login.twig */
class __TwigTemplate_240293ea017913d6c4c092734bafd876654ef724e32098ba5c28fab1ac97bf92 extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_login.twig", 1);
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
    <div class=\"content\">
      <div class=\"row\">
        <div class=\"column small-24 medium-12 large-8 medium-centered\">
          <ul id=\"auth-tabs\" data-tabs class=\"tabs\">
            <li class=\"tabs-title";
        // line 9
        if ( !(isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " is-active";
        }
        echo "\"><a href=\"#login-tab\"";
        if ( !(isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " aria-selected=\"true\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вход")), "html", null, true);
        echo "</a></li>
            <li class=\"tabs-title";
        // line 10
        if ((isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " is-active";
        }
        echo "\"><a href=\"#register-tab\"";
        if ((isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " aria-selected=\"true\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Регистрация")), "html", null, true);
        echo "</a></li>
          </ul>
          <div data-tabs-content=\"auth-tabs\" class=\"tabs-content\">
            <div id=\"login-tab\" class=\"tabs-panel";
        // line 13
        if ( !(isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " is-active";
        }
        echo "\">
\t\t\t  ";
        // line 14
        try {
            \Cetera\Application::getInstance()->getWidget("User.Auth", array("recover_password_url" => "/recover-password/", "register_url" => false, "authorized_redirect" => "/"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 15
        echo "            </div>
          </div>
          <div data-tabs-content=\"auth-tabs\" class=\"tabs-content\">
            <div id=\"register-tab\" class=\"tabs-panel";
        // line 18
        if ((isset($context["register"]) ? $context["register"] : $this->getContext($context, "register"))) {
            echo " is-active";
        }
        echo "\">
              ";
        // line 19
        try {
            \Cetera\Application::getInstance()->getWidget("User.Register", array("unique_email" => true))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 20
        echo "            </div>
          </div>
        </div><br><br>
      </div>
    </div>
\t
";
    }

    public function getTemplateName()
    {
        return "page_login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 20,  87 => 19,  81 => 18,  76 => 15,  69 => 14,  63 => 13,  49 => 10,  37 => 9,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_login.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/design/page_login.twig");
    }
}

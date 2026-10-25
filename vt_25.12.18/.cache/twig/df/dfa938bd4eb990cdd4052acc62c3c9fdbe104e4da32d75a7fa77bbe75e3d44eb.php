<?php

/* @widget/user.register/default.twig */
class __TwigTemplate_4460b17a5417d861dfce52ea6465a67c566cefead1a0200754a46578e1a64dc9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'form' => array($this, 'block_form'),
            'success' => array($this, 'block_success'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 2
        echo "\t";
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "success", array())) {
            // line 3
            echo "\t
\t\t";
            // line 4
            if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error", array()) && (twig_length_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error", array())) > 1))) {
                // line 5
                echo "\t\t<div class=\"callout alert\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error", array()), "html", null, true);
                echo "</div>
\t\t";
            }
            // line 6
            echo "\t
\t
\t\t";
            // line 8
            $this->displayBlock('form', $context, $blocks);
            // line 38
            echo "\t\t
\t";
        } else {
            // line 40
            echo "
\t\t";
            // line 41
            $this->displayBlock('success', $context, $blocks);
            // line 46
            echo "
\t";
        }
    }

    // line 8
    public function block_form($context, array $blocks = array())
    {
        // line 9
        echo "\t\t<form method=\"post\">
\t\t\t<input type=\"hidden\" name=\"UserRegister\" value=\"1\" />
\t\t\t
\t\t\t<label>";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Логин")), "html", null, true);
        echo "</label>
\t\t\t<input name=\"login\" required type=\"text\" value=\"";
        // line 13
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array()), "login", array()), "html", null, true);
        }
        echo "\" class=\"";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array())) {
            echo " is-invalid-input";
        }
        echo "\">
\t\t\t";
        // line 14
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array())) {
            echo "<span class=\"form-error is-visible\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array()), "html", null, true);
            echo "</span>";
        }
        echo "\t

\t\t\t<label>";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Email")), "html", null, true);
        echo "</label>
\t\t\t<input name=\"email\" required type=\"email\" value=\"";
        // line 17
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array()), "email", array()), "html", null, true);
        }
        echo "\" class=\"";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "email_error", array())) {
            echo " is-invalid-input";
        }
        echo "\">
\t\t\t";
        // line 18
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "email_error", array())) {
            echo "<span class=\"form-error is-visible\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "email_error", array()), "html", null, true);
            echo "</span>";
        }
        echo "\t

\t\t\t<label>";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Ваше имя")), "html", null, true);
        echo "</label>
\t\t\t<input name=\"name\" required type=\"text\" value=\"";
        // line 21
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "post", array()), "name", array()), "html", null, true);
        }
        echo "\">\t\t
\t\t\t
\t\t\t<label>";
        // line 23
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Придумайте пароль")), "html", null, true);
        echo "</label>
\t\t\t<input type=\"password\" required name=\"password\" class=\"";
        // line 24
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array())) {
            echo " is-invalid-input";
        }
        echo "\">
\t\t\t";
        // line 25
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array())) {
            echo "<span class=\"form-error is-visible\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array()), "html", null, true);
            echo "</span>";
        }
        // line 26
        echo "
\t\t\t<label>";
        // line 27
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Повторите пароль")), "html", null, true);
        echo "</label>
\t\t\t<input type=\"password\" required name=\"password2\">\t

\t\t\t";
        // line 30
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "showRecaptcha", array())) {
            // line 31
            echo "\t\t\t<div class=\"g-recaptcha\" data-sitekey=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "recaptcha_site_key"), "method"), "html", null, true);
            echo "\"></div>
\t\t\t";
            // line 32
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "recaptcha_error", array())) {
                echo "<span class=\"form-error is-visible\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "recaptcha_error", array()), "html", null, true);
                echo "</span>";
            }
            // line 33
            echo "\t\t\t";
        }
        echo "\t\t
\t\t\t
\t\t\t<button type=\"submit\" class=\"button small-expanded\">";
        // line 35
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Зарегистрироваться")), "html", null, true);
        echo "</button>
\t\t</form> 
\t\t";
    }

    // line 41
    public function block_success($context, array $blocks = array())
    {
        // line 42
        echo "\t\t<div class=\"success callout\">
\t\t  <p>";
        // line 43
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вы были успешно зарегистрированы!")), "html", null, true);
        echo "</p>
\t\t</div>
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/user.register/default.twig";
    }

    public function getDebugInfo()
    {
        return array (  185 => 43,  182 => 42,  179 => 41,  172 => 35,  166 => 33,  160 => 32,  155 => 31,  153 => 30,  147 => 27,  144 => 26,  138 => 25,  132 => 24,  128 => 23,  121 => 21,  117 => 20,  108 => 18,  98 => 17,  94 => 16,  85 => 14,  75 => 13,  71 => 12,  66 => 9,  63 => 8,  57 => 46,  55 => 41,  52 => 40,  48 => 38,  46 => 8,  42 => 6,  36 => 5,  34 => 4,  31 => 3,  28 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/user.register/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/user.register/default.twig");
    }
}

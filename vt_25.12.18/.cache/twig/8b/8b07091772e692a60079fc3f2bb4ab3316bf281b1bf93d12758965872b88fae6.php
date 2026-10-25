<?php

/* @widget/user.auth/default.twig */
class __TwigTemplate_3e2af441e3f15e6a4bf9a47287e2f1cf65b0cd1c658d35bf139bb4229236331b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'form' => array($this, 'block_form'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
        // line 48
        echo "\t

";
        // line 50
        if ( !$this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "getUser", array(), "method")) {
            echo " 
\t";
            // line 51
            ob_start();
            // line 52
            echo "\t\t";
            $this->displayBlock('script', $context, $blocks);
            // line 105
            echo "\t
\t";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 107
            echo "\t";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
        }
        // line 108
        echo "\t";
    }

    // line 1
    public function block_html($context, array $blocks = array())
    {
        echo " 
\t";
        // line 2
        if ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "getUser", array(), "method")) {
            echo " 

\t\t";
            // line 5
            echo "\t\t<p><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "profile_url"), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "user", array()), "name", array()), "html", null, true);
            echo "</a> | <a href=\"/cms/logout.php\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Выход")), "html", null, true);
            echo "</a></p>

\t";
        } else {
            // line 8
            echo "
\t\t<div id=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-wrapper\">
\t\t";
            // line 10
            $this->displayBlock('form', $context, $blocks);
            // line 45
            echo "\t\t</div>
\t\t
\t";
        }
    }

    // line 10
    public function block_form($context, array $blocks = array())
    {
        echo " 
\t\t\t";
        // line 12
        echo "\t\t\t<form method=\"post\" id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
        echo "_form\">
\t\t\t\t<input type=\"hidden\" name=\"UserAuth\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
        echo "\" />
\t\t\t\t<label>";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Логин или Email")), "html", null, true);
        echo "</label>
\t\t\t\t<input name=\"login\" required type=\"text\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login", array()), "html", null, true);
        echo "\" class=\"";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array())) {
            echo " is-invalid-input";
        }
        echo "\">
\t\t\t\t";
        // line 16
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array())) {
            // line 17
            echo "\t\t\t\t<span class=\"form-error is-visible\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "login_error", array()), "html", null, true);
            echo "</span>
\t\t\t\t";
        }
        // line 18
        echo "\t\t
\t\t\t\t<label>";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Пароль")), "html", null, true);
        echo "</label>
\t\t\t\t<input type=\"password\" name=\"password\" class=\"";
        // line 20
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array())) {
            echo " is-invalid-input";
        }
        echo "\">
\t\t\t\t";
        // line 21
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array())) {
            // line 22
            echo "\t\t\t\t<span class=\"form-error is-visible\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "password_error", array()), "html", null, true);
            echo "</span>
\t\t\t\t";
        }
        // line 24
        echo "\t\t\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "recover_password_url"), "method")) {
            // line 25
            echo "\t\t\t\t\t<p><a title=\"\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "recover_password_url"), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Забыли пароль?")), "html", null, true);
            echo "</a></p>
\t\t\t\t";
        }
        // line 27
        echo "\t\t\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "register_url"), "method")) {
            // line 28
            echo "\t\t\t\t\t<p><a title=\"\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "register_url"), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Регистрация")), "html", null, true);
            echo "</a></p>
\t\t\t\t";
        }
        // line 30
        echo "\t\t\t\t<button type=\"submit\" class=\"button small-expanded\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Войти")), "html", null, true);
        echo "</button>
\t\t\t\t\t
\t\t\t</form>
\t\t\t
\t\t\t";
        // line 34
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "social"), "method")) {
            // line 35
            echo "\t\t\t  <p class=\"text-center social\">Войти через: 
\t\t\t\t  <span data-ulogin=\"display=buttons;fields=email;optional=nickname,first_name,last_name,photo;redirect_uri=";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "redirect", array()), "html", null, true);
            echo "\" id=\"uLogin\">
\t\t\t\t\t  &nbsp;<a data-uloginbutton=\"vkontakte\" class=\"fa-stack fa-lg text-vk\" href=\"#\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-vk fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t\t  <a data-uloginbutton=\"twitter\" class=\"fa-stack fa-lg text-twi\" href=\"#\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-twitter fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t\t  <a data-uloginbutton=\"facebook\" class=\"fa-stack fa-lg text-fb\" href=\"#\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-facebook fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t\t  <a data-uloginbutton=\"google\" class=\"fa-stack fa-lg text-gp\" href=\"#\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-google-plus fa-stack-1x fa-inverse\"></i></a>  
\t\t\t\t  </span>
\t\t\t  </p>
\t\t\t";
        }
        // line 44
        echo "\t\t";
    }

    // line 52
    public function block_script($context, array $blocks = array())
    {
        echo " 
\t\t\t";
        // line 53
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajax"), "method") &&  !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method"))) {
            // line 54
            echo "\t\t\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t\t\t\t";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_hook();
\t\t\t\t});

\t\t\t\tfunction ";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_hook(){
\t\t\t\t\tvar form = document.querySelector(\"#";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_form\");
\t\t\t\t\tif (form) {
\t\t\t\t\t\tform.addEventListener('submit', function (e) {
\t\t\t\t\t\t\te.preventDefault();
\t\t\t\t\t\t\t
\t\t\t\t\t\t\tvar widget = document.querySelector(\"#";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper\");
\t\t\t\t\t\t\twidget.innerHTML = '";
            // line 65
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите ...")), "html", null, true);
            echo "';
\t\t\t\t\t\t\t
\t\t\t\t\t\t\tvar request = new XMLHttpRequest();\t\t\t\t\t\t\t
\t\t\t\t\t\t\tvar data = new FormData(e.target);
\t\t\t\t\t\t\tdata.append('params[ajaxCall]', 1);
\t\t\t\t\t\t\t";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "setParam", array(0 => "ajax", 1 => 0), "method"), "params", array()));
            foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                // line 71
                echo "\t\t\t\t\t\t\tdata.append('params[";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "]', '";
                echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                echo "');
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\trequest.open('POST', '";
            // line 74
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getAjaxUrl", array(), "method");
            echo "', true);
\t\t\t\t\t\t\trequest.onload = function (e) {
\t\t\t\t\t\t\t\tif (request.readyState === 4) {

\t\t\t\t\t\t\t\t\t// Проверяем успешность GET-запроса
\t\t\t\t\t\t\t\t\tif (request.status === 200) {
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\tvar data = JSON.parse(request.responseText);
\t\t\t\t\t\t\t\t\t\tif (data.success) {
\t\t\t\t\t\t\t\t\t\t\tvar event = new CustomEvent('cetera.user.auth');
\t\t\t\t\t\t\t\t\t\t\tdocument.dispatchEvent(event);
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\tif (data.html) {
\t\t\t\t\t\t\t\t\t\t\twidget.innerHTML = data.html;
\t\t\t\t\t\t\t\t\t\t\t";
            // line 88
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_hook();\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t}\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\tif (data.redirect) {
\t\t\t\t\t\t\t\t\t\t\tdocument.location = data.redirect;
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t};
\t\t\t\t\t\t\trequest.onerror = function (e) { console.error(request.statusText); };
\t\t\t\t\t\t\trequest.send(data);\t\t\t\t\t\t
\t\t\t\t\t\t\t
\t\t\t\t\t\t});
\t\t\t\t\t}\t\t\t
\t\t\t\t}
\t\t\t";
        }
        // line 105
        echo "\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/user.auth/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  286 => 105,  266 => 88,  249 => 74,  246 => 73,  235 => 71,  231 => 70,  223 => 65,  219 => 64,  211 => 59,  207 => 58,  201 => 55,  198 => 54,  196 => 53,  191 => 52,  187 => 44,  176 => 36,  173 => 35,  171 => 34,  163 => 30,  155 => 28,  152 => 27,  144 => 25,  141 => 24,  135 => 22,  133 => 21,  127 => 20,  123 => 19,  120 => 18,  114 => 17,  112 => 16,  104 => 15,  100 => 14,  96 => 13,  91 => 12,  86 => 10,  79 => 45,  77 => 10,  73 => 9,  70 => 8,  59 => 5,  54 => 2,  49 => 1,  45 => 108,  41 => 107,  37 => 105,  34 => 52,  32 => 51,  28 => 50,  24 => 48,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/user.auth/default.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/user.auth/default.twig");
    }
}

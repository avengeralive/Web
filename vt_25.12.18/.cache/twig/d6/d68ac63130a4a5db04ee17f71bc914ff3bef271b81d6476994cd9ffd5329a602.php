<?php

/* @widget/_common/page404.twig */
class __TwigTemplate_cc403b1ebdfe370da04400141b2cd9be1b265daa21b43a475e252af8a98dea10 extends Twig_Template
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
        echo "\t\t\t<div class=\"row column\">
\t\t\t  <h1>";
        // line 2
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Ошибка 404: страница не найдена")), "html", null, true);
        echo "</h1>
\t\t\t</div>
\t\t
\t\t\t<div class=\"row column\">

\t\t\t\t<p>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("К сожалению, запрашиваемый Вами документ не найден на этом сервере.")), "html", null, true);
        echo "</p>
\t\t\t\t<p>";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Наиболее частые причины, приводящие к данной ошибке, следующие:")), "html", null, true);
        echo "</p>
\t\t\t\t<ul>
\t\t\t\t <li>";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("переход по ошибочной ссылке;")), "html", null, true);
        echo "</li>
\t\t\t\t <li>";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("неправильный ввод адреса.")), "html", null, true);
        echo "</li>
\t\t\t\t</ul>
\t\t\t\t<p>";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Решения:")), "html", null, true);
        echo "</p>
\t\t\t\t<ul>
\t\t\t\t <li>";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("исправьте адрес, ошибочно набранный в адресной строке браузера;")), "html", null, true);
        echo "</li>
\t\t\t\t <li>";
        // line 16
        echo call_user_func_array($this->env->getFunction('_')->getCallable(), array("попробуйте начать поиск необходимого материала с <a href=\"/\">главной страницы нашего сайта</a>."));
        echo "</li>
\t\t\t\t</ul> 
\t\t\t
\t\t\t</div>";
    }

    public function getTemplateName()
    {
        return "@widget/_common/page404.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 16,  53 => 15,  48 => 13,  43 => 11,  39 => 10,  34 => 8,  30 => 7,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/_common/page404.twig", "/usr/www/users/alivel/velvetin/cms/widgets/_common/page404.twig");
    }
}

<?php

/* @widget/_common/page404.twig */
class __TwigTemplate_bc1d8d4fa21b6733ffebec6248b48e34a7d38e94ba0400dccbf9ffe1f5772500 extends Twig_Template
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

    <div class=\"content\">
      <div class=\"row columns\">
        <div class=\"text-center\"><img src=\"/themes/shop/images/404.png\" alt=\"\"></div>
        <p>К сожалению, запрашиваемый Вами документ не найден на этом сервере.</p>
        <p>Наиболее частые причины, приводящие к данной ошибке, следующие:</p>
        <ul>
          <li>переход по ошибочной ссылке;</li>
          <li>неправильный ввод адреса.</li>
        </ul>
        <p>Решения:</p>
        <ul>
          <li>исправьте адрес, ошибочно набранный в адресной строке браузера;</li>
          <li>попробуйте начать поиск необходимого материала с <a href=\"\" title=\"\">главной страницы</a> нашего сайта.
          </li>
        </ul>
      </div>
    </div>";
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
        return array (  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/_common/page404.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/_common/page404.twig");
    }
}

<?php

/* @widget/_common/page404.twig */
class __TwigTemplate_67f8ba38dac5fbfc2b9625fa4325b088a06b74680bcc118a4479c582dbc9f1ab extends Twig_Template
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
        echo "<style>
@media (max-width: 1023px) and (min-width: 640px) {
  .large-8 p:not(.cart__price), .x-delivery-method, .heading, .h404 {
      padding-left: 0px !important;
  }
}
</style>
    <div class=\"content\">
      <div class=\"row column\">
        <div class=\"large-24 columns heading\">
          <div class=\"row\">
            <div class=\"large-8 columns\" style=\"min-height: 1px\"></div>
            <div class=\"large-16 columns h404\" style=\"padding-left: 6px;\">
              <h4 class=\"individual\">Ошибка 404</h4>
            </div> 
          </div>  
        </div>
        <div class=\"large-24 columns\" style=\"background: #efeceb;\">
          <div class=\"row\" style=\"margin: 40px 0px;\">
            <div class=\"large-8 columns\" style=\"min-height: 1px;\"></div>
            <div class=\"large-8 columns\" style=\"background: #efeceb; padding: 0px;\">
              <h4 style=\"font-size: 18px;\">Извините, запрашиваемая страница не найдена.</h4>
              <p style=\"font-size: 12px !important; margin-bottom: 0px;\">Возможно она была удалена или даже никогда не существовала. Чтобы найти нужную информацию, рекомендуем перейти на <a href=\"/\" style=\"text-decoration: underline;\">главную страницу</a></p>
            </div>
            <div class=\"large-8 columns\" style=\"min-height: 1px;\"></div>
          </div>
        </div>
      </div>
    </div>
    <style>.breadcrumbs { display: none; }</style>";
    }

    public function getTemplateName()
    {
        return "@widget/_common/page404.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/_common/page404.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/widgets/_common/page404.twig");
    }
}

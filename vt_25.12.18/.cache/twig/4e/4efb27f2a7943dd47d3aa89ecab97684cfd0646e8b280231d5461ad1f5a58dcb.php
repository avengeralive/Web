<?php

/* @widget/sale.catalog/default.twig */
class __TwigTemplate_fadbb6002e282844771fd50b1269437b686b4e3ab089f188ec7c788361b80a1c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "\">
";
        // line 2
        $this->displayBlock('html', $context, $blocks);
        // line 60
        echo "</div>
<div class=\"row\">
      <div class=\"large-18 large-centered columns\">
        <div class=\"row medium-up-2 mb25\">
          <div class=\"columns\">
            <p class=\"minify\">Размещенные на сайте материалы носят информационный характер и не являются публичной офертой, так как не содержат всех существенных условий договора (ст.435 ГК РФ). Цены зависят от валютного курса и могут быть изменены.</p>
          </div>
          <div class=\"columns\">
            <p class=\"minify\">Для уточнения окончательной стоимости изделий, а также других условий заказа (сроков изготовления, оплаты и доставки) обращайтесь к нашим менеджерам: <a href=\"tel:+79683930083\">+7 (968) 393-00-83</a>, <a href=\"tel:+74996505372\">+7 (499) 650-53-72</a>, e-mail <a href=\"mailto:velvetin.zakaz@gmail.com\">velvetin.zakaz@gmail.com</a>
            </p>
          </div>
        </div>
      </div>
    </div>
";
        // line 74
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("template" => "slider-gallery-star-clients.twig", "iterator" => $this->getAttribute($this->getAttribute((isset($context["catalog"]) ? $context["catalog"] : $this->getContext($context, "catalog")), "getById", array(0 => 498), "method"), "getMaterials", array(), "method")))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 75
        echo "    <div class=\"row columns\">
      <hr class=\"individual-hr\">
    </div>
    <div class=\"row columns\">
      <h4 class=\"individual\">Популярные изделия</h4>
    </div>
    ";
        // line 81
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("limit" => 6, "template" => "main_pop.twig", "catalog" => 465, "where" => "pop=true", "subsections" => 1, "order" => "RAND()"))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 82
        echo "
";
        // line 83
        ob_start();
        // line 84
        echo "\t";
        $this->displayBlock('script', $context, $blocks);
        $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 152
        $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
    }

    // line 2
    public function block_html($context, array $blocks = array())
    {
        // line 3
        echo "
\t";
        // line 4
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "error404", array())) {
            // line 5
            echo "
\t\t";
            // line 6
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "page404_template"), "method")) {
                // line 7
                echo "\t\t\t";
                $this->loadTemplate($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "page404_template"), "method"), "@widget/sale.catalog/default.twig", 7)->display($context);
                // line 8
                echo "\t\t";
            } else {
                // line 9
                echo "\t\t\t";
                $this->loadTemplate("@widget/_common/page404.twig", "@widget/sale.catalog/default.twig", 9)->display($context);
                // line 10
                echo "\t\t";
            }
            // line 11
            echo "
\t";
        } elseif ($this->getAttribute(        // line 12
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array())) {
            // line 13
            echo "
\t\t";
            // line 14
            try {
                \Cetera\Application::getInstance()->getWidget("Sale.Goods.Item", array("material_id" => $this->getAttribute($this->getAttribute(                // line 15
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "show_meta" => $this->getAttribute(                // line 16
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_meta"), "method"), "field_picture" => $this->getAttribute(                // line 17
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "item_field_picture"), "method"), "field_pictures" => $this->getAttribute(                // line 18
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "item_field_pictures"), "method"), "show_tabs" => $this->getAttribute(                // line 19
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "item_show_tabs"), "method"), "show_properties" => $this->getAttribute(                // line 20
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "item_show_properties"), "method"), "show_comments" => $this->getAttribute(                // line 21
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "item_show_comments"), "method")))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 23
            echo "
\t";
        } else {
            // line 25
            echo "
\t\t\t<div class=\"row rails\">
\t\t\t\t<div class=\"medium-6 large-5 xlarge-4 columns text-center medium-text-left\">
\t\t\t\t\t<h4 class=\"individual\">";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "name", array()), "html", null, true);
            echo "</h4>
\t\t\t\t</div>
\t\t\t\t<div class=\"medium-8 large-5 xlarge-4 columns text-center medium-text-left xxlarge-text-right\">
\t\t\t\t\t<a class=\"rel\" data-toggle=\"filter\"><img src=\"";
            // line 31
            echo twig_escape_filter($this->env, (isset($context["basePath"]) ? $context["basePath"] : $this->getContext($context, "basePath")), "html", null, true);
            echo "images/sq.svg\" alt=\"\">Отфильтровать</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"medium-10 large-14 xlarge-8 columns text-center\">
                    ";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "showPageProperty", array(0 => "list-paginator"), "method"), "html", null, true);
            echo "
\t\t\t\t</div>



\t\t\t\t\t";
            // line 39
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "iterator", array()), "count", array()) > 0)) {
                // line 40
                echo "\t\t\t\t\t<div class=\"columns\">
\t\t\t\t\t\t<div class=\"filter text-left hide\" id=\"filter\" data-toggler=\".hide\">
\t\t\t\t\t\t  <div class=\"filter__triangle\"></div>
\t\t\t\t\t\t  ";
                // line 43
                try {
                    \Cetera\Application::getInstance()->getWidget("Sale.Filter", array("catalog" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "catalog", array()), "filter_name" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "filter_name"), "method"), "css_class" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "filter_css_class"), "method")))->display();
                } catch (\Exception $e) {
                    echo '<div class="callout alert">'.$e->getMessage().'</div>';
                }

                // line 44
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t  </div>
\t\t\t\t\t</div>
\t\t\t\t\t";
                // line 47
                try {
                    \Cetera\Application::getInstance()->getWidget("Sale.Goods.List", array("iterator" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "iterator", array()), "template" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "view", array()), "limit" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "list_limit"), "method"), "paginator" => true, "paginator_url" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "listPaginatorUrl", array())))->display();
                } catch (\Exception $e) {
                    echo '<div class="callout alert">'.$e->getMessage().'</div>';
                }

                // line 48
                echo "
\t\t\t\t";
            } else {
                // line 50
                echo "\t\t\t\t\t";
                if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "filter"), "method") && $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "filter", array()), "isActive", array(), "method"))) {
                    // line 51
                    echo "\t\t\t\t\t\t<div class=\"callout alert\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Отсутствуют товары, удовлетворяющие заданным условиям.")), "html", null, true);
                    echo "</div>
\t\t\t\t\t";
                } else {
                    // line 53
                    echo "\t\t\t\t\t\t<div class=\"callout\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Товары отсутствуют.")), "html", null, true);
                    echo "</div>
\t\t\t\t\t";
                }
                // line 55
                echo "\t\t\t\t";
            }
            // line 56
            echo "

\t";
        }
    }

    // line 84
    public function block_script($context, array $blocks = array())
    {
        // line 85
        echo "\tdocument.addEventListener('DOMContentLoaded', function () {

\t\tjQuery('#";
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-clear').click(function(){
\t\t\tsaleClearFilter( jQuery(this).parents('.x-filter') );
\t\t\treturn false;
\t\t});

\t\tjQuery('#";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-clear-all').click(function(){
\t\t\tsaleClearFilter( jQuery('#";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "') );
\t\t\tjQuery('#";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " form').submit();
\t\t\treturn false;
\t\t});

\t\tjQuery('#";
        // line 98
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "').find('.x-filter').each(function(){
\t\t\tsaleCheckFilter( jQuery(this) );
\t\t});

\t\tjQuery('#";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " input, #";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " select').on('change', function(){
\t\t\tsaleCheckFilter( jQuery(this).parents('.x-filter') );
\t\t});

\t\tjQuery('#";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-sort').on('change', function(){
\t\t\tvar qd = sale_qd ();
\t\t\tqd['sort'] = jQuery(this).val();
\t\t\tlocation = '?' + jQuery.param(qd);

\t\t});

\t\tjQuery('#";
        // line 113
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo " .x-view').on('click', function(e){
\t\t\te.preventDefault();
\t\t\tvar qd = sale_qd ();
\t\t\tqd['view'] = jQuery(this).attr('data-view');
\t\t\tlocation = '?' + jQuery.param(qd);

\t\t});


\t});
\tfunction saleClearFilter(elm) {
\t\telm.find('input[type=\"text\"]').each(function(){
\t\t\tjQuery(this).val( jQuery(this).attr('data-default') ).trigger('change');
\t\t});
\t\telm.find('input:checked').prop('checked', false);
\t\telm.find('select').val('');
\t\tsaleCheckFilter(elm);
\t}
\tfunction saleCheckFilter(elm) {
\t\tvar c = elm.find('.x-clear');
\t\tif (elm.find('input[type=\"checkbox\"], input[type=\"radio\"]').length>0)
\t\t{
\t\t\tc.toggle(  elm.find(':checked').length > 0 );
\t\t}
\t\tif (elm.find('select').length>0)
\t\t{
\t\t\tc.toggle( elm.find('select').val() != '' );
\t\t}
\t\tif (elm.find('input[type=\"text\"]').length>0)
\t\t{
\t\t\tvar f = false;
\t\t\telm.find('input[type=\"text\"]').each(function(){
\t\t\t\tif (jQuery(this).val() != jQuery(this).attr('data-default')) f = true;
\t\t\t});
\t\t\tc.toggle( f );
\t\t}
\t}
\t";
    }

    public function getTemplateName()
    {
        return "@widget/sale.catalog/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 113,  256 => 106,  247 => 102,  240 => 98,  233 => 94,  229 => 93,  225 => 92,  217 => 87,  213 => 85,  210 => 84,  203 => 56,  200 => 55,  194 => 53,  188 => 51,  185 => 50,  181 => 48,  174 => 47,  169 => 44,  162 => 43,  157 => 40,  155 => 39,  147 => 34,  141 => 31,  135 => 28,  130 => 25,  126 => 23,  120 => 21,  119 => 20,  118 => 19,  117 => 18,  116 => 17,  115 => 16,  114 => 15,  112 => 14,  109 => 13,  107 => 12,  104 => 11,  101 => 10,  98 => 9,  95 => 8,  92 => 7,  90 => 6,  87 => 5,  85 => 4,  82 => 3,  79 => 2,  75 => 152,  71 => 84,  69 => 83,  66 => 82,  59 => 81,  51 => 75,  44 => 74,  28 => 60,  26 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.catalog/default.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/sale.catalog/default.twig");
    }
}

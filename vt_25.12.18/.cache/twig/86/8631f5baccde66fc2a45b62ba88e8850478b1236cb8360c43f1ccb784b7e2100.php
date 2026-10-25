<?php

/* @widget/sale.cart/default.twig */
class __TwigTemplate_f83767c1ff23171d65d88b90fdb28937b0e7e13985a7cf6538b5426274f7a4c6 extends Twig_Template
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
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "cart_is_empty"), "method")) {
            // line 2
            echo "
\t<div class=\"row column\">
\t\t";
            // line 4
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array());
            echo "
\t\t<div class=\"callout secondary\">
\t\t\t<p>";
            // line 6
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Ваша корзина пуста")), "html", null, true);
            echo "</p>
\t\t</div>
\t\t";
            // line 8
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "catalog_url"), "method")) {
                echo "\t\t
        <p><a href=\"";
                // line 9
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "catalog_url"), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("В каталог")), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вернуться в каталог")), "html", null, true);
                echo "</a></p>
\t\t";
            }
            // line 10
            echo "\t\t
\t</div>

";
        } else {
            // line 14
            echo "
<div id=\"";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">

\t";
            // line 17
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array());
            echo "
\t
\t";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProducts", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 20
                echo "    <div class=\"row\" id=\"x-cart-item-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">
      <div class=\"small-8 medium-2 column\"><img src=\"/imagetransform/width_200_height_200_fit_2";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "pic", array()), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                echo "\" class=\"product-tile-thumbnail\"></div>
      <div class=\"small-3 small-offset-1 medium-offset-0 medium-2 medium-push-8 column\">
        <div class=\"row\">
          <div class=\"small-12 medium-6 medium-push-6 column text-center\">
            <p><a href=\"#\" title=\"Удалить\" class=\"x-delete\" data-id=\"";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\"><img src=\"/plugins/sale/images/delete-circle.svg\" style=\"width: 28px;\"></a></p>
            <p class=\"hide-for-medium\">&#160;</p>
          </div>
          <div class=\"small-12 medium-6 medium-pull-6 column text-center\"></div>
        </div>
      </div>
      <div class=\"small-12 medium-5 large-3 medium-pull-2 column\">
        <p><a href=\"";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "url", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                if ($this->getAttribute($context["c"], "offer", array())) {
                    echo ", ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "name", array()), "html", null, true);
                }
                echo "</a><br></p>
\t\t";
                // line 33
                if ($this->getAttribute($context["c"], "options", array())) {
                    // line 34
                    echo "\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["c"], "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
                        // line 35
                        echo "\t\t\t<div class=\"row column\">
\t\t\t\t<label>";
                        // line 36
                        echo twig_escape_filter($this->env, $this->getAttribute($context["o"], "name", array()), "html", null, true);
                        echo "</label>
\t\t\t\t<input class=\"x-cart-option\" data-id=\"";
                        // line 37
                        echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                        echo "\" type=\"text\" name=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["o"], "name", array()), "html", null, true);
                        echo "\" value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["o"], "value", array()), "html", null, true);
                        echo "\">
\t\t\t</div>
\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 40
                    echo "\t\t";
                }
                // line 41
                echo "      </div>
      <div class=\"small-12 medium-3 large-5 medium-pull-2 column\">
        <div class=\"row\">
          <div class=\"small-12 medium-12 large-4 column\">
            <p>
\t\t\t";
                // line 46
                if ($this->getAttribute($context["c"], "offer", array())) {
                    // line 47
                    echo "\t\t\t\t<span class=\"x-price\">";
                    echo $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "displayDiscountPrice", array());
                    echo "</span>
\t\t\t\t";
                    // line 48
                    if (($this->getAttribute($this->getAttribute($context["c"], "offer", array()), "discount", array()) > 0)) {
                        echo "<span class=\"text-dark-gray\"><del style=\"white-space: nowrap\">";
                        echo $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "displayFullPrice", array());
                        echo "</del></span>";
                    }
                    echo "\t\t\t
\t\t\t";
                } else {
                    // line 50
                    echo "\t\t\t\t<span class=\"x-price\">";
                    echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayDiscountPrice", array());
                    echo "</span>
\t\t\t\t";
                    // line 51
                    if (($this->getAttribute($this->getAttribute($context["c"], "product", array()), "discount", array()) > 0)) {
                        echo "<span class=\"text-dark-gray\"><del style=\"white-space: nowrap\">";
                        echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayFullPrice", array());
                        echo "</del></span>";
                    }
                    echo "\t\t
\t\t\t";
                }
                // line 53
                echo "\t\t\t</p>
          </div>
          <div class=\"small-6 medium-12 large-4 column\">
            <div class=\"row\">
              <div class=\"small-12 medium-11 large-12 column\">
                <div class=\"input-group\">
                  <div class=\"input-group-button\">
                    <button class=\"button x-less\" data-id=\"";
                // line 60
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">–</button>
                  </div>
                  <input type=\"text\" value=\"";
                // line 62
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "quantity", array()), "html", null, true);
                echo "\" data-backup=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "quantity", array()), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\" class=\"input-group-field x-quantity\" data-product-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()), "html", null, true);
                echo "\" ";
                if ($this->getAttribute($context["c"], "offer", array())) {
                    echo "data-offer-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "id", array()), "html", null, true);
                    echo "\"";
                }
                echo ">
                  <div class=\"input-group-button\">
                    <button class=\"button x-more\" data-id=\"";
                // line 64
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">+</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class=\"small-6 medium-12 large-4 column\">
            <p class=\"lead no-wrap x-sum\">";
                // line 71
                echo $this->getAttribute($context["c"], "displaySum", array());
                echo "</p>
          </div>
        </div>
      </div>
      <div class=\"column hide-for-large\"><br class=\"hide-for-large\">
        <hr><br><br class=\"hide-for-medium\">
      </div>
    </div> 
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            echo "    <div class=\"row\">
      <div class=\"column show-for-medium\"><br></div>
      <div class=\"column small-12 medium-6 large-4\">
        <table>
          <tr>
            <td class=\"text-dark-gray\">";
            // line 85
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Количество товаров")), "html", null, true);
            echo ":</td>
            <td class=\"x-total-quantity\">";
            // line 86
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProductsCount", array(), "method"), "html", null, true);
            echo " шт.</td>
          </tr>
        </table><br>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"column small-12 medium-6 large-4 medium-offset-6 large-offset-8 text-center\">
        <p class=\"lead\">СУММА: &#160;<span class=\"stat x-total-sum\">";
            // line 93
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getDisplayTotal", array(), "method");
            echo "</span></p>
        <p><a href=\"";
            // line 94
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "order_url"), "method"), "html", null, true);
            echo "\" title=\"\" class=\"button expanded\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Оформить заказ")), "html", null, true);
            echo "</a></p>
      </div>
    </div>\t

</div>\t
\t
";
            // line 100
            ob_start();
            // line 101
            echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-more\");
\t\t\tfor (var i = 0; i  < c.length; i++) 
\t\t\t\tc[i].addEventListener(\"click\", function(){\t
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';\t\t
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 0;
\t\t\t\t\tv = v+1;
\t\t\t\t\tif (v<1) v = 1;\t
\t\t\t\t\t";
            // line 112
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(id,v);
\t\t\t\t});
\t\t\t
\t\t\tvar c = document.querySelectorAll(\"#";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-less\");
\t\t\tfor (var i = 0; i  < c.length; i++) \t\t\t
\t\t\t\tc[i].addEventListener(\"click\", function(){\t
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 0;
\t\t\t\t\tv = v-1;
\t\t\t\t\tif (v<1) v = 1;\t\t\t\t
\t\t\t\t\t";
            // line 124
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(id,v);
\t\t\t\t});\t

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 127
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-quantity\");
\t\t\tfor (var i = 0; i  < c.length; i++) \t\t\t
\t\t\t\tc[i].addEventListener(\"blur\", function(){\t
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 1;\t
\t\t\t\t\tif (v<1) v = 1;\t
\t\t\t\t\t";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(id,v);
\t\t\t\t});\t

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 138
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-delete\");
\t\t\tfor (var i = 0; i  < c.length; i++) \t\t\t
\t\t\t\tc[i].addEventListener(\"click\", function(e){\t
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\t";
            // line 143
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(id,0);
\t\t\t\t\te.preventDefault?e.preventDefault():(e.returnValue=false);
\t\t\t\t});\t

\t\t\t\$(\"#";
            // line 147
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-cart-option\").on('change', function(){
\t\t\t\t
\t\t\t\tjQuery.ajax({
\t\t\t\t\turl : '/plugins/sale/ajax.php',
\t\t\t\t\tdata: {
\t\t\t\t\t\taction: 'set_cart_option',
\t\t\t\t\t\tid    : \$(this).attr('data-id'),
\t\t\t\t\t\toption_name: \$(this).attr('name'),
\t\t\t\t\t\toption_value: \$(this).val()
\t\t\t\t\t},
\t\t\t\t\tdataType: 'json',
\t\t\t\t\tsuccess: function (data) {                                

\t\t\t\t\t},
\t\t\t\t\terror: function (xhr) {
\t\t\t\t\t\t
\t\t\t\t\t}
\t\t\t\t\t
\t\t\t\t});\t
\t\t
\t\t\t});\t\t\t
\t\t
\t\t});
\t\t
\t\tfunction ";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(id,v)
\t\t{
\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\tvar q = document.querySelector(itemId + \".x-quantity\");
\t\t\t\t\t
\t\t\tq.value = v;
\t\t\tvar s = document.querySelector(itemId + \".x-sum\");
\t\t\tvar sum = document.querySelector(\"#";
            // line 178
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-sum\");
\t\t\tvar sum_backup = sum.innerHTML;
\t\t\tsum.innerHTML = '";
            // line 180
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите...")), "html", null, true);
            echo "';
\t\t\tvar s_backup = s.innerHTML;
\t\t\ts.innerHTML = '";
            // line 182
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите...")), "html", null, true);
            echo "';
\t\t\t
\t\t\tjQuery.ajax({
\t\t\t\turl : '/plugins/sale/ajax.php?action=set_cart_quantity&id='+id+'&quantity='+v,
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(data) {
\t\t\t\t\tjQuery(document).trigger( 'cetera.sale.basket.add', [ data ] );\t
\t\t\t\t\tsum.innerHTML = data.total_sum;
\t\t\t\t\ts.innerHTML = data.sum;
\t\t\t\t\tdocument.querySelector(\"#";
            // line 191
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-quantity\").innerHTML = data.count + ' ";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("шт.")), "html", null, true);
            echo "';
\t\t\t\t\tif (v == 0)
\t\t\t\t\t{
\t\t\t\t\t\tvar row = document.querySelector(itemId);
\t\t\t\t\t\tif (row) row.parentNode.removeChild(row);\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t}\t\t\t\t\t
\t\t\t\t},
\t\t\t\terror: function(data) {
\t\t\t\t\tjQuery(itemId + \".x-quantity\").val( jQuery(itemId + \".x-quantity\").attr('data-backup') );
\t\t\t\t\tsum.innerHTML = sum_backup;
\t\t\t\t\ts.innerHTML = s_backup;
\t\t\t\t\tvar o = jQuery.parseJSON(data.responseText);
\t\t\t\t\tif (o.message) alert(o.message);
\t\t\t\t}
\t\t\t});
\t\t\t\t\t\t
\t\t}
\t\t

";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 211
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
            echo "\t

";
        }
    }

    public function getTemplateName()
    {
        return "@widget/sale.cart/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  422 => 211,  397 => 191,  385 => 182,  380 => 180,  375 => 178,  365 => 171,  338 => 147,  331 => 143,  323 => 138,  317 => 135,  306 => 127,  300 => 124,  288 => 115,  282 => 112,  270 => 103,  266 => 101,  264 => 100,  253 => 94,  249 => 93,  239 => 86,  235 => 85,  228 => 80,  213 => 71,  203 => 64,  186 => 62,  181 => 60,  172 => 53,  163 => 51,  158 => 50,  149 => 48,  144 => 47,  142 => 46,  135 => 41,  132 => 40,  119 => 37,  115 => 36,  112 => 35,  107 => 34,  105 => 33,  95 => 32,  85 => 25,  76 => 21,  71 => 20,  67 => 19,  62 => 17,  57 => 15,  54 => 14,  48 => 10,  39 => 9,  35 => 8,  30 => 6,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.cart/default.twig", "/usr/www/users/alivel/velvetin/plugins/sale/widgets/sale.cart/default.twig");
    }
}

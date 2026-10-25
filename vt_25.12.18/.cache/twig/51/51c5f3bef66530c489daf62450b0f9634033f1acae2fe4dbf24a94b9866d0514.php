<?php

/* @widget/sale.cart/default.twig */
class __TwigTemplate_3f04c25914974c855a750be96c8add5dcc258ecc0b53e72da1574ad68cda8ba1 extends Twig_Template
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
<div id=\"";
            // line 3
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">
\t<div class=\"row\">
      <div class=\"large-16 columns large-centered\">
\t  <div class=\"row column\">
        <h5 class=\"individual\">Готовые к заказу</h5>
      </div>
\t  </div>
    </div>
    <div class=\"row columns\">
      <div class=\"cart\">

        <div class='row'>
          <div class=\"large-16 columns large-centered\">


\t\t\t\t\t<div class=\"row discount__bar__empty\">
\t\t\t\t\t\t<div class=\"column small-24 medium-15 large-18\">
\t\t\t\t\t\t\t<p class='cart__basket-empty text-left'>Ваша корзина пуста</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"column small-24 medium-9 large-6 text-center medium-text-right \">
\t\t\t\t\t\t\t<p class=\"cart__money cart__money_empty text-center medium-text-right large-text-left\">Итого:<br><span class=\"x-total-sum\">";
            // line 23
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getDisplayTotal", array(), "method");
            echo "</span></p>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
        </div>
      </div>
\t\t</div>
\t</div>
</div>
";
        } else {
            // line 32
            echo "
<div id=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">
\t<div class=\"row\">
      <div class=\"large-16 columns large-centered\">
\t  <div class=\"row column\">
        <h5 class=\"individual\">Готовые к заказу</h5>
      </div>
\t  </div>
    </div>
    <div class=\"row columns\">
      <div class=\"cart\">
        <div class=\"row\">
          <div class=\"large-16 columns large-centered\">
\t";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProducts", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 46
                echo "    <div class=\"row\" id=\"x-cart-item-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\" data-equalizer data-equalize-by-row=\"true\">

\t\t";
                // line 49
                echo "\t\t";
                $context["itrProducts"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array()), "materials", array()), "orderBy", array(0 => "tag"), "method");
                // line 50
                echo "\t\t";
                $context["isNotFound"] = true;
                // line 51
                echo "\t\t";
                $context["productsPerPage"] = 12;
                // line 52
                echo "\t\t";
                $context["productPosition"] = 1;
                // line 53
                echo "
\t\t";
                // line 55
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["itrProducts"]) ? $context["itrProducts"] : $this->getContext($context, "itrProducts")));
                foreach ($context['_seq'] as $context["_key"] => $context["Prod"]) {
                    if ((isset($context["isNotFound"]) ? $context["isNotFound"] : $this->getContext($context, "isNotFound"))) {
                        // line 56
                        echo "\t\t\t";
                        if (($this->getAttribute($context["Prod"], "id", array()) == $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()))) {
                            // line 57
                            echo "\t\t\t\t";
                            $context["isNotFound"] = false;
                            // line 58
                            echo "\t\t\t";
                        } else {
                            // line 59
                            echo "\t\t\t\t";
                            $context["productPosition"] = ((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) + 1);
                            // line 60
                            echo "\t\t\t";
                        }
                        // line 61
                        echo "\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Prod'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "
\t\t";
                // line 64
                echo "\t\t";
                if (((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) > (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage")))) {
                    // line 65
                    echo "\t\t\t";
                    $context["pageNum"] = (int) floor(((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) / 12));
                    // line 66
                    echo "\t\t\t\t";
                    if ((((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) * (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage"))) < (isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")))) {
                        // line 67
                        echo "\t\t\t\t\t";
                        $context["pageNum"] = ((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) + 1);
                        // line 68
                        echo "\t\t\t\t";
                    }
                    // line 69
                    echo "\t\t";
                } else {
                    // line 70
                    echo "\t\t\t";
                    $context["pageNum"] = 1;
                    // line 71
                    echo "\t\t";
                }
                // line 72
                echo "\t\t";
                // line 73
                echo "




      <div class=\"column small-8 medium-6 large-6 cart__img\" data-equalizer-watch>
      \t<p><img src=\"/imagetransform/width_200_height_130_fit_2";
                // line 79
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "pic", array()), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                echo "\"></p>
      </div>
      <div class=\"column small-16 medium-6 large-6\" data-equalizer-watch>
      \t<p>
      \t\t<a href=\"";
                // line 83
                if ($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array())) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array()), "url", array()), "html", null, true);
                    echo "?page=";
                    echo twig_escape_filter($this->env, (isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")), "html", null, true);
                    echo "&id=";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()), "html", null, true);
                }
                echo "\">Aрт. ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "code", array()), "html", null, true);
                echo "<br>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                if ($this->getAttribute($context["c"], "offer", array())) {
                    echo ",<br>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "name", array()), "html", null, true);
                }
                echo "</a>
      \t</p>
      </div>

    \t<div class=\"column small-15 medium-6 large-6\">
    \t\t<div class=\"row\">
    \t\t\t<div class=\"column small-5\">
    \t\t\t\t<input class=\"cart__input x-quantity text-center\" type=\"text\" value=\"";
                // line 90
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "quantity", array()), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">
    \t\t\t</div>
    \t\t\t<div class=\"column small-19 text-right\">
    \t\t\t\t<div class=\"cart__price x-sum\">";
                // line 93
                echo $this->getAttribute($context["c"], "displaySum", array());
                echo "</div>
    \t\t\t</div>
    \t\t</div>
    \t</div>

            <!--div class=\"small-24 medium-24 large-6 column\">
            <p>
\t\t\t\t<span class=\"x-price\">";
                // line 100
                echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayDiscountPrice", array());
                echo "</span>
\t\t\t\t";
                // line 101
                if (($this->getAttribute($this->getAttribute($context["c"], "product", array()), "discount", array()) > 0)) {
                    // line 102
                    echo "\t\t\t\t<span class=\"text-dark-gray\"><del style=\"white-space: nowrap\">";
                    echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayFullPrice", array());
                    echo "</del></span>
\t\t\t\t";
                }
                // line 104
                echo "\t\t\t</p>
          </div-->

          <div class=\"large-6 medium-6 columns small-9 text-right\">
          \t<p><a class=\"cart__del x-delete\" href=\"#\" data-id=\"";
                // line 108
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">Удалить    <img src=\"/themes/shop/images/cross.svg\" alt=\"\"></a></p>
          </div>
          <div class=\"columns\">
            <hr class=\"cart__hr\">
          </div>
    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 115
            echo "    <div class=\"hide x-total-quantity\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProductsCount", array(), "method"), "html", null, true);
            echo " шт.</div>
    <div class=\"row discount__bar\">
    \t<div class=\"column small-24 medium-15 large-17 cart__discount\">
        <input class=\"input-group-field cart__bonus text-center\" type=\"text\" placeholder=\"Промо-код\">
        <button class=\"button medium-gray cart__calc\" type=\"button\">Пересчитать</button>
      </div>
      <div class=\"column small-24 medium-9 large-7 text-center medium-text-right cart__info\">
      \t";
            // line 122
            $context["tax"] = (int) floor((($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getTotal", array(), "method") * 0.18) / 1.18));
            // line 123
            echo "      \t<p class=\"cart__money text-center medium-text-right large-text-left\">Итого:<br><span class=\"x-total-sum\">";
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getDisplayTotal", array(), "method");
            echo "</span></p>
      \t<a class=\"button medium-gray cart__calc_order\" href=\"";
            // line 124
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "order_url"), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Оформить заказ")), "html", null, true);
            echo "</a>
      </div>
    </div>

\t\t<div class=\"row discount__bar__empty hide\">
    \t<div class=\"column small-24 medium-15 large-18\">
      \t<p class='cart__basket-empty text-left'>Ваша корзина пуста</p>
      </div>
      <div class=\"column small-24 medium-9 large-6 text-center medium-text-right \">
      \t<p class=\"cart__money cart__money_empty text-center medium-text-right large-text-left\">Итого:<br><span class=\"x-total-sum\">0 руб.</span></p>
      </div>
    </div>

</div>
        </div>
      </div>
    </div>
</div>


";
            // line 144
            ob_start();
            // line 145
            echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {

\t\t\t/*var c = document.querySelectorAll(\"#";
            // line 147
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-more\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"click\", function(){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 0;
\t\t\t\t\tv = v+1;
\t\t\t\t\tif (v<1) v = 1;
\t\t\t\t\t";
            // line 156
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 159
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-less\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"click\", function(){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 0;
\t\t\t\t\tv = v-1;
\t\t\t\t\tif (v<1) v = 1;
\t\t\t\t\t";
            // line 168
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-quantity\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"blur\", function(){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 1;
\t\t\t\t\tif (v<1) v = 1;
\t\t\t\t\t";
            // line 179
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});\t*/


\t\t\t//console.log('total: ', );


\t\t\tvar c = document.querySelectorAll(\"#";
            // line 186
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-delete\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"click\", function(e){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\t";
            // line 191
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,0,id);
\t\t\t\t\te.preventDefault?e.preventDefault():(e.returnValue=false);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 195
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-quantity\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"change\", function(e){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\tvar v = parseInt(document.querySelector(itemId + \".x-quantity\").value);
\t\t\t\t\tif (isNaN(v)) v = 0;
\t\t\t\t\tif (v<1) v = 1;
\t\t\t\t\t";
            // line 203
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});


\t\t});

\t\tfunction ";
            // line 209
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id)
\t\t{
\t\t\tdocument.querySelector(itemId + \".x-quantity\").value = v;
\t\t\tvar s = document.querySelector(itemId + \".x-sum\");
\t\t\tvar sum = document.querySelector(\"#";
            // line 213
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-sum\");
\t\t\tsum.innerHTML = '";
            // line 214
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите...")), "html", null, true);
            echo "';
\t\t\ts.innerHTML = '";
            // line 215
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите...")), "html", null, true);
            echo "';

\t\t\tjQuery.ajax({
\t\t\t\turl : '/plugins/sale/ajax.php?action=set_cart_quantity&id='+id+'&quantity='+v,
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(data) {
\t\t\t\t\tjQuery(document).trigger( 'cetera.sale.basket.add', [ data ] );
\t\t\t\t\tsum.innerHTML = data.total_sum;
\t\t\t\t\ts.innerHTML = data.sum;
\t\t\t\t\tdocument.querySelector(\"#";
            // line 224
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-quantity\").innerHTML = data.count + ' ";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("шт.")), "html", null, true);
            echo "';
\t\t\t\t\tif (v == 0)
\t\t\t\t\t{
\t\t\t\t\t\tvar row = document.querySelector(itemId);
\t\t\t\t\t\tif (row) row.parentNode.removeChild(row);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t});
\t\t\tcheckCart(v);
\t\t}

\t\tfunction checkCart(total)
\t\t{
\t\t\tif (total == 0)
\t\t\t{
\t\t\t\$('.discount__bar').remove();
\t\t\t\$('.discount__bar__empty').removeClass('hide');
\t\t\t}

\t\t}


";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 247
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
            // line 248
            echo "
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
        return array (  449 => 248,  447 => 247,  419 => 224,  407 => 215,  403 => 214,  399 => 213,  392 => 209,  383 => 203,  372 => 195,  365 => 191,  357 => 186,  347 => 179,  336 => 171,  330 => 168,  318 => 159,  312 => 156,  300 => 147,  296 => 145,  294 => 144,  269 => 124,  264 => 123,  262 => 122,  251 => 115,  238 => 108,  232 => 104,  226 => 102,  224 => 101,  220 => 100,  210 => 93,  202 => 90,  178 => 83,  167 => 79,  159 => 73,  157 => 72,  154 => 71,  151 => 70,  148 => 69,  145 => 68,  142 => 67,  139 => 66,  136 => 65,  133 => 64,  130 => 62,  123 => 61,  120 => 60,  117 => 59,  114 => 58,  111 => 57,  108 => 56,  102 => 55,  99 => 53,  96 => 52,  93 => 51,  90 => 50,  87 => 49,  81 => 46,  77 => 45,  62 => 33,  59 => 32,  47 => 23,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.cart/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/sale.cart/default.twig");
    }
}

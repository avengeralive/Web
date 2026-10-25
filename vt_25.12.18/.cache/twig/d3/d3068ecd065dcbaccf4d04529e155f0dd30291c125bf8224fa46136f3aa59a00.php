<?php

/* @widget/sale.cart/default.twig */
class __TwigTemplate_cdb3d15091a129ae5ce7b58aac5d7056574fd5c76a81c27008c79b5c7b44ceee extends Twig_Template
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
.cart__img img:hover {
    -ms-transform: scale(1.05);
    transform: scale(1.05);
}
.cart__img img {
    transition: 0.3s all;
    image-rendering: -moz-crisp-edges;
    image-rendering: -moz-crisp-edges;
    image-rendering: -o-crisp-edges;
    image-rendering: -webkit-optimize-contrast;
    -ms-interpolation-mode: nearest-neighbor;
}
</style>
";
        // line 15
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "cart_is_empty"), "method")) {
            // line 16
            echo "
<div id=\"";
            // line 17
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
            // line 37
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
            // line 46
            echo "
<div id=\"";
            // line 47
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
            // line 59
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getProducts", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 60
                echo "    <div class=\"row\" id=\"x-cart-item-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\" data-equalizer data-equalize-by-row=\"true\">

\t\t";
                // line 63
                echo "\t\t";
                $context["itrProducts"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array()), "materials", array()), "orderBy", array(0 => "tag"), "method");
                // line 64
                echo "\t\t";
                $context["isNotFound"] = true;
                // line 65
                echo "\t\t";
                $context["productsPerPage"] = 12;
                // line 66
                echo "\t\t";
                $context["productPosition"] = 1;
                // line 67
                echo "
\t\t";
                // line 69
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["itrProducts"]) ? $context["itrProducts"] : $this->getContext($context, "itrProducts")));
                foreach ($context['_seq'] as $context["_key"] => $context["Prod"]) {
                    if ((isset($context["isNotFound"]) ? $context["isNotFound"] : $this->getContext($context, "isNotFound"))) {
                        // line 70
                        echo "\t\t\t";
                        if (($this->getAttribute($context["Prod"], "id", array()) == $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()))) {
                            // line 71
                            echo "\t\t\t\t";
                            $context["isNotFound"] = false;
                            // line 72
                            echo "\t\t\t";
                        } else {
                            // line 73
                            echo "\t\t\t\t";
                            $context["productPosition"] = ((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) + 1);
                            // line 74
                            echo "\t\t\t";
                        }
                        // line 75
                        echo "\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Prod'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "
\t\t";
                // line 78
                echo "\t\t";
                if (((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) > (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage")))) {
                    // line 79
                    echo "\t\t\t";
                    $context["pageNum"] = (int) floor(((isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")) / 12));
                    // line 80
                    echo "\t\t\t\t";
                    if ((((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) * (isset($context["productsPerPage"]) ? $context["productsPerPage"] : $this->getContext($context, "productsPerPage"))) < (isset($context["productPosition"]) ? $context["productPosition"] : $this->getContext($context, "productPosition")))) {
                        // line 81
                        echo "\t\t\t\t\t";
                        $context["pageNum"] = ((isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")) + 1);
                        // line 82
                        echo "\t\t\t\t";
                    }
                    // line 83
                    echo "\t\t";
                } else {
                    // line 84
                    echo "\t\t\t";
                    $context["pageNum"] = 1;
                    // line 85
                    echo "\t\t";
                }
                // line 86
                echo "\t\t";
                // line 87
                echo "




      <div class=\"column small-8 medium-6 large-6 cart__img\" data-equalizer-watch>
      \t<p><a href=\"";
                // line 93
                if ($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array())) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array()), "url", array()), "html", null, true);
                    echo "?page=";
                    echo twig_escape_filter($this->env, (isset($context["pageNum"]) ? $context["pageNum"] : $this->getContext($context, "pageNum")), "html", null, true);
                    echo "&id=";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()), "html", null, true);
                }
                echo "\"><img src=\"/imagetransform/width_400_height_260_fit_2";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "pic", array()), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
                echo "\"></a></p>
      </div>
      <div class=\"column small-16 medium-6 large-6 cart__p_title\" data-equalizer-watch>
      \t<p>
      \t\t<a class=\"cart_product_title\" href=\"";
                // line 97
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
                // line 104
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "quantity", array()), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
                echo "\">
    \t\t\t</div>
    \t\t\t<div class=\"column small-19 text-right\">
    \t\t\t\t<div class=\"cart__price x-sum\">";
                // line 107
                echo $this->getAttribute($context["c"], "displaySum", array());
                echo "</div>
    \t\t\t</div>
    \t\t</div>
    \t</div>

            <!--div class=\"small-24 medium-24 large-6 column\">
            <p>
\t\t\t\t<span class=\"x-price\">";
                // line 114
                echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayDiscountPrice", array());
                echo "</span>
\t\t\t\t";
                // line 115
                if (($this->getAttribute($this->getAttribute($context["c"], "product", array()), "discount", array()) > 0)) {
                    // line 116
                    echo "\t\t\t\t<span class=\"text-dark-gray\"><del style=\"white-space: nowrap\">";
                    echo $this->getAttribute($this->getAttribute($context["c"], "product", array()), "displayFullPrice", array());
                    echo "</del></span>
\t\t\t\t";
                }
                // line 118
                echo "\t\t\t</p>
          </div-->

          <div class=\"large-6 medium-6 columns small-9 text-right\">
          \t<p><a class=\"cart__del x-delete\" href=\"#\" data-id=\"";
                // line 122
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
            // line 129
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
            // line 136
            $context["tax"] = (int) floor((($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getTotal", array(), "method") * 0.18) / 1.18));
            // line 137
            echo "      \t<p class=\"cart__money text-center medium-text-right large-text-left\">Итого:<br><span class=\"x-total-sum\">";
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "cart", array()), "getDisplayTotal", array(), "method");
            echo "</span></p>
      \t<a class=\"button medium-gray cart__calc_order\" href=\"";
            // line 138
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
            // line 158
            ob_start();
            // line 159
            echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {

\t\t\t/*var c = document.querySelectorAll(\"#";
            // line 161
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
            // line 170
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 173
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
            // line 182
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 185
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
            // line 193
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});\t*/


\t\t\t//console.log('total: ', );


\t\t\tvar c = document.querySelectorAll(\"#";
            // line 200
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-delete\");
\t\t\tfor (var i = 0; i  < c.length; i++)
\t\t\t\tc[i].addEventListener(\"click\", function(e){
\t\t\t\t\tvar id = this.getAttribute('data-id');
\t\t\t\t\tvar itemId = '#x-cart-item-' + id + ' ';
\t\t\t\t\t";
            // line 205
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,0,id);
\t\t\t\t\te.preventDefault?e.preventDefault():(e.returnValue=false);
\t\t\t\t});

\t\t\tvar c = document.querySelectorAll(\"#";
            // line 209
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
            // line 217
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id);
\t\t\t\t});


\t\t});

\t\tfunction ";
            // line 223
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "_change(itemId,v,id)
\t\t{
\t\t\tdocument.querySelector(itemId + \".x-quantity\").value = v;
\t\t\tvar s = document.querySelector(itemId + \".x-sum\");
\t\t\tvar sum = document.querySelector(\"#";
            // line 227
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-sum\");
\t\t\tsum.innerHTML = '";
            // line 228
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Подождите...")), "html", null, true);
            echo "';
\t\t\ts.innerHTML = '";
            // line 229
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
            // line 238
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-total-quantity\").innerHTML = data.count + ' ";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("шт.")), "html", null, true);
            echo "';
\t\t\t\t\tif (v == 0)
\t\t\t\t\t{
\t\t\t\t\t\tvar row = document.querySelector(itemId);
\t\t\t\t\t\tif (row) row.parentNode.removeChild(row);
\t\t\t\t\t}
\t\t\t\t\tcheckCart(data.count);
\t\t\t\t}
\t\t\t});
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
            // line 261
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
            // line 262
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
        return array (  473 => 262,  471 => 261,  443 => 238,  431 => 229,  427 => 228,  423 => 227,  416 => 223,  407 => 217,  396 => 209,  389 => 205,  381 => 200,  371 => 193,  360 => 185,  354 => 182,  342 => 173,  336 => 170,  324 => 161,  320 => 159,  318 => 158,  293 => 138,  288 => 137,  286 => 136,  275 => 129,  262 => 122,  256 => 118,  250 => 116,  248 => 115,  244 => 114,  234 => 107,  226 => 104,  202 => 97,  183 => 93,  175 => 87,  173 => 86,  170 => 85,  167 => 84,  164 => 83,  161 => 82,  158 => 81,  155 => 80,  152 => 79,  149 => 78,  146 => 76,  139 => 75,  136 => 74,  133 => 73,  130 => 72,  127 => 71,  124 => 70,  118 => 69,  115 => 67,  112 => 66,  109 => 65,  106 => 64,  103 => 63,  97 => 60,  93 => 59,  78 => 47,  75 => 46,  63 => 37,  40 => 17,  37 => 16,  35 => 15,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.cart/default.twig", "/home/velvetin/alfa.velvetin.ru/docs/themes/shop/widgets/sale.cart/default.twig");
    }
}

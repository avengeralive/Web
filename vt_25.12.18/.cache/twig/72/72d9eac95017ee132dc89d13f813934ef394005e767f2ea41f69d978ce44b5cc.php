<?php

/* @widget/sale.order/default.twig */
class __TwigTemplate_335640a9a8e1d17aca9dfae3100217cdb86c23dd81c5585201701d8fd3d2e52f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'products' => array($this, 'block_products'),
            'delivery' => array($this, 'block_delivery'),
            'payment' => array($this, 'block_payment'),
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
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "cart_is_empty"), "method")) {
            // line 3
            echo "
\t<div class=\"row column\">
\t\t<div class=\"callout secondary\">
\t\t\t<p>";
            // line 6
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Ваша корзина пуста")), "html", null, true);
            echo "</p>
\t\t</div>
\t\t";
            // line 8
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "catalog_url"), "method")) {
                // line 9
                echo "        <p><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "param", array(0 => "catalog_url"), "method"), "html", null, true);
                echo "\" title=\"В каталог\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Вернуться в каталог")), "html", null, true);
                echo "</a></p>
\t\t";
            }
            // line 11
            echo "\t</div>

";
        } elseif (($this->getAttribute($this->getAttribute(        // line 13
(isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "id", array()) > 0)) {
            // line 15
            echo "
    <div class=\"row\">
      ";
            // line 18
            echo "      <div class=\"large-16 columns large-centered\">
        <h5 class=\"individual\">Завершение заказа</h5>
      </div>
    </div>
    <div class=\"row columns\">
      <div class=\"cart\">
        <div class=\"row\">
          <div class=\"large-8 large-centered columns\">
            <p class=\"cart__price\">";
            // line 26
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Заказ №")), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "id", array()), "html", null, true);
            echo " ";
            echo " принят!</p>
            <p>На Ваш e-mail отправлено уведомление. В ближайшее время наши менеджеры обязательно с Вами свяжутся.<br>При возникновении вопросов, просьба обращаться по телефону: +7 (499) 650-53-72. Время работы: с понедельника по пятницу 09:00-18:00.<br>Благодарим за Ваш заказ!</p>
          </div>
        </div>
      </div>
    </div>

";
        } else {
            // line 35
            echo "\t<div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "\">

\t\t<div class=\"row\">
      <div class=\"large-16 columns large-centered\">
\t  <div class=\"row column\">
        <h5 class=\"individual\">Оформление заказа</h5>
      </div>
\t  </div>
    </div>


    \t<form class=\"x-order-form mb11\" method=\"post\" data-abide novalidate>
    \t <div class=\"row columns\" id=\"order-container\">
    \t \t";
            // line 48
            $this->displayBlock('products', $context, $blocks);
            // line 185
            echo "        <div class=\"cart\">
        \t<div class=\"row\">
            ";
            // line 187
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getPersonTypes", array(), "method")) > 0)) {
                // line 188
                echo "            \t<div class=\"large-8 large-centered columns\">
            \t\t<p><strong>Контактная информация</strong></p>
          \t\t</div>

          \t\t";
                // line 192
                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getPersonTypes", array(), "method")) > 1)) {
                    // line 193
                    echo "            \t\t<fieldset>
            \t  \t<legend><strong>Тип плательщика</strong></legend>
            \t  \t";
                    // line 195
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getPersonTypes", array(), "method"));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                        // line 196
                        echo "            \t  \t\t<input id=\"user-";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                        echo "\" type=\"radio\" name=\"person_type\" class=\"x-person-type\" value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                        echo "\"";
                        if ($this->getAttribute($context["loop"], "first", array())) {
                            echo " checked";
                        }
                        echo ">
            \t  \t\t<label for=\"user-";
                        // line 197
                        echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "name", array()), "html", null, true);
                        echo "</label>
\t\t\t\t    \t\t\t";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 199
                    echo "\t\t\t\t    \t\t</fieldset><br>
\t\t\t\t    \t";
                } else {
                    // line 201
                    echo "\t\t\t\t    \t\t<input name=\"person_type\" type=\"hidden\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "personTypes", array()), 0, array(), "array"), "id", array()), "html", null, true);
                    echo "\">
\t\t\t\t    \t";
                }
                // line 203
                echo "
\t\t\t\t    \t";
                // line 204
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getPersonTypes", array(), "method"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 205
                    echo "\t\t\t\t    \t\t<div id=\"props-";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                    echo "\" class=\"clearfix x-order-props";
                    if ( !$this->getAttribute($context["loop"], "first", array())) {
                        echo " hide";
                    }
                    echo "\">
\t\t\t\t    \t\t\t<div class=\"large-16 columns large-offset-4\">
\t\t\t\t    \t\t\t\t<div class=\"row medium-up-2\">
\t\t\t\t    \t\t\t";
                    // line 208
                    ob_start();
                    $context["group"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                    // line 209
                    echo "\t\t\t\t    \t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getProps", array(0 => $this->getAttribute($context["p"], "id", array())), "method"));
                    foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                        // line 210
                        echo "                                    ";
                        if (twig_in_filter($this->getAttribute($context["f"], "alias", array()), array(0 => "surname", 1 => "name", 2 => "phone", 3 => "email"))) {
                            // line 211
                            echo "\t\t\t\t    \t\t\t\t<div class=\"columns\">
\t\t\t\t    \t\t\t\t";
                            // line 212
                            if (((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")) != $this->getAttribute($context["f"], "group_name", array()))) {
                                // line 213
                                echo "\t\t\t\t    \t\t\t\t\t<h5><b>";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "group_name", array()), "html", null, true);
                                echo "</b></h5>
\t\t\t\t    \t\t\t\t";
                            }
                            // line 215
                            echo "\t\t\t\t    \t\t\t\t";
                            if ((($this->getAttribute($context["f"], "type", array()) == 1) || ($this->getAttribute($context["f"], "type", array()) == "TEXT"))) {
                                // line 216
                                echo "\t\t\t\t    \t\t\t\t\t<label class=\"cart__label\" for=\"x-prop-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "\"><span>";
                                if ($this->getAttribute($context["f"], "required", array())) {
                                    echo "* ";
                                }
                                echo "</span>";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                                echo "
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                                // line 217
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "\" name=\"props[";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "]\" type=\"text\" class=\"cart__engraving";
                                if ($this->getAttribute($context["f"], "required", array())) {
                                    echo " required";
                                }
                                echo "\" ";
                                if ($this->getAttribute($context["f"], "required", array())) {
                                    echo "required";
                                }
                                echo " value=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "default_value", array()), "html", null, true);
                                echo "\" ";
                                if ($this->getAttribute($context["f"], "is_email", array())) {
                                    echo " pattern=\"email\"";
                                }
                                echo " ";
                                if ($this->getAttribute($context["f"], "is_phone", array())) {
                                    echo " onkeypress='return event.charCode >= 48 && event.charCode <= 57' ";
                                }
                                echo " /></label>
\t\t\t\t    \t\t\t\t";
                            }
                            // line 219
                            echo "\t\t\t\t    \t\t\t\t";
                            if ((($this->getAttribute($context["f"], "type", array()) == 2) || ($this->getAttribute($context["f"], "type", array()) == "CHECKBOX"))) {
                                // line 220
                                echo "\t\t\t\t    \t\t\t\t\t<label for=\"x-prop-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                                if ($this->getAttribute($context["f"], "required", array())) {
                                    echo " *";
                                }
                                echo "</label>
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                                // line 221
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "\" name=\"props[";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                                echo "]\" type=\"checkbox\" ";
                                if ($this->getAttribute($context["f"], "required", array())) {
                                    echo " class=\"required\" required";
                                }
                                echo " value=\"1\" />
\t\t\t\t    \t\t\t\t";
                            }
                            // line 223
                            echo "\t\t\t\t    \t\t\t\t";
                            // line 227
                            echo "\t\t\t\t    \t\t\t\t";
                            if ($this->getAttribute($context["f"], "note", array())) {
                                // line 228
                                echo "\t\t\t\t    \t\t\t\t\t<p class=\"help-text\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "note", array()), "html", null, true);
                                echo "</p>
\t\t\t\t    \t\t\t\t";
                            }
                            // line 230
                            echo "\t\t\t\t    \t\t\t\t";
                            ob_start();
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "group_name", array()), "html", null, true);
                            $context["group"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                            // line 231
                            echo "\t\t\t\t    \t\t\t\t</div>
\t\t\t\t    \t\t\t\t";
                        }
                        // line 233
                        echo "\t\t\t\t    \t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 234
                    echo "\t\t\t\t    \t\t\t\t</div>
\t\t\t\t    \t\t\t</div>
\t\t\t\t    \t\t</div>
\t\t\t\t    \t";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 238
                echo "\t\t\t\t    ";
            }
            // line 239
            echo "
          ";
            // line 240
            $this->displayBlock('delivery', $context, $blocks);
            // line 273
            echo "
        <div class=\"mb30\"></div>
        <div class=\"large-8 large-centered columns\">
            <p class=\"mb25\"><strong>Адрес доставки</strong></p>
        </div>
        ";
            // line 278
            $context["pay"] = "";
            $context["comment"] = "";
            // line 279
            echo "\t\t\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getPersonTypes", array(), "method"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                // line 280
                echo "
\t\t\t\t    \t\t<div id=\"props-";
                // line 281
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                echo "\" class=\"x-order-props";
                if ( !$this->getAttribute($context["loop"], "first", array())) {
                    echo " hide";
                }
                echo "\">
\t\t\t\t    \t\t\t<div class=\"large-16 columns large-centered\">
\t\t\t\t    \t\t\t\t<div class=\"row medium-up-2\">

\t\t\t\t    \t\t\t";
                // line 285
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getProps", array(0 => $this->getAttribute($context["p"], "id", array())), "method"));
                foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                    // line 286
                    echo "\t\t\t\t    \t\t\t";
                    if (twig_in_filter($this->getAttribute($context["f"], "alias", array()), array(0 => "country", 1 => "city", 2 => "street", 3 => "index"))) {
                        // line 287
                        echo "\t\t\t\t    \t\t\t\t<div class=\"columns\">

\t\t\t\t    \t\t\t\t";
                        // line 289
                        if ((($this->getAttribute($context["f"], "type", array()) == 1) || ($this->getAttribute($context["f"], "type", array()) == "TEXT"))) {
                            // line 290
                            echo "\t\t\t\t    \t\t\t\t\t<label class=\"cart__label\" for=\"x-prop-";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\"><span>";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo "* ";
                            }
                            echo "</span>";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                            echo "
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                            // line 291
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" type=\"text\" class=\"cart__engraving";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " required";
                            }
                            echo "\" ";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo "required";
                            }
                            echo " value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "default_value", array()), "html", null, true);
                            echo "\" ";
                            if ($this->getAttribute($context["f"], "is_email", array())) {
                                echo " pattern=\"email\"";
                            }
                            echo " /></label>
\t\t\t\t    \t\t\t\t";
                        }
                        // line 293
                        echo "\t\t\t\t    \t\t\t\t";
                        if ((($this->getAttribute($context["f"], "type", array()) == 2) || ($this->getAttribute($context["f"], "type", array()) == "CHECKBOX"))) {
                            // line 294
                            echo "\t\t\t\t    \t\t\t\t\t<label for=\"x-prop-";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " *";
                            }
                            echo "</label>
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                            // line 295
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" type=\"checkbox\" ";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " class=\"required\" required";
                            }
                            echo " value=\"1\" />
\t\t\t\t    \t\t\t\t";
                        }
                        // line 297
                        echo "\t\t\t\t    \t\t\t\t";
                        // line 301
                        echo "\t\t\t\t    \t\t\t\t";
                        if ($this->getAttribute($context["f"], "note", array())) {
                            // line 302
                            echo "\t\t\t\t    \t\t\t\t\t<p class=\"help-text\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "note", array()), "html", null, true);
                            echo "</p>
\t\t\t\t    \t\t\t\t";
                        }
                        // line 304
                        echo "
\t\t\t\t    \t\t\t\t</div>
\t\t\t\t    \t\t\t";
                    } else {
                        // line 307
                        echo "\t\t\t\t    \t\t\t\t";
                        if (($this->getAttribute($context["f"], "alias", array()) == "payment")) {
                            // line 308
                            echo "\t\t\t\t    \t\t\t\t\t";
                            ob_start();
                            // line 309
                            echo "\t\t\t\t    \t\t\t\t\t\t<input id=\"x-prop-";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" class=\"cart__engraving\" type=\"text\" placeholder=\"\">
\t\t\t\t    \t\t\t\t\t";
                            $context["pay"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                            // line 311
                            echo "\t\t\t\t    \t\t\t\t";
                        }
                        // line 312
                        echo "\t\t\t\t    \t\t\t\t";
                        if (($this->getAttribute($context["f"], "alias", array()) == "comment")) {
                            // line 313
                            echo "\t\t\t\t    \t\t\t\t\t";
                            ob_start();
                            // line 314
                            echo "\t\t<div class=\"row\">
      <div class=\"large-12 large-centered columns\">
          <p class=\"mb14\"><strong>Комментарии к заказу</strong></p>
          <textarea id=\"x-prop-";
                            // line 317
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" class=\"cart__tarea\"> </textarea>
    </div>
        </div>
\t\t\t\t    \t\t\t\t\t";
                            $context["comment"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                            // line 321
                            echo "\t\t\t\t    \t\t\t\t";
                        }
                        // line 322
                        echo "\t\t\t\t    \t\t\t";
                    }
                    // line 323
                    echo "\t\t\t\t    \t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 324
                echo "\t\t\t\t    \t\t\t</div>
\t\t\t\t    \t\t\t<div class=\"row large-up-4 small-up-2\">
\t\t\t\t    \t\t\t";
                // line 326
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getProps", array(0 => $this->getAttribute($context["p"], "id", array())), "method"));
                foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                    // line 327
                    echo "\t\t\t\t    \t\t\t";
                    if (twig_in_filter($this->getAttribute($context["f"], "alias", array()), array(0 => "dom", 1 => "build", 2 => "apartment"))) {
                        // line 328
                        echo "\t\t\t\t    \t\t\t\t<div class=\"columns\">

\t\t\t\t    \t\t\t\t";
                        // line 330
                        if ((($this->getAttribute($context["f"], "type", array()) == 1) || ($this->getAttribute($context["f"], "type", array()) == "TEXT"))) {
                            // line 331
                            echo "\t\t\t\t    \t\t\t\t\t<label class=\"cart__label\" for=\"x-prop-";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\"><span>";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo "* ";
                            }
                            echo "</span>";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                            echo "
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                            // line 332
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" type=\"text\" class=\"cart__engraving";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " required";
                            }
                            echo "\" ";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo "required";
                            }
                            echo " value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "default_value", array()), "html", null, true);
                            echo "\" ";
                            if ($this->getAttribute($context["f"], "is_email", array())) {
                                echo " pattern=\"email\"";
                            }
                            echo " /></label>
\t\t\t\t    \t\t\t\t";
                        }
                        // line 334
                        echo "\t\t\t\t    \t\t\t\t";
                        if ((($this->getAttribute($context["f"], "type", array()) == 2) || ($this->getAttribute($context["f"], "type", array()) == "CHECKBOX"))) {
                            // line 335
                            echo "\t\t\t\t    \t\t\t\t\t<label for=\"x-prop-";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "name", array()), "html", null, true);
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " *";
                            }
                            echo "</label>
\t\t\t\t    \t\t\t\t\t<input id=\"x-prop-";
                            // line 336
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "\" name=\"props[";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "id", array()), "html", null, true);
                            echo "]\" type=\"checkbox\" ";
                            if ($this->getAttribute($context["f"], "required", array())) {
                                echo " class=\"required\" required";
                            }
                            echo " value=\"1\" />
\t\t\t\t    \t\t\t\t";
                        }
                        // line 338
                        echo "\t\t\t\t    \t\t\t\t";
                        if ($this->getAttribute($context["f"], "note", array())) {
                            // line 339
                            echo "\t\t\t\t    \t\t\t\t\t<p class=\"help-text\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["f"], "note", array()), "html", null, true);
                            echo "</p>
\t\t\t\t    \t\t\t\t";
                        }
                        // line 341
                        echo "
\t\t\t\t    \t\t\t\t</div>
\t\t\t\t    \t\t\t";
                    }
                    // line 344
                    echo "\t\t\t\t    \t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 345
                echo "\t\t\t\t    \t\t\t</div>
\t\t\t\t    \t\t\t\t</div>
\t\t\t\t    \t\t\t</div>
\t\t\t\t    \t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 349
            echo "
        ";
            // line 350
            $this->displayBlock('payment', $context, $blocks);
            // line 386
            echo "
\t\t\t  ";
            // line 387
            echo twig_escape_filter($this->env, (isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "html", null, true);
            echo "


            <div class=\"mb11\"></div>
            <div class=\"row medium-up-2\">
              <div class=\"columns\">
                <div class=\"saphire\">
                  <input class=\"saphire__input\" type=\"checkbox\" id=\"b61\" required=\"\">
                  <label class=\"saphire__label saphire__label_top\" for=\"b61\">* Согласен с условиями заказа и доставки<br>→ Условия заказа и доставки</label>
                </div>
              </div>
              <div class=\"columns\">
                <p class=\"mb33 cart__order\">
                     Итого:<br><span class=\"x-total\"></span></p>
              </div>
            </div>


\t\t\t<div class=\"row\">
        <div class=\"large-12 large-centered columns\">
          <button class=\"button x-order-confirm medium-gray expanded \" > Оформить заказ</button>
            <p id=\"errorMsgForm\" class=\"x-order-error hide\"></p>
            <p id=\"msg-order-error\">* Заполните обязательные поля.</p>
        </div>
\t\t\t</div>
        </div>
    </div>
  </div>
</form>



\t</div>


\t";
            // line 422
            ob_start();
            // line 423
            echo "
\t\tdocument.addEventListener('DOMContentLoaded', function () {

\t\t\tjQuery('#";
            // line 426
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " input[name=\"person_type\"]').on('change', function(){

\t\t\t\tjQuery('.x-order-props').addClass('hide');
\t\t\t\tjQuery('.x-order-props .required').removeAttr('required');

\t\t\t\tjQuery('#props-'+jQuery(this).val()).removeClass('hide');
\t\t\t\tjQuery('#props-'+jQuery(this).val()+' .required').attr('required','required');

\t\t\t\tsale_order_get_available_payments( jQuery('#";
            // line 434
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-order-form') );

\t\t\t});
\t\t\tjQuery('.x-order-props.hide .required').removeAttr('required');

\t\t\tjQuery('#";
            // line 439
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " input[name=\"delivery_method\"]').on('change', function(){
\t\t\t\tsale_order_get_available_payments( jQuery('#";
            // line 440
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-order-form') );
\t\t\t});

\t\t\tjQuery('#";
            // line 443
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " input[name=\"payment_method\"]').on('change', function(){
\t\t\t\tsale_order_get_available_payments( jQuery('#";
            // line 444
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-order-form') );
\t\t\t});

\t\t\tjQuery('#";
            // line 447
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " input').on('change', function(){
\t\t\t\tsale_order_check_form( jQuery('#";
            // line 448
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-order-form') );
\t\t\t});

\t\t\tjQuery('#";
            // line 451
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " input[name=\"props[1]\"]').on('change', function(){

 \t\t\tif (\$(this).hasClass('is-invalid-input'))
\t\t\t{
\t\t\t\t\$('.x-order-confirm').attr(\"disabled\", 'disabled');
\t\t\t}

\t\t\t});

\t\t\tsale_order_get_available_payments( jQuery('#";
            // line 460
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo " .x-order-form') );

/*
            jQuery('.x-order-error').bind(\"DOMSubtreeModified\",function()
            {
            var strError = document.getElementById('errorMsgForm').innerHTML;
            strError = (strError.trim) ? strError.trim() : strError.replace(/^\\s+/,'');
            if (strError=='')
            {
            \$('#msg-order-error').removeClass('hide');
            \$('#msg-order-error').addClass('hide');

            }
            else
            {
            \$('#msg-order-error').removeClass('hide');

            }
            });
\t\t\t\t\t\t*/

\t\t});
\t";
            $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 483
            echo "\t";
            $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
        }
        // line 485
        echo "
";
    }

    // line 48
    public function block_products($context, array $blocks = array())
    {
        // line 49
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "getProducts", array(), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 50
            echo "\t\t\t\t\t\t<div class=\"cart\">
        <div class=\"row\">
          <div class=\"large-16 columns large-offset-4\">
            <div class=\"row\" data-equalizer data-equalize-by-row=\"true\">
              <div class=\"column small-8 medium-6 large-6 cart__img\" data-equalizer-watch style=\"padding-bottom: 0px;\">
                <img src=\"/imagetransform/width_200_height_130_fit_2";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "pic", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
            echo "\">
              </div>
              <div class=\"column small-16 medium-9 large-6\" data-equalizer-watch>
                <p><a href=\"";
            // line 58
            if ($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array())) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["c"], "product", array()), "catalog", array()), "url", array()), "html", null, true);
                echo "?id=";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "id", array()), "html", null, true);
            }
            echo "\">
                     Aрт. ";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "code", array()), "html", null, true);
            echo "<br>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "product", array()), "name", array()), "html", null, true);
            if ($this->getAttribute($context["c"], "offer", array())) {
                echo ",<br>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["c"], "offer", array()), "name", array()), "html", null, true);
            }
            echo "</a></p>
              </div>
              <div class=\"large-4 medium-3 large-offset-2 small-9 columns\">
                  <input class=\"cart__input x-quantity text-center\" type=\"text\" value=\"";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "quantity", array()), "html", null, true);
            echo "\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "id", array()), "html", null, true);
            echo "\">
              </div>
              <div class=\"large-6 medium-6 small-15 columns\">
                <div class=\"cart__price\">";
            // line 65
            echo $this->getAttribute($context["c"], "displayPrice", array());
            echo "</div>
              </div>
            </div>
          </div>
          <!--div class=\"large-9 large-centered columns\">
            <p><strong>Металл</strong></p>
            <div class=\"row small-up-2\">
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b2\">
                    <label class=\"saphire__label\" for=\"b2\">Белое золото</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b3\">
                    <label class=\"saphire__label\" for=\"b3\">Желтое золото</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b4\">
                    <label class=\"saphire__label\" for=\"b4\">Красное золото</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b5\">
                    <label class=\"saphire__label\" for=\"b5\">Серебро</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
            </div>
            <div class=\"mb15\">     </div>
            <p><strong>Текст гравировки</strong></p>
            <input class=\"cart__engraving\" type=\"text\" placeholder=\"\">
            <div class=\"row small-up-2\">
              <div class=\"columns\">
                <div class=\"saphire\">
                  <input class=\"saphire__input\" type=\"checkbox\" id=\"b6\">
                  <label class=\"saphire__label saphire__label_top\" for=\"b6\">Горизонтальное расположение гравировки</label>
                </div>
              </div>
              <div class=\"columns\">
                <div class=\"saphire\">
                  <input class=\"saphire__input\" type=\"checkbox\" id=\"b7\">
                  <label class=\"saphire__label saphire__label_top\" for=\"b7\">Вертикальное расположение гравировки</label>
                </div>
              </div>
              <div class=\"columns\">
                <p><img src=\"./i/flower.png\" alt=\"Товар\"></p>
              </div>
              <div class=\"columns large-text-right\">
                <p><img src=\"./i/flower.png\" alt=\"Товар\"></p>
              </div>
            </div>
            <div class=\"mb15\">  </div>
            <p><strong>Длина браслета (см)    </strong></p>
            <div class=\"row small-up-2\">
              <div class=\"columns\">
                <input class=\"cart__engraving\" type=\"text\" placeholder=\"\">
              </div>
              <div class=\"columns\"><a href=\"#\">→ Как замерить длину? Инструкция по замеру</a></div>
            </div>
            <div class=\"mb15\">  </div>
            <p><strong>Тип замка</strong></p>
            <div class=\"row small-up-2\">
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b8\">
                    <label class=\"saphire__label\" for=\"b8\">Круглый</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b9\">
                    <label class=\"saphire__label\" for=\"b9\">Карабин</label>
                  </div>
                <div class=\"mb15\"></div>
              </div>
              <div class=\"columns\">
                <p><img src=\"./i/flower.png\" alt=\"Товар\"></p>
              </div>
              <div class=\"columns large-text-right\">
                <p><img src=\"./i/flower.png\" alt=\"Товар\"></p>
              </div>
            </div>
            <div class=\"mb15\"></div>
            <p><strong>Тип цепи</strong></p>
            <div class=\"row small-up-2\">
              <div class=\"columns\">
                  <div class=\"saphire\">
                    <input class=\"saphire__input\" type=\"checkbox\" id=\"b10\">
                    <label class=\"saphire__label\" for=\"b10\">Якорная</label>
                  </div>
                <div class=\"mb15\"></div>
                <p><img src=\"./i/flower.png\" alt=\"Товар\"></p>
              </div>
            </div>
            <div class=\"mb15\"></div>
            <p><strong>Ваши пожелания / изменения / дополнения</strong></p>
            <textarea class=\"cart__tarea\"> </textarea>
            <div class=\"file\">
              <div class=\"file__upload text-center\">
                <label>
                  <input type=\"file\" name=\"file\"><span>Прикрепить файл</span>
                </label>
              </div>
              <input class=\"file__main\" type=\"text\" disabled=\"\">
            </div>
          </div-->
        </div>
      </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 183
        echo "
\t\t\t\t";
    }

    // line 240
    public function block_delivery($context, array $blocks = array())
    {
        // line 241
        echo "\t\t\t<div class=\"mb30\"></div>
      <div class=\"large-8 large-centered columns\">
\t\t\t\t<p class=\"mb14\"><strong>Доставка</strong></p>
          \t</div>
            <div class=\"large-8 large-centered columns\">
            \t";
        // line 246
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getOrder", array(), "method"), "getDeliveryMethods", array(0 => 1), "method"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            // line 247
            echo "            \t\t\t\t<div class=\"hide x-delivery-method x-delivery-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
            echo "\">
            \t\t\t\t\t<div class=\"saphire\">
            \t\t\t\t\t\t<input id=\"d";
            // line 249
            echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
            echo "\" class=\"saphire__input\" type=\"radio\" name=\"delivery_method\" ";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo " checked";
            }
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
            echo "\">
            \t\t\t\t\t\t<!--span class=\"label\">";
            // line 250
            if (($this->getAttribute($context["d"], "getCost", array(0 => false, 1 => false), "method") >= 0)) {
                // line 251
                echo "            \t\t\t\t\t\t";
                echo $this->getAttribute($context["d"], "getCost", array(0 => true, 1 => false), "method");
                echo "
            \t\t\t\t\t\t";
            } else {
                // line 253
                echo "            \t\t\t\t\t\t<a data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
                echo "\" class=\"x-delivery-method-calculate button small\" id=\"x-delivery-method-calculate-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Рассчитать")), "html", null, true);
                echo "</a>
            \t\t\t\t\t\t<span class=\"x-delivery-method-cost\"></span>
            \t\t\t\t\t\t";
            }
            // line 256
            echo "            \t\t\t\t\t\t</span-->
            \t\t\t\t\t\t<label class=\"saphire__label\" for=\"d";
            // line 257
            echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
            echo "\">";
            echo $this->getAttribute($context["d"], "name", array());
            echo "</label>


            \t\t\t\t\t";
            // line 260
            ob_start();
            echo $this->getAttribute($context["d"], "getHtml", array(), "method");
            $context["html"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 261
            echo "            \t\t\t\t\t";
            if ((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html"))) {
                // line 262
                echo "            \t\t\t\t\t\t<div class=\"row\">
            \t\t\t\t\t\t\t<div class=\"small-11 small-offset-1 columns x-delivery-method-html\" id=\"x-delivery-method-html-";
                // line 263
                echo twig_escape_filter($this->env, $this->getAttribute($context["d"], "id", array()), "html", null, true);
                echo "\">
            \t\t\t\t\t\t\t\t";
                // line 264
                echo twig_escape_filter($this->env, (isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")), "html", null, true);
                echo "
            \t\t\t\t\t\t\t</div>
            \t\t\t\t\t\t</div>
            \t\t\t\t\t";
            }
            // line 268
            echo "            \t\t\t\t</div>
            \t\t\t</div>
            \t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 271
        echo "            \t</div>
\t\t\t  ";
    }

    // line 350
    public function block_payment($context, array $blocks = array())
    {
        // line 351
        echo "          <div class=\"mb30\"></div>
        \t<div class=\"large-8 large-centered columns\">
\t\t\t\t<p><strong>Оплата</strong></p>
\t\t\t</div>
        \t<div class=\"large-16 columns large-centered\">
            <div class=\"row large-up-4 small-up-2\">
\t\t\t\t\t";
        // line 357
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getOrder", array(), "method"), "getPaymentMethods", array(0 => 1), "method"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 358
            echo "\t\t\t\t\t";
            if ((($this->getAttribute($context["loop"], "index", array()) % 2) == 1)) {
                // line 359
                echo "\t\t\t\t\t\t<div class=\"columns\">
\t\t\t\t\t";
            }
            // line 361
            echo "\t\t\t\t\t\t\t<div class=\"saphire hide x-payment-method x-payment-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t<input id=\"p";
            // line 362
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\" class=\"saphire__input\" type=\"radio\"
\t\t\t\t\t\t\t\t\t\tname=\"payment_method\"
\t\t\t\t\t\t\t\t\t\t";
            // line 364
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo " checked";
            }
            // line 365
            echo "\t\t\t\t\t\t\t\t\t\tvalue=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t";
            // line 366
            if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "paymentData", array()) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "order", array()), "paymentData", array()), "id", array()) == $this->getAttribute($context["p"], "id", array())))) {
                echo "checked";
            }
            echo ">
\t\t\t\t\t\t\t\t";
            // line 367
            if (($this->getAttribute($context["p"], "id", array()) == 5)) {
                // line 368
                echo "\t\t\t\t\t\t\t\t\t<label class=\"saphire__label otherwise\" for=\"p";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                echo "\" data-equalizer-watch>
\t\t\t\t\t\t\t\t\t\t&#160;";
                // line 369
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "name", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, (isset($context["pay"]) ? $context["pay"] : $this->getContext($context, "pay")), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t";
            } else {
                // line 372
                echo "\t\t\t\t\t\t\t\t\t<label class=\"saphire__label\" for=\"p";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
                echo "\" data-equalizer-watch>
\t\t\t\t\t\t\t\t\t\t&#160;";
                // line 373
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "name", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 375
            echo "\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t";
            // line 376
            if ($this->getAttribute($context["p"], "note", array())) {
                echo "<p class=\"help-text\"> ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "note", array()), "html", null, true);
                echo "</p>";
            }
            // line 377
            echo "\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
            // line 379
            if (((($this->getAttribute($context["loop"], "index", array()) % 2) == 0) &&  !$this->getAttribute($context["loop"], "first", array()))) {
                // line 380
                echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            // line 382
            echo "\t\t\t\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 383
        echo "\t\t\t  \t\t</div>
\t\t\t\t\t</div>
\t\t\t  ";
    }

    public function getTemplateName()
    {
        return "@widget/sale.order/default.twig";
    }

    public function getDebugInfo()
    {
        return array (  1192 => 383,  1178 => 382,  1174 => 380,  1172 => 379,  1168 => 377,  1162 => 376,  1159 => 375,  1154 => 373,  1149 => 372,  1141 => 369,  1136 => 368,  1134 => 367,  1128 => 366,  1123 => 365,  1119 => 364,  1114 => 362,  1109 => 361,  1105 => 359,  1102 => 358,  1085 => 357,  1077 => 351,  1074 => 350,  1069 => 271,  1053 => 268,  1046 => 264,  1042 => 263,  1039 => 262,  1036 => 261,  1032 => 260,  1024 => 257,  1021 => 256,  1010 => 253,  1004 => 251,  1002 => 250,  992 => 249,  986 => 247,  969 => 246,  962 => 241,  959 => 240,  954 => 183,  830 => 65,  822 => 62,  810 => 59,  802 => 58,  794 => 55,  787 => 50,  782 => 49,  779 => 48,  774 => 485,  770 => 483,  744 => 460,  732 => 451,  726 => 448,  722 => 447,  716 => 444,  712 => 443,  706 => 440,  702 => 439,  694 => 434,  683 => 426,  678 => 423,  676 => 422,  638 => 387,  635 => 386,  633 => 350,  630 => 349,  613 => 345,  607 => 344,  602 => 341,  596 => 339,  593 => 338,  582 => 336,  572 => 335,  569 => 334,  548 => 332,  537 => 331,  535 => 330,  531 => 328,  528 => 327,  524 => 326,  520 => 324,  514 => 323,  511 => 322,  508 => 321,  499 => 317,  494 => 314,  491 => 313,  488 => 312,  485 => 311,  477 => 309,  474 => 308,  471 => 307,  466 => 304,  460 => 302,  457 => 301,  455 => 297,  444 => 295,  434 => 294,  431 => 293,  410 => 291,  399 => 290,  397 => 289,  393 => 287,  390 => 286,  386 => 285,  375 => 281,  372 => 280,  354 => 279,  351 => 278,  344 => 273,  342 => 240,  339 => 239,  336 => 238,  319 => 234,  313 => 233,  309 => 231,  304 => 230,  298 => 228,  295 => 227,  293 => 223,  282 => 221,  272 => 220,  269 => 219,  244 => 217,  233 => 216,  230 => 215,  224 => 213,  222 => 212,  219 => 211,  216 => 210,  211 => 209,  208 => 208,  197 => 205,  180 => 204,  177 => 203,  171 => 201,  167 => 199,  149 => 197,  138 => 196,  121 => 195,  117 => 193,  115 => 192,  109 => 188,  107 => 187,  103 => 185,  101 => 48,  84 => 35,  71 => 26,  61 => 18,  57 => 15,  55 => 13,  51 => 11,  43 => 9,  41 => 8,  36 => 6,  31 => 3,  29 => 2,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.order/default.twig", "/home/velvetin/beta.velvetin.ru/docs/themes/shop/widgets/sale.order/default.twig");
    }
}

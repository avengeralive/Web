<?php

/* @widget/sale.goods.item/default.twig */
class __TwigTemplate_a7ebf93750acd01f92d49112ac530d32e3bbe3478cc77750e4f41b5ff77ee4de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'product_info' => array($this, 'block_product_info'),
            'tabs' => array($this, 'block_tabs'),
            'tabs_content' => array($this, 'block_tabs_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/sale.goods.item/default.twig", 1)->display($context);
        // line 2
        echo "
<div id=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
        echo "\" class=\"x-product x-cetera-widget\" data-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "html", null, true);
        echo "\" data-class=\"Cetera.fo.Material\" data-type=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "objectDefinition", array()), "alias", array()), "html", null, true);
        echo "\">

";
        // line 5
        $this->displayBlock('html', $context, $blocks);
        // line 189
        echo "</div>

";
        // line 191
        $context["script"] = ('' === $tmp = "\t
\tdocument.addEventListener('DOMContentLoaded', function () {
\t
\t\tjQuery('.x-show-comments').click(function(){
\t\t\t
\t\t\tjQuery('#product-tabs-1').foundation('selectTab', jQuery('#product-tab-comments'));
\t\t\t
\t\t});
\t
\t\tif ( jQuery('#product-tabs-1 li').length > 0 )
\t\t{
\t\t\tjQuery('#product-tabs-1').foundation('selectTab', jQuery('#x-product-tabs-content .tabs-panel:first'));
\t\t}
\t\telse
\t\t{
\t\t\tjQuery('#x-product-tabs').hide();
\t\t}

\t});
") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 211
        $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
    }

    // line 5
    public function block_html($context, array $blocks = array())
    {
        // line 6
        echo "\t<div class=\"row\">
\t\t<div class=\"small-24 medium-12 column tests\">

\t\t\t  ";
        // line 9
        if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : null), "material", array(), "any", false, true), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_pictures"), "method"), array(), "array", true, true) && (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_pictures"), "method"), array(), "array")) > 0))) {
            // line 10
            echo "\t\t\t  
\t\t\t\t<div class=\"row\">
\t\t\t\t  <div class=\"small-24 large-20 large-push-2 column text-center\">

\t\t\t\t\t<img id=\"x-product-image\" class=\"product-image\" data-zoom-image=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\" style=\"margin-bottom: 1.5rem\" src=\"/imagetransform/width_600_height_600";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\">

\t\t\t\t  </div>
\t\t\t\t  <div class=\"small-24 large-4 large-pull-10 column\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t  <div class=\"small-24 medium-22 large-24 end column\">
\t\t\t\t\t\t<div class=\"row\">

\t\t\t\t\t\t\t<div class=\"product-thumbs\" id=\"x-product-thumbs\">

\t\t\t\t\t\t\t  <a href=\"#\" class=\"active\" data-image=\"/imagetransform/width_600_height_600";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\" data-zoom-image=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t<div class=\"column\"><img src=\"/imagetransform/width_100_height_100_fit_3";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\" alt=\"\" style=\"width: 100%; background: #ccc;\" class=\"thumbnail\"></div>
\t\t\t\t\t\t\t  </a>
\t\t\t\t\t\t\t  ";
            // line 27
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_pictures"), "method"), array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                // line 28
                echo "\t\t\t\t\t\t\t  <a href=\"#\" data-image=\"/imagetransform/width_600_height_600";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "file", array()), "html", null, true);
                echo "\" data-zoom-image=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "file", array()), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t<div class=\"column\"><img data-zoom-image=\"";
                // line 29
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "file", array()), "html", null, true);
                echo "\" src=\"/imagetransform/width_100_height_100_fit_3";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "file", array()), "html", null, true);
                echo "\" alt=\"\" style=\"width: 100%; background: #ccc;\" class=\"thumbnail\"></div>
\t\t\t\t\t\t\t  </a>
\t\t\t\t\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t  </div>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t</div>\t\t\t  
\t\t\t  
\t\t\t  ";
        } else {
            // line 42
            echo "\t\t\t  
\t\t\t  <p class=\"text-center\">
\t\t\t\t  <a id=\"x-product-image-single-link\" href=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\">
\t\t\t\t\t<img id=\"x-product-image-single\" class=\"product-image\" data-zoom-image=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\" style=\"margin-bottom: 1.5rem\" src=\"/imagetransform/width_600_height_600";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "field_picture"), "method"), array(), "array"), "html", null, true);
            echo "\">
\t\t\t\t  </a>
\t\t\t  </p>
\t\t\t  
\t\t\t  ";
        }
        // line 50
        echo "
\t\t</div>
\t\t  
\t\t  <div class=\"small-24 medium-12 column\"><br class=\"hide-for-medium\">
\t\t  
\t\t    ";
        // line 55
        $this->displayBlock('product_info', $context, $blocks);
        // line 88
        echo "
\t\t\t<p>
\t\t\t\t<span class=\"stat\">";
        // line 90
        echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "displayPrice", array());
        echo "</span>
\t\t\t\t";
        // line 91
        if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "discount", array()) > 0)) {
            // line 92
            echo "\t\t\t\t\t<del class=\"text-dark-gray\">";
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "displayFullPrice", array());
            echo "</del>
\t\t\t\t";
        }
        // line 94
        echo "\t\t\t</p>
\t\t\t
\t\t\t<div class=\"row\">
\t\t\t <div class=\"small-8 large-8 column\">
\t\t\t\t<div class=\"input-group\">
\t\t\t\t  <div class=\"input-group-button\">
\t\t\t\t\t<button class=\"button x-less\">&ndash;</button>
\t\t\t\t  </div>
\t\t\t\t  <input type=\"text\" class=\"x-quantity input-group-field text-center\" value=\"1\">
\t\t\t\t  <div class=\"input-group-button\">
\t\t\t\t\t<button class=\"button x-more\">+</button>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  <div class=\"small-12 end column\">
\t\t\t\t<a class=\"top button expanded x-add-to-cart\" data-id=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "html", null, true);
        echo "\"><i class=\"fa fa-shopping-cart fa-lg\">&nbsp;</i>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Добавить в корзину")), "html", null, true);
        echo "</a>
\t\t\t  </div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"row column\"><br>
\t\t\t\t<p>
\t\t\t\t";
        // line 119
        echo "\t\t\t\t<a ";
        if ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "user", array())) {
            echo "class=\"x-add-to-wishlist\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "html", null, true);
            echo "\"";
        } else {
            echo "data-open=\"add-to-favourites-auth-popup\"";
        }
        echo "><i class=\"fa fa-lg fa-heart-o\">&nbsp;</i>Запомнить</a>
\t\t\t\t</p>\t\t\t
\t\t\t\t<hr><br>
\t\t\t</div>\t\t\t

\t\t\t";
        // line 124
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "share_buttons"), "method")) {
            // line 125
            echo "\t\t\t<div class=\"row column\">
\t\t\t
\t\t\t\t<span class=\"show-for-large text-medium-gray\">";
            // line 127
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Рассказать")), "html", null, true);
            echo ":  </span>
\t\t\t\t<noindex>
\t\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-vk\" href=\"http://vkontakte.ru/share.php?url=http://";
            // line 129
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            if ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array())) {
                echo "&image=http://";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array()), "html", null, true);
            }
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-vk fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-twi\" href=\"http://twitter.com/intent/tweet?text=";
            // line 130
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array()), "html", null, true);
            echo "&url=http://";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-twitter fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-fb\" href=\"http://www.facebook.com/sharer.php?u=http://";
            // line 131
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-facebook fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-gp\" href=\"https://plus.google.com/share?url=http://";
            // line 132
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-google-plus fa-stack-1x fa-inverse\"></i></a>
\t\t\t\t</noindex>\t\t\t

\t\t\t\t<br><br>
\t\t\t</div>
\t\t\t";
        }
        // line 137
        echo "\t
\t\t\t
\t\t  </div>
\t</div> 

\t<div class=\"row column\"  id=\"x-product-tabs\">
\t\t<ul class=\"tabs\" data-tabs=\"ll3p5i-tabs\" id=\"product-tabs-1\">
\t\t";
        // line 144
        $this->displayBlock('tabs', $context, $blocks);
        // line 156
        echo "\t
\t\t</ul>
\t\t<div id=\"x-product-tabs-content\" class=\"tabs-content\" data-tabs-content=\"product-tabs-1\">
\t\t";
        // line 159
        $this->displayBlock('tabs_content', $context, $blocks);
        // line 184
        echo "\t\t
\t\t</div>
\t</div>
\t<br>
\t";
    }

    // line 55
    public function block_product_info($context, array $blocks = array())
    {
        // line 56
        echo "\t\t\t
\t\t\t\t<div class=\"product-top-line clearfix\">
\t\t\t\t";
        // line 58
        if (($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "discount", array()) > 0)) {
            // line 59
            echo "\t\t\t\t\t<span class=\"label success\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Акция")), "html", null, true);
            echo "</span>
\t\t\t\t";
        }
        // line 61
        echo "\t\t\t\t";
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_comments"), "method") && $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "isPluginComments", array(), "method"))) {
            // line 62
            echo "\t\t\t\t    <div class=\"float-right\">
\t\t\t\t\t\t<div class=\"product-rating fa-lg\">
\t\t\t\t\t\t";
            // line 64
            $context["avg"] = twig_round($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "getRatingAverage", array(), "method"));
            // line 65
            echo "\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                echo "<i class=\"fa ";
                if (($context["i"] <= (isset($context["avg"]) ? $context["avg"] : $this->getContext($context, "avg")))) {
                    echo "fa-star";
                } else {
                    echo "fa-star-o";
                }
                echo "\">&nbsp;</i>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<a class=\"pseudo-link x-show-comments\" title=\"\" href=\"#product-tab-comments\">Отзывы &nbsp;(";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "getCommentsCount", array(), "method"), "html", null, true);
            echo ")</a>
\t\t\t\t    </div>
\t\t\t\t";
        }
        // line 70
        echo "\t\t\t\t</div>\t\t
\t\t\t\t<br>
\t\t\t
\t\t\t\t<h1 class=\"product-page-title\">";
        // line 73
        echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array());
        echo "</h1><br>\t\t\t
\t\t\t\t";
        // line 74
        echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "short", array());
        echo "
\t\t\t\t
\t\t\t\t";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "properties", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ($this->getAttribute($context["p"], "value", array())) {
                // line 77
                echo "\t\t\t\t
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t  <div class=\"small-24 large-6 column\">
\t\t\t\t\t\t<div class=\"product-param-title\"><strong>";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "name", array()), "html", null, true);
                echo ":</strong></div>
\t\t\t\t\t  </div>
\t\t\t\t\t  <div class=\"small-24 large-18 column\">";
                // line 82
                echo $this->getAttribute($context["p"], "value", array());
                echo "</div>
\t\t\t\t\t</div>\t\t\t\t

\t\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "\t\t\t\t
\t\t\t";
    }

    // line 144
    public function block_tabs($context, array $blocks = array())
    {
        // line 145
        echo "\t\t
\t\t\t";
        // line 146
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "tabs", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            if ($this->getAttribute($context["t"], "value", array())) {
                // line 147
                echo "\t\t\t\t<li class=\"tabs-title\" role=\"presentation\"><a href=\"#product-tab-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
                echo "\" role=\"tab\" aria-controls=\"product-tab-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
                echo "\" id=\"product-tab-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
                echo "-label\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "name", array()), "html", null, true);
                echo "</a></li>
\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 149
        echo "\t\t\t\t\t\t\t
\t\t\t";
        // line 150
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_comments"), "method") && $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "isPluginComments", array(), "method"))) {
            // line 151
            echo "\t\t\t<li class=\"tabs-title\" role=\"presentation\">
\t\t\t\t<a href=\"#product-tab-comments\" role=\"tab\" aria-controls=\"product-tab-comments\" aria-selected=\"false\" id=\"product-tab-comments-label\">Отзывы (";
            // line 152
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "getCommentsCount", array(), "method"), "html", null, true);
            echo ")</a>
\t\t\t</li>
\t\t\t";
        }
        // line 155
        echo "\t\t\t
\t\t";
    }

    // line 159
    public function block_tabs_content($context, array $blocks = array())
    {
        // line 160
        echo "\t\t 
\t\t\t";
        // line 161
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "tabs", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            if ($this->getAttribute($context["t"], "value", array())) {
                // line 162
                echo "\t\t\t<div class=\"tabs-panel\" id=\"product-tab-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
                echo "\" role=\"tabpanel\" aria-hidden=\"false\" aria-labelledby=\"product-tab-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
                echo "-label\">
\t\t\t\t";
                // line 163
                if (twig_test_iterable($this->getAttribute($context["t"], "value", array()))) {
                    // line 164
                    echo "\t\t\t\t\t<table>
\t\t\t\t\t";
                    // line 165
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["t"], "value", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["prop"]) {
                        // line 166
                        echo "\t\t\t\t\t\t<tr><td>";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["prop"], "name", array()), "html", null, true);
                        echo "</td><td>";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["prop"], "value", array()), "html", null, true);
                        echo "</td></tr>
\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prop'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 168
                    echo "\t\t\t\t\t</table>
\t\t\t\t";
                } else {
                    // line 170
                    echo "\t\t\t        ";
                    echo $this->getAttribute($context["t"], "value", array());
                    echo "
\t\t\t\t";
                }
                // line 172
                echo "\t\t\t</div>
\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 173
        echo "\t\t 
\t\t 
\t\t\t";
        // line 175
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_comments"), "method") && $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "isPluginComments", array(), "method"))) {
            // line 176
            echo "\t\t\t<div class=\"tabs-panel\" id=\"product-tab-comments\" role=\"tabpanel\" aria-hidden=\"true\" aria-labelledby=\"product-tab-comments-label\">
\t\t\t  
\t\t\t\t<h3>";
            // line 178
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Отзывы покупателей")), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "getCommentsCount", array(), "method"), "html", null, true);
            echo ")</h3>
\t\t\t\t";
            // line 179
            try {
                \Cetera\Application::getInstance()->getWidget("Comments.List", array("material" => $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "form_rating_text" => "Ваша оценка товара", "form_reload_after_post" => 1))->display();
            } catch (\Exception $e) {
                echo '<div class="callout alert">'.$e->getMessage().'</div>';
            }

            // line 180
            echo "\t\t\t  
\t\t\t</div>
\t\t\t";
        }
        // line 183
        echo "\t\t\t
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/sale.goods.item/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  523 => 183,  518 => 180,  511 => 179,  505 => 178,  501 => 176,  499 => 175,  495 => 173,  487 => 172,  481 => 170,  477 => 168,  466 => 166,  462 => 165,  459 => 164,  457 => 163,  450 => 162,  445 => 161,  442 => 160,  439 => 159,  434 => 155,  428 => 152,  425 => 151,  423 => 150,  420 => 149,  404 => 147,  399 => 146,  396 => 145,  393 => 144,  388 => 86,  377 => 82,  372 => 80,  367 => 77,  362 => 76,  357 => 74,  353 => 73,  348 => 70,  342 => 67,  339 => 66,  323 => 65,  321 => 64,  317 => 62,  314 => 61,  308 => 59,  306 => 58,  302 => 56,  299 => 55,  291 => 184,  289 => 159,  284 => 156,  282 => 144,  273 => 137,  263 => 132,  258 => 131,  251 => 130,  241 => 129,  236 => 127,  232 => 125,  230 => 124,  215 => 119,  204 => 109,  187 => 94,  181 => 92,  179 => 91,  175 => 90,  171 => 88,  169 => 55,  162 => 50,  152 => 45,  148 => 44,  144 => 42,  132 => 32,  121 => 29,  114 => 28,  110 => 27,  105 => 25,  99 => 24,  84 => 14,  78 => 10,  76 => 9,  71 => 6,  68 => 5,  64 => 211,  43 => 191,  39 => 189,  37 => 5,  28 => 3,  25 => 2,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/sale.goods.item/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/themes/shop/widgets/sale.goods.item/default.twig");
    }
}

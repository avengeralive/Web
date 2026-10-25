<?php

/* @widget/comments.list/default.twig */
class __TwigTemplate_f035019141bb23383bef50a525ee7d67eb890b226722aa9b8c5167d0246d5f0e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('html', $context, $blocks);
        // line 43
        echo "

";
        // line 45
        $this->loadTemplate("@widget/comments.list/default.twig", "@widget/comments.list/default.twig", 45, "1374314564")->display($context);
    }

    // line 1
    public function block_html($context, array $blocks = array())
    {
        // line 2
        echo "\t
\t";
        // line 3
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 4
            echo "\t\t<div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
            echo "-wrapper\">
\t";
        }
        // line 5
        echo "\t
\t
\t";
        // line 7
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "widgetTitle", array())) {
            echo "<h3>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getWidgetTitle", array()), "html", null, true);
            echo "</h3>";
        }
        echo "\t
\t
\t";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "comments", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            echo "    
\t    <a name=\"comment-";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\"></a>
        <div class=\"media-object\">
\t\t\t";
            // line 12
            if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "rating"), "method") && $this->getAttribute($context["m"], "rating", array()))) {
                // line 13
                echo "\t\t\t\t<div class=\"fa-lg float-right\">
\t\t\t\t";
                // line 14
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    echo "<i class=\"fa ";
                    if (($context["i"] <= $this->getAttribute($context["m"], "rating", array()))) {
                        echo "fa-star";
                    } else {
                        echo "fa-star-o";
                    }
                    echo "\">&nbsp;</i>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 15
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 16
            echo "\t\t\t
            <div class=\"media-object-section show-for-large\">
                 <div class=\"thumbnail\"><img src=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "avatar", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "nickname", array()), "html", null, true);
            echo "\" style=\"background:#bbb;width:45px;height:45px;\"></div>
            </div>
\t\t\t<div class=\"media-object-section\">
\t\t\t\t<span class=\"text-dark-gray\">";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "nickname", array()), "html", null, true);
            echo ", &nbsp; ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["m"], "dat", array()), "Y.m.d H:i"), "html", null, true);
            echo "</span>
\t\t\t</div>\t\t
        </div>
        <p>";
            // line 24
            echo $this->getAttribute($context["m"], "comment", array());
            echo "</p><br>    
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "
\t";
        // line 27
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 28
            echo "\t\t<div class=\"x-pages\">
\t\t\t";
            // line 29
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
\t\t</div>
\t";
        }
        // line 31
        echo "\t\t
\t
\t";
        // line 33
        if ( !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method")) {
            // line 34
            echo "\t\t</div>\t
\t\t";
            // line 35
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "form"), "method")) {
                // line 36
                echo "\t\t<div id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getUniqueId", array(), "method"), "html", null, true);
                echo "-form\">
\t\t\t";
                // line 37
                echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getForm", array(), "method");
                echo "
\t\t</div>
\t\t";
            }
            // line 39
            echo "\t
\t";
        }
        // line 41
        echo "\t
";
    }

    public function getTemplateName()
    {
        return "@widget/comments.list/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 41,  156 => 39,  150 => 37,  145 => 36,  143 => 35,  140 => 34,  138 => 33,  134 => 31,  128 => 29,  125 => 28,  123 => 27,  120 => 26,  112 => 24,  104 => 21,  96 => 18,  92 => 16,  88 => 15,  73 => 14,  70 => 13,  68 => 12,  63 => 10,  57 => 9,  48 => 7,  44 => 5,  38 => 4,  36 => 3,  33 => 2,  30 => 1,  26 => 45,  22 => 43,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/comments.list/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/plugins/comments/widgets/comments.list/default.twig");
    }
}


/* @widget/comments.list/default.twig */
class __TwigTemplate_f035019141bb23383bef50a525ee7d67eb890b226722aa9b8c5167d0246d5f0e_1374314564 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 45
        $this->parent = $this->loadTemplate("@widget/_common/ajax-paginator.twig", "@widget/comments.list/default.twig", 45);
        $this->blocks = array(
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@widget/_common/ajax-paginator.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 46
    public function block_script($context, array $blocks = array())
    {
        // line 47
        echo "\t\t";
        $this->displayParentBlock("script", $context, $blocks);
        echo "
\t\t";
        // line 48
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajax"), "method") &&  !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method"))) {
            // line 49
            echo "\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t\t";
            // line 50
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_comment();
\t\t});\t\t
\t\tfunction ";
            // line 52
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_comment(){
\t\t\tvar form = document.querySelector(\"#";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-form .x-form\");
\t\t\tform.addEventListener('new_comment', function () {\t\t\t\t\t\t\t
\t\t\t\t";
            // line 55
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_loadpage( ";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_currentpage );\t\t\t\t\t\t\t\t
\t\t\t\t";
            // line 56
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_comment();
\t\t\t});\t\t
\t\t}
\t\t";
        }
        // line 60
        echo "\t";
    }

    public function getTemplateName()
    {
        return "@widget/comments.list/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  259 => 60,  252 => 56,  246 => 55,  241 => 53,  237 => 52,  232 => 50,  229 => 49,  227 => 48,  222 => 47,  219 => 46,  202 => 45,  160 => 41,  156 => 39,  150 => 37,  145 => 36,  143 => 35,  140 => 34,  138 => 33,  134 => 31,  128 => 29,  125 => 28,  123 => 27,  120 => 26,  112 => 24,  104 => 21,  96 => 18,  92 => 16,  88 => 15,  73 => 14,  70 => 13,  68 => 12,  63 => 10,  57 => 9,  48 => 7,  44 => 5,  38 => 4,  36 => 3,  33 => 2,  30 => 1,  26 => 45,  22 => 43,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/comments.list/default.twig", "/var/www/tpl.fastsite.ru/www/subdmn/velvetin/plugins/comments/widgets/comments.list/default.twig");
    }
}

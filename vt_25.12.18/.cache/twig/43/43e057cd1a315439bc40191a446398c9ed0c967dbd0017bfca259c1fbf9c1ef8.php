<?php

/* @widget/material/default.twig */
class __TwigTemplate_351f060ed9287d9bbf73aa8cc7cb9d844eb319507b00a582f98f0f647b967a7f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html' => array($this, 'block_html'),
            'share' => array($this, 'block_share'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"x-cetera-widget\" data-class=\"Cetera.fo.Material\" data-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "id", array()), "html", null, true);
        echo "\" data-type=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "objectDefinition", array()), "alias", array()), "html", null, true);
        echo "\">
";
        // line 2
        $this->displayBlock('html', $context, $blocks);
        // line 34
        echo "</div>";
    }

    // line 2
    public function block_html($context, array $blocks = array())
    {
        // line 3
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getMaterial", array())) {
            // line 4
            echo "
\t<h1>";
            // line 5
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array());
            echo "</h1>
\t
\t<div class=\"content\">
\t\t";
            // line 8
            if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "show_pic"), "method") && $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array()))) {
                // line 9
                echo "\t\t<div class=\"left picture\">
\t\t\t<img src=\"";
                // line 10
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array()), "html", null, true);
                echo "\" />
\t\t</div>
\t\t";
            }
            // line 13
            echo "\t\t
\t\t";
            // line 14
            echo $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "text", array());
            echo "
\t\t\t
\t\t";
            // line 16
            $this->displayBlock('share', $context, $blocks);
            // line 30
            echo "\t</div>

";
        }
    }

    // line 16
    public function block_share($context, array $blocks = array())
    {
        // line 17
        echo "\t\t";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "share_buttons"), "method")) {
            // line 18
            echo "\t\t<div class=\"callout share text-center\">
\t\t
\t\t\t<span class=\"show-for-large text-medium-gray\">";
            // line 20
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('_')->getCallable(), array("Поделиться в соц. сетях")), "html", null, true);
            echo ":  </span>
\t\t\t<noindex>
            <a rel=\"nofollow\" class=\"fa-stack fa-lg text-vk\" href=\"http://vkontakte.ru/share.php?url=http://";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            if ($this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array())) {
                echo "&image=http://";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "pic", array()), "html", null, true);
            }
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-vk fa-stack-1x fa-inverse\"></i></a>
\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-twi\" href=\"http://twitter.com/intent/tweet?text=";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "name", array()), "html", null, true);
            echo "&url=http://";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-twitter fa-stack-1x fa-inverse\"></i></a>
\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-fb\" href=\"http://www.facebook.com/sharer.php?u=http://";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-facebook fa-stack-1x fa-inverse\"></i></a>
\t\t\t<a rel=\"nofollow\" class=\"fa-stack fa-lg text-gp\" href=\"https://plus.google.com/share?url=http://";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["s"]) ? $context["s"] : $this->getContext($context, "s")), "SERVER_NAME", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "material", array()), "url", array()), "html", null, true);
            echo "\" title=\"\"><i class=\"fa fa-circle fa-stack-2x\"></i><i class=\"fa fa-google-plus fa-stack-1x fa-inverse\"></i></a>
\t\t\t</noindex>
\t\t</div>\t\t\t
\t\t";
        }
        // line 28
        echo "\t
\t\t";
    }

    public function getTemplateName()
    {
        return "@widget/material/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 28,  113 => 25,  108 => 24,  101 => 23,  91 => 22,  86 => 20,  82 => 18,  79 => 17,  76 => 16,  69 => 30,  67 => 16,  62 => 14,  59 => 13,  53 => 10,  50 => 9,  48 => 8,  42 => 5,  39 => 4,  37 => 3,  34 => 2,  30 => 34,  28 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/material/default.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/material/default.twig");
    }
}

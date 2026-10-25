<?php

/* page_section_server1.twig */
class __TwigTemplate_3e4e6258ee9a6f488176f9c2f44cba45056451ba88b3b3c7c8c751e3032f7571 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_section_server1.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        echo "  

    <div class=\"row column\">
       ";
        // line 6
        try {
            \Cetera\Application::getInstance()->getWidget("Breadcrumbs", array())->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 7
        echo "    </div>
\t
\t";
        // line 9
        ob_start();
        $context["menu"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "

    <div class=\"row\">
\t\t\t";
        // line 13
        if ((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu"))) {
            // line 14
            echo "        <div class=\"right columns small-24 medium-9 large-6\">
\t\t  
\t\t  <div class=\"content offset\">
\t\t\t  <div class=\"callout\">";
            // line 17
            echo twig_escape_filter($this->env, (isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "html", null, true);
            echo "
\t\t\t  </div>
\t\t  </div>
\t\t  
        </div>
        
\t\t";
        }
        // line 24
        echo "        <div class=\"center ";
        if ((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu"))) {
            echo "columns small-24 medium-15 large-18";
        } else {
            echo "column";
        }
        echo "\">
\t\t
\t\t\t";
        // line 26
        try {
            \Cetera\Application::getInstance()->getWidget("Section", array("page404_template" => "page_404.twig", "list_template" => "tiles.twig", "list_limit" => 9, "material_share_buttons" => 1, "list_where" => (isset($context["list_where"]) ? $context["list_where"] : $this->getContext($context, "list_where"))))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        echo "\t\t
\t\t
        </div>

\t\t

    </div>
             
";
    }

    public function getTemplateName()
    {
        return "page_section_server1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 26,  70 => 24,  60 => 17,  55 => 14,  53 => 13,  48 => 10,  45 => 9,  41 => 7,  34 => 6,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_section_server1.twig", "/usr/www/users/alivel/velvetin/themes/shop/design/page_section_server1.twig");
    }
}

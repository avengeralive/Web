<?php

/* @widget/_common/ajax-paginator.twig */
class __TwigTemplate_34bbbe5131e8d82993dc3958edb6601223834d44211ca066c8df68c86abd14c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        // line 2
        echo "\t";
        $this->displayBlock('script', $context, $blocks);
        // line 63
        echo "\t
";
        $context["script"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 65
        $this->getAttribute($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "application", array()), "addHeadString", array(0 => (("<script>" . (isset($context["script"]) ? $context["script"] : $this->getContext($context, "script"))) . "</script>")), "method");
    }

    // line 2
    public function block_script($context, array $blocks = array())
    {
        echo " 
\t\t";
        // line 3
        if (($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajax"), "method") &&  !$this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "ajaxCall"), "method"))) {
            // line 4
            echo "
\t\tdocument.addEventListener('DOMContentLoaded', function () {
\t\t\t";
            // line 6
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_links();
\t\t});
\t\tfunction ";
            // line 8
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_links(){
\t\t\tvar pageLink = document.querySelectorAll(\"#";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper .x-pages a\");
\t\t\tfor (var i = 0; i  < pageLink.length; i++) pageLink[i].addEventListener(\"click\", ";
            // line 10
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_pageClick);
\t\t}

\t\tfunction ";
            // line 13
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_pageClick(e)
\t\t{
\t\t\te.preventDefault();
\t\t\t";
            // line 16
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_loadpage( this.dataset.page );
\t\t}
\t\t
\t\tvar ";
            // line 19
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_currentpage = 1;
\t\tfunction ";
            // line 20
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_loadpage( page )
\t\t{
\t\t    ";
            // line 22
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_currentpage = page;
\t\t\t
\t\t\tvar widget = document.querySelector(\"#";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-wrapper\");
\t\t\t
\t\t\t
\t\t\tvar loading = '<div id=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-loading\">";
            echo twig_replace_filter((isset($context["loading"]) ? $context["loading"] : $this->getContext($context, "loading")), array("
" => "", "" => "", "'" => "'"));
            echo "</div>';
\t\t\t";
            // line 28
            if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "infinite"), "method")) {
                // line 29
                echo "\t\t\t\twidget.innerHTML += loading;
\t\t\t\tvar p = document.querySelectorAll(\"#";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
                echo "-wrapper .x-pages\");
\t\t\t\tfor (var i = 0; i  < p.length; i++) p[i].parentNode.removeChild(p[i]);
\t\t\t";
            } else {
                // line 33
                echo "\t\t\t\twidget.innerHTML = loading;
\t\t\t";
            }
            // line 35
            echo "\t\t\t
\t\t\tvar request = new XMLHttpRequest();
\t\t\tvar body = '";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "params", array()));
            foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                echo "params[";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "]=";
                if (($context["name"] == "page")) {
                    echo "' + page + '";
                } else {
                    echo twig_escape_filter($this->env, twig_urlencode_filter($context["value"]), "html", null, true);
                }
                echo "&";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "params[ajaxCall]=1';
\t\t\trequest.open('POST', '";
            // line 38
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getAjaxUrl", array(), "method");
            echo "', true);
\t\t\trequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
\t\t\trequest.onload = function (e) {
\t\t\t\tif (request.readyState === 4) {

\t\t\t\t\t// Проверяем успешность GET-запроса
\t\t\t\t\tif (request.status === 200) {
\t\t\t\t\t\tvar ldr = document.querySelector(\"#";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), "html", null, true);
            echo "-loading\");
\t\t\t\t\t\tldr.outerHTML = request.responseText;
\t\t\t\t\t\t";
            // line 47
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "uniqueId", array()), array("-" => "_")), "html", null, true);
            echo "_hook_links();
\t\t\t\t\t\tjQuery(document).foundation();
\t\t\t\t\t} else {
\t\t\t\t\t\tconsole.error(request.statusText);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t};

\t\t\trequest.onerror = function (e) {
\t\t\t\tconsole.error(request.statusText);
\t\t\t};

\t\t\trequest.send(body);\t\t
\t\t
\t\t}
\t\t";
        }
        // line 63
        echo "\t";
    }

    public function getTemplateName()
    {
        return "@widget/_common/ajax-paginator.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 63,  155 => 47,  150 => 45,  140 => 38,  121 => 37,  117 => 35,  113 => 33,  107 => 30,  104 => 29,  102 => 28,  95 => 27,  89 => 24,  84 => 22,  79 => 20,  75 => 19,  69 => 16,  63 => 13,  57 => 10,  53 => 9,  49 => 8,  44 => 6,  40 => 4,  38 => 3,  33 => 2,  29 => 65,  25 => 63,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/_common/ajax-paginator.twig", "/var/www/tpl.fastsite.ru/www/cms/widgets/_common/ajax-paginator.twig");
    }
}

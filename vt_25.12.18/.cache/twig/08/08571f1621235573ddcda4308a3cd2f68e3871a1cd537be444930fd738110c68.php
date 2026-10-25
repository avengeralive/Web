<?php

/* @widget/list/mass_media.twig */
class __TwigTemplate_605bf6c2c93752153f4e9c66447e8cec5c48e60d48051880287c2c27f5c25753 extends Twig_Template
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
        $this->loadTemplate("@widget/_common/favorite.twig", "@widget/list/mass_media.twig", 1)->display($context);
        // line 2
        echo "<style>
.pht:hover { cursor: zoom-in; }
</style>
<script src=\"https://code.jquery.com/jquery-3.3.1.min.js\"></script>
";
        // line 6
        $this->displayBlock('html', $context, $blocks);
    }

    public function block_html($context, array $blocks = array())
    {
        // line 7
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 8
            echo "  <div class=\"row stocksitem active\" id=\"act";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo "\">
      <div class=\"columns\">
        <div class=\"date\">
          ";
            // line 11
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["m"], "dat", array()), "d.m.Y"), "html", null, true);
            echo "
        </div>
        <div class=\"content\">
          <a class=\"news__more\" href=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "url", array()), "html", null, true);
            echo "\" onclick=\"return false;\"><h4>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "name", array()), "html", null, true);
            echo "</h4></a>
          ";
            // line 15
            if (($this->getAttribute($context["m"], "pic", array()) != "")) {
                // line 16
                echo "          <div class=\"imager\" style=\"width: 100%; float: left; position: relative; margin-bottom: 6px;\">
            <div class=\"imagerinner\">
          <a class=\"left-button\" style=\"cursor: pointer; position: absolute; left: 7px; top: calc(50% - 18px);\" onclick=\"\$('.rows";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').each(function(i, v){ 
          if (\$(v).attr('src') == \$('.photo";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')) {
            if (i == 0) {
              \$('.photo";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1]).attr('data-zoom')); 
              \$('.photo";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1]).attr('src')); 
            } else { 
              \$('.photo";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i - 1]).attr('data-zoom'));
              \$('.photo";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i - 1]).attr('src')); 
            }
            return false;
          } });\"><i class=\"fa fa-angle-left fa-2x\"></i></a>
          <a class=\"right-button\" style=\"cursor: pointer; position: absolute; right: 7px; top: calc(50% - 18px);\" onclick=\"\$('.rows";
                // line 29
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').each(function(i, v){ 
          if (\$(v).attr('src') == \$('.photo";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')) { 
            if (i == \$('.rows";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1) { 
              \$('.photo";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[0]).attr('data-zoom')); 
              \$('.photo";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[0]).attr('src')); 
            } else { 
              \$('.photo";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i + 1]).attr('data-zoom'));
              \$('.photo";
                // line 36
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i + 1]).attr('src')); 
            }
            return false;
          } });\"><i class=\"fa fa-angle-right fa-2x\"></i></a>
          <script>
            \$(document).keyup(function(e) {
              if (e.keyCode === 27)  {
                \$('.imager').removeClass('modals'); \$('body').css('overflow', 'scroll'); x = \$('.photo";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src'); \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')); \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', x);
              }
              if (e.keyCode === 37)  {
                \$('.rows";
                // line 46
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').each(function(i, v){ 
                if (\$(v).attr('src') == \$('.photo";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')) { 
                  if (i == 0) { 
                    \$('.modals .photo";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1]).attr('data-zoom')); 
                    \$('.modals .photo";
                // line 50
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1]).attr('src')); 
                  } else { 
                    \$('.modals .photo";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i - 1]).attr('data-zoom'));
                    \$('.modals .photo";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i - 1]).attr('src')); 
                  }
                } });
              }
              if (e.keyCode === 39)  {
                \$('.rows";
                // line 58
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').each(function(i, v){
                console.log(\$(v).attr('src'));
                if (\$(v).attr('src') == \$('.photo";
                // line 60
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')) { 
                  if (i == \$('.rows";
                // line 61
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img').length - 1) { 
                    \$('.modals .photo";
                // line 62
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[0]).attr('data-zoom')); 
                    \$('.modals .photo";
                // line 63
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[0]).attr('src')); 
                  } else { 
                    \$('.modals .photo";
                // line 65
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i + 1]).attr('data-zoom'));
                    \$('.modals .photo";
                // line 66
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', \$(\$('.rows";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo " img')[i + 1]).attr('src')); 
                  }
                  return false;
                } });
              }
            });
          </script>
          <button onclick=\"\$('.imager').removeClass('modals'); \$('body').css('overflow', 'scroll'); x = \$('.photo";
                // line 73
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src'); \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('src', \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom')); \$('.photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "').attr('data-zoom', x);\" class=\"close-button\" type=\"button\" style=\"right: 8px !important; top: 8px !important;\">
          <img src=\"/themes/shop/images/cross.svg\" alt=\"\" style=\"width: 14px; height: 14px;\"></button><img src=\"/imagetransform/width_840_height_560_fit_2";
                // line 74
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                echo "\" class=\"pht photo";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "\" data-zoom=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                echo "\" style=\"float: left; margin-top: 0px;\">
            </div>
          </div>
          <p style=\"margin-top: 0px; margin-bottom: 0px !important; margin-left:0px; margin-right: 0px; width: 420px; float: left; max-width: 100%;\" class=\"imagesrow rows";
                // line 77
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                echo "\">
          ";
                // line 78
                if ( !twig_test_empty($this->getAttribute($context["m"], "slider_img", array()))) {
                    // line 79
                    echo "          <img src=\"/imagetransform/width_840_height_560_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                    echo "\" style=\"width: 65px !important; height: 43px; margin: 1px; cursor: pointer;\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                    echo "\" onclick=\"\$('.photo";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                    echo "').attr('src', \$(this).attr('src')); \$('.photo";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                    echo "').attr('data-zoom', \$(this).attr('data-zoom'));\">
          ";
                }
                // line 81
                echo "          ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["m"], "slider_img", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["im"]) {
                    // line 82
                    echo "          <img src=\"/imagetransform/width_840_height_560_fit_2";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["im"], "file", array()), "html", null, true);
                    echo "\" style=\"width: 65px !important; height: 43px; margin: 1px; cursor: pointer;\" data-zoom=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["im"], "file", array()), "html", null, true);
                    echo "\" onclick=\"\$('.photo";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                    echo "').attr('src', \$(this).attr('src')); \$('.photo";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
                    echo "').attr('data-zoom', \$(this).attr('data-zoom'));\">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['im'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 84
                echo "          </p>
          ";
                // line 85
                if ( !twig_test_empty($this->getAttribute($context["m"], "slider_img", array()))) {
                    // line 86
                    echo "          <img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "pic", array()), "html", null, true);
                    echo "\" style=\"display: none;\">
          ";
                }
                // line 88
                echo "          ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["m"], "slider_img", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["im"]) {
                    // line 89
                    echo "          <img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["im"], "file", array()), "html", null, true);
                    echo "\" style=\"display: none;\">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['im'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 91
                echo "          ";
            }
            // line 92
            echo "          ";
            if (($this->getAttribute($context["m"], "video", array()) != "")) {
                // line 93
                echo "          <iframe style=\"width: 420px; max-width: 100%; height: 280px; margin-top: 25px;\" class=\"yt-player\" src=\"https://www.youtube.com/embed/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "video", array()), "html", null, true);
                echo "?controls=1&rel=0&enablejsapi=1\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>
          ";
            }
            // line 95
            echo "          <div class=\"materialall\">";
            echo $this->getAttribute($context["m"], "text", array());
            echo "</div>
        </div>
      </div>
  </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "  ";
        if ($this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getParam", array(0 => "paginator"), "method")) {
            // line 101
            echo "    <div class=\"row column x-pages\" style=\"margin-top: 20px; float: left;\">
      ";
            // line 102
            echo $this->getAttribute((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "getPaginator", array(), "method");
            echo "
    </div>
  ";
        }
        // line 105
        echo "  \t
";
    }

    public function getTemplateName()
    {
        return "@widget/list/mass_media.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  365 => 105,  359 => 102,  356 => 101,  353 => 100,  341 => 95,  335 => 93,  332 => 92,  329 => 91,  320 => 89,  315 => 88,  309 => 86,  307 => 85,  304 => 84,  289 => 82,  284 => 81,  272 => 79,  270 => 78,  266 => 77,  256 => 74,  246 => 73,  234 => 66,  228 => 65,  221 => 63,  215 => 62,  211 => 61,  207 => 60,  202 => 58,  192 => 53,  186 => 52,  177 => 50,  169 => 49,  164 => 47,  160 => 46,  148 => 43,  136 => 36,  130 => 35,  123 => 33,  117 => 32,  113 => 31,  109 => 30,  105 => 29,  96 => 25,  90 => 24,  81 => 22,  73 => 21,  68 => 19,  64 => 18,  60 => 16,  58 => 15,  52 => 14,  46 => 11,  39 => 8,  34 => 7,  28 => 6,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@widget/list/mass_media.twig", "/usr/www/users/alivel/velvetin/themes/shop/widgets/list/mass_media.twig");
    }
}

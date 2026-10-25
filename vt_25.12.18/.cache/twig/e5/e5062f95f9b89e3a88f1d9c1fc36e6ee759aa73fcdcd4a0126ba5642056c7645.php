<?php

/* page_contacts.twig */
class __TwigTemplate_85082dc1f91804082fca7d0ebaf3890bd581ea714d1b5ef6329071947bcd35ae extends Twig_Template
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
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "page_contacts.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<style>
@media (min-width: 1280px) {
.contacts__contact-us-title {
  padding-left: 20px !important;
  }
}
@media (min-width: 900px) {
  #form2, .contcc {
    width: 900px !important;
  }
  .contcc {
    padding: 0px !important;
  }

  .conts { width: 760px !important; margin-top: 25px !important; }
  .contacts {
    margin-bottom: 25px;
  }
  .contacts__schedule {
    display: none;
  }
  .thumbnail img {
    border-radius: 50px;
  }
  .end img {
    margin-top: 10px !important; 
    margin-bottom: 10px !important;
  }
}
.contacts_map { max-width: 100% !important; }
</style>
    <div class=\"row\">
        ";
        // line 36
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "contacts-info-list.twig", "catalog" => 513))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 37
        echo "        ";
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "contacts-route-list.twig", "catalog" => 512))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 38
        echo "      <div class=\"row column contacts\">
        <div class=\"column large-16 large-centered\">
          ";
        // line 40
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "contacts-worktime-list.twig", "catalog" => 511))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 41
        echo "          ";
        try {
            \Cetera\Application::getInstance()->getWidget("List", array("order" => "tag", "sort" => "ASC", "limit" => 0, "template" => "contacts-list.twig", "catalog" => 510))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 42
        echo "        </div>
      </div>
    </div>
    <div class=\"row column\">
        <div class=\"large-16 large-centered columns contcc\">
        ";
        // line 47
        try {
            \Cetera\Application::getInstance()->getWidget("forms", array("form" => 3))->display();
        } catch (\Exception $e) {
            echo '<div class="callout alert">'.$e->getMessage().'</div>';
        }

        // line 48
        echo "        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "page_contacts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 48,  105 => 47,  98 => 42,  90 => 41,  83 => 40,  79 => 38,  71 => 37,  64 => 36,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "page_contacts.twig", "/home/velvetin/velvetin.ru/docs/themes/shop/design/page_contacts.twig");
    }
}

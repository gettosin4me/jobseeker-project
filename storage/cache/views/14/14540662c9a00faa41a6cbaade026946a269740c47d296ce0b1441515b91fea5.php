<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* frontend/app/home.html */
class __TwigTemplate_0155a2ebb991b945f7ade3b1eaa21c3523bc21e5feb2742b3d8943c334855693 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->displayBlock('title', $context, $blocks);
        // line 2
        $this->displayBlock('head', $context, $blocks);
        // line 7
        $this->displayBlock('content', $context, $blocks);
    }

    // line 1
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Jobseeker Home";
    }

    // line 2
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "    <style type=\"text/css\">
        .important { color: #336699; }
    </style>
";
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <h1>Index</h1>
    <p class=\"important\">
        Welcome on my awesome homepage.
    </p>
";
    }

    public function getTemplateName()
    {
        return "frontend/app/home.html";
    }

    public function getDebugInfo()
    {
        return array (  70 => 8,  66 => 7,  59 => 3,  55 => 2,  48 => 1,  44 => 7,  42 => 2,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frontend/app/home.html", "/Users/tosin/dev/www/project/jobseeker/resources/views/frontend/app/home.html");
    }
}

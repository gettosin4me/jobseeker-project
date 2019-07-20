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
class __TwigTemplate_91ca24a33b0472b781f06a185b65248bc5a0c25ed7531718f96ae5a35980492b extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html>
    <head>
        <title>Jobseeker<title>
    </head>
    <body>
        <h1>Hello</h1>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "frontend/app/home.html";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frontend/app/home.html", "/Users/tosin/dev/www/project/jobseeker/resources/views/frontend/app/home.html");
    }
}

<?php

namespace App\View;

use App\View\Helper\GridHelper;
use App\View\Helper\RowHelper;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\HttpFoundation\Response;

class View
{
    private $templating;

    public function __construct()
    {
        $filesystemLoader = new FilesystemLoader(__DIR__ . '../../../views/%name%.php');
        $this->templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);

        $this->templating->addHelpers([new GridHelper, new RowHelper]);
    }

    public function render($templateName, $parameters = [])
    {
        $content = $this->templating->render($templateName, $parameters);
        return new Response($content);
    }
}
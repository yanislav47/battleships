<?php

namespace App\Controller;

use App\View\View;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    protected $view;
    protected $request;

    public function __construct(Request $request)
    {
        $this->view = new View();
        $this->request = $request;
    }
}
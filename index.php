<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$gameController = \App\Controller\GameController::class;

$app = new Bootstrap\Application();
$app->map('/', $gameController, 'index');
$app->map('/shoot', $gameController, 'shoot');
$app->map('/reset', $gameController, 'reset');

$response = $app->handle($request);
$response->send();
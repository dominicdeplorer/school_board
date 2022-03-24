<?php

use SchoolBoard\Core;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/app/Core.php';

$request = Request::createFromGlobals();
$app = new Core();
$routes = require_once __DIR__ . '/routes.php';
$response = $app->handle($request);
$response->send();
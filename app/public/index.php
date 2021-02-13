<?php

namespace public;

define('ROOT', realpath('../'));

require_once(ROOT . '/libs/Autoloader.php');

use libs\Autoloader;
use controllers;
use controllers\DefaultController;
use Exception;

$autoloader = new Autoloader(ROOT);
$autoloader->load();

$removeParamsUri = preg_replace("/\?.*/", '', $_SERVER['REQUEST_URI']);
$parseUri = explode('/', $removeParamsUri);
$peices = array_values(array_filter($parseUri, function($x) { if ($x !== '') return $x; }));

if (empty($peices)) {
    $controller = new DefaultController();
    $controller->defaultView();
    exit;
}

$controllerName = sprintf("\controllers\%sController", ucfirst($peices[0]));
$controller = new $controllerName();

if (!isset($peices[1])) {
    $action = 'default';
} else {
    $action = $peices[1];
}

if (!method_exists($controller, $action)) {
    require_once('../views/404.html');
    exit;
}

$controller->$action();
<?php

function call($action, $controller) {

    $objController = new $controller;

    $objController->{ $action }();
}

$controllers = glob("Controllers/*.php");
foreach ($controllers as &$controllerTempo){
    $controllerTempo = substr(substr($controllerTempo, 0, -4),12);
}
unset($controllerTempo);

$controller .= 'Controller';
if (in_array($controller, $controllers)) {
    require_once('Controllers/' . $controller .'.php');
    if (in_array($action, get_class_methods($controller))) {
        call($action, $controller);
    } else {
        call('erreur', 'autresController');
    }
} else {
    call( 'erreur', 'autresController');
}
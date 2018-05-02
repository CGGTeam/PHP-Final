<?php

function call($action, $controller) {

    $objController = new $controller;
    var_dump($objController->{$action}());
    $objController->{ $action }()->afficher();
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
        require_once('Controllers/autresController.php');
        call('erreur', 'autresController');
    }
} else {
    require_once('Controllers/autresController.php');
    call( 'erreur', 'autresController');
}
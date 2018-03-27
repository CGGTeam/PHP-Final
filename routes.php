<?php

function call($controller, $action, $class) {

    require_once('Controllers/' . $controller . 'Controller.php');

    $objController = new $class;

    $objController->{ $action }();
}

$controllers = glob("Controllers/*.php");
foreach ($controllers as $controllerTempo){
    $controllerTempo = substr($controllerTempo, 0, -4);
}

if (array_key_exists($controller, $controllers)) {
    $class = $controller . 'Controller';
    if (in_array($action, get_class_methods($class))) {
        call($controller, $action, $class);
    } else {
        call('autresPages', 'erreur', 'AutresController');
    }
} else {
    call('autresPages', 'erreur', 'AutresController');
}
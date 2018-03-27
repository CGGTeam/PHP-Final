<?php

include_once "sqlConnection.php";

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'CompteControllers';
    $action     = 'login';
}

include_once "Views/header.php";
include_once "routes.php";
include_once "Views/footer.php";
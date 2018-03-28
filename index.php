<?php

require_once "sqlConnection.php";

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'CompteControllers';
    $action     = 'login';
}

require_once "Views/header.php";
require_once "routes.php";
require_once "Views/footer.php";
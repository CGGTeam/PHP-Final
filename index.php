<?php
    require_once "Utilitaires/classe-mysql-2018-03-18.php";
    require_once "sqlConnection.php";
    require_once "Utilitaires/View.php";
    require_once "Utilitaires/ModelBinding.php";


if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'Login';
    $action = 'Login';
}

require_once "Views/header.php";
require_once "routes.php";
require_once "Views/footer.php";
?>
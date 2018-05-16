<?php
    ob_start();
    
    require_once "Utilitaires/ModelBinding.php";
    require_once "Models/Donnees/Utilisateur.php";
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION["utilisateurCourant"])) {
        $strFichier = $_SESSION["utilisateurCourant"]->statutAdmin ? "module-admin.php" : "gestion-documents.php";
        $strController = isset($_GET["controller"]) ? "?controller=" . $_GET["controller"] : "";
        $strAction = isset($_GET["action"]) ? "action=" . $_GET["action"] : "";
        if (!$strController || $strController == "") {
            $strAction = "?$strAction";
        } else {
            $strAction = "&$strAction";
        }
        $strParamsGet = $_SERVER['QUERY_STRING'];
        if (!(empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['REQUEST_URI'], "?") === false))
            $strParamsGet = "?" . $_SERVER['QUERY_STRING'];
        
        if (!$_SESSION["utilisateurCourant"]->statutAdmin) {
            header("Location: $strFichier$strParamsGet");
            http_response_code(302);
            die();
        }
    }
    
    require_once "Utilitaires/libraries-communes-2018-03-28.php";
    require_once "Utilitaires/classe-mysql-2018-03-18.php";
    require_once "sqlConnection.php";
    require_once "Utilitaires/View.php";
    require_once "Utilitaires/JSONView.php";
    require_once "Utilitaires/ModelBinding.php";
    require_once "Models/Donnees/Utilisateur.php";
    require_once "Utilitaires/ModelState.php";
    require_once "Controllers/ModuleUtilisateurBase.php";
    require_once "Controllers/ModuleAdminBase.php";
    require_once "Utilitaires/ValidationPr3.php";
    require_once "Utilitaires/Utilitaires-ProjetFinal.php";
    require_once "Models/EditReferences/CoursSessionIJModel.php";
    require_once "Models/Donnees/Document.php";
    
    $objBD = mysql::getBD();
    $objBD->selectionneRow("Document");
    $tDocs = ModelBinding::bindToClass($objBD->OK, "Document");
    
    const UPLOAD_DIR = "./televersements";
    $objBD = mysql::getBD();
    
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    } else {
        $controller = 'Login';
        $action = 'Login';
    }
    
    require_once "routes.php";
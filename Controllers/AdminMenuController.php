<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:33 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    
    class AdminMenuController extends ModuleAdminBase
    {
        function __construct()
        {
            //init
            session_start();
            parent::__construct();
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelBinding.php";
            require_once "Utilitaires/View.php";
        }
    
        function AdminMenu()
        {
            $GLOBALS["titrePage"] = "Menu Admin";
            return new View($_SESSION["utilisateurCourant"]);
        }
    
        function EditDocuments() {
            header('Location: ?controller=EditDocuments&action=SelectionSession');
            return new View("", 301);
        }
    
        function EditArborescence() {
            header('Location: ?controller=EditArborescence&action=EditArborescence');
            return new View("", 301);
        }
    
        function EditGroupes() {
            header('Location: ?controller=EditGroupes&action=EditGroupes');
            return new View("", 301);
        }
    
        function EditPrivileges() {
            header('Location: ?controller=EditPrivileges&action=EditPrivileges');
            return new View("", 301);
        }
    
        function EditReferences() {
            header('Location: ?controller=EditReferences&action=EditReferences');
            return new View("", 301);
        }
    
        function Quitter() {
            session_abort();
            header('Location: ?controller=Login&action=Login');
            return new View("", 301);
        }
    }
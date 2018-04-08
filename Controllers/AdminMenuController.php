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
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelBinding.php";
            require_once "Utilitaires/View.php";
        }
    
        function AdminMenu()
        {
            if ($_SESSION["utilisateurCourant"] && $_SESSION["utilisateurCourant"]->statutAdmin) {
                return new View();
            } else {
                return new View("401: Not Authorized", 401);
            }
        }
    
        function EditDocuments() {
            return new View(null, "Views/EditDocuments/EditDocumentsView.php");
        }
    
        function EditArborescence() {
            return new View(null, "Views/EditArborescence/EditArborescenceView.php");
        }
    
        function EditGroupes() {
            return new View(null, "Views/EditGroupes/EditGroupesView.php");
        }
    
        function EditPrivileges() {
            return new View(null, "Views/EditPrivileges/EditPrivilegesView.php");
        }
    
        function EditReferences() {
            return new View(null, "Views/EditReferences/EditReferencesView.php");
        }
    
        function Quitter()
        {
            Utilisateur::$utilisateurCourant = null;
            return new View(EnumEtatsLogin::AUCUN_POST, "Views/Login/LoginView.php");
        }
    }
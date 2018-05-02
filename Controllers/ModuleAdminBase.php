<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 3:44 PM
     */
    
    abstract class ModuleAdminBase {

        function __construct() {
            require_once "Models/EditReferences/EnumEtatsReferences.php";
            require_once "Models/EditReferences/ReferencesModel.php";
            require_once "Utilitaires/ModelBinding.php";
            require_once "Utilitaires/View.php";
            require_once "Models/Donnees/Categorie.php";
            require_once "Models/Donnees/Cours.php";
            require_once "Models/Donnees/CoursSession.php";
            require_once "Models/Donnees/Document.php";
            require_once "Models/Donnees/Session.php";
            require_once "Models/Donnees/Utilisateur.php";

            if (!isset($_SESSION)) {
                session_start();
            }
            global $authorized;
            $authorized = $_SESSION["utilisateurCourant"] && $_SESSION["utilisateurCourant"]->statutAdmin;
        }
    }
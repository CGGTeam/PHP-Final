<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:33 AM
     */
    
    class AdminMenuController
    {
        function __construct()
        {
            //init
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelBinding.php";
        }
    
        function adminMenu()
        {
            echo "adminMenu";
            if ($_SESSION["utilisateurCourant"] && $_SESSION["utilisateurCourant"]->statutAdmin) {
                return new View();
            } else {
                return new View("403: Not Authorized", 403);
            }
        }
        
        function quitter()
        {
            Utilisateur::$utilisateurCourant = null;
            return new View(EnumEtatsLogin::AUCUN_POST, "Views/Login/LoginView.php");
        }
    }
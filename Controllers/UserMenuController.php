<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-06
     * Time: 12:56 PM
     */
    
    require_once "Controllers/ModuleUtilisateurBase.php";
    
    class UserMenuController extends ModuleUtilisateurBase
    {
        function __construct()
        {
            parent::__construct();
            require_once "Models/Donnees/Utilisateur.php";
        }
        
        function ChoixCours()
        {
            $GLOBALS["titrePage"] = "Choix d'un cours";
            return new View();
        }
        
        function AfficherCours() {
            $GLOBALS["titrePage"] = "Affichage des cours";
            return new View();
        }
    }
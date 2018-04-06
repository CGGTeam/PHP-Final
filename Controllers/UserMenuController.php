<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-06
     * Time: 12:56 PM
     */
    
    class UserMenuController
    {
        function __construct()
        {
            //init
            require_once "Models/Donnees/Utilisateur.php";
        }
        
        function userMenu()
        {
            if (Utilisateur::$utilisateurCourant) {
                return new View();
            } else {
                return new View("403: Not Authorized", 403);
            }
        }
    }
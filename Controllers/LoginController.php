<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-03
     * Time: 3:29 PM
     */
    
    class LoginController
    {
        function __construct()
        {
            //init
        }
    
        function Login()
        {
            $strNomUtil = post("tbNomUtilisateur");
            $strMotPasse = post("tbMotDePasse");
            $objView = new View(null, "Views/Login/LoginView.php");
    
            if ($strNomUtil && $strMotPasse) {
                $strConditions = "NomUtilisateur = " . $strNomUtil;
                $strConditions .= "MotDePasse = " . $strMotPasse;
                /** @var mysql $BD */
                global $BD;
                $objRetour = $BD->selectionneRow("Utilisateurs",
                    "NomUtilisateur, MotDePasse, StatutAdmin, NomComplet", $strConditions);
                if ($objRetour) {
                    $objUtilisateur = null;
                    $binAdmin = true;
                    if ($binAdmin) {
                        $objView = new View($objUtilisateur, "../Views/AdminMenu/AdminMenuView.php");
                    } else {
                        $objView = new View($objUtilisateur, "../Views/UserMenu/UserMenuView.php");
                    }
                }
            }
        
            return $objView;
        }
    }
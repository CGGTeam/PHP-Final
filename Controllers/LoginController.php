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
        
        function login()
        {
            $strNomUtil = post("tbNomUtilisateur");
            $strMotPasse = post("tbMotDePasse");
            if ($strNomUtil && $strMotPasse) {
                /** @var mysql $BD */
                global $BD;
                $strConditions = "NomUtilisateur = " . $strNomUtil;
                $strConditions .= "MotDePasse = " . $strMotPasse;
                $objRetour = $BD->selectionneRow("Utilisateurs",
                    "NomUtilisateur, MotDePasse, StatutAdmin, NomComplet", $strConditions);
                if ($objRetour) {
                    $binAdmin = true;
                    //TODO: request
                    if ($binAdmin) {
                        require_once $_SERVER["DOCUMENT_ROOT"] . "/Views/AdminMenu/AdminMenuView.php";
                    } else {
                        require_once $_SERVER["DOCUMENT_ROOT"] . "/Views/UserMenu/UserMenuView.php";
                    }
                }
            }
        }
    }
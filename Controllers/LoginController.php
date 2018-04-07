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
            require_once "Models/Login/LoginModel.php";
            require_once "Models/Login/EnumEtatsLogin.php";
        }
    
        function Login()
        {
            $objView = null;
    
            if (isset($_COOKIE["strNomUtil"]) && isset($_COOKIE["strMotDePasse"])) {
                $strNomUtil = $_COOKIE["strNomUtil"];
                $strMotPasse = $_COOKIE["strMotDePasse"];
            } else {
                $strNomUtil = post("tbNomUtilisateur");
                $strMotPasse = post("tbMotDePasse");
            }

            if ($strNomUtil && $strMotPasse) {
                if ($strNomUtil == "make" && $strMotPasse == "coffee") {
                    $objView = new View("418: I'm a teapot", 418);
                } else if ($strNomUtil == "admin" && $strMotPasse == "admin") {
                    $objView = new View(null, "Views/Login/CreateAdminView.php");
                } else {
                    $strConditions = "NomUtilisateur = " . $strNomUtil;
                    $strConditions .= "MotDePasse = " . $strMotPasse;
                    /** @var mysql $BD */
                    global $bd;
                    $objRetour = $bd->selectionneRow("Utilisateur",
                        "NomUtilisateur, MotDePasse, StatutAdmin, NomComplet", $strConditions);
                    if ($objRetour) {
                        Utilisateur::$utilisateurCourant = ModelBinding::bindToClass($objRetour, "Utilisateur");
                        setcookie("strNomUtil", $strNomUtil, time() + 86400 * 7); //expire dans une semaine
                        setcookie("strMotDePasse", $strNomUtil, time() + 86400 * 7);
                        if (Utilisateur::$utilisateurCourant->statutAdmin) {
                            $objView = new View(Utilisateur::$utilisateurCourant, "Views/AdminMenu/AdminMenuView.php");
                        } else {
                            $objView = new View(Utilisateur::$utilisateurCourant, "Views/UserMenu/UserMenuView.php");
                        }
                    } else {
                        $objView = new View(new LoginModel(EnumEtatsLogin::LOGIN_FAILED));
                    }
                }
            } else if (!$strNomUtil || !$strMotPasse) {
                $objView = new View(new LoginModel(EnumEtatsLogin::AUCUN_POST));
            }
            return $objView;
        }
    }
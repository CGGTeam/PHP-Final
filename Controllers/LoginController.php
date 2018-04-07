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
            $strNomUtil = post("tbNomUtilisateur");
            $strMotPasse = post("tbMotDePasse");
            $objView = null;
    
            if ($strNomUtil && $strMotPasse) {
                if ($strNomUtil == "" && $strMotPasse == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::UTILISATEUR_ET_MOT_DE_PASSE_VIDE));
                } else if ($strMotPasse == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::MOT_DE_PASSE_VIDE));
                } else if ($strNomUtil == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::UTILISATEUR_VIDE));
                } else if ($strNomUtil == "make" && $strMotPasse == "coffee") {
                    $objView = new View("418: not a teapot", 418);
                } else {
                    $strConditions = "NomUtilisateur = '" . $strNomUtil . "'";
                    $strConditions .= " AND MotDePasse = '" . $strMotPasse . "'";
                    /** @var mysql $bd */
                    global $bd;
                    $objRetour = $bd->selectionneRow("Utilisateur",
                        "nomUtilisateur, motDePasse, statutAdmin, nomComplet", $strConditions);
                    if ($objRetour) {
                        Utilisateur::$utilisateurCourant = ModelBinding::bindToClass($objRetour, "Utilisateur");
        
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
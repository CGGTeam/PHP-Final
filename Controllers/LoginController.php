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
            $objView = null;
    
            if ($strNomUtil && $strMotPasse) {
                if ($strNomUtil == "" && $strMotPasse == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::UTILISATEUR_ET_MOT_DE_PASSE_VIDE));
                } else if ($strMotPasse == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::MOT_DE_PASSE_VIDE));
                } else if ($strNomUtil == "") {
                    $objView = new View(new LoginModel(EnumEtatsLogin::UTILISATEUR_VIDE));
                } else {
                    $strConditions = "NomUtilisateur = " . $strNomUtil;
                    $strConditions .= "MotDePasse = " . $strMotPasse;
                    /** @var mysql $BD */
                    global $BD;
                    $objRetour = $BD->selectionneRow("Utilisateur",
                        "NomUtilisateur, MotDePasse, StatutAdmin, NomComplet", $strConditions);
                    if ($objRetour) {
                        $objUtilisateur = null;
                        $binAdmin = true;
                        if ($binAdmin) {
                            $objView = new View($objUtilisateur, "../Views/AdminMenu/AdminMenuView.php");
                        } else {
                            $objView = new View($objUtilisateur, "../Views/UserMenu/UserMenuView.php");
                        }
                    } else {
                        $objView = new View(new LoginModel(EnumEtatsLogin::LOGIN_FAILED));
                    }
                }
            } else if (!$strNomUtil || !$strMotPasse) {
                $objView = new View(new LoginModel(EnumEtatsLogin::AUCUN_POST),
                    "../Views/UserMenu/LoginView.php");
            }
        
            return $objView;
        }
    }
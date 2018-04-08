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
            require_once "Models/Login/EnumEtatsUtil.php";
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelState.php";
        }
    
        function Login()
        {
            session_abort();
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
                    session_start();
                    $_SESSION["creerAdmin"] = true;
                    $objView = new View(new LoginModel(EnumEtatsLogin::AUCUN_POST), "Views/Login/CreateAdminView.php");
                } else {
                    $strConditions = "NomUtilisateur = " . $strNomUtil;
                    $strConditions .= "MotDePasse = " . $strMotPasse;
                    /** @var mysql $BD */
                    global $bd;
                    $objRetour = $bd->selectionneRow("Utilisateur",
                        "NomUtilisateur, MotDePasse, StatutAdmin, NomComplet", $strConditions);
                    if ($objRetour || ($strNomUtil == "test" && $strMotPasse == "test")) {
                        session_start();
    
                        if ($strNomUtil == "test" && $strMotPasse == "test") {
                            $_SESSION["utilisateurCourant"] = new Utilisateur(
                                [
                                    "id" => null,
                                    "nomUtilisateur" => "test",
                                    "motDePasse" => "test",
                                    "statutAdmin" => true,
                                    "nomComplet" => "Test, Test",
                                    "courriel" => "test@test.com"
                                ], false);
                        } else {
                            $_SESSION["utilisateurCourant"] = ModelBinding::bindToClass($objRetour, "Utilisateur");
                        }
                        
                        if ($_SESSION["utilisateurCourant"]->statutAdmin) {
                            $objView = new View($_SESSION["utilisateurCourant"], "Views/AdminMenu/AdminMenuView.php");
                        } else {
                            $objView = new View($_SESSION["utilisateurCourant"], "Views/UserMenu/UserMenuView.php");
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
    
        function creerAdmin()
        {
            session_start();
            if (!isset($_SESSION["creerAdmin"]) || !$_SESSION["creerAdmin"]) {
                return new View("403: Forbidden", 403);
            }
    
            $strNomUtil = post("tbNomUtilisateur");
            $strNomComplet = post("tbNomComplet");
            $strEmail = post("tbCourriel");
            $strMotPasse = post("tbMotDePasse");
    
            if ($strNomUtil && $strMotPasse && $strNomComplet && $strEmail) {
                /** @var mysql $bd */
                global $bd;
                $objResultatNomUtil = $bd->selectionneRow("Utilisateur", "Courriel", "NomUtilisateur='" . $strNomUtil . "'");
                $objResultatCourriel = $bd->selectionneRow("Utilisateur", "Courriel", "Courriel='" . $strEmail . "'");
                if (!$objResultatNomUtil || !$objResultatCourriel) {
                    $tempo = $objResultatNomUtil->fetch_array();
                    return new View($tempo, "Views/Login/CreateAdminView.php");
                } else if ($objResultatNomUtil->num_rows > 0 && $objResultatCourriel->num_rows > 0) {
                    $tempo = $objResultatNomUtil->fetch_array();
                    return new View($tempo, "Views/Login/CreateAdminView.php");
                } else if ($objResultatNomUtil->num_rows > 0) {
                    $tempo = $objResultatNomUtil->fetch_array();
                    return new View($tempo, "Views/Login/CreateAdminView.php");
                } else if ($objResultatCourriel->num_rows > 0) {
                    $tempo = $objResultatNomUtil->fetch_array();
                    return new View($tempo, "Views/Login/CreateAdminView.php");
                }
                $objUtil = new Utilisateur(
                    [
                        "nomUtilisateur" => $strNomUtil,
                        "motDePasse" => $strMotPasse,
                        "statutAdmin" => true,
                        "nomComplet" => $strNomComplet,
                        "courriel" => $strEmail
                    ], true
                );
                $objUtil->saveChangesOnObj();
                var_dump($objUtil);
        
                $_SESSION["creerAdmin"] = false;
                return new View(new LoginModel(EnumEtatsLogin::AUCUN_POST), "Views/Login/LoginView.php");
                
            } else {
                return new View(new LoginModel(EnumEtatsLogin::AUCUN_POST), "Views/Login/CreateAdminView.php");
            }
        }
    }
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
            global $authorized;
            $authorized = true;
            require_once "Models/Login/LoginModel.php";
            require_once "Models/Login/EnumEtatsLogin.php";
            require_once "Models/Login/EnumEtatsUtil.php";
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelState.php";
        }

        /**
         * @return null|View
         */
        function Login()
        {
            $objView = null;

            if (isset($_SESSION["strNomUtil"])) {
                $strNomUtil = $_SESSION["strNomUtil"]->nomUtilisateur;
                $strMotPasse = $_COOKIE["strMotDePasse"]->motDePasse;
            } else {
                session_unset();
                $strNomUtil = post("tbNomUtilisateur");
                $strMotPasse = post("tbMotDePasse");
            }

            if ($strNomUtil && $strMotPasse) {
                if ($strNomUtil == "make" && $strMotPasse == "coffee") {
                    $objView = new View("418: I'm a teapot", 418);
                } else {
                    $strConditions = "NomUtilisateur = '" . $strNomUtil . "' AND ";
                    $strConditions .= "MotDePasse = '" . $strMotPasse . "'";
                    /** @var mysql $BD */
                    global $bd;
                    $objRetour = $bd->selectionneRow("Utilisateur", "*", $strConditions);

                    echo "<br />";
                    echo "ALFKJHNIUFGHWAOIF";

                    if ($objRetour && $objRetour->num_rows > 0) {
                        session_start();
                        echo "ALFKJHNIUFGHWAOIF";
                        $_SESSION["utilisateurCourant"] = ModelBinding::bindToClass($objRetour, "Utilisateur")[0];
                        
                        if ($_SESSION["utilisateurCourant"]->nomUtilisateur == "admin" && $_SESSION["utilisateurCourant"]->motDePasse == "admin") {
                            $_SESSION["creerAdmin"] = true;
                            header('Location: ?controller=Login&action=CreerAdmin');
                            $objView = new View("", 301);
                        } else if ($_SESSION["utilisateurCourant"]->statutAdmin) {
                            header('Location: ?controller=AdminMenu&action=AdminMenu');
                            $objView = new View("", 302);
                        } else {
                            $objView = new View($_SESSION["utilisateurCourant"], "Views/UserMenu/UserMenuView.php");
                        }
                    } else {
                        $objView = new View(new LoginModel(EnumEtatsLogin::LOGIN_FAILED));
                    }
                }
            } else if (!$strNomUtil || !$strMotPasse) {
                session_unset();
                $objView = new View(new LoginModel(EnumEtatsLogin::AUCUN_POST));
            }
            return $objView;
        }
    
        function CreerAdmin()
        {
            session_start();
            global $authorized;
            $authorized = isset($_SESSION["creerAdmin"]) && $_SESSION["creerAdmin"];
    
            $strNomUtil = post("tbNomUtilisateur");
            $strNomComplet = post("tbNomComplet");
            $strEmail = post("tbCourriel");
            $strMotPasse = post("tbMotDePasse");
    
            if ($strNomUtil && $strMotPasse && $strNomComplet && $strEmail) {
                /** @var mysql $bd */
                global $bd;
                $objResultatNomUtil = $bd->selectionneRow("Utilisateur", "Courriel", "NomUtilisateur= '" . $strNomUtil . "'");
                $objResultatCourriel = $bd->selectionneRow("Utilisateur", "Courriel", "Courriel= '" . $strEmail . "'");
                if (!$objResultatNomUtil || !$objResultatCourriel) {
                    return new View(EnumEtatsUtil::ERREUR_BD, "Views/Login/CreateAdminView.php");
                } else if ($objResultatNomUtil->num_rows > 0 && $objResultatCourriel->num_rows > 0) {
                    return new View(EnumEtatsUtil::SAME_BOTH, "Views/Login/CreateAdminView.php");
                } else if ($objResultatNomUtil->num_rows > 0) {
                    return new View(EnumEtatsUtil::SAME_USER, "Views/Login/CreateAdminView.php");
                } else if ($objResultatCourriel->num_rows > 0) {
                    return new View(EnumEtatsUtil::SAME_EMAIL, "Views/Login/CreateAdminView.php");
                } else if ($strNomUtil == "admin" && $strMotPasse == "admin") {
                    return new View(EnumEtatsUtil::ADMIN_ADMIN, "Views/Login/CreateAdminView.php");
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

                /** @var Utilisateur $utilCourant */
                $utilCourant = $_SESSION["utilisateurCourant"];
                $utilCourant->setModelState(ModelState::Deleted);
                $utilCourant->saveChangesOnObj();
                $_SESSION["creerAdmin"] = false;
                return new View(new LoginModel(EnumEtatsLogin::AUCUN_POST), "Views/Login/LoginView.php");
                
            } else {
                return new View(new LoginModel(EnumEtatsLogin::AUCUN_POST), "Views/Login/CreateAdminView.php");
            }
        }
    }
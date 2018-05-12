<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-03
     * Time: 3:29 PM
     */
    
    class LoginController {
        function __construct() {
            //init
            global $authorized;
            $authorized = true;
            require_once "Models/Login/LoginModel.php";
            require_once "Models/Login/EnumEtatsLogin.php";
            require_once "Models/Login/EnumEtatsUtil.php";
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelState.php";
        }
    
        function Logout() {
            session_unset();
            header('Location: ?controller=Login&action=Logout');
            return new View("", 302);
        }
        
        /**
         * @return null|View
         */
        function Login() {
            session_start();
            global $authorized;
            $authorized = true;
            $GLOBALS["titrePage"] = "Connexion";
            $objView = null;
            if (isset($_SESSION["utilisateurCourant"])) {
                $strNomUtil = $_SESSION["utilisateurCourant"]->nomUtilisateur;
                $strMotPasse = $_SESSION["utilisateurCourant"]->motDePasse;
            } else {
                $strNomUtil = post("tbNomUtilisateur");
                $strMotPasse = post("tbMotDePasse");
            }
    
            if (isset($_SESSION["creerAdmin"])) {
                $_SESSION["creerAdmin"] = false;
            }
            
            if ($strNomUtil && $strMotPasse) {
                if ($strNomUtil == "make" && $strMotPasse == "coffee") {
                    $objView = new View("418: I'm a teapot", 418);
                } else {
                    if (!validerNomUtilisateur($strNomUtil) || !validerMotPasse($strMotPasse)
                        && (strtolower($strNomUtil) != "admin" && strtolower($strMotPasse) != "admin")) {
                        return new View(EnumEtatsLogin::LOGIN_FAILED);
                    }
                    $strConditions = "NomUtilisateur = '" . $strNomUtil . "' AND ";
                    $strConditions .= "MotDePasse = '" . $strMotPasse . "'";
                    $objRetour = mysql::getBD()->selectionneRow("Utilisateur", "*", $strConditions);
    
                    if ($objRetour && $objRetour->num_rows) {
                        session_start();
                        $_SESSION["utilisateurCourant"] = ModelBinding::bindToClass($objRetour, "Utilisateur")[0];
                        if ($_SESSION["utilisateurCourant"]->nomUtilisateur == "admin" && $_SESSION["utilisateurCourant"]->motDePasse == "admin") {
                            $_SESSION["creerAdmin"] = true;
                            header('Location: ?controller=Login&action=CreerAdmin');
                            $objView = new View("", 301);
                        } else if ($_SESSION["utilisateurCourant"]->statutAdmin) {
                            header('Location: ?controller=AdminMenu&action=AdminMenu');
                            $objView = new View("", 302);
                        } else {
                            header('Location: ?controller=UserMenu&action=ChoixCours');
                            $objView = new View("", 302);
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
        
        function CreerAdmin() {
            $GLOBALS["titrePage"] = "Première connexion";
    
            session_start();
            global $authorized;
            $authorized = isset($_SESSION["creerAdmin"]) && $_SESSION["creerAdmin"];
    
            $strNomUtil = post("tbNomUtilisateur");
            $strNomComplet = post("tbNomComplet");
            $strEmail = post("tbCourriel");
            $strMotPasse = post("tbMotDePasse");
    
            if ($strNomUtil && $strMotPasse && $strNomComplet && $strEmail) {
                if (!validerNomComplet($strNomComplet) || !validerNomUtilisateur($strNomUtil) ||
                    !validerAdresseCourriel($strEmail) || !validerMotPasse($strMotPasse)) {
                    return new View(new LoginModel(EnumEtatsUtil::INVALID));
                }
                
                $objResultatNomUtil = mysql::getBD()->selectionneRow("Utilisateur", "Courriel", "NomUtilisateur= '" . $strNomUtil . "'");
                $objResultatCourriel = mysql::getBD()->selectionneRow("Utilisateur", "Courriel", "Courriel= '" . $strEmail . "'");
    
                if (!$objResultatNomUtil || !$objResultatCourriel) {
                    return new View(new LoginModel(EnumEtatsUtil::ERREUR_BD));
                } else if ($strNomUtil == "admin" && $strMotPasse == "admin") {
                    return new View(new LoginModel(EnumEtatsUtil::ADMIN_ADMIN));
                } else if ($objResultatNomUtil->num_rows > 0 && $objResultatCourriel->num_rows > 0) {
                    return new View(new LoginModel(EnumEtatsUtil::SAME_BOTH));
                } else if ($objResultatNomUtil->num_rows > 0) {
                    return new View(new LoginModel(EnumEtatsUtil::SAME_USER));
                } else if ($objResultatCourriel->num_rows > 0) {
                    return new View(new LoginModel(EnumEtatsUtil::SAME_EMAIL));
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
                /** @var Utilisateur $utilCourant */
                $utilCourant = $_SESSION["utilisateurCourant"];
                $utilCourant->setModelState(ModelState::Deleted);
                $utilCourant->saveChangesOnObj();

                $objUtil->setModelState(ModelState::Added);
                $objUtil->saveChangesOnObj();

                $_SESSION["creerAdmin"] = false;
    
                session_destroy();
                header('Location: ?controller=Login&action=Login');
                return new View("", 302);
            } else {
                return new View(new LoginModel(EnumEtatsLogin::AUCUN_POST));
            }
        }
    
        function Deconnexion() {
            global $authorized;
            $authorized = true;
            session_start();
            session_destroy();
            header('Location: ?controller=Login&action=Login');
            return new View("", 302);
        }
    }
<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-06
     * Time: 12:56 PM
     */
    
    require_once "Controllers/ModuleUtilisateurBase.php";
    
    class UserMenuController extends ModuleUtilisateurBase {
        function __construct() {
            parent::__construct();
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Models/Donnees/CoursSession.php";
            require_once "Models/Donnees/Document.php";
        }
        
        function ChoixCours() {
            $GLOBALS["titrePage"] = "Choix d'un cours";
            $utilId = $_SESSION["utilisateurCourant"]->id;
            $objBD = MYSQL::getBD();
            $objBD->selectionneRow("CoursSession", "*", "utilisateur='$utilId'");
            if ($objBD->OK) {
                $tCoursSession = ModelBinding::bindToClass($objBD->OK, "CoursSession");
                return new View($tCoursSession);
            }
            return new View("", 500);
        }
        
        function AfficherCours() {
            $GLOBALS["titrePage"] = "Affichage des cours";
            $objBD = MYSQL::getBD();
            $session = explode("_", post("coursChoisi"))[0];
            $cours = explode("_", post("coursChoisi"))[1];
            $strConditions = "session='$session' AND sigle='$cours' AND utilisateur='"  . $_SESSION["utilisateurCourant"]->id . "'";
            $objRetour = $objBD->selectionneRow("CoursSession", "*", $strConditions);
            if($objRetour && $objRetour->num_rows ){
                $objBD->selectionneRow("Document", "*", "session='$session' AND sigle='$cours'");
                if ($objBD->OK) {
                    $tDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
                    return new View($tDocuments);
                }
            }
            return new View("", 500);
        }
    }
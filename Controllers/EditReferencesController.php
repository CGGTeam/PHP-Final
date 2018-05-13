<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditReferencesController extends ModuleAdminBase {
        
        function EditReferences() {
            $GLOBALS["titrePage"] = "Modification des tables de référence";
            return new View();
        }
        
        function Afficher() {
            $strType = post("btnType");
            $GLOBALS["titrePage"] = "Affichage des " . mb_strtolower($strType) . "s";
    
            if (!$strType) {
                return new View();
            }

            $objRetour = mysql::getBD()->selectionneRow($strType);
            $tDonnees = ModelBinding::bindToClass($objRetour, $strType);

            return new View(new ReferencesModel($tDonnees, $strType, EnumEtatsReferences::EDIT));
        }

        function EditListeSessions(){
            $tDonnees = [];
            $objRetour = mysql::getBD()->selectionneRow("Session");
            if($objRetour)
                $tDonnees = ModelBinding::bindToClass($objRetour, "Session");

            return new View($tDonnees);
        }

        function EditListeUtilisateurs(){
            $tDonnees = [];
            $objRetour = mysql::getBD()->selectionneRow("Utilisateur");
            if($objRetour)
                $tDonnees = ModelBinding::bindToClass($objRetour, "Utilisateur");

            return new View($tDonnees);
        }

        function EditListeCours(){
            $tDonnees = [];
            $objRetour = mysql::getBD()->selectionneRow("Cours");
            if($objRetour)
                $tDonnees = ModelBinding::bindToClass($objRetour, "Cours");

            return new View($tDonnees);
        }

        function EditListeCategories(){
            $tDonnees = [];
            $objRetour = mysql::getBD()->selectionneRow("Categorie");
            if($objRetour)
                $tDonnees = ModelBinding::bindToClass($objRetour, "Categorie");

            return new View($tDonnees);
        }

        function EditListeCoursSessions(){
            $tDonnees = [];
            $tAdmin = [];
            $objRetour = mysql::getBD()->selectionneRowIJ("CoursSession", "id, nomComplet, nomUtilisateur, session, sigle, statutAdmin",
                "Utilisateur", "courssession.utilisateur = utilisateur.id", "statutAdmin = 1" );
            if($objRetour)
                $tDonnees = ModelBinding::bindToClass($objRetour, "CoursSessionIJModel");
            $objRetour = mysql::getBD()->selectionneRow("Utilisateur", "*", "statutAdmin = 1");
            if($objRetour)
                $tAdmin = ModelBinding::bindToClass($objRetour, "Utilisateur");

            return new View((object) [
                'tAdmin' => $tAdmin,
                'tDonnees' => $tDonnees
            ]);
        }
    }
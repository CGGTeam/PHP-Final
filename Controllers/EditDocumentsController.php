<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    require_once("Models/EditDocuments/SelectionDocumentModel.php");
    require_once("Models/EditDocuments/EnumEtatsDocuments.php");
    require_once("Models/EditDocuments/DocumentsCoursSession.php");
    
    
    class EditDocumentsController extends ModuleAdminBase {
        function __construct() {
            parent::__construct();
        }
        
        function EditDocuments() {
            $session =  post("session");
            $cours =  post("cours");
            $GLOBALS["titrePage"] = "Modification des documents du cours " . $cours . " " . $session;
            $model = null;
    
            if ($session && $cours) {
                $objBD = Mysql::getBD();
                $objBD->selectionneRow("Document", "*", "session='" . $session . "' AND sigle='" . $cours . "' AND supprimer = 0");
                if ($objBD->OK) {
                    $tListeDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
                    $objBD->selectionneRow("Categorie");
                    $tListeCategories = ModelBinding::bindToClass($objBD->OK, "Categorie");
                    $objBD->selectionneRow("Session");
                    $tListeSessions = ModelBinding::bindToClass($objBD->OK, "Session");
                    $objBD->selectionneRow("Cours");
                    $tListeCours = ModelBinding::bindToClass($objBD->OK, "Cours");
                    $model = new DocumentsCoursSession($tListeDocuments, $tListeCategories, $tListeSessions, $tListeCours, EnumEtatsDocuments::SUCCES, sizeof($tListeDocuments));
                } else
                   return new View ("500: Erreur Fatale", 500);
            }

            return new View($model);

        }
        
        function SelectionSession() {
            $GLOBALS["titrePage"] = "Sélection d'un cours-session";
            $objBD = MYSQL::getBD();
            $objBD->selectionneRow("CoursSession");
            if ($objBD->OK) {
                $tCoursSession = ModelBinding::bindToClass($objBD->OK, "CoursSession");
                $tListeDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
                $objBD->selectionneRow("Categorie");
                $tListeCategories = ModelBinding::bindToClass($objBD->OK, "Categorie");
                $objBD->selectionneRow("Session");
                $tListeSessions = ModelBinding::bindToClass($objBD->OK, "Session");
                $objBD->selectionneRow("Cours");
                $tListeCours = ModelBinding::bindToClass($objBD->OK, "Cours");
            }
            else
                return new View("500: Erreur Fatale", 500);
    
            $objBD->selectionneRow("Document");
            if ($objBD->OK)
                $intNbDocuments = $objBD->OK->num_rows;
            else
                return new View("500: Erreur Fatale", 500);
    
            return new View(new DocumentsCoursSession($tListeDocuments, $tListeCategories, $tListeSessions, $tListeCours, EnumEtatsDocuments::SUCCES, sizeof($tListeDocuments)));
        }
    
        function SauvegardeFichier() {
            $objBD = mysql::getBD();
            $objBD->selectionneRow("document", "id");
            if ($objBD->OK) {
                //TODO: const for upload dir
                $tIds = $objBD->OK->fetch_all();
                for ($i = 0; $i < $tIds; $i++) {
                    if (isset($_FILES[$tIds[$i][0]])) {
                        enregistrerDocument($tIds[$i][0], "./televersements", null, PHP_INT_MAX,
                            ["txt", "doc", "docx", "pdf", "zip", "rtf", "odt", "tex", "wks", "wps", "wpd"]);
                        $objBD->modifieEnregistrements("document",
                            "hyperLien='" . $_FILES[$tIds[$i][0]] . "'", "id='" . $tIds[$i][0] . "'");
                    }
                }
            }
        }
    }
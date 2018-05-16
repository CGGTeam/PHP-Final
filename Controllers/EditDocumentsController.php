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
            $session = get("session");
            $cours = get("cours");
            $GLOBALS["titrePage"] = "Modification des documents du cours " . $cours . " " . $session;
            $model = null;
    
            if ($session && $cours) {
                $objBD = Mysql::getBD();
                $objBD->selectionneRow("Document", "*", "session='" . $session . "' AND sigle='" . $cours . "' AND supprimer = 0");
                if ($objBD->OK) {
                    $tListeDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
                    $objBD->requete = "SELECT max(id) FROM document";
                    $objBD->OK = mysqli_query($objBD->cBD, $objBD->requete);
                    $lastIndex = $objBD->OK->fetch_array()[0];
                    $objBD->selectionneRow("Categorie");
                    $tListeCategories = ModelBinding::bindToClass($objBD->OK, "Categorie");
                    $objBD->selectionneRow("Session");
                    $tListeSessions = ModelBinding::bindToClass($objBD->OK, "Session");
                    $objBD->selectionneRow("Cours");
                    $tListeCours = ModelBinding::bindToClass($objBD->OK, "Cours");
                    $model = new DocumentsCoursSession($tListeDocuments, $tListeCategories, $tListeSessions, $tListeCours, EnumEtatsDocuments::SUCCES, sizeof($tListeDocuments));
                    $model->lastIndex = $lastIndex+1;

                } else
                   return new View ("500: Erreur Fatale", 500);
            }

            return new View($model);

        }
        
        function SelectionSession() {
            $GLOBALS["titrePage"] = "Sélection d'un cours-session";
            $objBD = MYSQL::getBD();
            $objBD->selectionneRow("Session");
            $tListeSessions = ModelBinding::bindToClass($objBD->OK, "Session");
            $objBD->selectionneRow("Cours");
            $tListeCours = ModelBinding::bindToClass($objBD->OK, "Cours");
    
            $objBD->selectionneRow("Document");
            if ($objBD->OK)
                $intNbDocuments = $objBD->OK->num_rows;
            else
                return new View("500: Erreur Fatale", 500);

            $objBD->selectionneRowIJ("CoursSession", "utilisateur, session, sigle",
                "Utilisateur", "courssession.utilisateur = utilisateur.id", "statutAdmin = 1" );
            if ($objBD->OK)
                $intNbCoursSessions = $objBD->OK->num_rows;
            else
                return new View("500: Erreur Fatale", 500);
    
            return new View(new DocumentsCoursSession(null, null, $tListeSessions, $tListeCours, EnumEtatsDocuments::SUCCES, $intNbDocuments, $intNbCoursSessions));
        }
    
        function SauvegardeFichier() {
            $objBD = mysql::getBD();
            $objBD->selectionneRow("document", "id");
            if ($objBD->OK) {
                $tIds = $objBD->OK->fetch_all();
                for ($i = 0; $i < sizeof($tIds); $i++) {
                    if (isset($_FILES[$tIds[$i][0]])) {
                        enregistrerDocument($tIds[$i][0], UPLOAD_DIR, null, PHP_INT_MAX,
                            ["txt", "doc", "docx", "pdf", "zip", "rtf", "odt", "tex", "wks", "wps", "wpd"]);
                        $objBD->modifieEnregistrements("document",
                            "hyperLien='" . UPLOAD_DIR . "/" . $_FILES[$tIds[$i][0]]["name"] . "'", "id='" . $tIds[$i][0] . "'");
                    }
                }
            }
            $objBD->selectionneRow("Document", "*");
            $tDocs = ModelBinding::bindToClass($objBD->OK, "Document");
            return new JSONView($tDocs);
        }
    }
<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    require_once("Models/EditDocuments/SelectionDocuments.php");
    require_once("Models/EditDocuments/EnumEtatsDocument.php");
    require_once("Models/EditDocuments/DocumentsCoursSession.php");
    
    
    class EditDocumentsController extends ModuleAdminBase
    {
        function __construct() {
            parent::__construct();
        }
    
        function EditDocuments()
        {
            $intIDSession = post("ddlSession");
            $GLOBALS["titrePage"] = "Modification des documents de la session [...]";
            $model = null;
    
            if ($intIDSession) {
                $objBD = Mysql::getBD();
                $objBD->selectionneRow("Document", "*", "session='$intIDSession'");
                if ($objBD->OK) {
                    $tListeDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
                    $model = new DocumentsCoursSession($tListeDocuments, EnumEtatsDocuments::SUCCES, sizeof($tListeDocuments));
                } else
                    return new View ("500: Erreur Fatale", 500);
            } else
                $model = new DocumentsCoursSession(null, EnumEtatsDocuments::AUCUN_POST);
    
            return new View($model);
        }
    
        function SelectionSession()
        {
            $GLOBALS["titrePage"] = "Sélection d'un cours-session";
            $objBD = MYSQL::getBD();
            $objBD->selectionneRow("CoursSession");
            if ($objBD->OK)
                $tCoursSession = ModelBinding::bindToClass($objBD->OK, "CoursSession");
            else
                return new View("500: Erreur Fatale", 500);
    
            $objBD->selectionneRow("Document");
            if ($objBD->OK)
                $intNbDocuments = $objBD->OK->num_rows;
            else
                return new View("500: Erreur Fatale", 500);
    
            return new View(new SelectionDocumentModel($intNbDocuments, $tCoursSession));
        }
    }
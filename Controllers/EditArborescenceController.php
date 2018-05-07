<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:44 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditArborescenceController extends ModuleAdminBase {
        function __construct() {
            parent::__construct();
        }
        
        function EditArborescence() {
            $GLOBALS["titrePage"] = "Arborescence des documents";
            $objBD = Mysql::getBD();
            $objBD->selectionneRow("Document");
            if ($objBD->OK)
                $tCoursSession = ModelBinding::bindToClass($objBD->OK, "Document");
            else
                return new View("500: Erreur Fatale", 500);
            return new View($tCoursSession);
        }
        
        function Confirmer() {
            $GLOBALS["titrePage"] = "Nettoyage de l'arborescence";
            return new View();
        }
    }
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
    }
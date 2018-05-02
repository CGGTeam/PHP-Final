<?php
    
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 6:28 PM
     */
    class BDController extends ModuleAdminBase {


        function __construct() {
            require_once "Models/EditReferences/EnumEtatsReferences.php";
            require_once "Models/EditReferences/ReferencesModel.php";
            require_once "Utilitaires/ModelBinding.php";
            require_once "Utilitaires/View.php";
            require_once "Models/Donnees/Categorie.php";
            require_once "Models/Donnees/Cours.php";
            require_once "Models/Donnees/CoursSession.php";
            require_once "Models/Donnees/Document.php";
            require_once "Models/Donnees/Session.php";
            require_once "Models/Donnees/Utilisateur.php";
            parent::__construct();
        }


        function Confirmer() {
            log_fichier("test");
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
    
    
            for ($i = 0; $i < sizeof($tDonneesJson); $i++) {
                $sj = $tDonneesJson[$i];
                $etat = $sj["modelState"];
                //TODO: these unsets shouldn't be here
                //=======C A N C E R   Z O N E========
                if ($etat == ModelState::Added) {
                    unset($sj["id"]); //This can probably stay
                } else {
                    $sj["id"] = intval($sj["id"]);
                }
                unset($sj[37]);
                unset($sj["modelState"]);//this too
                unset($sj["undefined"]);
                //====================================
                /** @var ModelBinding $so */
                $so = new $strType($sj);
                $so->setModelState($etat);
                $so->saveChangesOnObj();
            }
    
            $tDonneesPHP = array();
    
            $objBD = mysql::getBD();
            $objBD->selectionneRow($strType);
            if ($objBD->OK)
                ModelBinding::bindToClass($objBD->OK, $strType);
            else {
                //http_response_code(500);
                return new View(500);
            }

            log_fichier("allo");
            return new JSONView(json_encode($tDonneesPHP));
        }
    }
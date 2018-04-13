<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditReferencesController extends ModuleAdminBase
    {
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
    
        function EditReferences()
        {
            $GLOBALS["titrePage"] = "Modification des tables de référence";
            return new View();
        }
    
        function Afficher()
        {
            $strType = post("btnType");
            $GLOBALS["titrePage"] = "Affichage des " . mb_strtolower($strType) . "s";
    
            if (!$strType) {
                return new View();
            }
            
            global $bd;
            $objRetour = $bd->selectionneRow($strType);
            $tDonnees = ModelBinding::bindToClass($objRetour, $strType);

            return new View(new ReferencesModel($tDonnees, $strType, EnumEtatsReferences::EDIT));
        }
    
        function Confirmer() {
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
    
            foreach ($tDonneesJson as $sj) {
                $etat = $sj["modelState"];
                //TODO: thess unsets shouldn't be here
                //=======C A N C E R   Z O N E========
                if ($etat == 0) {
                    unset($sj["id"]); //This can probably stay
                } else {
                    $sj["id"] = intval($sj["id"]);
                }
                unset($sj[37]);
                unset($sj["modelState"]);//this too
                unset($sj["undefined"]);
                //====================================
//                var_dump($sj);
                /** @var ModelBinding $so */
                $so = new $strType($sj);
                $so->setModelState($etat);
//                var_dump($so);
                $so->saveChangesOnObj();
            }
//            return new View(null, 'Views/EditReferences/AfficherView');
        }
    }
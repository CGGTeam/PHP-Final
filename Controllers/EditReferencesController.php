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
                //echo "test2";
                return new View();
            }
            
            global $bd;
            $objRetour = $bd->selectionneRow($strType);
            $tDonnees = ModelBinding::bindToClass($objRetour, $strType);
    
            return new View(new ReferencesModel($tDonnees, $strType, EnumEtatsReferences::EDIT));
        }
    
        function Confirmer() {
            $strType = post("strType");
            $strDonnees = file_get_contents('php://input');
            $tDonneesJson = json_decode($strDonnees, true);
        
            foreach ($tDonneesJson as $sj) {
                $so = ((new ReflectionClass($strType))->getConstructor())->invoke(null, $sj);
                $so->saveChangesOnObj();
            }
        
            $_POST["test"];
            header('Location: ?controller=EditReferences&action=Afficher');
            echo $strType;
            return new View("", 301);
        }
    }
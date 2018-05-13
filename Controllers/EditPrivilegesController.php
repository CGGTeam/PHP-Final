<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditPrivilegesController extends ModuleAdminBase {
        function __construct() {
            parent::__construct();
        }
        
        function EditPrivileges() {
            $GLOBALS["titrePage"] = "Modification des privilèges";
            $objBD = Mysql::getBD();
            $objBD->selectionneRow("CoursSession");
            if ($objBD->OK)
                $tCoursSession = ModelBinding::bindToClass($objBD->OK, "CoursSession");
            else
                return new View("500: Erreur Fatale", 500);
    
            $objBD->selectionneRow("Utilisateur");
            if ($objBD->OK)
                $tUtilisateurs = ModelBinding::bindToClass($objBD->OK, "Utilisateur");
    
            return new View(["CoursSession" => $tCoursSession, "Utilisateurs" => $tUtilisateurs]);
        }

        function Post()
        {
            $objBD = Mysql::getBD();
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
            foreach ($tDonneesJson as $obj) {
                $objBD->supprimeEnregistrements('courssession', "utilisateur = '" . $obj['id'] . "'");
                log_fichier($objBD->requete);
                foreach ($obj["tbCours"] as $cs) {
                    $cs["utilisateur"] = $obj["id"];
                    $tempo = new CoursSession($cs, true);
                    log_fichier($tempo);
                    $tempo->saveChangesOnObj();
                    log_fichier($objBD->requete);
                }
            }

            return $this->EditPrivileges();
        }
    }
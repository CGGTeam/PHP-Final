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
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
    
    
            for ($i = 0; $i < sizeof($tDonneesJson); $i++) {
                $sj = $tDonneesJson[$i];
                $intEtat = $sj["modelState"];
                /*
                if ($intEtat == ModelState::Added) {
                    unset($sj["id"]); //This can probably stay
                } else if(isset($sj["id"])){
                    $sj["id"] = intval($sj["id"]);
                }
                */
                unset($sj["modelState"]);//this too
    
                /** @var ModelBinding $so */
                $so = new $strType($sj);
                if (strtolower($strType) == "document") {
                    /**@var Document $so */
                    if ($intEtat == ModelState::Deleted) {
                        $so->setModelState(ModelState::Same);
                        $objBD = MySql::getBD();
                        $objBD->modifieEnregistrements("Document", "supprimer=1", "id='$so->id'");
                    }
                } else if (strtolower($strType) == "utilisateur" && $intEtat == ModelState::Deleted) {
                    /**@var Utilisateur $so */
                    if ($so->statutAdmin) {
                        $objBD = mysql::getBD();
                        $objBD->selectionneRow("utilisateur", "*", "statutAdmin=1");
                        if ($objBD->OK && $objBD->OK->num_rows == 1) {
                            $so->setModelState(ModelState::Same);
                        }
                    }
                } else
                    $so->setModelState($intEtat);

                log_fichier($so);
                $so->saveChangesOnObj();
            }
    
            $objBD = mysql::getBD();
    
            if ($strType == "Document")
                $strCondition = "supprimer = 0";
            $objBD->selectionneRow($strType, "*", $strCondition);
            if ($objBD->OK)
                $tDonneesPHP = ModelBinding::bindToClass($objBD->OK, $strType);
            else {
                return new View(500);
            }

            return new JSONView($tDonneesPHP);
        }
    
        /**
         * @return View
         */
        function Reset() {
            set_time_limit(60);
            
            if (file_exists(UPLOAD_DIR)) {
                $tDocuments = scandir(UPLOAD_DIR);
                $rexp = "/^..?$/";
                foreach ($tDocuments as $doc) {
                    if (!preg_match($rexp, $doc)) {
                        unlink(UPLOAD_DIR . "/" . $doc);
                    }
                }
                rmdir(UPLOAD_DIR);
            }
        
            $objBD = Mysql::getBD();
            //Nuke les tables
            $tNomsTables = ["courssession", "document", "cours", "session", "utilisateur", "categorie"];
            foreach ($tNomsTables as $table)
                $objBD->supprimeTable($table);
        
            //Reconstruction des structures de tables
            //categorie
            $objBD->creeTableGenerique("categorie",
                "V15,description", "description", true);
            //utilisateur
            $objBD->creeTableGenerique("utilisateur",
                "I,id;V25,nomUtilisateur;V15,motDePasse;B,statutAdmin;V30,nomComplet;V50,courriel",
                "id", true);
            $objBD->addConst("utilisateur", "UNIQUE(nomUtilisateur)", true);
            //session
            $objBD->creeTableGenerique("session",
                "V6,description;D,dateDebut;D,dateFin", "description", true);
            //cours
            $objBD->creeTableGenerique("cours",
                "V7,sigle;V50,titre", "sigle", true);
    
            //document
            $objBD->creeTableGenerique("document",
                "I,id;V6,session;V7,sigle;D,dateCours;J,noSequence;D,dateAccesDebut;" .
                "D,dateAccesFin;V100,titre;V255,description;J,nbPages;V15,categorie;J,noVersion;" .
                "D,dateVersion;V255,hyperLien;J,ajoutePar;B,supprimer", "id", true);
            $objBD->ajouteFKCasc("document", "session",
                "session", "description", true);
            $objBD->ajouteFKCasc("document", "sigle",
                "cours", "sigle", true);
            $objBD->ajouteFKNull("document", "categorie",
                "categorie", "description", true);
            $objBD->ajouteFKNull("document", "ajoutePar",
                "utilisateur", "id", true);
    
            $objBD->creeTableGenerique("courssession", "V6,session;V7,sigle;J,utilisateur",
                "session, sigle, utilisateur", true);
            $objBD->ajouteFKCasc("courssession", "sigle",
                "cours", "sigle", true);
            $objBD->ajouteFKCasc("courssession", "session",
                "session", "description", true);
            $objBD->ajouteFKCasc("courssession", "utilisateur",
                "utilisateur", "id", true);

    
            $objBD->requete = substr($objBD->requete, 0, strlen($objBD->requete) - 1);
            log_fichier($objBD->requete);
            $objBD->cBD->multi_query($objBD->requete);
    
            while ($objBD->cBD->more_results()) {
                $objBD->cBD->next_result();
            }
    
            $objBD->insereEnregistrement("utilisateur", "1", "admin", "admin", "1", "admin, admin", "admin@admin.com");
            $objBD->requete = "";
            if (!file_exists(UPLOAD_DIR))
                mkdir(UPLOAD_DIR);
            $tDocuments = scandir("./reset/televersements");
            $rexp = "/^..?$/";
            foreach ($tDocuments as $doc) {
                if (!preg_match($rexp, $doc)) {
                    copy("./reset/televersements/$doc", UPLOAD_DIR . "/$doc");
                }
            }
    
            $classes = ["categorie", "cours", "session", "utilisateur", "document", "courssession"];
    
            foreach ($classes as $c) {
                loadDonneesCSV($c);
            }
    
            session_destroy();
            return new View("");
        }
    }
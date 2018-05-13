<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    require_once("Models/EditGroupes/Champ.php");
    require_once("Models/EditGroupes/EnumRaisons.php");
    require_once("Utilitaires/ModelState.php");
    
    
    class EditGroupesController extends ModuleAdminBase
    {
        function __construct() {
            parent::__construct();
        }
    
        function EditGroupes() {
            $GLOBALS["titrePage"] = "Selection d'un CSV";
            return new View();
        }
    
        /**
         * Retourne modèle avec:
         * [
         *  "tDonnees" => un tableau d'objets Champ. Chaque objet contient une valeur string (à afficher) et un booléen
         *      qui indique si le champs est valide. à la fin de chaque rangée du tableau2D, il y a un objet Champ avec
         *      une valeur = à "OK" si les champs de la rangée sont valides et "PAS OK" sinon. Ce dernier est toujours
         *      considéré valide
         *  "binOK" => indique s'il y a eu une erreur de validation.
         * ]
         * @return View
         */
        function ValidationCSV() {
            $GLOBALS["titrePage"] = "Validation des données";
            $tRetour = array();
            $tSessions = array();
            $binOK = true;
        
            if (isset($_FILES["fichierCSV"])) {
                if (file_exists("permissions.csv")) {
                    unlink("permissions.csv");
                }
                enregistrerDocument("fichierCSV", "./temp", "permissions.csv",
                    PHP_INT_MAX, ["csv"]);
                $fp = fopen("./temp/permissions.csv", "r");
                for ($i = 0; !feof($fp); $i++) {
                    $tRetour[] = array();
                    $binVerdict = true;
                    $tChamps = fgetcsv($fp, 0, ";");
                
                    if ($tChamps[0]) { //NomUtilisateur
                        if (validerNomUtilisateur($tChamps[0], true, $raison))
                            $tRetour[$i][] = new Champ($tChamps[0], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[0], false, $raison);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false, EnumRaisons::ABSENT);
                    }
                
                    if ($tChamps[1]) { //MotDePasse
                        if (validerMotPasse($tChamps[1], $raison))
                            $tRetour[$i][] = new Champ($tChamps[1], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[1], false, $raison);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false, EnumRaisons::ABSENT);
                    }
                
                    if ($tChamps[2]) { //NomComplet
                        if (validerNomComplet($tChamps[2], $raison))
                            $tRetour[$i][] = new Champ($tChamps[2], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[2], false, $raison);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false, EnumRaisons::ABSENT);
                    }
                
                    if ($tChamps[3]) { //Courriel
                        if (validerAdresseCourriel($tChamps[3], $raison))
                            $tRetour[$i][] = new Champ($tChamps[3], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[3], false, $raison);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false, EnumRaisons::ABSENT);
                    }
        
                    $tdecompte = array_count_values($tChamps);
                    for ($j = 4; $j < sizeof($tChamps); $j++) { //Sigles
                        if ($tChamps[$j]) {
                            if (validerSigle($tChamps[$j], $raison))
                                $tRetour[$i][] = new Champ($tChamps[$j], true);
                            else {
                                $binVerdict = false;
                                $tRetour[$i][] = new Champ($tChamps[$j], false, $raison);
                            }
                            $tRetour[$i][$j]->raison = $tdecompte[$j] > 1 ? EnumRaisons::DOUBLON : $tRetour[$i][$j]->raison;
                        } else {
                            $tRetour[$i][] = new Champ("", true);
                        }
                    }
                    $binOK = $binVerdict ? $binVerdict : false;
                    $tRetour[$i][] = new Champ($binVerdict ? "OK" : "PAS OK", true);
                }
    
                $objBD = mysql::getBD();
                $objBD->selectionneRow("session");
                if ($objBD->OK)
                    $tSessions = ModelBinding::bindToClass($objBD->OK, "Session");
                else
                    $binOK = false;
            }
    
            return new View([
                "tDonnees" => $tRetour,
                "tSessions" => $tSessions,
                "binOK" => $binOK
            ]);
        }
    
        /**
         * retourne la même chose que ValidationCSV sauf que les rangées de tRetour ne contiennent que les informations
         * des sigles.
         * @return JSONView
         */
        function ValiderSession() {
            $GLOBALS["titrePage"] = "Validation des Cours-Sessions";
    
            $strSession = get("ddlSession");
            session_start();
            $_SESSION["sessionSelec"] = $strSession;
            $binOK = false;
            $tRetour = array();
        
            if (file_exists("./temp_upload/permissions.csv")) {
                $contenu = file_get_contents("./temp_upload/permissions.csv");
                $tcontenu = preg_split("/\r\n|\r|\n/", $contenu);
                $objBD = Mysql::getBD();
                for ($i = 1; $i < sizeof($tcontenu); $i++) {
                    $tRetour[] = array();
                    $binVerdict = true;
                    $tChamps = preg_split('/[\t;,\|\^]/g', $tcontenu[$i]);
                
                    for ($j = 4; $j < sizeof($tChamps); $j++) {
                        if ($tChamps[$j]) {
                            if ($objBD->OK && $objBD->OK->num_rows > 0) {
                                $tRetour[$i][] = new Champ($tChamps[$j], true);
                            } else {
                                $binVerdict = false;
                                $tRetour[$i][] = new Champ($tChamps[$j], false);
                            }
                        }
                    }
                    $binOK = $binVerdict ? $binVerdict : false;
                    $tRetour[$j][] = $binVerdict;
                }
            }
        
            return new JSONView([
                "tDonnees" => $tRetour,
                "binOK" => $binOK
            ]);
        }
        
        function Confirmer() {
            session_start();
            $strSession = $_SESSION["sessionSelec"];
            unset($_SESSION["sessionSelec"]);
        
            if (file_exists("./temp_upload/permissions.csv")) {
                $fp = fopen("./temp_upload/permissions.csv", "r");
                while (!feof($fp)) {
                    $tChamps = fgetcsv($fp, 0, ";");
                    $objUtil = new Utilisateur([
                        "nomUtilisateur" => $tChamps[0],
                        "motDePasse" => $tChamps[1],
                        "statutAdmin" => $tChamps[2] == "U" ? 0 : 1,
                        "nomComplet" => $tChamps[3],
                        "courriel" => $tChamps[4]
                    ]);
                    $objUtil->setModelState(ModelState::Added);
                    $objUtil->saveChangesOnObj();
    
                    for ($j = 4; $j < sizeof($tChamps); $j++) {
                        if ($tChamps[$j]) {
                            $objCoursSession = new CoursSession([
                                "session" => $strSession,
                                "sigle" => $tChamps[$j],
                                "utilisateur" => $objUtil->id
                            ]);
    
                            $objCoursSession->setModelState(ModelState::Added);
                            $objCoursSession->saveChangesOnObj();
                        }
                    }
                }
            }
            header('Location: ?controller=EditPrivileges&action=EditPrivileges');
            return new View("", 302);
        }
    }
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
    
    const TEMP_DIR = "./temp";
    const TEMP_FILE = "permissions.csv";
    
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
                if (!file_exists(TEMP_DIR))
                    mkdir(TEMP_DIR);
    
                if (file_exists(TEMP_DIR . "/" . TEMP_FILE))
                    unlink(TEMP_DIR . "/" . TEMP_FILE);
                enregistrerDocument("fichierCSV", TEMP_DIR, TEMP_FILE,
                        PHP_INT_MAX, ["csv"]);
                $fp = fopen(TEMP_DIR . "/" . TEMP_FILE, "r");
                fgetcsv($fp, 0, ";");
                $binErreur = false;
                for ($i = 0; !feof($fp) && !$binErreur; $i++) {
                    $tRetour[] = array();
                    $binVerdict = true;
                    $tChamps = fgetcsv($fp, 0, ";");
                    if (!$tChamps)
                        continue;
                    if (sizeof($tChamps) < 4) {
                        $binErreur = true;
                        continue;
                    }
    
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
                        $tRetour[$i][] = new Champ("", true);
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
                            $tRetour[$i][$j]->raison = $tdecompte[$tChamps[$j]] > 1 ? EnumRaisons::DOUBLON : $tRetour[$i][$j]->raison;
                            $tRetour[$i][$j]->valide = $tdecompte[$tChamps[$j]] > 1 ? false : $tRetour[$i][$j]->valide;
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
                "binOK" => $binOK,
                "binErreur" => !$binErreur
            ]);
        }
    
        /**
         * retourne la même chose que ValidationCSV sauf que les rangées de tRetour ne contiennent que les informations
         * des sigles.
         * @return JSONView
         */
        function ValiderSession() {
            $GLOBALS["titrePage"] = "Validation des Cours-Sessions";
    
            $strSession = post("ddlSession");
            $_SESSION["sessionSelec"] = $strSession;
            $binOK = false;
            $tRetour = array();
            if (file_exists(TEMP_DIR . "/" . TEMP_FILE)) {
                $objBD = Mysql::getBD();
                $fp = fopen(TEMP_DIR . "/" . TEMP_FILE, "r");
                fgetcsv($fp, 0, ";");
                for ($i = 1; !feof($fp); $i++) {
                    $tRetour[] = array();
                    $binVerdict = true;
                    $tChamps = fgetcsv($fp, 0, ";");
                    if (!$tChamps)
                        continue;
                    
                    for ($j = 4; $j < sizeof($tChamps); $j++) {
                        if ($tChamps[$j]) {
                            $rexpAdmin = "/^ADM-[AHE]\\d{2}$/";
    
                            if (!preg_match($rexpAdmin, $tChamps[$j])) {
                                $objBD->selectionneRow("Cours", "*", "sigle='$tChamps[$j]'");
                                if ($objBD->OK && $objBD->OK->num_rows > 0) {
                                    $tRetour[$i][] = new Champ($tChamps[$j], true);
                                } else {
                                    $binVerdict = false;
                                    $tRetour[$i][] = new Champ($tChamps[$j], false, EnumRaisons::BD_ABSENT);
                                }
                            } else {
                                $tRetour[$i][] = new Champ($tChamps[$j], true);
                            }
                        }
                    }
                    $binOK = $binVerdict ? $binVerdict : false;
                    $tRetour[$i][] = $binVerdict;
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
    
            if (file_exists(TEMP_DIR . "/" . TEMP_FILE)) {
                $fp = fopen(TEMP_DIR . "/" . TEMP_FILE, "r");
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
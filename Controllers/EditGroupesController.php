<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    require_once("Models/EditGroupes/Champ.php");
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
                enregistrerDocument("fichierCSV", "./temp", "permissions.csv",
                    PHP_INT_MAX, ["csv", "tsv"]);
                $tcontenu = preg_split("/\r\n|\r|\n/", file_get_contents($_FILES["fichierCSV"]["tmp_name"]));
                for ($i = 1; $i < sizeof($tcontenu); $i++) {
                    $tRetour[] = array();
                    $binVerdict = true;
                    $tChamps = preg_split('/[\t;,\|\^]/g', $tcontenu[$i]);
                
                    if ($tChamps[0]) { //NomUtilisateur
                        if (validerNomUtilisateur($tChamps[0]))
                            $tRetour[$i][] = new Champ($tChamps[0], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[0], false);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false);
                    }
                
                    if ($tChamps[1]) { //MotDePasse
                        if (validerMotPasse($tChamps[1]))
                            $tRetour[$i][] = new Champ($tChamps[1], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[1], false);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false);
                    }
                
                    if ($tChamps[2]) { //NomComplet
                        if (validerNomComplet($tChamps[2]))
                            $tRetour[$i][] = new Champ($tChamps[2], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[2], false);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false);
                    }
                
                    if ($tChamps[3]) { //Courriel
                        if (validerAdresseCourriel($tChamps[3]))
                            $tRetour[$i][] = new Champ($tChamps[3], true);
                        else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ($tChamps[3], false);
                        }
                    } else {
                        $binVerdict = false;
                        $tRetour[$i][] = new Champ("", false);
                    }
                
                    for ($j = 4; $j < sizeof($tChamps); $j++) { //Sigles
                        if ($tChamps[$j]) { //NomUtilisateur
                            if (validerSigle($tChamps[$j]))
                                $tRetour[$i][] = new Champ($tChamps[$j], true);
                            else {
                                $binVerdict = false;
                                $tRetour[$i][] = new Champ($tChamps[$j], false);
                            }
                        } else {
                            $binVerdict = false;
                            $tRetour[$i][] = new Champ("", false);
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
        function validerSession() {
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
    
        function confirmer() {
            session_start();
            $strSession = $_SESSION["sessionSelec"];
            unset($_SESSION["sessionSelec"]);
        
            if (file_exists("./temp_upload/permissions.csv")) {
                $contenu = file_get_contents("./temp_upload/permissions.csv");
                $tcontenu = preg_split("/\r\n|\r|\n/", $contenu);
                $objBD = Mysql::getBD();
                for ($i = 1; $i < sizeof($tcontenu); $i++) {
                    $tChamps = preg_split('/[\t;,\|\^]/g', $tcontenu[$i]);
                    $objBD->selectionneRow("Utilisateur", "id", "nomUtilisateur=$tChamps[0]");
                    $intId = intval($objBD->OK->fetch_row()[0]);
                
                    for ($j = 4; $j < sizeof($tChamps); $j++) {
                        if ($tChamps[$j]) {
                            $objCoursSession = new CoursSession([
                                "session" => $strSession,
                                "sigle" => $tChamps[$j],
                                "utilisateur" => $intId
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
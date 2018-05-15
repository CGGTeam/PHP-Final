<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:44 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    require_once("Models/EditArborescence/EditArborescenceModel.php");

    function fichiersSort($a, $b) {
        return intval($a->binDeleted) > intval($b->binDeleted);
    }

    class EditArborescenceController extends ModuleAdminBase {
        function __construct() {
            parent::__construct();
        }

        function EditArborescence() {
            $GLOBALS["titrePage"] = "Arborescence des documents";
            $objBD = Mysql::getBD();
            $objBD->selectionneRow("Document", "*", "supprimer=1", "session, sigle, titre ASC");
            if ($objBD->OK)
                $tDocuments = ModelBinding::bindToClass($objBD->OK, "Document");
            else
                return new View("500: Erreur Fatale", 500);
            return new View($tDocuments);
        }

        function ConfirmerSuppressionBD() {
            $GLOBALS["titrePage"] = "Confirmer suppression des documents";
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
            $tDocuments = $tDonneesJson;
            $tVerdicts = array();
            $verdict = true;
            $lastIndex = 0;
            $tRetour = array();

            try {
                for ($i = 0; $i < sizeof($tDocuments); $i++) {
                    $lastIndex = $i;
                    $sj = $tDocuments[$i];
                    $so = new Document($sj);
                    $so->saveChangesOnObj();
                    if (mysql::getBD()->OK) {
                        $so -> verdict = true;
                    } else {
                        $so -> verdict = false;
                    }
                    $tRetour[] = $so;
                }
            } catch (Exception $e) {
                $verdict = $e;
                return $verdict;
            }

            return new JSONView($tRetour);
        }

        function ConfirmerSuppressionFichiers() {
            $GLOBALS["titrePage"] = "Confirmer suppression des fichiers orphelins";
            //TODO: make const for upload dir

            $strDirTelev = "./televersements";
            $tFichiersTraites = array();
            $tFichiers = scandir($strDirTelev);
            if ($tFichiers) {
                foreach ($tFichiers as $nomFichier) {
                    if (!is_dir($nomFichier)) {
                        $fd = new FichierDoc($nomFichier, false);
                        $tFichiersTraites[] = $fd;
                        $objBd = Mysql::getBD();
                        $objBd->selectionneRow("Documents", "*", "hyperLien='$nomFichier'");
                        if ($objBd->OK && $objBd->OK->num_rows == 0) {
                            unlink($nomFichier);
                            $fd->binDeleted = true;
                        }
                    }
                }
            }

            usort($tFichiersTraites, "fichiersSort");

            return new View($tFichiersTraites);
        }
    }
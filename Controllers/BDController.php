<?php
    
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 6:28 PM
     */
    class BDController extends ModuleAdminBase {
        function Confirmer() {
            log_fichier("test");
            $strPOST = file_get_contents('php://input');
            $arSplit = explode("\n", $strPOST);
            $strType = $arSplit[0];
            $strDonnees = $arSplit[1];
            $tDonneesJson = json_decode($strDonnees, true);
            $tDonneesPHP = array();
            
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
                $tDonneesPHP[$i] = $so;
            }
            
            return json_encode($tDonneesPHP);
        }
    }
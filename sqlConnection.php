<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
$strNomBD="bdh18_boyer";
$strLocalHost = "localhost";

if(!isset($GLOBALS['BD'])) {
    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    $GLOBALS['BD'] = new mysql($strNomBD, $strInfosSensibles);
    $GLOBALS['BD']->connexion();
}
<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
$strNomBD="bdh18_boyer";
$strLocalHost = "localhost";

detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    /** - Connection à la base de données MySQL
     * @global mysqli $GLOBALS ['BD']
     * @name $BD
     */
$GLOBALS['BD'] = new mysql($strNomBD, $strInfosSensibles);
$GLOBALS['BD']->connexion();
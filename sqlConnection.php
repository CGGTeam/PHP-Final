<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
$strNomBD="bdh18_boyer";
$strLocalHost = "localhost";

    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    /** - Connection à la base de données MySQL
     * @global mysqli $bd
     */
    global $bd;
    $bd = new mysql($strNomBD, $strInfosSensibles);
    $bd->connexion();
<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
    $strNomBD = "bdh18_brassard_lahey";
$strLocalHost = "localhost";

    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    /** - Connection à la base de données MySQL
     */
    $bd = new mysql($strNomBD, $strInfosSensibles);
    $bd->connexion();
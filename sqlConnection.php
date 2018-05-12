<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
    $strNomBD = "pjf_papersensation";
$strLocalHost = "localhost";

    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    /** - Connection à la base de données MySQL
     */
    $bd = new mysql($strNomBD, $strInfosSensibles);
    $bd->connexion();
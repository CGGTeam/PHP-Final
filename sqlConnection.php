<?php
$strMonIP = "";
$strIPServeur = "";
$strNomServeur = "";
$strInfosSensibles = "";
$strNomBD="pjf_papersensation";
$strLocalHost = "localhost";

    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
    /** - Connection à la base de données MySQL
     * @global mysql $bd
     */
    global $bd;
    $bd = new mysql($strNomBD, $strInfosSensibles);
    $bd->connexion();
    var_dump($bd->selectionneRow('Utilisateur'));
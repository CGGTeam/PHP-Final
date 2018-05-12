<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-11
     * Time: 11:05 AM
     */
    
    /**
     * Gère le téléversement d'un fichier donné
     * @param string $strNomPost Nom du fichier dans le tableau $_FILES[]
     * @param string $strNomDossier Nom du dossier où sera entreposé le fichier
     * @param string $strNouveauNom Nouveau nom du fichier qui remplacera celui fourni durant le téleversement (inclut
     * extension)
     * @param int $grandeurMax Grandeur maximum (en bytes) permise du fichier
     * @param string[] $tTypesFichiers Tableau des extensions de fichier permises (en minuscules)
     */
    function enregistrerDocument($strNomPost, $strNomDossier, $strNouveauNom = null, $grandeurMax = PHP_INT_MAX, $tTypesFichiers = []) {
        $strNomFichier = $_FILES[$strNomPost]["name"];
        $strNomFichierTemp = $_FILES[$strNomPost]["tmp_name"];
        $strTypeFichier = strtolower($_FILES[$strNomPost]["type"]);
        $binTypeValide = sizeof($tTypesFichiers) == 0 || in_array($strTypeFichier, $tTypesFichiers);
        $intTaille = intval($_FILES["tbNomFichier"]["size"]);
        
        if (!$binTypeValide)
            exit ("Le fichier n'est pas d'un type valide");
        
        if ($intTaille > $grandeurMax)
            exit("La grandeur du fichier excède la limite de " . $grandeurMax);
        
        if (!is_uploaded_file($strNomFichierTemp))
            exit("Téléversement impossible...");
        
        if (!move_uploaded_file($strNomFichierTemp, $strNomDossier . "/" .
            ($strNouveauNom ? $strNomFichier : $strNomFichier)))
            exit("Impossible de copier le fichier '$strNomFichier' dans le dossier '$strNomDossier'");
    }
    
    function loadDonneesCSV($classe) {
        $objBD = mysql::getBD();
        $contenu = explode(";", file_get_contents("./reset/$classe.csv"));
        
        for ($i = 0; $i < sizeof($contenu); $i++) {
            if ($contenu[$i] == "") {
                unset($contenu[$i]);
            }
        }
        
        for ($i = 0; $i < sizeof($contenu); $i++) {
            $contenu[$i] = explode(",", trim($contenu[$i]));
            for ($j = 0; $j < sizeof($contenu[$i]); $j++) {
                $contenu[$i][$j] = trim($contenu[$i][$j]);
            }
        }
        
        $objBD->insereEnregistrementsTableau($classe, $contenu, true);
    }
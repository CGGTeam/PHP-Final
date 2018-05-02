<?php
    /**
     * Created by PhpStorm.
     * User: Simon Boyer
     * Date: 30/01/18
     * Time: 15:45
     */

    /**
     * AAAAMMJJ
     * (09-02-2018)
     * Retourne la date au format aaaa-mm-jj
     * @param string|int $strDateOuIntJour Date au format jj-mm-[aa]aa ou jour
     * @param int $intMois
     * @param int $intAnnee
     * @return string-
     */
    function AAAAMMJJ($strDateOuIntJour = null, $intMois = null, $intAnnee = null) {
        if ($strDateOuIntJour == null)
            $strDateOuIntJour = aujourdhui();
        if ($intMois == null) {
            extraitJJMMAAAAv2($strDateOuIntJour, $intMois, $intAnnee);
        }
        $intAnneeFinale = ($intAnnee > 999) ? $intAnnee
            : (($intAnnee > 20) ? 1900 + $intAnnee : 2000 + $intAnnee);

        return sprintf("%s-%s-%s", $intAnneeFinale, ajouteZeros($intMois, 2),
            ajouteZeros($strDateOuIntJour, 2));
    }
    
    function annee($strDate) {
        $intAnnee = null;
        $intDummy = null;
        extraitJJMMAAAAv2($intDummy, $intDummy, $intAnnee, $strDate);
        return $intAnnee;
    }

    /**
     * Retourne la date d'aujourd'hui
     * @param bool $binAAAAMMJJ format AAAA-mm-dd?
     * @return bool
     */
    function aujourdhui($binAAAAMMJJ = true) {
        return $binAAAAMMJJ ? date("Y-m-d") : date("d-m-Y");
    }

    /**
     * @param int $numValeur a afficher
     * @param int $intLargeur largeur
     * @return string
     */
    function ajouteZeros($numValeur, $intLargeur) {
        return sprintf("%'0$intLargeur" . "d", $numValeur);
    }


    /**
     * Retourne si l'annee est bissextile
     * @param int $intAnnee Année
     * @return bool
     */
    function bissextile($intAnnee) {
        return date("L", mktime(0, 0, 0, 1, 1, $intAnnee)) == 1;
    }

/*
|----------------------------------------------------------------------------------|
| chargeFichierEnMemoire() (2018-03-13)
| Réf.: http://php.net/manual/fr/function.count.php
|       http://ca.php.net/manual/fr/function.file.php
|       http://php.net/manual/fr/function.file-get-contents.php
|       http://ca.php.net/manual/fr/function.str-replace.php
|       http://php.net/manual/fr/function.strlen.php
|----------------------------------------------------------------------------------|
*/
function chargeFichierEnMemoire($strNomFichier,
                                &$tContenu, &$intNbLignes,
                                &$strContenu, &$intTaille,
                                &$strContenuHTML) {
    /* Récupère toutes les lignes et les entrepose dans un tableau
       Retrait de tous les CR et LF
       Récupère le nombre de lignes */
    $tContenu = file($strNomFichier);
    $tContenu = str_replace("\n", "", str_replace("\r", "", $tContenu));
    $intNbLignes = count($tContenu);

    /* Récupère toutes les lignes et les entrepose dans une chaîne */
    $strContenu = file_get_contents($strNomFichier);
    $intTaille = strlen($strContenu);

    /* Entrepose la chaîne résultante dans une autre après l'avoir XHTMLisé ! */
    $strContenuHTML = str_replace("\n\r", "<br />", str_replace("\r\n", "<br />", $strContenu));
}
/*
|----------------------------------------------------------------------------------|
| compteLignesFichier() (2018-03-13)
| Réf.: http://ca.php.net/manual/fr/function.count.php
|       http://ca.php.net/manual/fr/function.file.php
|----------------------------------------------------------------------------------|
*/
function compteLignesFichier($strNomFichier) {
    $intNbLignes = -1;
    if (fichierExiste($strNomFichier)) {
        $intNbLignes = count(file($strNomFichier));
    }
    return $intNbLignes;
}

/*
 |-----------------------------------------------------------------------------|
 | convertitSousChaineEnEntier (2018-01-29)
 |-----------------------------------------------------------------------------|
 */
    function convertitSousChaineEnEntier($strChaine, $intDepart, $intLongueur) {
    $intEntier = intval(substr($strChaine, $intDepart, $intLongueur));
    return $intEntier;
}





    /**
     * dateEnLitteral
     * (09-02-2018)
     * Renvoie la date en litteral, mettre "C" pour afficher le jour
     * @param string $strDate (optional) Defaut: Date courante
     * @param string $strJourSemaine (optionel) Mettre "C" pour afficher le jour
     * @return string
     */
    function dateEnLitteral($strDate = null, $strJourSemaine = null) {
        if ($strDate == null || strtoupper($strDate) == 'C') {
            if ($strDate == null)
                $strDate = aujourdhui();
            elseif ($strJourSemaine == null) {
                $strJourSemaine = 'C';
                $strDate = aujourdhui();
            } else {
                $strDate = $strJourSemaine;
                $strJourSemaine = 'C';
            }
        }
        $intJS = null;
        $intJ = null;
        $intA = null;
        $intM = null;
        extraitJSJJMMAAAAv2($intJS, $intJ, $intM, $intA, $strDate);
        if (strtoupper($strJourSemaine) == 'C')
            return sprintf('%s %s %s %d', jourSemaineEnLitteral($intJS, true), er($intJ), moisEnLitteral($intM), $intA);
        return sprintf('%s %s %d', er($intJ), moisEnLitteral($intM), $intA);

    }

    /**
     * dateValide
     * (09-02-2018)
     * Verifie si une date est valide
     * @param string $strDate
     * @return bool
     */
    function dateValide($strDate) {
        if ((preg_match("/\d{2}-\d{2}-\d{4}/", $strDate) == 1) ||
            (preg_match("/\d{4}-\d{2}-\d{2}/", $strDate) == 1)) {
            $intJ = null;
            $intM = null;
            $intA = null;
            $intJS = null;
            extraitJSJJMMAAAAv2($intJS, $intJ, $intM, $intA, $strDate);
            $result = checkdate($intM, $intJ, $intA);
        } else {
            $result = false;
        }

        return $result;
    }


/**
 * Decompose une URL et renvoi les parties par reference. Renvoi true si URL valide
 * @param $strURL
 * @param $strChemin
 * @param $strNom
 * @param $strSuffixe
 * @return bool
 */
    function decomposeURL($strURL, &$strChemin, &$strNom, &$strSuffixe){
        $tResults = [];
        if(preg_match('/^((?P<chemin>http:\/\/.+\/?)\/)?(?P<nom>\w+)\.(?P<suffixe>\w+)$/', $strURL, $tResults)){
            $strChemin = $tResults['chemin'] == '' ? '.' : $tResults['chemin'];
            $strNom = $tResults['nom'];
            $strSuffixe = $tResults['suffixe'];
            return true;
        }else{
            return false;
        }

    }

/*
|----------------------------------------------------------------------------------|
| detecteFinFichier() (2018-03-13)
| Réf.: http://php.net/manual/fr/function.feof.php
|----------------------------------------------------------------------------------|
*/
function detecteFinFichier($fp) {
    $binVerdict = true;
    if ($fp) {
        $binVerdict = feof($fp);
    }
    return $binVerdict;
}

/*
   |-------------------------------------------------------------------------------------|
   | detecteServeur (2017-03-18)
   |-------------------------------------------------------------------------------------|
   */
function detecteServeur(&$strMonIP, &$strIPServeur, &$strNomServeur, &$strInfosSensibles) {
    $strMonIP = $_SERVER["REMOTE_ADDR"];
    $strIPServeur = $_SERVER["SERVER_ADDR"];
    $strNomServeur = $_SERVER["SERVER_NAME"];
    $strInfosSensibles = str_replace(".", "-", $strNomServeur) . ".php";
}

    /**
     * dollar
     * (20-02-2018)
     * Retourne sous format monetaire
     * @param $fltMontant
     * @param int (optionnel) $intNbDecimales
     * @return string
     */
    function dollar($fltMontant, $intNbDecimales=2){
        return number_format(round($fltMontant, $intNbDecimales),2,","," ") . " $";
    }

    /**
     * dollarParentheses
     * (20-02-2018)
     * Retourne sous format monetaire et avec parenthese si negatif
     * @param $fltMontant
     * @param int (optionnel) $intNbDecimales
     * @return string
     */
    function dollarParentheses($fltMontant, $intNbDecimales=2){
        return ($fltMontant >= 0) ? number_format(round($fltMontant, $intNbDecimales, PHP_ROUND_HALF_DOWN),2,","," ") . " $"
            : "(" . number_format(round(abs($fltMontant), $intNbDecimales),2,","," ") . ") $";
    }

/**
 * @param $strChaine
 * @param $intLargeur
 * @return bool|string
 */
    function droite($strChaine, $intLargeur){
        return substr($strChaine,-$intLargeur);
    }



/*
|----------------------------------------------------------------------------------|
| ecritLigneDansFichier() (2018-03-13)
| Réf.: http://php.net/manual/fr/function.fputs.php
|       http://php.net/manual/fr/function.gettype.php
|----------------------------------------------------------------------------------|
*/
function ecritLigneDansFichier($fp, $strLigneCourante, $binSaut_intNbLignesSaut = false) {
    $binVerdict = fputs($fp, $strLigneCourante);
    if ($binVerdict) {
        switch (gettype($binSaut_intNbLignesSaut)) {
            case "integer" :
                for ($i=1; $i<=$binSaut_intNbLignesSaut && $binVerdict; $i++) {
                    $binVerdict = fputs($fp, "\r\n");
                }
                break;
            case "boolean" :
                if ($binSaut_intNbLignesSaut) {
                    $binVerdict = fputs($fp, "\r\n");
                }
        }
    }
    return $binVerdict;
}

/*
|----------------------------------------------------------------------------------|
| litLigneDansFichier() (2018-03-13)
| Réf.: http://ca.php.net/manual/fr/function.fgets.php
|       http://ca.php.net/manual/fr/function.str-replace.php
|----------------------------------------------------------------------------------|
*/
/**
 * Ecrit une chaine avec X nombres de </br>, 0 par defaut
 * @param $strChaine
 * @param int (optionnel) $intNbBR
 * @return string
 */
    function ecrit($strChaine, $intNbBR=0){
        echo $strChaine . str_repeat("<br/>", $intNbBR);
    }

    /*
     |-----------------------------------------------------------------------------|
     | er (2018-01-29)
     | Scénarions: er($intEntier)
     |             er($intEntier, $binExposant)
     |-----------------------------------------------------------------------------|
     */
    function er($intEntier, $binExposant = true)
    {
        return $intEntier . ($intEntier == 1 ? ($binExposant ? "<sup>er</sup>" : "er") : "");
    }

/**
 * Vrai si la valeur entree est numerique
 * @param $strValeur
 * @return false|int
 */
    function estNumerique($strValeur){
        return preg_match('/^\d+((\.|\,)\d+)?$/', $strValeur);
    }

/**
 * Store l'etat civil dans $strEtatCivil. Et retourne vrai si il est valide
 * @param $chrEtat
 * @param $chrSexe
 * @param $strEtatCivil
 * @return bool
 */
    function etatCivilValide($chrEtat, $chrSexe, &$strEtatCivil){
        switch (strtoupper($chrEtat)){
            case "C":
                $strEtatCivil = "Célibataire";
                break;
            case "F":
                $strEtatCivil = strtoupper($chrSexe) == "H" ? "Conjoint de fait" : "Conjointe de fait";
                break;
            case "M":
                $strEtatCivil = strtoupper($chrSexe) == "H" ? "Marié" : "Mariée";
                break;
            case "S":
                $strEtatCivil = strtoupper($chrSexe) == "H" ? "Séparé" : "Séparée";
                break;
            case "D":
                $strEtatCivil = strtoupper($chrSexe) == "H" ? "Divorcé" : "Divorcée";
                break;
            case "V":
                $strEtatCivil = strtoupper($chrSexe) == "H" ? "Veuf" : "Veuve";
                break;
            default:
                return false;
        }
        return true;
    }

    /*
 |-----------------------------------------------------------------------------|
 | extraitJJMMAAAA (2018-01-29)
 | Scénarios: extraitJJMMAAAA($intJour, $intMois, $intAnnee)            <= date()
 |            extraitJJMMAAAA($intJour, $intMois, $intAnnee, $strDate)  <= $strDate
 |-----------------------------------------------------------------------------|
 */
    function extraitJJMMAAAA(&$intJour, &$intMois, &$intAnnee)
    {
        if (func_num_args() == 3) {
            $strDate = date("d-m-Y");
        } else {
            $strDate = func_get_arg(3);
        }
        $intJour = intval(substr($strDate, 0, 2));
        $intMois = intval(substr($strDate, 3, 2));
        $intAnnee = intval(substr($strDate, 6, 4));
    }

    /*
     |-----------------------------------------------------------------------------|
     | extraitsJSJJMMAAAA (2018-01-29)
     | Scénarios: extraitJSJJMMAAAA($intJourSemaine, $intJour, $intMois, $intAnnee)
     |            extraitJSJJMMAAAA($intJourSemaine, $intJour, $intMois, $intAnnee, $strDate)
     |-----------------------------------------------------------------------------|
     */
    function extraitJSJJMMAAAA(&$intJourSemaine, &$intJour, &$intMois, &$intAnnee)
    {
        if (func_num_args() == 4) {
            $strDate = date("d-m-Y");
            $intJourSemaine = date("N");
        } else {
            $strDate = func_get_arg(4);
            $intJourSemaine = date("N", strtotime($strDate));
        }
        $intJour = intval(substr($strDate, 0, 2));
        $intMois = intval(substr($strDate, 3, 2));
        $intAnnee = intval(substr($strDate, 6, 4));
    }

    /**
     * extraitJSJJMMAAAAv2
     * (09-02-2018)
     * Extrait tous les elements d'une date sous forme string
     * @param $intJourSemaine
     * @param $intJour
     * @param $intMois
     * @param $intAnnee
     * @param string $strDate (optional)
     */
    function extraitJSJJMMAAAAv2(&$intJourSemaine, &$intJour, &$intMois, &$intAnnee, $strDate = null) {
        if (func_num_args() == 4) {
            $strDate = date("d-m-Y");
            $intJourSemaine = date("N");
        } else {
            $strDate = func_get_arg(4);
            $intJourSemaine = date("N", strtotime($strDate));
        }
        if (preg_match("/\d{2}-\d{2}-\d{4}/", $strDate)) {
            $intJour = intval(substr($strDate, 0, 2));
            $intMois = intval(substr($strDate, 3, 2));
            $intAnnee = intval(substr($strDate, 6, 4));
        } else {
            $intAnnee = intval(substr($strDate, 0, 4));
            $intMois = intval(substr($strDate, 5, 2));
            $intJour = intval(substr($strDate, 8, 2));
        }
    }

    /**
     * extraitJSlitteral
     * (22-02-2018)
     * Retourne le jour de la semaine de la date fournie en litteral
     * @param null $strDate
     * @param bool $binMajuscule
     * @return string
     */
    function extraitJSlitteral($strDate = null, $binMajuscule = false){
        if($strDate === null)
            $strDate = aujourdhui();

        $intJour = date('w', strtotime($strDate));
        return ($intJour == 0) ? jourSemaineEnLitteral(7, $binMajuscule)
            : jourSemaineEnLitteral($intJour, $binMajuscule);

    }

    /**
     * extraitJJMMAAAAv2
     * (09-02-2018)
     * Extrait tous les elements sauf le jour de la semaine d'une date sous forme string
     * @param $intJour
     * @param $intMois
     * @param $intAnnee
     * @param string $strDate (optional)
     */
    function extraitJJMMAAAAv2(&$intJour, &$intMois, &$intAnnee, $strDate = null) {
        if (func_num_args() == 3) {
            $strDate = date("d-m-Y");
        } else {
            $strDate = func_get_arg(3);
        }
        if (preg_match("/\d{2}-\d{2}-\d{4}/", $strDate)) {
            $intJour = intval(substr($strDate, 0, 2));
            $intMois = intval(substr($strDate, 3, 2));
            $intAnnee = intval(substr($strDate, 6, 4));
        } else {
            $intAnnee = intval(substr($strDate, 0, 4));
            $intMois = intval(substr($strDate, 5, 2));
            $intJour = intval(substr($strDate, 8, 2));
        }
    }

/*
|----------------------------------------------------------------------------------|
| fermeFichier() (2018-03-13)
| Réf.: http://ca.php.net/manual/fr/function.fclose.php
|----------------------------------------------------------------------------------|
*/
function fermeFichier($fp) {
    $binVerdict = false;
    if ($fp) {
        $binVerdict = fclose($fp);
    }
    return $binVerdict;
}
/*
|----------------------------------------------------------------------------------|
| fichierExiste() (2018-03-13)
| Réf.: http://ca.php.net/manual/fr/function.file-exists.php
|----------------------------------------------------------------------------------|
*/
function fichierExiste($strNomFichier) {
    return file_exists($strNomFichier);
}

    /**
     * fichierToTableau
     * (22-02-2018)
     * Retourne un tabeau representant un fichier avec des separateurs
     * @param resource $fichier
     * @param string $strSeparateur
     * @param null $decimalSeperator
     * @return array
     */
    function fichierToTableau($fichier, $strSeparateur, $decimalSeperator=null){
        $tCumulatif = [];
        while (! feof($fichier)){
            $strLigne = fgets($fichier);
            if($decimalSeperator !== null){
                $strLigne = str_replace($decimalSeperator, '.',$strLigne);
            }
            $tLigne = explode($strSeparateur,$strLigne);
            $tCumulatif[] = $tLigne;

        }

        rewind($fichier);
        return $tCumulatif;
    }

/**
 * Retourne chaine coupe a partir de la gauche
 * @param $strChaine
 * @param $intLongueur
 * @return bool|string
 */
    function gauche($strChaine, $intLongueur){
        return substr($strChaine, 0, $intLongueur);
    }



    /**
     * get
     * (09-02-2018)
     * Essaie de retourner valeur du parametre, sinon retourne null
     * @param string $strNomParametre
     * @return null|string
     */
    function get($strNomParametre) {
        return (isset($_GET[$strNomParametre]) ? $_GET[$strNomParametre] : null);
    }

    function hierOuDemain($date, $binDemain){
        $datetime = new DateTime($date);
        if($binDemain)
            $datetime->add(new DateInterval("P1D"));
        else
            $datetime->sub(new DateInterval("P1D"));
        return $datetime->format('Y-m-d');
    }

    /**
     * innerHTMLDomJavascript
     * (26-02-2018)
     * Change le innerHTML d'un element DOM
     * @param $id
     * @param $innerHTML
     */
    function innerHTMLDomJavascript($id, $innerHTML){
        echo '
<script>
    var x = document.getElementById(\'' . $id .'\');
    x.innerHTML = \''  . $innerHTML  . '\';
</script>
';
    }

    /**
     * input
     * (09-02-2018)
     * Genere une balise input
     * @param string $strID
     * @param string $strCLASS
     * @param string $strMAXLENGTH
     * @param string $strVALUE
     * @param bool $binECHO
     * @return string
     */
    function input($strID, $strCLASS, $strMAXLENGTH, $strVALUE, $binECHO = false) {
        $baliseFinal = sprintf('<input id="%1$s" name="%1$s"' .
            'class="%2$s" type="text" maxlength="%3$s" value="%4$s" />',
            $strID, $strCLASS, $strMAXLENGTH, $strVALUE);
        if (!$binECHO)
            return $baliseFinal;
        echo $baliseFinal;
    }

    /**
     * (2018-02-01)
     * Renvois la date entree en parametre au format JJ-MM-AAAA
     * @param int $intJour Jour
     * @param int $intMois Mois
     * @param int $intAnnee Annee
     * @return string
     */
    function JJMMAAAA($intJour, $intMois, $intAnnee) {
        $intAnneeFinale = ($intAnnee > 999) ? $intAnnee
            : (($intAnnee > 20) ? 1900 + $intAnnee : 2000 + $intAnnee);
        return ajouteZeros($intJour, 2) . "-" . ajouteZeros($intMois, 2) . "-" . $intAnneeFinale;
    }
    
    function jour($strDate) {
        $intJour = null;
        $intDummy = null;
        extraitJJMMAAAAv2($intJour, $intDummy, $intDummy, $strDate);
        return $intJour;
    }

    /*
     |-----------------------------------------------------------------------------|
     | jourSemaineEnLitteral (2018-01-29)
     | Scénarios: jourSemaineEnLitteral($intMois)                 <= Première lettre en minuscule
     |            jourSemaineEnLitteral($intMois, $binMajuscule)   <= En fonction de $binMajuscule
     |-----------------------------------------------------------------------------|
     */
    function jourSemaineEnLitteral($intNoJour, $binMajuscule = false) {
        $strJour = "N/A";
        switch ($intNoJour) {
            case 1 :
                $strJour = "lundi";
                break;
            case 2 :
                $strJour = "mardi";
                break;
            case 3 :
                $strJour = "mercredi";
                break;
            case 4 :
                $strJour = "jeudi";
                break;
            case 5 :
                $strJour = "vendredi";
                break;
            case 6 :
                $strJour = "samedi";
                break;
            case 7 :
                $strJour = "dimanche";
                break;
        }
        $strJour = $binMajuscule ? ucfirst($strJour) : $strJour;
        return $strJour;
    }

    /**
     * listeDeroulante
     * (16-02-2018)
     * Retourne la balise d'une liste deroulante
     * @param $strID
     * @param string $strAutreParams autres parametres
     * @param string[] $tContenu liste des elements
     * @param null|string $strReloadOnChange (facultatif) nom de l'id du form a reload
     * @param null|string $selected (facultatif) Element selectionne
     * @return string
     */
    function listeDeroulante($strID, $strAutreParams, $tContenu, $strReloadOnChange = null, $selected = null) {
        $baliseFinal = sprintf('<select id="%1$s" name="%1$s" %2$s
        %3$s>', $strID, $strAutreParams,
            ($strReloadOnChange === null ? '' :
                'onchange="document.getElementById(\'' . $strReloadOnChange . '\').submit();"'));

        if ($selected === null | $selected === '')
            $baliseFinal .= '<option value></option>';

        for ($i = 0; $i < count($tContenu); $i++) {
            $baliseFinal .= sprintf('<option value="%s" %s>%s</option>', $i + 1, ($selected == ($i + 1)) ? 'selected' : '', $tContenu[$i]);
        }

        return $baliseFinal . '</select>';
    }


function litLigneDansFichier($fp) {
    return str_replace("\n", "", str_replace("\r", "", fgets($fp)));
}

function log_js($obj){
    $contenu = is_string($obj) ? $obj : var_export($obj);
    echo "<script type='text/javascript'>console.log('$contenu');</script>";
}

function log_fichier($obj){
    $contenu = "\n\n-------------------------------------------------------\n"
        . date("Y/m/d h:i:sa") . "\n";
    $contenu .= is_string($obj) ? $obj : var_export($obj, true);
    file_put_contents('log.txt', $contenu, FILE_APPEND);
}

/**
 *
 * @param $strChaine
 * @return string
 */
    function majuscule($strChaine){
        return mb_strtoupper($strChaine);
    }

    function minuscule($strChaine){
        return mb_strtolower($strChaine);
    }

    function mois($strDate)
    {
        $intMois = null;
        $intDummy = null;
        extraitJJMMAAAAv2($intDummy, $intMois, $intDummy, $strDate);
        return $intMois;
    }

    /*
    |-----------------------------------------------------------------------------|
    | moisEnLitteral (2018-01-29)
    | Scénarios: moisEnLitteral($intMois)                 <= Première lettre en minuscule
    |            moisEnLitteral($intMois, $binMajuscule)   <= En fonction de $binMajuscule
    |-----------------------------------------------------------------------------|
    */
    function moisEnLitteral($intMois, $binMajuscule = false, $strDefaut = "N/A", $strMotApostrophe = null, $strLettreApostrophe = null) {
        $strMois = $strDefaut;
        $binVoyelle = false;
        switch ($intMois) {
            case 1 :
                $strMois = "janvier";
                break;
            case 2 :
                $strMois = "f&eacute;vrier";
                break;
            case 3 :
                $strMois = "mars";
                break;
            case 4 :
                $strMois = "avril";
                $binVoyelle = true;
                break;
            case 5 :
                $strMois = "mai";
                break;
            case 6 :
                $strMois = "juin";
                break;
            case 7 :
                $strMois = "juillet";
                break;
            case 8 :
                $strMois = "ao&ucirc;t";
                $binVoyelle = true;
                break;
            case 9 :
                $strMois = "septembre";
                break;
            case 10 :
                $strMois = "octobre";
                $binVoyelle = true;
                break;
            case 11:
                $strMois = "novembre";
                break;
            case 12 :
                $strMois = "d&eacute;cembre";
                break;
        }
        $strMois = $binMajuscule ? ucfirst($strMois) : $strMois;
        $strMois = $strMotApostrophe !== null && $strLettreApostrophe !== null && $binVoyelle
            ? $strMotApostrophe . "'" . $strMois : $strMotApostrophe . $strLettreApostrophe . " " . $strMois;
        return $strMois;
    }

    /**
     * Retourne le nombre de jours dans l'annee
     * @param int $intAnnee Année
     * @return int
     */
    function nombreJoursAnnee($intAnnee) {
        return bissextile($intAnnee) ? 366 : 365;
    }

    /**
     * nombreJoursEntreDeuxDates
     * (2/9/18)
     * Trouve le nombre de jours entre 2 dates
     * @param string $strDate1
     * @param string $strDate2
     * @return int
     */
    function nombreJoursEntreDeuxDates($strDate1, $strDate2) {

        return (strtotime($strDate2) - strtotime($strDate1)) / 60 / 60 / 24;

    }
    
    function nombreJoursMois($intMois, $intAnnee) {
        return date("t", mktime(0, 0, 0, $intMois, 1, $intAnnee));

    }


/*
|----------------------------------------------------------------------------------|
| ouvreFichier() (2018-03-13)
| Réf.: http://ca.php.net/manual/fr/function.fopen.php
|       http://ca.php.net/manual/fr/function.strtoupper.php
|----------------------------------------------------------------------------------|
*/
function ouvreFichier($strNomFichier, $strMode="L") {
    switch (strtoupper($strMode)) {
        case "A" :
        case "A" :
            $strMode = "a";
            break;
        case "E" :
        case "W" :
            $strMode = "w";
            break;
        case "L" :
        case "R" :
            $strMode = "r";
            break;
    }
    $fp = fopen($strNomFichier, $strMode);
    return $fp;
}

    /**
     * post
     * (09-02-2018)
     * Essaie de retourner valeur du parametre, sinon retourne null
     * @param string $strNomParametre
     * @return null|string
     */
    function post($strNomParametre) {
        return (isset($_POST[$strNomParametre]) ? $_POST[$strNomParametre] : null);
    }

    /**
     * pourcent
     * (22-02-2018)
     * Retoure le nombre en pourcentage
     * @param float $fltNombre
     * @return string
     */
    function pourcent($fltNombre){
        return $fltNombre . " %";
    }

    /** (09-02-2018)
     * Genere une balise sumbit
     * @param string $strID
     * @param string $strCLASS
     * @param string $strMAXLENGTH
     * @param string $strVALUE
     * @param bool $binECHO
     * @return string
     */
    function submitBalise($strID, $strCLASS, $strVALUE, $binECHO = false) {
        $baliseFinal = sprintf('<input id="%1$s" name="%1$s"' .
            'class="%2$s" type="submit" value="%3$s" />',
            $strID, $strCLASS, $strVALUE);
        if (!$binECHO)
            return $baliseFinal;
        echo $baliseFinal;
    }








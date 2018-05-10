<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-09
     * Time: 6:57 PM
     */
    
    /**
     * @param string $nomUtil nom d'utilisateur forme: pr.nom (en minuscules) 3 à 25 caractères
     * @return bool
     */
    function validerNomUtilisateur($nomUtil) {
        if ($nomUtil) {
            $rexp = "/^[a-z]{1-2}.[a-z]{1,13}$/";
            if (strlen($nomUtil) >= 3 && strlen($nomUtil) <= 25 && preg_match($rexp, $nomUtil) && strtolower($nomUtil) == $nomUtil) {
                $objBd = Mysql::getBD();
                $objBd->selectionneRow("Utilisateurs", "*", "nomUtilisateur='$nomUtil");
                return ($objBd->OK && $objBd->OK->num_rows > 0);
            } else
                return false;
        } else
            return false;
    }
    
    /**
     * @param string $motPasse mot de passe forme: 3 à 15 caractères; Lettres ou Chiffres; Minuscules != Majuscules
     * @return bool
     */
    function validerMotPasse($motPasse) {
        if ($motPasse) {
            $rexp = "/^[a-z0-9]{3,15}$/i";
            return preg_match($rexp, $motPasse) != false;
        } else
            return false;
    }
    
    /**
     * @param string $nomComplet Nom, Prénom; 5 à 30 caractères
     * @return bool
     */
    function validerNomComplet($nomComplet) {
        if ($nomComplet) {
            $rexp = "/^[a-z\- ]+, [a-z\- ]+$/i";
            return preg_match($rexp, $nomComplet) != false;
        } else
            return false;
    }
    
    /**
     * @param string $courriel thing[atsing]thing.thing
     * @return bool
     */
    function validerAdresseCourriel($courriel) {
        if ($courriel) {
            $rexp = "/\w+\@\w+\.\w+/i";
            return (preg_match($rexp, $courriel) && strlen($courriel) >= 10 && strlen($courriel) <= 50);
        } else
            return false;
    }
    
    /**
     * @param $categorie 3 à 15 caractères
     * @return bool
     */
    function validerCategorie($categorie) {
        if ($categorie) {
            return $categorie >= 3 && $categorie <= 15;
        } else
            return false;
    }
    
    /**
     * @param string $session Exactement 6 caractères; [AHE]-Année
     * @return bool
     */
    function validerSession($session) {
        if ($session) {
            $rexp = "/[AHE]-\d{4}/";
            if (preg_match($rexp, $session)) {
                $annee = intval(substr($session, 2));
                return $annee >= 2018 && $annee <= 2021;
            } else
                return false;
        } else
            return false;
    }
    
    /**
     * Valider la date de début ou de fin de session
     * @param string $date aaaa-mm-jj (entre 2018 et 2021)
     * @return bool
     */
    function validerDateSession($date) {
        if ($date) {
            if (preg_match("/\d{2}-\d{2}-\d{4}/", $date) && dateValide($date)) {
                $annee = annee($date);
                return $annee >= 2018 && $annee <= 2021;
            } else
                return false;
        } else
            return false;
    }
    
    /**
     * @param $titre 5 à 50 caractère
     * @return bool
     */
    function validerTitreCours($titre) {
        return $titre && strlen($titre) > 5 && strlen($titre);
    }
    
    
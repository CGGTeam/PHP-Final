<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-09
     * Time: 6:57 PM
     */
    require_once "Models/EditGroupes/EnumRaisons.php";
    /**
     * @param string $nomUtil nom d'utilisateur forme: pr.nom (en minuscules) 3 à 25 caractères
     * @return bool
     */
    function validerNomUtilisateur($nomUtil, $binCheckBD = false, &$raison=null) {
        if ($nomUtil) {
            $rexp = "/^[a-z]{1,2}.[a-z]{1,13}$/";
            if (strlen($nomUtil) >= 3 && strlen($nomUtil) <= 25 && preg_match($rexp, $nomUtil) && strtolower($nomUtil) == $nomUtil) {
                if ($binCheckBD) {
                    $objBd = Mysql::getBD();
                    $objBd->selectionneRow("Utilisateurs", "*", "nomUtilisateur='$nomUtil");
                    $raison = $objBd->OK && $objBd->OK->num_rows == 0 ? EnumRaisons::VALIDE : EnumRaisons::BD_COLLISION;
                    return $objBd->OK && $objBd->OK->num_rows == 0;
                } else {
                    return true;
                }
            } else {
                $raison = EnumRaisons::INVALIDE;
                return false;
            }
        } else {
            $raison = EnumRaisons::ABSENT;
            return false;
        }
    }
    
    /**
     * @param string $motPasse mot de passe forme: 3 à 15 caractères; Lettres ou Chiffres; Minuscules != Majuscules
     * @return bool
     */
    function validerMotPasse($motPasse, &$raison = null) {
        if ($motPasse) {
            $rexp = "/^[a-z0-9]{3,15}$/i";
            $raison = preg_match($rexp, $motPasse) != false ? EnumRaisons::VALIDE : EnumRaisons::INVALIDE;
            return preg_match($rexp, $motPasse) != false;
        } else {
            $raison = EnumRaisons::ABSENT;
            return false;
        }
    }
    
    /**
     * @param string $nomComplet Nom, Prénom; 5 à 30 caractères
     * @return bool
     */
    function validerNomComplet($nomComplet, &$raison = null) {
        if ($nomComplet) {
            $rexp = "/^[a-z\- ]+, [a-z\- ]+$/i";
            $raison = preg_match($rexp, $nomComplet) != false ? EnumRaisons::VALIDE : EnumRaisons::INVALIDE;
            return preg_match($rexp, $nomComplet) != false;
        } else {
            $raison = EnumRaisons::ABSENT;
            return false;
        }
    }
    
    /**
     * @param string $courriel thing[atsing]thing.thing
     * @return bool
     */
    function validerAdresseCourriel($courriel, &$raison = null) {
        if ($courriel) {
            $rexp = "/^[a-z0-9.\-_]+\@\w+\.\w+$/i";
            $raison = preg_match($rexp, $nomComplet) != false ? EnumRaisons::VALIDE : EnumRaisons::INVALIDE;
            return (preg_match($rexp, $courriel) && strlen($courriel) >= 10 && strlen($courriel) <= 50);
        } else {
            $raison = EnumRaisons::ABSENT;
            return false;
        }
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
            if (preg_match("/^\d{2}-\d{2}-\d{4}$/", $date) && dateValide($date)) {
                $annee = annee($date);
                return $annee >= 2018 && $annee <= 2021;
            } else
                return false;
        } else
            return false;
    }
    
    /**
     * @param string $titre 5 à 50 caractère
     * @return bool
     */
    function validerTitreCours($titre) {
        return $titre && strlen($titre) > 5 && strlen($titre);
    }
    
    /**
     * @param string $sigle
     * @return bool
     */
    function validerSigle($sigle, &$raison = null) {
        if ($sigle) {
            $rexpSigle = "/^\d{1,3}-[A-Z0-9]$/";
            $rexpAdmin = "/^ADM-[AHE]\d{2}$/";
            if (preg_match($rexpSigle, $sigle)) {
                $raison = EnumRaisons::VALIDE;
                return true;
            }
            else if (preg_match($rexpAdmin, $sigle)) {
                $annee = intval(substr($sigle, 5));
                $raison = $annee >= 18 && $annee <= 21 ? EnumRaisons::VALIDE : EnumRaisons::INVALIDE;
                return $annee >= 18 && $annee <= 21;
            } else {
                EnumRaisons::INVALIDE;
                return false;
            }
        } else {
            $raison = EnumRaisons::ABSENT;
            return false;
        }
    }
    
    /**
     * Vérifie si une variable est un string et si sa longueur est incluse dans l'intervalle spécifiée
     * @param string $string valeur string à valider
     * @param int $intMin longueur minimale du string (inclus)
     * @param int $intMax longueur maximale du string (inclus)
     * @return bool valide ou non
     */
    function validerString($string, $intMin, $intMax) {
        if (is_string($string)) {
            $long = strlen($string);
            return $long >= $intMin && $long <= $intMax;
        } else
            return false;
    }
    
    /**
     * Vérifie si une variable est un int si elle est inclus dans l'intervalle spécifiée
     * @param int $int valeur int à valider
     * @param int $intMin valeur minimale du int (inclus)
     * @param int $intMax valeur maximale du int (inclus)
     * @return bool valide ou non
     */
    function validerInt($int, $intMin = PHP_INT_MIN, $intMax = PHP_INT_MAX) {
        if (is_int($int)) {
            return $int >= $intMin && $int <= $intMax;
        } else
            return false;
    }
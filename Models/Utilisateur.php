<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:49 AM
     */
    
    /**
     * Class Utilisateur modèle qui représente l'utilisateur
     */
    class Utilisateur
    {
        public $nomUtilisateur;
        public $motDePasse;
        public $statutAdmin;
        public $nomComplet;
        public $courriel;
    
        /**
         * Utilisateur constructor.
         * @param string $strNomUtilisateur - Identifiant pour connexion
         * @param string $strMotDePasse - Mot de passe pour connexion
         * @param boolean $binStatutAdmin - true=Administrateur; false=Utilisateur
         * @param string $strNomComplet - Nom et prénom de l’utilisateur
         * @param string $strCourriel - Adresse de courriel permettant à l’utilisateur de
         *                              récupérer son mot de passe à partir de son nom
         *                              d’utilisateur (saisie par l’administrateur).
         */
        function __construct($strNomUtilisateur, $strMotDePasse, $binStatutAdmin, $strNomComplet, $strCourriel) {
            $this->nomUtilisateur = $strNomUtilisateur;
            $this->motDePasse = $strMotDePasse;
            $this->statutAdmin = $binStatutAdmin;
            $this->nomComplet = $strNomComplet;
            $this->courriel = $strCourriel;
        }
    }
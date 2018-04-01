<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:27 AM
     */
    
    /**
     * Class Document - Modèle qui représente un document
     */
    class Document
    {
        public $session;
        public $sigle;
        public $dateCours;
        public $noSequence;
        public $dateAccesDebut;
        public $dateAccesFin;
        public $titre;
        public $description;
        public $nbPages;
        public $categorie;
        public $noVersion;
        public $dateVersion;
        public $hyperLien;
        public $ajoutePar;
    
        /**
         * Document constructor.
         * @param string $strSession - No de la session (A-2099; H-2018 à A-2021)
         * @param string $strSigle - Sigle du cours (999-ZZZ; ADM-A99)
         * @param DateTime | string $dtDateCours - Date de remise du document
         * @param int $intNoSequence - No de séquence dans le cours
         * @param DateTime | string $dtDateAccesDebut - Date de début d’accessibilité
         * @param DateTime | string $dtDateAccesFin - Date de fin d’accessibilité
         * @param string $strTitre - Titre du document
         * @param string $strDescription - Description du document
         * @param int $intNbPages - Nombre de pages
         * @param string $strCategorie - Catégorie du document
         * @param int $intNoVersion - Numéro de la version
         * @param DateTime | string $dtDateVersion - Date de la dernière version
         * @param string $strHyperLien - Nom du document
         * @param int $intAjoutePar - No de l’administrateur ayant effectué l’ajout (1
         */
        function __construct($strSession, $strSigle, $dtDateCours, $intNoSequence, $dtDateAccesDebut, $dtDateAccesFin,
                 $strTitre, $strDescription, $intNbPages, $strCategorie, $intNoVersion, $dtDateVersion, $strHyperLien,
                 $intAjoutePar) {
            $this->session = $strSession;
            $this->sigle = $strSigle;
            $this->dateCours = $dtDateCours;
            $this->noSequence = $intNoSequence;
            $this->dateAccesDebut = $dtDateAccesDebut;
            $this->dateAccesFin = $dtDateAccesFin;
            $this->titre = $strTitre;
            $this->description = $strDescription;
            $this->nbPages = $intNbPages;
            $this->categorie = $strCategorie;
            $this->noVersion = $intNoVersion;
            $this->dateVersion = $dtDateVersion;
            $this->hyperLien = $strHyperLien;
            $this->ajoutePar = $intAjoutePar;
        }
    }
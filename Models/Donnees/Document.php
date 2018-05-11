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
    class Document extends ModelBinding {
        /** @var int $id */
        public $id;
        /** @var string $session No de la session (A-2099; H-2018 à A-2021) */
        public $session;
        /** @var string $sigle Sigle du cours (999-ZZZ; ADM-A99) */
        public $sigle;
        /** @var string $dateCours Date de remise du document */
        public $dateCours;
        /** @var int $noSequence No de séquence dans le cours */
        public $noSequence;
        /** @var string $dateAccesDebut Date de début d’accessibilité */
        public $dateAccesDebut;
        /** @var string $dateAccesFin Date de fin d’accessibilité */
        public $dateAccesFin;
        /** @var string $titre Titre du document */
        public $titre;
        /** @var string $description Description du document */
        public $description;
        /** @var int $nbPages Nombre de pages */
        public $nbPages;
        /** @var string $categorie Catégorie du document */
        public $categorie;
        /** @var int $noVersion Numéro de la version */
        public $noVersion;
        /** @var string $dateVersion Date de la dernière version */
        public $dateVersion;
        /** @var string $hyperLien Nom du document ex: 25-projet-fin-session-2018-03-23.pdf */
        public $hyperLien;
        /** @var int $ajoutePar No de l’administrateur ayant effectué l’ajout */
        public $ajoutePar;
        /** @var bool $supprimer */
        public $supprimer;
    
        public function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties, $binAjout);
        }
        
        public function valider() {
            //TODO: valider si entre début et fin de session
            try {
                $binValide = validerSession($this->session) && validerSigle($this->sigle)
                    && validerDateSession($this->dateCours)
                    && validerInt(intval($this->noSequence), 1, 20)
                    && validerDateSession($this->dateAccesDebut) && validerDateSession($this->dateAccesFin)
                    && validerString($this->titre, 5, 100)
                    && validerString($this->description, 5, 255)
                    && validerInt(intval($this->nbPages), 1, 999)
                    && validerString(strval($this->categorie), 3, 15)
                    && validerInt(intval($this->noVersion), 1, 99)
                    && dateValide($this->dateVersion)
                    && validerInt(intval($this->ajoutePar), 1)
                    && (is_null($this->supprimer) || is_bool($this->supprimer));
            } catch (Exception $e) {
                $binValide = false;
            }
            if (!$binValide)
                $this->setModelState(ModelState::Invalid);
            return $binValide;
        }
    }
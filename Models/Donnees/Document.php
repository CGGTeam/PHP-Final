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
    class Document extends ModelBinding
    {
        public $id;
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
    
        public function __construct(array $properties = array(), $binAjout = false)
        {
            parent::__construct($properties, $binAjout);
        }
    }